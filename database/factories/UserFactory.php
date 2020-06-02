<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->name,
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('daniel'),
        'address'   => Str::random(10),
        'phone'     => rand(1000000,9000000),
        'role_id'   => rand(1,3),
        'company_position_id'   => rand(1,3),
        'status'    => rand(0,1)
    ];
});
