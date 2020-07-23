<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cabinet;
use Faker\Generator as Faker;

$factory->define(Cabinet::class, function (Faker $faker) {
    return [
        'title' => 'ШКФ '.$faker->word . '-' . strtoupper($faker->bothify('??-###')),
        'location_km' => $faker->numberBetween($min = 4, $max = 72),
        'location_piket' => $faker->randomDigit,
        'lat' => $faker->randomFloat($nbMaxDecimals = 6, $min = 58.90, $max = 59.99),
        'lng' => $faker->randomFloat($nbMaxDecimals = 6, $min = 30.28, $max = 31.55), // горизонталь
        'comment' => $faker->realText(),
        'sector_id' => 1
    ];
});
