<?php

namespace App\Repositories;

use App\Models\Color as Model;
use Illuminate\Support\Collection;

class ColorRepository
{ 
    /**
     * getAll
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        $colors = Model::all();
        return $colors;
    }

    /**
     * getById
     *
     * @param  mixed $id
     * @return Model
     */
    public function getById(string $id)
    {
        $color = Model::where(compact('id'))->first();
        return $color;
    }

    /**
     * getByName
     *
     * @param  mixed $name
     * @return Collection
     */
    public function getByName(string $name) : Collection
    {
        $colors = Model::where(compact('name'))->first();
        return $colors;
    }
    
    /**
     * getWhere
     *
     * @param  mixed $where
     * @return Collection
     */
    public function getWhere(array $where) : Collection
    {
        $colors = Model::where($where)->get();
        return $colors;
    }
}