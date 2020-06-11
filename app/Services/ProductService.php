<?php

namespace App\Services;

use App\Repositories\ProductRepository as Repository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Models\Product as Model;

class ProductService
{        
    private $repository;
    private $categoryRepository;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository = app(Repository::class);
        $this->categoryRepository = app(CategoryRepository::class);
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
        $result = Model::create($data);
        return $result;
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
    public function getByType($type)
    {
        $products = $this->repository->getByType($type);
        return $products;
    }

    /**
     * getByCategoryAndType
     *
     * @param  mixed $category
     * @param  mixed $type
     * @return void
     */
    public function getByCategoryNameAndType(string $category_name, string $type)
    {
        //check if this type of clothing exists in this category
        if (!$this->checkType($category_name, $type)) abort(404);

        $products = $this->repository->getByCategoryNameAndType($category_name, $type);
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
     * checkType
     *
     * @param  mixed $category_name
     * @param  mixed $type
     * @return void
     */
    public function checkType(string $category_name, string $type)
    {
        $category = $this->categoryRepository->getByName($category_name);
        $typesCollection = $category->typesCollection;

        //check if this type of clothing exists
        $result = ($typesCollection->search(strtolower($type)) !== false);

        return $result;
    }
}