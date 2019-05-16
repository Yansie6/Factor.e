<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'company_id' => rand(1, 10),
        'name' => $faker->lastName,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
