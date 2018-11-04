<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TurnoCalendarResource extends JsonResource
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
            'title' => $paciente,
            'start' => $this->fecha,
        ];
    }
}
