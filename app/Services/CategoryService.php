<?php

namespace App\Services;

use App\Repositories\CategoryRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Category as Model;

class CategoryService
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
}