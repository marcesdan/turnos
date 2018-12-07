<?php
/**
 * Created by PhpStorm.
 * User: marces
 * Date: 18/09/18
 * Time: 13:31
 */

namespace App\Services;

use App\Jobs\VerificarSolicitud;
use App\Notifications\SolicitudNotification;
use App\Paciente;
use App\Turno;

class SolicitudService
{

    /**
     * Crea una solicitud para un turno.
     * La solicitud deja al turno marcado como reservado. Sin embargo, si el paciente no
     * confirma la solicitud dentro de las horas establecidas. El turno quedara con
     * "reservado" en null, mediante el Job VerificarSolicitud.
     * @param Turno $turno
     * @param Paciente $paciente
     */
    public function crearSolicitud(Turno $turno, Paciente $paciente)
    {
        VerificarSolicitud::dispatch($turno)->delay(now()->addHours(12));
        $turno->reservado = now();
        $turno->save();
        $paciente->notify(new SolicitudNotification($turno));
    }

    public function confirmarSolicitud(Turno $turno, Paciente $paciente)
    {
        $turno->paciente()->associate($paciente);
        $turno->save();
    }
}
