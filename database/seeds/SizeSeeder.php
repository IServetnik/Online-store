<?php

use Illuminate\Database\Seeder;
use App\Services\ProductService;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [];

        $productService = app(ProductService::class);
        $products = $productService->getAll();

        foreach($products as $product) {
            $sizeNames = collect(['xs', 's', 'm', 'l', 'xl']);
            $sizeNames = $sizeNames->random(rand(1, $sizeNames->count()));
            foreach($sizeNames as $sizeName) {
                $sizes[] = ['product_id' => $product->id, 'name' => $sizeName, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
            }
        }

        DB::table('sizes')->insert($sizes);
    }
}
