<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ReviewRepository as Repository;
use App\Models\Review as Model;
use App\Exceptions\ReviewException as Exception;

class ReviewService
{        
    private $repository;
    private $productService;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = app(Repository::class);
        $this->productService = app(ProductService::class);
    }
        
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $this->makeData($request);

        $result = Model::create($data);
        if(!$result) throw new Exception("Something went wrong");

        $reviews = $this->getByProduct($data['product_id']);
        $this->setRating($data['product_id']);

        return $reviews;
    }



    /**
     * getById
     *
     * @param  mixed $id
     * @return void
     */
    public function getById(string $id)
    {
        $reviews = $this->repository->getById($id);
        return $reviews;
    }

    /**
     * getByProduct
     *
     * @param  mixed $id
     * @return void
     */
    public function getByProduct(string $product_id)
    {
        $reviews = $this->repository->getByProduct($product_id);
        return $reviews;
    }

    /**
     * getByUser
     *
     * @param  mixed $id
     * @return void
     */
    public function getByUser(string $user_id)
    {
        $reviews = $this->repository->getByUser($user_id);
        return $reviews;
    }
    



    /**
     * makeData
     *
     * @param  mixed $request
     * @return void
     */
    public function makeData(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;

        return $data;
    }

    public function setRating(string $product_id)
    {
        $reviews = $this->getByProduct($product_id);

        //set the average rating of the product
        $ratings = [];
        foreach($reviews as $review) $ratings[] = $review->rating;
        $rating = array_sum($ratings)/count($ratings);

        $product = $this->productService->getById($product_id);
        $product->rating = $rating;
        $product->save();
    }
}