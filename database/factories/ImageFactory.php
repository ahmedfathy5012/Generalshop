<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'url'=>$faker->randomElement([
             'https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg',
             'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
             'https://www.w3schools.com/w3css/img_lights.jpg',
             'https://cdn.vox-cdn.com/thumbor/XKPu8Ylce2Cq6yi_pgyLyw80vb4=/0x0:1920x1080/1200x800/filters:focal(807x387:1113x693)/cdn.vox-cdn.com/uploads/chorus_image/image/63380914/PIA16695_large.0.jpg',
        ]),

      //  'url' => $faker->imageUrl(1000,600),
        'product_id'=>$faker->numberBetween(1,1500),
    ];
});
