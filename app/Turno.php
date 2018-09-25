<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = 'turno';

    /**
     * Devuelve al paciente al que pertenece este turno
     */
    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }

     /**
     * Devuelve al médico al que pertenece este turno
     */
    public function medico()
    {
        return $this->belongsTo('App\Medico');
    }
}
