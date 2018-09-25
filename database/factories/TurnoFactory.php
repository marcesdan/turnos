<?php

use Faker\Generator as Faker;

$factory->define(App\Turno::class, function (Faker $faker) {
    return [
        'fecha' => $faker->dateTimeBetween('now', '+30 days'),
        'reservado' => true,
        'confirmado' => false,
        'paciente_id' => function () {
            return App\Paciente::all()->random()->id;
        },
        'medico_id' => function () {
            return App\Medico::all()->random()->id;
        },
    ];
});
