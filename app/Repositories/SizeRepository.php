<?php

namespace App\Repositories;

use App\Models\Size as Model;
use Illuminate\Support\Collection;

class SizeRepository
{ 
    /**
     * getAll
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        $sizes = Model::all();
        return $sizes;
    }
            
    /**
     * getByProduct
     *
     * @param  mixed $product_id
     * @return Collection
     */
    public function getByProduct(string $product_id) : Collection
    {
        $sizes = Model::where(compact('product_id'))->get();
        return $sizes;
    }

    /**
     * getById
     *
     * @param  mixed $id
     * @return Model
     */
    public function getById(string $id)
    {
        $size = Model::where(compact('id'))->first();
        return $size;
    }

    /**
     * getByName
     *
     * @param  mixed $name
     * @return Collection
     */
    public function getByName(string $name) : Collection
    {
        $sizes = Model::where(compact('name'))->get();
        return $sizes;
    }
    
    /**
     * getWhere
     *
     * @param  mixed $where
     * @return Collection
     */
    public function getWhere(array $where) : Collection
    {
        $sizes = Model::where($where)->get();
        return $sizes;
    }
}