<?php

namespace App\Models;

use App\Services\ProductService;
use Illuminate\Support\Collection;

class Cart
{   
    public $product;
    public $size;
    public $quantity;

    /**
     * __construct
     *
     * @param  mixed $product
     * @param  mixed $size
     * @param  mixed $quantity
     * @return void
     */
    public function __construct(Product $product = null, string $size = null, int $quantity = null)
    {
        if ($product && $size && $quantity) {
            $this->product = $product;
            $this->size = $size;
            $this->quantity = $quantity;
        }
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
     * @param  mixed $product
     * @param  mixed $sizes
     * @return void
     */
    public function add(Product $product, array $sizes)
    {   
        $cartItems = $this->createCartItem($product, $sizes, 0);
        foreach($cartItems as $cartItem) {
            $this->putInCart($cartItem);
        }
    
        return $cartItems;
    }
 
    /**
     * delete
     *
     * @param  mixed $product
     * @param  mixed $size
     * @return void
     */
    public function delete(Product $product, string $size)
    {
        $cartItem = $this->get($product, $size);
        $this->deleteFromCart($cartItem);

        return $cartItem;
    }
    
    /**
     * increaseQuantity
     *
     * @param  mixed $product
     * @param  mixed $size
     * @return void
     */
    public function increaseQuantity(Product $product, string $size)
    {
        $cartItem = $this->get($product, $size);
        $cartItem->quantity++;

        $this->putInCart($cartItem);

        return $cartItem;
    }
 
    /**
     * decreaseQuantity
     *
     * @param  mixed $product
     * @param  mixed $size
     * @return void
     */
    public function decreaseQuantity(Product $product, string $size)
    {
        $cartItem = $this->get($product, $size);
        $cartItem->quantity--;

        if($cartItem->quantity === 0) $this->deleteFromCart($cartItem);
        else $this->putInCart($cartItem);
        
        return $cartItem;
    }
    
    /**
     * totalPrice
     *
     * @return void
     */
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
        session()->put("cart.{$this->name($cartItem->product, $cartItem->size)}", $cartItem);

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
        session()->forget("cart.{$this->name($cartItem->product, $cartItem->size)}");
        return true;
    }

    /**
     * has
     *
     * @param  mixed $product
     * @param  mixed $size
     * @return void
     */
    protected function has(Product $product, string $size)
    {
        $result = session()->has("cart.".$this->name($product, $size));
        return $result;
    }
    
    /**
     * get
     *
     * @param  mixed $product
     * @param  mixed $size
     * @return void
     */
    protected function get(Product $product, string $size)
    {
        $result = session()->get("cart.".$this->name($product, $size));
        return $result;
    }

    /**
     * createCartItem
     *
     * @param  mixed $product
     * @param  mixed $sizes
     * @param  mixed $quantity
     * @return void
     */
    protected function createCartItem(Product $product, array $sizes, int $quantity)
    {
        $cartItems = [];

        foreach($sizes as $size) {
            $name = $this->name($product, $size);
            if($this->has($product, $size)) {
                $cartItem = $this->get($product, $size);
                $cartItem->quantity++;
                $cartItems[] = $cartItem;
            } else {
                $cartItem = new self($product, $size, $quantity+1);
                $cartItems[] = $cartItem;
            }
        }
        return $cartItems;
    }
    
    /**
     * name
     *
     * @param  mixed $product
     * @param  mixed $sizes
     * @return void
     */
    protected function name(Product $product, string $size)
    {
        $name = $product->name."-".$size;
        return $name;
    }
}