<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanTurnoRequest;
use App\Http\Resources\TurnoResource;
use App\Services\PacienteService;
use App\Services\TurnoService;
use App\Services\MedicoService;
use Illuminate\Http\Request;
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
        $especialidades = $this->medicoService->findAllEspecialidades();
        return view('turno.create', [
            'paciente' => $paciente,
            'medicos' => $medicos,
            'especialidades' => $especialidades,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlanTurnoRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store(PlanTurnoRequest $request)
    {
        $input = $request->validated();
        $medico = Auth::user()->medico;
        $turnos = $this->turnoService->planificarSemana($input, $medico);
        return TurnoResource::collection($turnos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
