<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\CartRepository as Repository;

class CartService
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
        if(!session()->has("cart.$name")) {
            session()->put("cart.$name.quantity", 1);
        } else {
            $quantity = session()->get("cart.$name.quantity");
            session()->put("cart.$name.quantity", $quantity+1);
        }
    }
    
    /**
     * dlete
     *
     * @param  mixed $name
     * @return void
     */
    public function delete(string $name)
    {
        session()->forget("cart.$name");
    }
    
    /**
     * increaseQuantity
     *
     * @param  mixed $name
     * @return void
     */
    public function increaseQuantity(string $name)
    {
        $quantity = session()->get("cart.$name.quantity");
        session()->put("cart.$name.quantity", $quantity+1);

        return $quantity;
    }

    /**
     * decreaseQuantity
     *
     * @param  mixed $name
     * @return void
     */
    public function decreaseQuantity(string $name)
    {
        $quantity = session()->get("cart.$name.quantity");
        if($quantity === 1) session()->forget("cart.$name");
        else session()->put("cart.$name.quantity", $quantity-1);

        return $quantity;
    }
}