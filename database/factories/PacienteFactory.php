<?php

use Faker\Generator as Faker;

$factory->define(App\Paciente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'telefono' => $faker->phoneNumber,
        'documento' => $faker->numberBetween($min = 1000000, $max = 99999999),
    ];
});
