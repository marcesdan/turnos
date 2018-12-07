<?php

namespace App\Http\Controllers;

use App\Services\EspecialidadService;
use App\Services\MedicoService;
use App\Services\PacienteService;
use App\Services\TurnoService;

class TurnoController extends Controller
{
    protected $medicoService;
    protected $turnoService;
    protected $pacienteService;
    protected $especialidadService;

    public function __construct(TurnoService $turnoService,
                                MedicoService $medicoService,
                                PacienteService $pacienteService
    )
    {
        $this->medicoService = $medicoService;
        $this->turnoService = $turnoService;
        $this->pacienteService = $pacienteService;
    }

    /**
     * Retorna al usuario recepcionista una vista con los turnos que están próximos a ocurrir.
     * y así confirmarlos cuando los pacientes arriben.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTurnosSinConfirmar()
    {
        return view('turno.sin-confirmar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        $paciente = $this->pacienteService->find($id);
        $medicos = $this->medicoService->findAll();
        //$especialidades = $this->medicoService->findAllEspecialidades();

        $espService = new EspecialidadService();
        $especialidades = $espService->findAll();
        return view('turno.create', [
            'paciente' => $paciente,
            'medicos' => $medicos,
            'especialidades' => $especialidades,
        ]);
    }
}
