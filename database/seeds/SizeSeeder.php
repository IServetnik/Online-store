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
        $products = app(ProductService::class)->getAll();

        foreach($products as $product) {
            $sizes_name = $product->sizesNameArray;

            foreach($sizes_name as $size_name) {
                DB::table('sizes')->insert(['name' => $size_name, 'product_id' => $product->id, 'quantity' => rand(1, 50), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
            }
        }
    }
}
