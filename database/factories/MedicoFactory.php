<?php

use Faker\Generator as Faker;

$factory->define(App\Medico::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'especialidad_id' => factory(App\Especialidad::class)->create()->id,
    ];
});
