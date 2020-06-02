<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'code'          => $faker->unique()->numberBetween(1000,9000),
        'description'   => $faker->sentence,
        'stock'         => 0,
        'price'         => rand(1000,10000),
        'unit'          => $faker->randomElement(['CAJA','FARDO','BOLSA','PAQUETES']),
        'status'        => 1
    ];
});
