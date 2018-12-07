<?php
/**
 * Created by PhpStorm.
 * User: marces
 * Date: 18/09/18
 * Time: 13:31
 */

namespace App\Services;

use App\Especialidad;
use App\Medico;
use App\Paciente;
use App\Turno;
use App\Solicitud;
use Carbon\Carbon;

class TurnoService
{

    /**
     * @param $id
     * @return Turno
     */
    public function find($id)
    {
        return Turno::findOrFail($id);
    }

    /**
     * Retorna todos los turnos
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return Turno::all();
    }

    /**
     * Retorna los turnos que están próximos a ocurrir.
     * Proximidad establecida de una hora por defecto.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurnosSinConfirmar()
    {
        $desde = Carbon::now()->subMinutes(25);
        $hasta = Carbon::now()->addHour();
        return Turno::whereNull('finalizado')
            ->whereNotNull('reservado')
            ->whereNull('confirmado')
            ->whereBetween('fecha', [$desde, $hasta])
            ->get();
    }

    /**
     * Retorna todos los turno del dia de hoy
     * @param Medico $medico
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurnosDeHoy(Medico $medico)
    {
        return $medico->turnos()
            ->whereBetween('fecha', [Carbon::today(), Carbon::tomorrow()])
            ->whereNotNull('reservado')
            ->get();
    }

    /**
     * Retorna los turnos del dia de hoy que quedan por atender
     * @param Medico $medico
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurnosDeHoyRestantes(Medico $medico)
    {
        return $medico->turnos()
            ->whereBetween('fecha', [Carbon::today(), Carbon::tomorrow()])
            ->whereNotNull('reservado')
            ->whereNull('finalizado')
            ->get();
    }

    public function reservarTurno(Turno $turno, Paciente $paciente)
    {
        $turno->reservarTurno($paciente);
        $turno->save();
    }

    public function confirmarTurno($turnoId)
    {
        $turno = $this->find($turnoId);
        $turno->confirmado = Carbon::now();
        $turno->save();
    }

    public function cancelarTurno($turnoId)
    {
        $turno = $this->find($turnoId);
        $turno->reservado = null;
        $turno->save();
    }

    public function finalizarTurno($turnoId)
    {
        $turno = $this->find($turnoId);
        $turno->finalizado = Carbon::now();
        $turno->save();
    }


    /**
     * Planifica un conjunto de turno para una semana, determinado por:
     * Los días de la semana que tendrán turos
     * La hora desde que comienzan los turno (primer turno)
     * La hora donde finalizan los turno (ultimo turno)
     * La duración del turno. (que marcará los intervalos de tiempo)
     * @param $input
     * @param Medico $medico
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function planificarHorarios($input, Medico $medico)
    {
        $hora_desde = Carbon::createFromTimeString($input['hora_desde']);
        $hora_hasta = Carbon::createFromTimeString($input['hora_hasta']);

        foreach ($input['dias'] as $dia) {
            $current = new Carbon("next {$this->getDia($dia)}");
            $this->planificarDia($medico, $current, $hora_desde, $hora_hasta, $input['duracion']);
        }
        return $this->getMisTurnosActuales($medico);
    }

    private function planificarDia(Medico $medico, Carbon $dia, Carbon $hora_desde, Carbon $hora_hasta, $duracion)
    {
        $current = $dia->copy()->setTimeFrom($hora_desde); // El dia aun no tiene una hora
        $end = $dia->copy()->setTimeFrom($hora_hasta); // Para comparar y poder finalizar el loop

        while ($current <= $end) {
            $this->crearTurno($medico, $current);
            $current->addMinutes($duracion);
        }
    }

    /**
     * @param Medico $medico
     * @param Carbon $fecha
     */
    public function crearTurno(Medico $medico, Carbon $fecha)
    {
        $turno = new Turno();
        $turno->medico()->associate($medico);
        $turno->fecha = $fecha;
        $turno->save();
    }

    private function getDia($dia)
    {
        switch ($dia) {
            case "lunes":
                return "monday";
            case "martes":
                return "tuesday";
            case "miercoles":
                return "wednesday";
            case "jueves":
                return "thursday";
            case "viernes":
                return "friday";
        }
    }
}
