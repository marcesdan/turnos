<?php
/**
 * Created by PhpStorm.
 * User: marces
 * Date: 18/09/18
 * Time: 13:31
 */

namespace App\Services;

use App\Medico;
use App\Turno;
use Carbon\Carbon;

class TurnoService
{
    protected $medicoService;

    public function __construct(MedicoService $medicoService)
    {
        $this->medicoService = $medicoService;
    }

    /**
     * Retorna todos los turno que aun no han sido atendidos, ni confirmados, ni reservados
     * @param Medico $medico
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurnosActuales(Medico $medico)
    {
        return $medico->turnos()
            ->whereNull('finalizado')
            ->where('fecha', '>=', Carbon::today())
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
     * Retorna los turno del dia de hoy que quedan por atender
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
    public function planificarSemana($input, Medico $medico)
    {
        $hora_desde = Carbon::createFromTimeString($input['hora_desde']);
        $hora_hasta = Carbon::createFromTimeString($input['hora_hasta']);

        foreach ($input['dias'] as $dia) {
            $current = new Carbon("next {$this->getDia($dia)}");
            $this->planificarDia($medico, $current, $hora_desde, $hora_hasta, $input['duracion']);
        }
        return $this->getTurnosActuales($medico);
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

    private function crearTurno(Medico $medico, Carbon $fecha)
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
