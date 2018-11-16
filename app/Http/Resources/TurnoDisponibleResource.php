<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TurnoDisponibleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'medico' => $this->medico->user->getFullNameAttribute(),
            'especialidad' => $this->medico->especialidad->nombre,
            'fecha' => $this->fecha,
        ];
    }
}
