<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\CartRepository as Repository;
use \Cart as Model;
use App\Exceptions\CartException as Exception;

class CartService
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
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $items = $this->repository->getAll();
        return $items;
    }
    
    /**
     * add
     *
     * @param  mixed $name
     * @return void
     */
    public function add(string $name)
    {
        $product = $this->productService->getByName($name);
        $result = Model::add($product);

        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }
    
    /**
     * dlete
     *
     * @param  mixed $name
     * @return void
     */
    public function delete(string $name)
    {
        $product = $this->productService->getByName($name);
        $result = Model::delete($product);

        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }
    
    /**
     * increaseQuantity
     *
     * @param  mixed $name
     * @return void
     */
    public function increaseQuantity(string $name)
    {
        $product = $this->productService->getByName($name);
        $result = Model::increaseQuantity($product);

        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }

    /**
     * decreaseQuantity
     *
     * @param  mixed $name
     * @return void
     */
    public function decreaseQuantity(string $name)
    {
        $product = $this->productService->getByName($name);
        $result = Model::decreaseQuantity($product);

        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }
    
    /**
     * totalPrice
     *
     * @return void
     */
    public function totalPrice()
    {
        $totalPrice = Model::totalPrice();
        return $totalPrice;
    }
}