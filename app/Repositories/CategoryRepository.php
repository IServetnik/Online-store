<?php

namespace App\Repositories;

use App\Models\Category as Model;
use Illuminate\Support\Collection;

class CategoryRepository
{        
    /**
     * getAll
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        $categories = Model::all();
        return $categories;
    }
    
    /**
     * getById
     *
     * @param  mixed $id
     * @return Model
     */
    public function getById(string $id) : Model
    {
        $product = Model::where(compact('id'))->first();
        return $product;
    }

    /**
     * getByCategory
     *
     * @param  mixed $category
     * @return Model
     */
    public function getByName(string $name) : Model
    {
        $categories = Model::where(compact('name'))->first();
        return $categories;
    }
    
    /**
     * getWhere
     *
     * @param  mixed $where
     * @return Collection
     */
    public function getWhere(array $where) : Collection
    {
        $categories = Model::where($where)->get();
        return $categories;
    }
}