<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed paciente
 * @property mixed fecha
 * @property mixed medico
 */
class TurnoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $paciente = $this->paciente ? $this->paciente->getFullNameAttribute() : "Libre";
        return [
            'id' => $this->id,
            'nombre' => $paciente,
            'paciente' => $this->paciente,
            'medico' => $this->medico->user->getFullNameAttribute(),
            'especialidad' => $this->medico->especialidad->nombre,
            'fecha' => $this->fecha,
        ];
    }
}
