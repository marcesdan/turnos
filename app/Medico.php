<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user
 * @property mixed especialidad
 * @property mixed turnos
 */
class Medico extends Model
{
    protected $table = 'medico';

    /**
     * Devuelve el usuario asociado a este medico.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

     /**
     * Devuelve la especialidad asociada a este medico.
     */
    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad');
    }

     /**
     * Devuelve todos los turno pertenecientes a este medico
     */
    public function turnos()
    {
        return $this->hasMany('App\Turno');
    }

    /**
     * Setea el usuario asociado a este medico.
     * @param $user
     */
    public function setUser($user)
    {
        $this->user()->associate($user);
    }

    /**
     * Setea la especialidad asociada a este medico. Además, se da la posibilidad de
     * crear una nueva especialidad en caso de que no exista la dada.
     * @param $especialidad
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad()->associate(
            Especialidad::firstOrCreate(['nombre' => $especialidad])
        );
    }
}
