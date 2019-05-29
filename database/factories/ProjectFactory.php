<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'company_id' => rand(1, 10),
        'name' => $faker->lastName,
        'status' => rand(0, 3),
        'last_updated_by' => rand(1, 10),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
