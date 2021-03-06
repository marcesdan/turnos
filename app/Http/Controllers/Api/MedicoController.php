<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicoCollection;
use App\Http\Resources\TurnoResource;
use App\Services\MedicoService;
use App\Services\TurnoService;

class MedicoController extends Controller
{
    protected $medicoService;
    protected $turnoService;

    /**
     * MedicoController constructor.
     * @param $medicoService
     * @param $turnoService
     */
    public function __construct(MedicoService $medicoService, TurnoService $turnoService)
    {
        $this->medicoService = $medicoService;
        $this->turnoService = $turnoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return MedicoCollection
     */
    public function index()
    {
        return new MedicoCollection(
            $this->medicoService->findAll()
        );
    }

    /**
     * Devuelve una colección con todos los turnos disponibles de un medico
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function turnosDisponibles($id)
    {
        $medico = $this->medicoService->find($id);
        return TurnoResource::collection(
            $this->medicoService->getTurnosDisponibles($medico)
        );
    }
}
