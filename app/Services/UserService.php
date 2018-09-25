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
        return User::all();
    }

    /** Retona el usuario con un $id
     * @param $id
     * @return User
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /** Actualiza el $user dado con $input
     * @param $input
     * @param User $user
     */
    public function update($input, User $user)
    {
        $user->fill([
            'nombre' => $input['nombre'],
            'apellido' => $input['apellido'],
            'email' => $input['email'],
        ]);
        $user->save();
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
