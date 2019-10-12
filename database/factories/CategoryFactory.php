<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->word,
        //'image_direction' => $faker->randomElement([left,right]),
        //'image_url' => $faker->imageUrl(1000,600),
    ];
});
