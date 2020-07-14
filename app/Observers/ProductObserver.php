<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductObserver
{  
    /**
     * creating
     *
     * @param  mixed $product
     * @return void
     */
    public function creating(Product $product)
    {
        $this->prepareData($product);
    }
    
    /**
     * created
     *
     * @param  mixed $product
     * @return void
     */
    public function created(Product $product)
    {
        if(request()->has('sizes_name') && request()->has('quantity')) {
            $data = request()->all();
            $sizeService = app(\App\Services\SizeService::class);

            foreach($data['sizes_name'] as $key => $size_name) {
                $sizeRequest = new Request([
                    'name'   => $size_name,
                    'product_id'  => $product->id,
                    'quantity' => $data['quantity'][$key],
                ]);
                $sizeService->store($sizeRequest);
            }
        }
    }
    
    /**
     * updating
     *
     * @param  mixed $product
     * @return void
     */
    public function updating(Product $product)
    {
        $this->prepareData($product);
        if ($product->isDirty('price')) $product->old_price = $product->price;
    }
    
    /**
     * updated
     *
     * @param  mixed $product
     * @return void
     */
    public function updated(Product $product)
    {
        if(request()->has('sizes_name') && request()->has('quantity')) {
            $data = request()->all();
            $sizeService = app(\App\Services\SizeService::class);
            $sizes = $product->sizes;

            foreach($sizes as $size) {
                $key = array_search($size->name, $data['sizes_name']);
                if($key !== false) {
                    if($size->quantity = $data['quantity'][$key]) {
                        $size->update(['quantity' => $data['quantity'][$key]]);
                    }
                    unset($data['sizes_name'][$key]);
                    unset($data['quantity'][$key]);
                } else {
                    $size->delete();
                }
            }
            
            foreach($data['sizes_name'] as $key => $size_name) {
                $sizeRequest = new Request([
                    'name'   => $size_name,
                    'product_id'  => $product->id,
                    'quantity' => $data['quantity'][$key],
                ]);
                $sizeService->store($sizeRequest);
            }
        }
    }
    
    /**
     * deleting
     *
     * @param  mixed $product
     * @return void
     */
    public function deleting(Product $product)
    {
        $reviews = $product->reviews;
        $reviews->each(function ($item, $key) {
            $item->delete();
        });

        $sizes = $product->sizes;
        $sizes->each(function ($item, $key) {
            $item->delete();
        });
    }
    
    
    /**
     * makeData
     *
     * @param  mixed $product
     * @return void
     */
    private function prepareData(Product $product)
    {
        if(request()->has('sizes_name')) $product->sizes_name = implode(", ", request()->get('sizes_name'));

        foreach($product->getAttributes() as $key => $value) {
            if ($key !== "description" && $key !== "old_price") {
                $product->$key = strtolower($value);
            } 
        } 
    }
}
