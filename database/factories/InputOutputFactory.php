<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InputOutput;
use Faker\Generator as Faker;

$factory->define(InputOutput::class, function (Faker $faker) {
    return [
        'code'          => $faker->randomElement(array('E','S')).'-'.$faker->date('ymd').'1'.$faker->numberBetween(0,500),
        'date'          => $faker->dateTimeBetween('-1 years','now',null)->format('Y-m-d'),
        'user_id'       => 1,
        'operation'     => $faker->sentence(4,true),
        'product_code'  => $faker->randomElement(array('1111111111','2222222222','3333333333','4444444444','5555555555','6666666666','7777777777','8888888888')),
        'type'          => $faker->randomElement(array('input','output','purchase','sale')),
        'quantity'      => $faker->numberBetween(10,100),
    ];
});
