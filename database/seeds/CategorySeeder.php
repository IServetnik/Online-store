<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $categories[] = [
            'name' => 'men',
            'types' => 'shoes,shirts,trousers,hats,socks',
        ];
        $categories[] = [
            'name' => 'women',
            'types' => 'shoes,shirts,trousers,hats,socks',
        ];
        $categories[] = [
            'name' => 'kids',
            'types' => 'shoes,shirts,trousers,hats,socks',
        ];

        DB::table('categories')->insert($categories);
    }
}
