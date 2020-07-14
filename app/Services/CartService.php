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
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
        $name = $request->name;
        $sizes_name = $request->size_name;

        $product = $this->productService->getByName($name);
        $result = Model::add($product, $sizes_name);

        if(!$result) throw new Exception("Something went wrong");
        return $result;
    }
      
    /**
     * delete
     *
     * @param  mixed $request
     * @param  mixed $name
     * @return void
     */
    public function delete(Request $request, string $name)
    {
        $size_name = $request->size_name;
        
        $product = $this->productService->getByName($name);
        $result = Model::delete($product, $size_name);

        if(!$result) throw new Exception("Something went wrong");
        return $result;
    }
      
    /**
     * increaseQuantity
     *
     * @param  mixed $request
     * @param  mixed $name
     * @return void
     */
    public function increaseQuantity(Request $request, string $name)
    {
        $size_name = $request->size_name;

        $product = $this->productService->getByName($name);
        $result = Model::increaseQuantity($product, $size_name);

        if(!$result) throw new Exception("Something went wrong");
        return $result;
    }
 
    /**
     * decreaseQuantity
     *
     * @param  mixed $request
     * @param  mixed $name
     * @return void
     */
    public function decreaseQuantity(Request $request, string $name)
    {
        $size_name = $request->size_name;

        $product = $this->productService->getByName($name);
        $result = Model::decreaseQuantity($product, $size_name);

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