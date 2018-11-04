<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed paciente
 * @property mixed fecha
 * @property mixed medico
 */
class TurnoConfirmadoResource extends JsonResource
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
        // se convierte un timestamp a una hora en formato 24hs, ejemplo: 16:00
        $hora = date('H:i', strtotime($this->fecha));
        return [
            'id' => $this->id,
            'nombre' => $paciente,
            'documento' => $this->paciente->documento,
            'hora' => $hora,
        ];
    }
}
