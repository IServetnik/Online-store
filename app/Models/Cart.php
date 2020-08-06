<?php

namespace App\Models;

use App\Services\ProductService;
use Illuminate\Support\Collection;

class Cart
{   
    public $product;
    public $size_name;
    public $color_name;
    public $quantity;

    /**
     * __construct
     *
     * @param  mixed $product
     * @param  mixed $size_name
     * @param  mixed $color_name
     * @param  mixed $quantity
     * @return void
     */
    public function __construct(Product $product = null, string $size_name = null, string $color_name = null, int $quantity = null)
    {
        if ($product && $size_name && $color_name && $quantity) {
            $this->product = $product;
            $this->size_name = $size_name;
            $this->color_name = $color_name;
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
    public function delete(Product $product, array $size)
    {
        $size_name = $size['sizeName'];
        $color_name = $size['colorName'];

        $cartItem = $this->get($product, $size_name, $color_name);
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
    public function increaseQuantity(Product $product,  array $size)
    {
        $size_name = $size['sizeName'];
        $color_name = $size['colorName'];

        $cartItem = $this->get($product, $size_name, $color_name);
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
    public function decreaseQuantity(Product $product, array $size)
    {
        $size_name = $size['sizeName'];
        $color_name = $size['colorName'];
        
        $cartItem = $this->get($product, $size_name, $color_name);
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
        session()->put("cart.{$this->name($cartItem->product, $cartItem->size_name, $cartItem->color_name)}", $cartItem);

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
        session()->forget("cart.{$this->name($cartItem->product, $cartItem->size_name, $cartItem->color_name)}");
        return true;
    }
  
    /**
     * has
     *
     * @param  mixed $product
     * @param  mixed $size_name
     * @param  mixed $color_name
     * @return void
     */
    protected function has(Product $product, string $size_name, string $color_name)
    {
        $result = session()->has("cart.".$this->name($product, $size_name, $color_name));
        return $result;
    }
    
    /**
     * get
     *
     * @param  mixed $product
     * @param  mixed $size_name
     * @param  mixed $color_name
     * @return void
     */
    protected function get(Product $product, string $size_name, string $color_name)
    {
        $result = session()->get("cart.".$this->name($product, $size_name, $color_name));
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
            $size_name = $size['sizeName'];
            $color_name = $size['colorName'];
            $name = $this->name($product, $size_name, $color_name);

            if($this->has($product, $size_name, $color_name)) {
                $cartItem = $this->get($product, $size_name, $color_name);
                $cartItem->quantity++;
                $cartItems[] = $cartItem;
            } else {
                $cartItem = new self($product, $size_name, $color_name, $quantity+1);
                $cartItems[] = $cartItem;
            }
        }
        return $cartItems;
    }
    
    /**
     * name
     *
     * @param  mixed $product
     * @param  mixed $size_name
     * @param  mixed $color_name
     * @return void
     */
    protected function name(Product $product, string $size_name, string $color_name)
    {
        $name = $product->name."-".$size_name."-".$color_name;
        return $name;
    }
}