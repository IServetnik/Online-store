<?php

namespace App\Observers;

use App\Models\Product;

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
     * makeData
     *
     * @param  mixed $product
     * @return void
     */
    private function prepareData(Product $product)
    {
        if(request()->has('sizes')) $product->sizes = implode(", ", request()->get('sizes'));

        foreach($product->getAttributes() as $key => $value) {
            if ($key !== "description" && $key !== "old_price") {
                $product->$key = strtolower($value);
            } 
        } 
    }
}
