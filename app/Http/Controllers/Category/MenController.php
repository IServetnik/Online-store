<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\ProductService as Service;

class MenController extends Controller
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
        $products = $this->service->getByCategory('men');
        return view('category.men.men', compact('products'));
    }

        
    /**
     * get by id
     *
     * @return void
     */
    public function getByType($type)
    {
        $products = $this->service->getByCategoryAndType('men', $type);
        return view('category.men.men', compact('products'));
    }
}
