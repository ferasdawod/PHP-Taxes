<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Models\TaxEntry::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(0, 10000),
    ];
});
