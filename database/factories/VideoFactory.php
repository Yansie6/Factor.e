<?php

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'project_id' => rand(1, 10),
        'name' => $faker->firstName . ".mp4" ,
        'test_person' => $faker->name,
        'link' => "https://www.youtube.com/watch?v=gAjR4_CbPpQ",
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
