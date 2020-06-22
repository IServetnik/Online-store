<?php

namespace App\Repositories;

use App\Models\Product as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository
{             
    /**
     * getAll
     *
     * @param  mixed $paginationCount
     * @return LengthAwarePaginator
     */
    public function getAll($paginationCount = null) : LengthAwarePaginator
    {
        $products = Model::paginate($paginationCount);
        return $products;
    }
          
    /**
     * getByCategory
     *
     * @param  mixed $category_name
     * @param  mixed $paginationCount
     * @return LengthAwarePaginator
     */
    public function getByCategory(string $category_name, $paginationCount = null) : LengthAwarePaginator
    {
        $products = Model::where(compact('category_name'))->paginate($paginationCount);
        return $products;
    }
     
    /**
     * getByType
     *
     * @param  mixed $type_name
     * @param  mixed $paginationCount
     * @return LengthAwarePaginator
     */
    public function getByType(string $type_name, $paginationCount = null) : LengthAwarePaginator
    {
        $products = Model::where(compact('type_name'))->paginate($paginationCount);
        return $products;
    }
    
    /**
     * getByCategoryAndType
     *
     * @param  mixed $category_name
     * @param  mixed $type_name
     * @param  mixed $paginationCount
     * @return LengthAwarePaginator
     */
    public function getByCategoryAndType(string $category_name, string $type_name, $paginationCount = null) : LengthAwarePaginator
    {
        $products = Model::where(compact('category_name', 'type_name'))->paginate($paginationCount);
        return $products;
    }
    
    /**
     * getById
     *
     * @param  mixed $id
     * @return Model
     */
    public function getById(string $id)
    {
        $product = Model::where(compact('id'))->first();
        return $product;
    }
        
    /**
     * getByName
     *
     * @param  mixed $name
     * @return Model
     */
    public function getByName(string $name)
    {
        $product = Model::where(compact('name'))->first();
        return $product;
    }
   
    /**
     * getWhere
     *
     * @param  mixed $where
     * @param  mixed $paginationCount
     * @return LengthAwarePaginator
     */
    public function getWhere(array $where, $paginationCount = null) : LengthAwarePaginator
    {
        $products = Model::where($where)->paginate($paginationCount);
        return $products;
    }
}