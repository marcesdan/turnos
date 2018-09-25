<?php

use Faker\Generator as Faker;

$factory->define(App\Especialidad::class, function (Faker $faker) {
    return [
        'nombre' => $faker->unique()->jobTitle,
    ];
});
