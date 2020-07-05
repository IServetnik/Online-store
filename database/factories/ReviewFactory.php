<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1, 100),
        'user_id' => $faker->numberBetween(1, 20),
        'text' => $faker->text(rand(30,50)),
        'rating' => $faker->numberBetween(1, 5),
    ];
});
