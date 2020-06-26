<?php

namespace App\Repositories;

use App\Services\ProductService;
use Illuminate\Support\Collection;
use \Cart as Model;

class CartRepository
{             
    /**
     * getAll
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        $items = Model::all();
        return $items;
    }
}