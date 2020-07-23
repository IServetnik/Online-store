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
        $this->createProductSize($product);
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
        
        if(request()->get('withDiscount')) {
            if ($product->isDirty('price')) $product->old_price = $product->getOriginal('price');
        } else {
            $product->old_price = null;
        }
    }
    
    /**
     * updated
     *
     * @param  mixed $product
     * @return void
     */
    public function updated(Product $product)
    {
        $this->createProductSize($product);
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
        $reviews->each(function ($review, $key) {
            $review->delete();
        });

        $sizes = $product->sizes;
        $product->sizes()->detach();
    }
    
    
    /**
     * makeData
     *
     * @param  mixed $product
     * @return void
     */
    private function prepareData(Product $product)
    {
        foreach($product->getAttributes() as $key => $value) {
            if ($key !== "description" && $key !== "old_price") {
                $product->$key = strtolower($value);
            } 
        } 
    }
    
    /**
     * createProductSize
     *
     * @param  mixed $product
     * @return void
     */
    private function createProductSize(Product $product)
    {
        if(request()->has('sizes')) {
            $sizes = $product->sizes;

            $data = request()->all();
            $size_ids = array_column($data['sizes'], 'id');
            $size_quantities = array_column($data['sizes'], 'quantity');

            foreach($sizes as $size) {
                $key = array_search($size->id, $size_ids);
                if($key !== false) {
                    if($size->pivot->quantity != $size_quantities[$key]) {
                        $product->sizes()->sync([$size->id => ['quantity' => $size_quantities[$key]]]);
                    }
                    unset($data['sizes'][$key]);
                } else {
                    $product->sizes()->detach($size_ids[$key]);
                }
            }

            foreach($data['sizes'] as $size) {
                $product->sizes()->attach($size['id'], ['quantity' => $size['quantity']]);
            }
        }
    }
}
