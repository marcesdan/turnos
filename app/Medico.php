<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * Devuelve todos los turnos pertenecientes a este medico
     */
    public function turnos()
    {
        return $this->hasMany('App\Turno');
    }
}
