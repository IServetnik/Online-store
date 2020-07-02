<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Services\CartService as Service;
use App\Http\Controllers\Controller;

class CartController extends Controller
{    
    private $service;

    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct()
    {
        $this->service = app(Service::class);

        $this->middleware('isAjax');
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
        $sizes = $request->size;

        $cartItem = $this->service->add($name, $sizes);
        return response()->json(['totalPrice'=>$cartItem[0]->totalPrice()]);
    }
    
    /**
     * delete
     *
     * @param  mixed $request
     * @return void
     */
    public function delete(Request $request)
    {
        $name = $request->name;
        $size = $request->size;

        $cartItem = $this->service->delete($name, $size);
        return response()->json(['totalPrice'=>$cartItem->totalPrice()]);
    }
    
    /**
     * increaseQuantity
     *
     * @param  mixed $request
     * @return void
     */
    public function increaseQuantity(Request $request)
    {
        $name = $request->name;
        $size = $request->size;

        $cartItem = $this->service->increaseQuantity($name, $size);
        return response()->json(['quantity'=>$cartItem->quantity, 'totalPrice'=>$cartItem->totalPrice()]);
    }
    
    /**
     * decreaseQuantity
     *
     * @param  mixed $request
     * @return void
     */
    public function decreaseQuantity(Request $request)
    {
        $name = $request->name;
        $size = $request->size;

        $cartItem = $this->service->decreaseQuantity($name, $size);
        return response()->json(['quantity'=>$cartItem->quantity, 'totalPrice'=>$cartItem->totalPrice()]);
    }
}
