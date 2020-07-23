<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Camera;
use Faker\Generator as Faker;

$factory->define(Camera::class, function (Faker $faker) {
    return [
        'title' => 'КМР ' . strtoupper($faker->bothify('??-###')),
        'location_km' => $faker->numberBetween($min = 4, $max = 72),
        'location_piket' => $faker->randomDigit,
        'lat' => $faker->randomFloat($nbMaxDecimals = 6, $min = 58.90, $max = 59.99),
        'lng' => $faker->randomFloat($nbMaxDecimals = 6, $min = 30.28, $max = 31.55), // горизонталь
        'comment' => $faker->realText(),
        'ip' => $faker->ipv4,
        'login' => $faker->userName,
        'password' => $faker->password,
        'cabinet_id' => 1
    ];
});
