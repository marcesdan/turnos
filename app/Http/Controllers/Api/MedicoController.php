<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MedicoCollection;
use App\Services\MedicoService;
use App\Http\Controllers\Controller;

class MedicoController extends Controller
{
    protected $medicoService;

    public function __construct(MedicoService $medicoService)
    {
        $this->medicoService = $medicoService;
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
}
