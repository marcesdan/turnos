<?php
/**
 * Created by PhpStorm.
 * UserRequest: marces
 * Date: 15/08/18
 * Time: 09:34
 */

namespace App\Services;

use App\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /** Retorna todos los usuarios del sistema
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        // retornamos todos los usuarios que no son médicos
        return User::whereDoesntHave('role', function ($q) {
            $q->where('nombre', 'Médico');
        })->get();
    }

    /** Retona el usuario con un $id
     * @param $id
     * @return User
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /** Regista un usuario en el sistema
     * @param $input , campos del nuevo usuario
     * @return User, el usuario registrado
     */
    public function create($input)
    {
        return new User($input, $input['rol']);
    }

    /** Actualiza el $user dado con $input
     * @param $input
     * @param User $user
     * @return User
     */
    public function update($input, User $user)
    {
        return $user->actualizar($input);
    }


    /**
     * @param User $user
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }
}
