<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Models\State::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
    ];
});
