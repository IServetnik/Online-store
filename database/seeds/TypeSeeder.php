<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [];

        $types[] = ['name' => 'shoes', 'category_name' => 'men', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'shirts', 'category_name' => 'men', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'trousers', 'category_name' => 'men', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'hats', 'category_name' => 'men', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'socks', 'category_name' => 'men', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $types[] = ['name' => 'shoes', 'category_name' => 'women', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'shirts', 'category_name' => 'women', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'trousers', 'category_name' => 'women', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'hats', 'category_name' => 'women', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'socks', 'category_name' => 'women', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];

        $types[] = ['name' => 'shoes', 'category_name' => 'kids', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'shirts', 'category_name' => 'kids', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'trousers', 'category_name' => 'kids', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'hats', 'category_name' => 'kids', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        $types[] = ['name' => 'socks', 'category_name' => 'kids', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")];
        
        DB::table('types')->insert($types);
    }
}
