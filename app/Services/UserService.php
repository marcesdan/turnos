<?php
/**
 * Created by PhpStorm.
 * UserRequest: marces
 * Date: 15/08/18
 * Time: 09:34
 */

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Hash;

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
    public function register($input)
    {
        return $this->createUser($input, $input['rol']);
    }

    /** Crea un usuario en el sistema, puede ser utilizado por otros servicios
     * @param $input , los campos del nuevo usuario
     * @param $rol , el rol que juega el usuario en el sistema
     * @return User, el usuario registrado
     */
    public function createUser($input, $rol)
    {
        //se crea al usuario
        $user = new User();
        $user->fill($input);
        $user->password = Hash::make(str_random(8));
        $user->setRole($rol);
        $user->save();
        return $user;
    }

    /** Actualiza el $user dado con $input
     * @param $input
     * @param User $user
     * @return User
     */
    public function update($input, User $user)
    {
        $user->fill($input);

        // si está presente en el array y es un nuevo rol...
        if ( array_has($input, 'rol') )
            $user->setRole($input['rol']);

        $user->save();
        return $user;
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
