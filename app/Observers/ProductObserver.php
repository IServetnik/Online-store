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
        if(request()->has('sizes')) $this->createSizes(request()->all(), $product);
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
        if(request()->has('sizes')) {
            $sizeService = app(\App\Services\SizeService::class);
            $sizes = $product->sizes;

            $data = request()->all();
            $sizes_name = array_column($data['sizes'], 'name');
            $sizes_quantity = array_column($data['sizes'], 'quantity');

            foreach($sizes as $size) {
                $key = array_search($size->name, $sizes_name);
                if($key !== false) {
                    if($size->quantity != $sizes_quantity[$key]) {
                        $size->update(['quantity' => $sizes_name[$key]]);
                    }
                    unset($data['sizes'][$key]);
                } else {
                    $size->delete();
                }
            }

            $this->createSizes($data, $product);
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
        if(request()->has('sizes')) {
            $sizes = request()->get('sizes');
            $sizes_name = array_column($sizes, 'name');
            $product->sizes_name = implode(", ", $sizes_name);
        }

        foreach($product->getAttributes() as $key => $value) {
            if ($key !== "description" && $key !== "old_price") {
                $product->$key = strtolower($value);
            } 
        } 
    }
          
    /**
     * createSizes
     *
     * @param  mixed $data
     * @param  mixed $product
     * @return void
     */
    private function createSizes(array $data, Product $product)
    {
        $sizeService = app(\App\Services\SizeService::class);

        foreach($data['sizes'] as $size) {
            $sizeRequest = new Request([
                'name'   => $size['name'],
                'product_id'  => $product->id,
                'quantity' => $size['quantity'],
            ]);
            $sizeService->store($sizeRequest);
        }
    }
}
