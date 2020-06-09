<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\ProductService as Service;

class KidsController extends Controller
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
        $products = $this->service->getByCategoryName('kids');
        return view('category.kids.kids', compact('products'));
    }

        
    /**
     * get by id
     *
     * @return void
     */
    public function getByType($type)
    {
        $products = $this->service->getByCategoryNameAndType('kids', $type);

        return view('category.kids.kids', compact('products'));
    }
}
