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
            session()->save();
        } else {
            $quantity = session()->get("cart.$name.quantity");
            session()->put("cart.$name.quantity", ++$quantity);
            session()->save();
        }
    }
}