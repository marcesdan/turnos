<?php
/**
 * Created by PhpStorm.
 * ProyectoRequest: marces
 * Date: 15/08/18
 * Time: 09:34
 */

namespace App\Services;

use App\Proyecto;
use App\User;
use App\Lider;

class ProyectoService
{
    public function getAll($user = null)
    {
        return
            isset($user)
                ? Proyecto::where('lider_id', $user->id)->orderBy('nombre')->get()
                : Proyecto::all();
    }

    public function get($id)
    {
        return Proyecto::find($id);
    }

    public function save($input, $proyecto = null)
    {
        isset($proyecto)
            ? $proyecto->fill($input)
            : Proyecto::create($input);

        $proyecto->setLider(
            new Lider(User::find($input['lider']))
        );

        return $proyecto;
    }

    public function destroy($id)
    {
        return Proyecto::destroy($id);
    }
}