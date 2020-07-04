<?php

namespace App\Repositories;

use App\Services\ReviewService;
use Illuminate\Support\Collection;
use App\Models\Review as Model;

class ReviewRepository
{             
    /**
     * getAll
     *
     */
    public function getAll()
    {
        $reviews = Model::all();
        return $reviews;
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
     * getByProduct
     *
     * @param  mixed $id
     */
    public function getByProduct($product_id)
    {
        $reviews = Model::where(compact('product_id'))->get();
        return $reviews;
    }

    /**
     * getByProduct
     *
     * @param  mixed $id
     */
    public function getByUser($user_id)
    {
        $reviews = Model::where(compact('user_id'))->get();
        return $reviews;
    }
}