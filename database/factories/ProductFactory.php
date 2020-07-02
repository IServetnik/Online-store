<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'description' => $faker->text(rand(50,70)),
        'price' => $faker->randomFloat(3, 30, 300),
        'old_price' => $faker->randomElement([null, $faker->randomFloat(3, 30, 300)]),
        'category_name' => $faker->randomElement(['men', 'women', 'kids']),
        'type_name' => $faker->randomElement(['shoes', 'shirts', 'trousers', 'hats', 'socks']),
        'brand' => $faker->randomElement(['nike', 'adidas', 'gucci', 'vans', 'lacoste']),
        'color' => $faker->randomElement(['white', 'black', 'blue', 'yellow', 'gray', 'pink']),
        'sizes' => implode(", ", $faker->randomElements(['xs', 's', 'm', 'l', 'xl', 'xxl'], rand(2, 6))),
    ];
});
