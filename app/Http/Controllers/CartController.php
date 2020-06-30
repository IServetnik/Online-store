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
}
