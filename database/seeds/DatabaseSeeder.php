<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
        factory(Product::class, 50)->create();

        $this->call(CategorySeeder::class);
        $this->call(TypeSeeder::class);
    }
}
