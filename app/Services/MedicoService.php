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
    /** Todos los médicos del sistema
     * @return Medico[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return Medico::all();
    }

    /**
     * @param $id
     * @return Medico
     */
    public function find($id)
    {
        return Medico::findOrFail($id);
    }

    /**
     * Busca una especialidad por su id
     * @param $id
     * @return Especialidad
     */
    public function findEspecialidad($id)
    {
        return Especialidad::findOrFail($id);
    }

    /**
     * Retorna los turnos disponibles de un médico dado
     * @param Medico $medico
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurnosDisponibles(Medico $medico)
    {
        return $medico->turnos()
            ->whereNull('reservado')
            ->where('fecha', '>', now()->addHour())
            ->get();
    }

    /**
     * Retorna todos los turnos actuales de un médico, ya sean reservados o no, confirmados o no.
     * los de now() en adelante.
     * @param Medico $medico
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurnosActuales(Medico $medico)
    {
        return $medico->turnos()
            ->whereNull('finalizado')
            ->where('fecha', '>=', today())
            ->get();
    }

    /**
     * Retorna los turnos ya han sido confirmados.
     * Lo cual significa que el médico ya puede atenderlos
     * @param Medico $medico
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurnosConfirmados(Medico $medico)
    {
        return $medico->turnos()
            ->whereNull('finalizado')
            ->whereNotNull('confirmado')
            ->get();
    }


    /** Regista un usuario en el sistema
     * @param $input, los campos del nuevo usuario
     * @return Medico, el medico registrado
     */
    public function create($input)
    {
        $user = new User($input, 'Médico');
        //se crea al médico y se asocia al usuario
        $medico = new Medico();
        $medico->setUser($user);
        $medico->setEspecialidad($input['especialidad']);
        $medico->save();
        return $medico;
    }

    /** Actualiza el $medico dado con $input
     * @param $input
     * @param Medico $medico
     * @return Medico
     */
    public function update($input, Medico $medico)
    {
        $medico->user->actualizar($input);
        $medico->setEspecialidad($input['especialidad']);
        $medico->save();
        return $medico;
    }

    /**
     * Elimina un medico dado
     * @param Medico $medico
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Medico $medico)
    {
        return $medico->user->delete();
    }
}
