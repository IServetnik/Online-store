<?php

namespace App\Services;

use App\Repositories\ProductRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Product as Model;
use App\Exceptions\ProductException as Exception;
use App\Filters\ProductFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

class ProductService
{        
    private $repository;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = app(Repository::class);
    }
      




    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (!$this->checkType($data['category_name'], $data['type_name'])) throw new Exception('Incorrect type');
        if (!$this->checkSizes($data['sizes'])) throw new Exception("Size or color names are not unique");
        if (!$this->checkName($data['name'])) throw new Exception("The name has already been taken.");
        if (!$this->checkFile($data['image'])) throw new Exception("The file must be an image.");

        $result = Model::create($data);
        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $name
     * @return void
     */
    public function update(Request $request, $name)
    {
        $data = $request->all();

        if (!$this->checkType($data['category_name'], $data['type_name'])) throw new Exception('Incorrect type');
        if (!$this->checkSizes($data['sizes'])) throw new Exception("Size or color names are not unique");
        if (!$this->checkName($data['name'], $name)) throw new Exception("The name has already been taken.");
        if ($data['image']) {
            if (!$this->checkFile($data['image'])) throw new Exception("The file must be an image.");
        }

        $product = $this->getByName($name);
        if ($data['price'] != $product->price) $data['old_price'] = $product->price;

        $result = $product->update($data);
        if(!$result) throw new Exception("Something went wrong");
        
        return $result;
    }
    
    /**
     * destroy
     *
     * @param  mixed $name
     * @return void
     */
    public function destroy(string $name)
    {
        $product = $this->repository->getByName($name);

        $result = $product->delete();
        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }
    
    /**
     * show
     *
     * @param  mixed $name
     * @return void
     */
    public function show(string $name)
    {
        $product = $this->getByName($name);
        if(!$product) abort(404);

        return $product;
    }

    /**
     * edit
     *
     * @param  mixed $name
     * @return void
     */
    public function edit(string $name)
    {
        $product = $this->getByName($name);
        if(!$product) abort(404);
        
        return $product;
    }





    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $products = $this->repository->getAll();

        return $products;
    }

    /**
     * getAllWithPaginate
     *
     * @param  mixed $paginationCount
     * 
     * @return void
     */
    public function getAllWithPaginate($paginationCount = null)
    {
        $products = $this->repository->getAllWithPaginate($paginationCount);
        $this->checkPagination($products);

        return $products;
    }
        
    /**
     * getByCategory
     *
     * @param  mixed $category_name
     * @param  mixed $paginationCount
     * @return void
     */
    public function getByCategory(string $category_name, $paginationCount = null)
    {
        $products = $this->repository->getByCategory($category_name, $paginationCount);
        $this->checkPagination($products);

        return $products;
    }
   
    /**
     * getByType
     *
     * @param  mixed $type_name
     * @return void
     */
    public function getByType(string $type_name)
    {
        $products = $this->repository->getByType($type_name);

        return $products;
    }

    /**
     * getByCategoryAndType
     *
     * @param  mixed $category
     * @param  mixed $type_name
     * @param  mixed $paginationCount
     * @return void
     */
    public function getByCategoryAndType(string $category_name, string $type_name, $paginationCount = null)
    {
        if (!$this->checkType($category_name, $type_name)) abort(404);

        $products = $this->repository->getByCategoryAndType($category_name, $type_name, $paginationCount);
        $this->checkPagination($products);

        return $products;
    }

    /**
     * getById
     *
     * @param  mixed $id
     * @return void
     */
    public function getById(string $id)
    {
        $products = $this->repository->getById($id);
        return $products;
    }
        
    /**
     * getByName
     *
     * @param  string $name
     * @return void
     */
    public function getByName(string $name)
    {
        $product = $this->repository->getByName($name);
        return $product;
    }
 
    /**
     * getWhere
     *
     * @param  mixed $where
     * @param  mixed $paginationCount
     * @return void
     */
    public function getWhere(array $where, $paginationCount = null)
    {
        $products = $this->repository->getWhere($where, $paginationCount);
        $this->checkPagination($products);

        return $products;
    }
       
    /**
     * getByFilter
     *
     * @param  mixed $filters
     * @param  mixed $paginationCount
     * @return void
     */
    public function getByFilter($filters, $paginationCount = null)
    {
        $filter = app(ProductFilter::class);
        $products = $filter->apply($filters, $paginationCount);
        $this->checkPagination($products);

        return $products;
    }

    



    /**
     * checkType
     *
     * @param  mixed $category_name
     * @param  mixed $type_name
     * @return void
     */
    public function checkType(string $category_name, string $type_name)
    {
        $typeService = app(TypeService::class);
        $type = $typeService->getByCategoryAndName($category_name, $type_name);

        $result = ($type !== null) ? true : false;
        return $result;
    }
        
    /**
     * checkSizes
     *
     * @param  mixed $sizes
     * @return void
     */
    public function checkSizes(array $sizes)
    {
        //if the size ids are unique
        $sizeNames= array_map('strtolower', array_column($sizes, 'name'));
        if(count($sizeNames) !== count(array_unique($sizeNames))) return false;

        //check the color names
        foreach($sizes as $size) {
            $names = array_map('strtolower', array_column($size['colors'], 'name'));
            if(count($names) !== count(array_unique($names))) return false;
        }

        return true;
    }

    /**
     * checkName
     *
     * @param  mixed $newName
     * @param  mixed $oldName
     * @return void
     */
    public function checkName(string $newName, string $oldName = null)
    {
        $newName = strtolower($newName);
        $oldName = strtolower($oldName);

        if ($newName === $oldName) return true;

        $products = $this->getByName($newName);
        if (empty($products)) return true;

        return false;
    }
    
    /**
     * checkPagination
     *
     * @param  mixed $paginator
     * @param  mixed $paginationCount
     * @return void
     */
    public function checkPagination(LengthAwarePaginator $paginator)
    {
        $pageNumber = request()->input('page');
        if($pageNumber !== null) {
            if($pageNumber > $paginator->lastPage()) {
                return redirect(\URL::current().'?page=' . $paginator->lastPage())->send();
            }
        }
    }
    
    /**
     * checkFile
     *
     * @param  mixed $file
     * @return void
     */
    public function checkFile(UploadedFile $file)
    {
        $fileExtension = $file->getClientOriginalExtension();
        $allowedExtensions = ['png', 'jpg', 'jpeg'];

        if(array_search($fileExtension, $allowedExtensions) !== null) {
            return true;
        } else {
            return false;
        }
    }
}