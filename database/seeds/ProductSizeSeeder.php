<?php

use Illuminate\Database\Seeder;
use \App\Services\ProductService;
use \App\Services\SizeService;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productService = app(ProductService::class);
        $products = $productService->getAll();

        $sizeService = app(SizeService::class);
        $sizes = $sizeService->getAll();

        foreach($products as $product) {
            $sizeIds = $sizes->pluck('id')->random(rand(1, $sizes->count()));
            foreach($sizeIds as $sizeId) {
                $product->sizes()->attach($sizeId, ['quantity' => rand(1, 50)]);
            }
        }
    }
}
