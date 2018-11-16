<?php

namespace App\Mail;

use App\Paciente;
use App\Turno;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservarTurno extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Turno $turno
     * @param Paciente $paciente
     */
    public function __construct(Turno $turno, Paciente $paciente)
    {
        $this->turno = $turno;
        $this->paciente = $paciente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reservar-turno')
            ->with([
                'paciente' => $this->paciente->getFullNameAttribute(),
                'medico' => $this->turno->medico->user->getFullNameAttribute(),
                'fecha' => $this->turno->fecha,
                'especialidad' => $this->turno->medico->especialidad->nombre,
            ]);
    }
}
