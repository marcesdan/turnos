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

class MedicoService
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

    /** Todas las especialidades del hospital
     * @return Especialidad[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAllEspecialidades()
    {
        return Especialidad::all();
    }

    /** Regista un usuario en el sistema
     * @param $input, los campos del nuevo usuario
     * @return Medico, el medico registrado
     */
    public function register($input)
    {
        $user = $this->userService->createUser($input, 'Médico');
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
        $this->userService->update($input, $medico->user);
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
