<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Models\County::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'tax_rate' => $faker->numberBetween(0, 20),
    ];
});
