<?php

namespace App\Http\Controllers\InternalApi;

use App\Http\Resources\PacienteResource;
use App\Services\MedicoService;
use App\Services\PacienteService;
use App\Services\TurnoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PacienteController extends Controller
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
     * Ingreso del paciente al sistema publico de turnos
     *
     * @param Request $request
     * @return PacienteResource
     */
    public function ingreso(Request $request)
    {
        $paciente = $this->pacienteService->findByDocumento(
            $request->get('documento')
        );
        return new PacienteResource($paciente);
    }
}
