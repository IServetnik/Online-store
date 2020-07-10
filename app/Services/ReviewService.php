<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ReviewRepository as Repository;
use App\Models\Review as Model;
use App\Exceptions\ReviewException as Exception;

class ReviewService
{        
    private $repository;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = app(Repository::class);
    }
        
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $result = Model::create($data);
        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $review = $this->repository->getById($id);

        $result = $review->update($data);
        if(!$result) throw new Exception("Something went wrong");
        
        return $result;
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(string $id)
    {
        $review = $this->getById($id);

        $result = $review->delete();
        if(!$result) throw new Exception("Something went wrong");
        
        return $result;
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
}