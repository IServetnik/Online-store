<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Http\Request;
use \App\Services\SizeService;

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
        if(request()->has('sizes')) $this->createSizes(request()->all(), $product->id);
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
            $size_names = array_column($data['sizes'], 'name');
            $size_quantities = array_column($data['sizes'], 'quantity');

            foreach($sizes as $size) {
                $key = array_search($size->name, $size_names);
                if($key !== false) {
                    if($size->quantity != $size_quantities[$key]) {
                        $size->update(['quantity' => $size_names[$key]]);
                    }
                    unset($data['sizes'][$key]);
                } else {
                    $size->delete();
                }
            }

            $this->createSizes($data, $product->id);
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
            $size_names = array_column($sizes, 'name');
            $product->size_names = implode(", ", $size_names);
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
     * @param  mixed $product_id
     * @return void
     */
    private function createSizes(array $data, string $product_id)
    {
        $sizeService = app(SizeService::class);

        foreach($data['sizes'] as $size) {
            $sizeRequest = new Request([
                'name'   => $size['name'],
                'product_id'  => $product_id,
                'quantity' => $size['quantity'],
            ]);
            $sizeService->store($sizeRequest);
        }
    }
}
