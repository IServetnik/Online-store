<?php

use Illuminate\Database\Seeder;
use App\Services\ProductService;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [];

        $productService = app(ProductService::class);
        $products = $productService->getAll();

        foreach($products as $product) {
            foreach($product->sizes as $size) {
                $colorNames = collect(['blue', 'red', 'green', 'purple', 'black', 'orange', 'yellow', 'white', 'gray']);
                $colorNames = $colorNames->random(rand(1, $colorNames->count()));
                foreach($colorNames as $colorName) {
                    $colors[] = ['product_id' => $product->id, 'size_id' => $size->id, 'name' => $colorName, 'quantity' => rand(1, 50), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
                }
            }
        }

        DB::table('colors')->insert($colors);
    }
}
