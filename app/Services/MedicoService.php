<?php
/**
 * Created by PhpStorm.
 * User: marces
 * Date: 18/09/18
 * Time: 13:31
 */

namespace App\Services;

use App\Especialidad;
use App\Medico;
use App\User;

class MedicoService
{

    /** Todas las especialidades del hospital
     * @return Especialidad[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAllEspecialidades() {
        return Especialidad::all();
    }


    /**
     * @param User $user
     * @param $especialidad
     */
    public function create(User $user, $especialidad)
    {
        $medico = new Medico();
        $medico->user()->associate($user);
        //damos la posibilidad de crear una nueva especialidad en caso de que no exista la dada
        $medico->especialidad()->associate(
            Especialidad::firstOrCreate(['nombre' => $especialidad])
        );
        $medico->save();
    }
}
