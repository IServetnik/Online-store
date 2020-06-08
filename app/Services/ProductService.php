<?php

namespace App\Services;

use App\Repositories\ProductRepository as Repository;

class ProductService
{        
    private $repository;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
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
    public function getByCategory(string $category)
    {
        $products = $this->repository->getByCategory($category);
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
    public function getByCategoryAndType(string $category, string $type)
    {
        $products = $this->repository->getByCategoryAndType($category, $type);
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
}