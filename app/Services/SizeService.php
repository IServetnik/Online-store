<?php

namespace App\Services;

use App\Repositories\SizeRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Size as Model;
use App\Exceptions\SizeException as Exception;

class SizeService
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

        $result = Model::create($data);
        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }



    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $sizes = $this->repository->getAll();
        return $sizes;
    }

    /**
     * getByProduct
     *
     * @param  mixed $product_name
     * @return void
     */
    public function getByProduct(string $product_name)
    {
        $sizes = $this->repository->getByProduct($product_name);
        return $sizes;
    }

    /**
     * getById
     *
     * @param  mixed $id
     * @return void
     */
    public function getById(string $id)
    {
        $sizes = $this->repository->getById($id);
        return $sizes;
    }
        
    /**
     * getByName
     *
     * @param  string $name
     * @return void
     */
    public function getByName(string $name)
    {
        $size = $this->repository->getByName($name);
        return $size;
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