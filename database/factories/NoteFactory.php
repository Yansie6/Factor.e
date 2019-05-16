<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'project_id' => rand(1, 10),
        'title' => $faker->text(100),
        'content' => $faker->text(255),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
