<?php

use Faker\Generator as Faker;

$factory->define(App\Video_note::class, function (Faker $faker) {
    return [
        'video_id' => rand(1, 10),
        'content' => $faker->text(100),
        'timestamp' => $faker->dateTime,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
