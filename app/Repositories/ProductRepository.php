<?php

namespace App\Repositories;

use App\Models\Product as Model;
use Illuminate\Support\Collection;

class ProductRepository
{          
    /**
     * getAll
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        $products = Model::with('category')->get();
        return $products;
    }
      
    /**
     * getByCategoryName
     *
     * @param  mixed $category_name
     * @return Collection
     */
    public function getByCategoryName(string $category_name) : Collection
    {
        $products = Model::where(compact('category_name'))->with('category')->get();
        return $products;
    }
    
    /**
     * getByType
     *
     * @param  mixed $type
     * @return Collection
     */
    public function getByType(string $type) : Collection
    {
        $products = Model::where(compact('type'))->with('category')->get();
        return $products;
    }
    
    /**
     * getByCategoryAndType
     *
     * @param  mixed $category
     * @param  mixed $type
     * @return Collection
     */
    public function getByCategoryNameAndType(string $category_name, string $type) : Collection
    {
        $products = Model::where(compact('category_name', 'type'))->with('category')->get();
        return $products;
    }
    
    /**
     * getById
     *
     * @param  mixed $id
     * @return Model
     */
    public function getById(string $id) : Model
    {
        $product = Model::where(compact('id'))->with('category')->first();
        return $product;
    }
        
    /**
     * getByName
     *
     * @param  mixed $name
     * @return Model
     */
    public function getByName(string $name) : Model
    {
        $product = Model::where(compact('name'))->with('category')->first();
        return $product;
    }

    /**
     * getWhere
     *
     * @param  mixed $where
     * @return Collection
     */
    public function getWhere(array $where) : Collection
    {
        $products = Model::where($where)->with('category')->get();
        return $products;
    }
}