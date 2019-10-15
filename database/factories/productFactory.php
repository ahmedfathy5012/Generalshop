<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph(5),
        'unit'=> $faker->numberBetween(1,20),
        'price'=> $faker->randomfloat(2,10,500),
        'total'=>$faker->numberBetween(2,250),
        'category_id'=>$faker->numberBetween(1,12),
    ];
});
