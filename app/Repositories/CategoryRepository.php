<?php

namespace App\Repositories;

use App\Models\Category as Model;

class CategoryRepository
{        
    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $categories = Model::all();
        return $categories;
    }
    
    /**
     * getByCategory
     *
     * @param  mixed $category
     * @return void
     */
    public function getByName(string $name)
    {
        $categories = Model::where(compact('name'))->first();
        return $categories;
    }
    
    /**
     * getWhere
     *
     * @param  mixed $where
     * @return void
     */
    public function getWhere(array $where)
    {
        $categories = Model::where($where)->get();
        return $categories;
    }
}