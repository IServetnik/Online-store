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

        $this->middleware('isAjax')->only(['add']);
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
        $name = $request->name;
        $this->service->add($name);

        return response()->json(['result'=>'success']);
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
        $this->service->delete($name);

        return response()->json(['result'=>'success']);
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
        $cartItem = $this->service->increaseQuantity($name);

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
        $cartItem = $this->service->decreaseQuantity($name);

        return response()->json(['quantity'=>$cartItem->quantity, 'totalPrice'=>$cartItem->totalPrice()]);
    }
}
