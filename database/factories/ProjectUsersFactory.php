<?php

use Faker\Generator as Faker;

$factory->define(App\Project_linked_user::class, function (Faker $faker) {
    return [
        'project_id' => rand(1, 10),
        'user_id' => rand(1, 10),
    ];
});
