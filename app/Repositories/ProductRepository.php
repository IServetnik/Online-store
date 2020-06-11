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
        $products = Model::with('category')->get();
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
        $products = Model::where(compact('category_name'))->with('category')->get();
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
        $products = Model::where(compact('type'))->with('category')->get();
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
        $products = Model::where(compact('category_name', 'type'))->with('category')->get();
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
        $product = Model::where(compact('id'))->with('category')->get();
        return $product;
    }
        
    /**
     * getByName
     *
     * @param  mixed $name
     * @return void
     */
    public function getByName(string $name)
    {
        $product = Model::where(compact('name'))->with('category')->first();
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
        $products = Model::where($where)->with('category')->get();
        return $products;
    }
}