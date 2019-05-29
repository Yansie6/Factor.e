<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'phone' => $faker->unique()->phoneNumber,
        'email' => $faker->companyEmail,
        'image' => "https://placekitten.com/200/300",
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
