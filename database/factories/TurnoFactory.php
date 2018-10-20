<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Turno::class, function (Faker $faker) {
    $time = $faker->dateTimeBetween('now', '+30 days');
    return [
        'fecha' => $time,
        'reservado' => Carbon::now(),
        'confirmado' => $time->modify('-15 minutes'),
        'paciente_id' => function () {
            return App\Paciente::all()->random()->id;
        },
        'medico_id' => function () {
            return App\Medico::all()->random()->id;
        },
    ];
});
