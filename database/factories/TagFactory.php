<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'tag' => $faker->word,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
