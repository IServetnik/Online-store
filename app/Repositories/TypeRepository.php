<?php

namespace App\Repositories;

use App\Models\Type as Model;
use Illuminate\Support\Collection;

class TypeRepository
{          
    /**
     * getAll
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        $types = Model::with('category')->get();
        return $types;
    }
      
    /**
     * getByCategoryName
     *
     * @param  mixed $category_name
     * @return Collection
     */
    public function getByCategoryName(string $category_name) : Collection
    {
        $types = Model::where(compact('category_name'))->with('category')->get();
        return $types;
    }
    
    /**
     * getById
     *
     * @param  mixed $id
     * @return Model
     */
    public function getById(string $id)
    {
        $type = Model::where(compact('id'))->with('category')->first();
        return $type;
    }
        
    /**
     * getByName
     *
     * @param  mixed $name
     * @return Model
     */
    public function getByName(string $name)
    {
        $type = Model::where(compact('name'))->with('category')->first();
        return $type;
    }

    /**
     * getWhere
     *
     * @param  mixed $where
     * @return Collection
     */
    public function getWhere(array $where) : Collection
    {
        $types = Model::where($where)->with('category')->get();
        return $types;
    }
}