<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'phone' => $faker->unique()->phoneNumber,
        'email' => $faker->companyEmail,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
