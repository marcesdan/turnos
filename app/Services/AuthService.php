<?php
/**
 * Created by PhpStorm.
 * UserRequest: marces
 * Date: 15/08/18
 * Time: 09:34
 */

namespace App\Services;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{

    /**
     * @var MedicoService
     */
    protected $medicoService;

    /**
     * AuthService constructor.
     * @param MedicoService $medicoService
     */
    public function __construct(MedicoService $medicoService)
    {
        $this->medicoService = $medicoService;
    }

    /** Regista un usuario en el sistema
     * @param $input los campos del nuevo usuario
     * @return User el usuario registrado
     */
    public function register($input)
    {
        $role = Role::where('nombre', $input['rol'])->first();
        $user =  User::create([
            'nombre' => $input['nombre'],
            'apellido' => $input['apellido'],
            'email' => $input['email'],
            'password' => Hash::make(str_random(8)),
        ]);
        $user->role()->associate($role);
        $user->save();

        // Si es un médico, debemos crear un medico y asociarlo al usuario
        if (isset($input['especialidad']) && $role->nombre == 'Médico') {
            $this->medicoService->create($user, $input['especialidad']);
        }
        return $user;
    }
}
