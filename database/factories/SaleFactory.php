<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'code'      => 'V-'. $faker->date('ymd'). '1'. rand(1,500),
        'date'      => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone=null)->format('d-m-Y'),
        'user_id'   => 1,
        'client'    => $faker->firstName .' ' .$faker->lastName,
        'total'     => rand(1000,12000),
        'description'   => $faker->sentence
    ];
});
