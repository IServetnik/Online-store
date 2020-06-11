<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'price' => $faker->randomFloat(3, 30, 300),
        'old_price' => $faker->randomElement([null, $faker->randomFloat(3, 30, 300)]),
        'category_name' => $faker->randomElement(['men', 'women', 'kids']),
        'type' => $faker->randomElement(['shoes', 'shirts', 'trousers', 'hats', 'socks']),
        'brand' => $faker->randomElement(['nike', 'adidas', 'gucci', 'vans', 'lacoste']),
        'color' => $faker->randomElement(['white', 'black', 'blue', 'yellow', 'gray', 'pink']),
    ];
});
