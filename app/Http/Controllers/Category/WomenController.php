<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\ProductService as Service;

class WomenController extends Controller
{
    private $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * get all
     *
     * @return void
     */
    public function getAll()
    {
        $products = $this->service->getByCategory('women');
        return view('category.women.women', compact('products'));
    }

        
    /**
     * get by id
     *
     * @return void
     */
    public function getByType($type)
    {
        $products = $this->service->getByCategoryAndType('women', $type);
        return view('category.women.women', compact('products'));
    }
}
