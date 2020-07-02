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
     * @param  mixed $sizes
     * @return void
     */
    public function add(string $name, array $sizes)
    {
        $product = $this->productService->getByName($name);
        $result = Model::add($product, $sizes);

        if(!$result) throw new Exception("Something went wrong");
        return $result;
    }
    
    /**
     * dlete
     *
     * @param  mixed $name
     * @param  mixed $size
     * @return void
     */
    public function delete(string $name, string $size)
    {
        $product = $this->productService->getByName($name);
        $result = Model::delete($product, $size);

        if(!$result) throw new Exception("Something went wrong");
        return $result;
    }
    
    /**
     * increaseQuantity
     *
     * @param  mixed $name
     * @param  mixed $size
     * @return void
     */
    public function increaseQuantity(string $name, string $size)
    {
        $product = $this->productService->getByName($name);
        $result = Model::increaseQuantity($product, $size);

        if(!$result) throw new Exception("Something went wrong");
        return $result;
    }

    /**
     * decreaseQuantity
     *
     * @param  mixed $name
     * @param  mixed $size
     * @return void
     */
    public function decreaseQuantity(string $name, string $size)
    {
        $product = $this->productService->getByName($name);
        $result = Model::decreaseQuantity($product, $size);

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