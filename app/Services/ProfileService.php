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

class ProfileService
{

    protected $userService;
    protected $medicoService;

    public function __construct(UserService $userService, MedicoService $medicoService)
    {
        $this->userService = $userService;
        $this->medicoService = $medicoService;
    }

    /** Todas las especialidades del hospital
     * @return Especialidad[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAllEspecialidades()
    {
        return $this->medicoService->findAllEspecialidades();
    }

    /** Actualiza el $user dado con $input, el user es un medico
     * @param $input
     * @param Medico $medico
     * @return Medico
     */
    public function updateMedico($input, Medico $medico)
    {
        $this->medicoService->update($input, $medico);
        return $medico;
    }

    /** Actualiza el $user dado con $input, el user es un admin o recepcionista
     * @param $input
     * @param $user
     * @return Medico
     */
    public function updateUser($input, $user)
    {
        $this->userService->update($input, $user);
        return $user;
    }
}
