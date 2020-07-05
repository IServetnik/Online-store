<?php

namespace App\Services;

use App\Repositories\ProductRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Product as Model;
use App\Exceptions\ProductException as Exception;
use App\Filters\ProductFilter;
use Illuminate\Pagination\LengthAwarePaginator;

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
        if (!$this->checkName($data['name'])) throw new Exception("Name is not unique");

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
        if (!$this->checkName($data['name'], $name)) throw new Exception("Name is not unique");

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

        //delete reviews
        $reviewService = app(ReviewService::class);
        $reviews = $reviewService->getByProduct($product->id);

        $reviews->each(function ($item, $key) {
            $item->delete();
        });

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
     * @param  mixed $paginationCount
     * 
     * @return void
     */
    public function getAll($paginationCount = null)
    {
        $products = $this->repository->getAll($paginationCount);
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
     * getByCategory
     * 
     * @param  mixed $paginationCount
     * 
     * @return void
     */
    public function getByType(string $type_name, $paginationCount = null)
    {
        $products = $this->repository->getByType($type_name, $paginationCount);
        $this->checkPagination($products);

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
}