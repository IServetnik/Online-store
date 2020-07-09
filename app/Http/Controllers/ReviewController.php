<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReviewService as Service;
use App\Services\ProductService;

class ReviewController extends Controller
{    
    private $service;
    private $productService;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = app(Service::class);
        $this->productService = app(ProductService::class);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->service->store($request);

        return back();
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(string $id)
    {
        $this->service->destroy($id);

        return back();
    }
}
