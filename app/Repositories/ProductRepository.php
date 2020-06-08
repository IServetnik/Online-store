<?php

namespace App\Repositories;

use App\Models\Product as Model;

class ProductRepository
{        
    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $products = Model::all();
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
        $products = Model::where(compact('category'))->get();
        return $products;
    }
    
    /**
     * getByType
     *
     * @param  mixed $type
     * @return void
     */
    public function getByType(string $type)
    {
        $products = Model::where(compact('type'))->get();
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
        $products = Model::where(compact('category', 'type'))->get();
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
        $product = Model::where(compact('id'))->get();
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
        $products = Model::where($where)->get();
        return $products;
    }
}