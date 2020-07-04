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

        $this->middleware('isAjax');
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $reviews = $this->service->store($request);
        $product = $this->productService->getById($request->product_id);

        return response()->json(['reviews'=>$reviews, 'rating'=>$product->rating]);
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
    public function destroy($id)
    {
        //
    }
}
