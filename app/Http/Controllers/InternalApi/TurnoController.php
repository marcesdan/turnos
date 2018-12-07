<?php

namespace App\Http\Controllers\InternalApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanHorarioRequest;
use App\Http\Resources\TurnoCalendarResource;
use App\Http\Resources\TurnoConfirmadoResource;
use App\Http\Resources\TurnoDisponibleResource;
use App\Http\Resources\TurnoResource;
use App\Http\Resources\TurnoSinConfirmarResource;
use App\Services\MedicoService;
use App\Services\PacienteService;
use App\Services\TurnoService;
use Illuminate\Support\Facades\Auth;

class TurnoController extends Controller
{
    protected $medicoService;
    protected $turnoService;
    protected $pacienteService;

    public function __construct(TurnoService $turnoService,
                                MedicoService $medicoService,
                                PacienteService $pacienteService)
    {
        $this->medicoService = $medicoService;
        $this->turnoService = $turnoService;
        $this->pacienteService = $pacienteService;
    }

    /**
     * Retorna al usuario recepcionista una vista con los turnos sin confirmar,
     * y así poder confirmarlos cuando los pacientes arriben.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getTurnosSinConfirmar()
    {
        return TurnoResource::collection(
            $turnos = \App\Turno::whereDate('fecha', '>', '2018-11-12')->get()
        );
        /*
        return TurnoResource::collection(
            $turnos = $this->turnoService->getTurnosSinConfirmar()
        );
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlanHorarioRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function planificarHorarios(PlanHorarioRequest $request)
    {
        $input = $request->validated();
        $medico = Auth::user()->medico;
        $turnos = $this->turnoService->planificarHorarios($input, $medico);
        return TurnoCalendarResource::collection($turnos);
    }

    /**
     * Store a newly created resource in storage.
     * @param $turno
     * @param $paciente
     */
    public function reservarTurno($turno, $paciente)
    {
        $turno = $this->turnoService->find($turno);
        $paciente = $this->pacienteService->find($paciente);
        $this->turnoService->reservarTurno($turno, $paciente);
        return parent::ok();
    }

    /**
     * Confirma un turno minutos antes de que se realice la atencion del mismo
     * @param $turno
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmarTurno($turno)
    {
        $this->turnoService->confirmarTurno($turno);
        return parent::noContent();
    }

    /**
     * Cancela un turno, el cual estará disponible para ser reservado por otro pacieinte
     * @param $turno
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelarTurno($turno)
    {
        $this->turnoService->cancelarTurno($turno);
        return parent::noContent();
    }

    /**
     * Finaliza un turno, lo cual significa que fue atendido
     * @param $turno
     * @return \Illuminate\Http\JsonResponse
     */
    public function finalizarTurno($turno)
    {
        $this->turnoService->finalizarTurno($turno);
        return parent::noContent();
    }
}
