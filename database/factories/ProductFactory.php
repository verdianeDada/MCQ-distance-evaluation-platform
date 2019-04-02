<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Product::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(500, 5000),
        'description' => $faker->text(8),
        'quantity' => $faker->numberBetween(1, 5000)
    ];
});
