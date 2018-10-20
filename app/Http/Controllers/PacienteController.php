<?php

namespace App\Http\Controllers;

use App\Services\PacienteService;
use App\Http\Requests\PacienteRequest;

class PacienteController extends Controller
{

    protected $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = $this->pacienteService->findAll();
        return view('paciente.index', ['pacientes' => $pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paciente.create');
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
     * Store the specified resource in storage.
     *
     * @param  \App\Http\Requests\PacienteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteRequest $request)
    {
        $validatedData = $request->validated();
        $this->pacienteService->store($validatedData);
        return redirect('/pacientes')->with('status', 'Paciente creado con éxito!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = $this->pacienteService->find($id);
        return view('paciente.edit', ['paciente' => $paciente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PacienteRequest $request
     * @param  int $documento
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteRequest $request, $id)
    {
        $paciente = $this->pacienteService->find($id);
        $validatedData = $request->validated();
        $this->pacienteService->update($validatedData, $paciente);
        return redirect('/pacientes')->with('status', 'Paciente editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = $this->pacienteService->find($id);
        $this->pacienteService->destroy($paciente);
        return response()->json(200);
    }
}
