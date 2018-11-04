<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon fecha
 * @property mixed reservado
 * @property mixed confirmado
 * @property mixed finalizado
 * @property mixed medico
 * @property mixed paciente
 */
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

    /**
     * Reserva un turno a un paciente dado
     * @param Paciente $paciente
     */
    public function reservarTurno(Paciente $paciente)
    {
        $this->paciente()->associate($paciente);
        $this->reservado = Carbon::now();
    }
}
