<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TurnoResource;
use App\Services\EspecialidadService;

class EspecialidadController extends Controller
{
    protected $especialidadService;

    public function __construct(EspecialidadService $especialidadService)
    {
        $this->especialidadService = $especialidadService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(['data' =>
            $this->especialidadService->findAll()
        ], 200);
    }

    /**
     *  Devuelve una colección con todos los turnos disponibles de una especialidad
     *
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function disponiblesPorEspecialidad($id)
    {
        $espServ = new EspecialidadService();
        $especialidad = $espServ->find($id);
        return TurnoResource::collection(
            $espServ->disponiblesPorEspecialidad($especialidad)
        );
    }
}
