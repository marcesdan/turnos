<?php

namespace App\Http\Controllers\InternalApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\TurnoResource;
use App\Services\MedicoService;
use App\Services\TurnoService;
use Illuminate\Support\Facades\Auth;

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
     * Devuelve una colección con todos los turno vigentes del medico autenticado
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function turnosActuales()
    {
        $medico = Auth::user()->medico;
        return TurnoResource::collection(
            $this->medicoService->getTurnosActuales($medico)
        );
    }

    /**
     * Retorna los turnos que están que ya han sido confirmados.
     * Lo cual significa que el médico ya puede atenderlos
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function turnosConfirmados()
    {
        $medico = Auth::user()->medico;
        return TurnoResource::collection(
            $this->medicoService->getTurnosConfirmados($medico)
        );
    }
}
