<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Color;

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
        $this->createSizesAndColors($product);
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
        $this->createSizesAndColors($product);
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
        foreach($reviews as $review) {
            $review->delete();
        }

        $sizes = $product->sizes;
        foreach($sizes as $size) {
            $colors = $size->colors;
            foreach($colors as $color) {
                $color->delete();
            }

            $size->delete();
        }
    }
    
    /**
     * deleted
     *
     * @param  mixed $product
     * @return void
     */
    public function deleted(Product $product)
    {
        if(!empty($product->image_name)) {
            $filePath = public_path('storage/images/product/'.$product->image_name);
            unlink($filePath);
        }
    }
    



    
    /**
     * makeData
     *
     * @param  mixed $product
     * @return void
     */
    private function prepareData(Product $product)
    {
        if(request()->hasFile('image')) {
            //Delete product image if it exists
            if(!empty($product->image_name)) {
                $filePath = public_path('storage/images/product/'.$product->image_name);
                unlink($filePath);
            }

            //Get image name
            $clientFileName = request()->file('image')->getClientOriginalName();
            $fileName = pathinfo($clientFileName, PATHINFO_FILENAME);
            $fileExtension = request()->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;

            $product->image_name = $fileNameToStore;

            //Store image
            $path = request()->file('image')->move(public_path('storage/images/product'), $fileNameToStore);
        }

        foreach($product->getAttributes() as $key => $value) {
            if ($key !== "description" && $key !== "old_price") {
                $product->$key = strtolower($value);
            } 
        } 
    }
     
    /**
     * createSizesAndColors
     *
     * @param  mixed $product
     * @return void
     */
    private function createSizesAndColors(Product $product)
    {
        if(request()->has('sizes')) {
            //Create sizes
            $sizes = $product->sizes;

            $data = request()->all();
            $sizeNames = array_map('strtolower', array_column($data['sizes'], 'name'));

            foreach($sizes as $size) {
                $sizeKey = array_search($size->name, $sizeNames);

                if($sizeKey !== false) {
                    //Update colors
                    $colorNames = array_map('strtolower', array_column($data['sizes'][$sizeKey]['colors'], 'name'));

                    foreach($size->colors as $color) {
                        $colorKey = array_search($color->name, $colorNames);
                        $dataColor = $data['sizes'][$sizeKey]['colors'][$colorKey];

                        if($colorKey !== false) {
                            if($color->quantity != $dataColor['quantity']) {
                                $color->quantity = $dataColor['quantity'];
                                $color->save();
                            }
                            unset($data['sizes'][$sizeKey]['colors'][$colorKey]);
                        } else {
                            $color->delete();
                        }
                    }

                    foreach($data['sizes'][$sizeKey]['colors'] as $color) {
                        Color::create(['product_id' => $product->id, 
                                    'size_id' => $size->id,
                                    'name' => strtolower($color['name']),
                                    'quantity' => $color['quantity']]);
                    }
                    unset($data['sizes'][$sizeKey]);
                } else {
                    $size->delete();
                }
            }

            foreach($data['sizes'] as $dataSize) {
                $size = Size::create(['product_id' => $product->id, 'name' => strtolower($dataSize['name'])]);
                foreach($dataSize['colors'] as $color) {
                    Color::create(['product_id' => $product->id, 
                                    'size_id' => $size->id,
                                    'name' => strtolower($color['name']),
                                    'quantity' => $color['quantity']]);
                }
            }
        }
    }
}
