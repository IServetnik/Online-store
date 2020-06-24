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
        return view('cart', compact('items'));
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
}
