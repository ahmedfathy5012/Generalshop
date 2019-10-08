<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified' => $faker->randomElement([true,false]),
        'mobile' => $faker->phoneNumber,
        'email_verified' => $faker->randomElement([true,false]),
        'billing_address' => $faker->numberBetween(1,1000),
        'shipping_address' => $faker->numberBetween(1,1000),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
    ];
});
