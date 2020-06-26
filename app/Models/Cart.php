<?php

namespace App\Models;

use App\Services\ProductService;
use Illuminate\Support\Collection;

class Cart
{   
    public $product;
    public $quantity;

    /**
     * __construct
     *
     * @param  Product $product
     * @param  mixed $quantity
     * @return void
     */
    public function __construct(Product $product = null, int $quantity = null)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
    
    
    /**
     * all
     *
     * @return void
     */
    public function all() : Collection
    {
        return collect(session()->get("cart"));
    }
    
    /**
     * add
     *
     * @param  Product $product
     * @return void
     */
    public function add(Product $product)
    {
        if($this->has($product)) {
            $cartItem = $this->get($product);
            $cartItem->quantity++;
        } else $cartItem = $this->createCartItem($product, 0);
        
        $this->putInCart($cartItem);
    
        return $cartItem;
    }
 
    /**
     * delete
     *
     * @param  mixed $product
     * @return void
     */
    public function delete(Product $product)
    {
        $cartItem = $this->get($product);
        $this->deleteFromCart($cartItem);

        return $cartItem;
    }
    
    /**
     * increaseQuantity
     *
     * @param  mixed $product
     * @return void
     */
    public function increaseQuantity(Product $product)
    {
        $cartItem = $this->get($product);
        $cartItem->quantity++;

        $this->putInCart($cartItem);

        return $cartItem;
    }
 
    /**
     * decreaseQuantity
     *
     * @param  mixed $product
     * @return void
     */
    public function decreaseQuantity(Product $product)
    {
        $cartItem = $this->get($product);
        $cartItem->quantity--;

        if($cartItem->quantity === 0) $this->deleteFromCart($cartItem);
        else $this->putInCart($cartItem);
        
        return $cartItem;
    }

    public function totalPrice()
    {
        $totalPrice = 0;

        $cartItems = $this->all();
        foreach($cartItems as $cartItem) $totalPrice += $cartItem->product->price * $cartItem->quantity;

        return $totalPrice;
    }
    



    
    /**
     * putInCart
     *
     * @param  mixed $cartItem
     * @return void
     */
    protected function putInCart(self $cartItem)
    {
        session()->put("cart.{$cartItem->product->name}", $cartItem);
        return true;
    }
    
    /**
     * deleteFromCart
     *
     * @param  mixed $cartItem
     * @return void
     */
    protected function deleteFromCart(self $cartItem)
    {
        session()->forget("cart.{$cartItem->product->name}");
        return true;
    }

    /**
     * has
     *
     * @param  mixed $product
     * @return void
     */
    protected function has(Product $product)
    {
        $result = session()->has("cart.$product->name");
        return $result;
    }
    
    /**
     * get
     *
     * @param  mixed $product
     * @return void
     */
    protected function get(Product $product)
    {
        $result = session()->get("cart.$product->name");
        return $result;
    }

    /**
     * createCartItem
     *
     * @param  mixed $product
     * @param  mixed $quantity
     * @return void
     */
    protected function createCartItem(Product $product, int $quantity)
    {
        return new self($product, $quantity+1);
    }
}