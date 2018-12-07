<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SolicitudRequest;
use App\Services\PacienteService;
use App\Services\SolicitudService;
use App\Services\TurnoService;

class SolicitudController extends Controller
{
    protected $turnoService;
    protected $pacienteService;
    protected $solicitudService;

    public function __construct(TurnoService $turnoService,
                                PacienteService $pacienteService,
                                SolicitudService $solicitudService)
    {
        $this->turnoService = $turnoService;
        $this->pacienteService = $pacienteService;
        $this->solicitudService = $solicitudService;
    }

    /**
     * @param SolicitudRequest $request
     */
    public function solicitarTurno(SolicitudRequest $request)
    {
        $input = $request->validated();
        $turno = $this->turnoService->find($input['turno']);
        $paciente = $this->pacienteService->find($input['paciente']);
        $this->solicitudService->crearSolicitud($turno, $paciente);
        return parent::ok();
    }

    /**
     * @param $turno_id
     * @param $paciente_id
     */
    public function confirmarSolicitud($turno_id, $paciente_id)
    {
        $turno = $this->turnoService->find($turno_id);
        $paciente = $this->pacienteService->find($paciente_id);
        $this->solicitudService->confirmarSolicitud($turno, $paciente);
        return parent::ok();
    }
}
