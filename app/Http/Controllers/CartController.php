<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService as Service;

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

        $this->middleware('isAjax')->except('index');
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $items = $this->service->getAll();
        $totalPrice = $this->service->totalPrice();
        return view('cart', compact('items', 'totalPrice'));
    }

    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
        $cartItem = $this->service->add($request);
        return response()->json(['totalPrice'=>$cartItem[0]->totalPrice()]);
    }
    
    /**
     * delete
     *
     * @param  mixed $request
     * @param  mixed $name
     * @return void
     */
    public function delete(Request $request, $name)
    {
        $cartItem = $this->service->delete($request, $name);
        return response()->json(['totalPrice'=>$cartItem->totalPrice()]);
    }
    
    /**
     * increaseQuantity
     *
     * @param  mixed $request
     * @param  mixed $name
     * @return void
     */
    public function increaseQuantity(Request $request, $name)
    {
        $cartItem = $this->service->increaseQuantity($request, $name);
        return response()->json(['quantity'=>$cartItem->quantity, 'totalPrice'=>$cartItem->totalPrice()]);
    }
    
    /**
     * decreaseQuantity
     *
     * @param  mixed $request
     * @param  mixed $name
     * @return void
     */
    public function decreaseQuantity(Request $request, $name)
    {
        $cartItem = $this->service->decreaseQuantity($request, $name);
        return response()->json(['quantity'=>$cartItem->quantity, 'totalPrice'=>$cartItem->totalPrice()]);
    }
}
