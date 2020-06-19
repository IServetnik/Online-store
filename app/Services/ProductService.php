<?php

namespace App\Services;

use App\Repositories\ProductRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Product as Model;
use App\Exceptions\ProductException;
use App\Filters\ProductFilter;

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
        $data = array_map('strtolower', $request->all());

        if (!$this->checkType($data['category_name'], $data['type_name'])) throw new ProductException('Incorrect type');
        if (!$this->checkName($data['name'])) throw new ProductException("Name is not unique");

        $result = Model::create($data);
        if(!$result) throw new ProductException("Something went wrong");

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
        $data = array_map('strtolower', $request->all());
        
        if (!$this->checkType($data['category_name'], $data['type_name'])) throw new ProductException('Incorrect type');
        if (!$this->checkName($data['name'], $name)) throw new ProductException("Name is not unique");

        $product = $this->getByName($name);
        if ($data['price'] != $product->price) $data['old_price'] = $product->price;

        $result = $product->update($data);

        if(!$result) throw new ProductException("Something went wrong");
        
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
        if(!$result) throw new ProductException("Something went wrong");

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
     * getByCategory
     *
     * @param  mixed $category
     * @return void
     */
    public function getByCategoryName(string $category_name)
    {
        $products = $this->repository->getByCategoryName($category_name);
        return $products;
    }

    /**
     * getByCategory
     *
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
     * @return void
     */
    public function getByCategoryAndType(string $category_name, string $type_name)
    {
        //check if this type of clothing exists in this category
        if (!$this->checkType($category_name, $type_name)) abort(404);

        $products = $this->repository->getByCategoryAndType($category_name, $type_name);
        
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
     * @return void
     */
    public function getWhere(array $where)
    {
        $products = $this->repository->getWhere($where);
        return $products;
    }
    
    /**
     * getByFilter
     *
     * @param  mixed $filters
     * @return void
     */
    public function getByFilter($filters)
    {
        $filter = app(ProductFilter::class);
        $products = $filter->apply($filters);

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
        $categoryService = app(CategoryService::class);
        $category = $categoryService->getByName($category_name);

        $types = $category->types;
        $types->transform(function ($item, $key) {return strtolower($item->name);});

        //check if this type of clothing exists
        $result = ($types->search(strtolower($type_name)) !== false);

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
}