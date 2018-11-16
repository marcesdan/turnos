<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\Services\EspecialidadService;
use App\Services\MedicoService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
