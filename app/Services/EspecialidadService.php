<?php
/**
 * Created by PhpStorm.
 * User: marces
 * Date: 18/09/18
 * Time: 13:31
 */

namespace App\Services;

use App\Especialidad;
use App\Turno;
use Carbon\Carbon;

class EspecialidadService
{
    /** Todas las especialidades del hospital
     * @return Especialidad[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return Especialidad::all();
    }

    /**
     * Busca una especialidad por su id
     * @param $id
     * @return Especialidad
     */
    public function find($id)
    {
        return Especialidad::findOrFail($id);
    }

    /**
     * Retorna los turnos disponibles de una especialidad dada
     * @param Especialidad $especialidad
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function turnosPorEspecialidad(Especialidad $especialidad)
    {
        // nos quedamos con los ids de todos los médicos de una especialidad
        $medicos = $especialidad->medicos
            ->pluck('id')
            ->all();

        return Turno::whereNull('reservado')
            ->where('fecha', '>', Carbon::now()->addHour())
            ->whereIn('medico_id', $medicos)->get();
    }
}
