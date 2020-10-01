<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Investigtion;
use Faker\Generator as Faker;

$factory->define(Investigtion::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence(3),
        'notes' => $faker->paragraph,
    ];
});
