<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Product;
use \App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(TypeSeeder::class);
        
        factory(User::class, 20)->create();
        factory(Product::class, 100)->create();
        factory(Review::class, 100)->create();

        Artisan::call('command:setcorrectrating');
    }
}
