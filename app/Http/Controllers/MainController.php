<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService as Service;

class MainController extends Controller
{   
    private $service;


    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->service->getAll(15);
        return view('main', compact('products'));
    }
}
