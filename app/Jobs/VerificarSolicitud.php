<?php

namespace App\Jobs;

use App\Paciente;
use App\Turno;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VerificarSolicitud implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $turno;

    /**
     * Create a new job instance.
     *
     * @param Turno $turno
     */
    public function __construct(Turno $turno)
    {
        $this->turno = $turno;
    }

    /**
     * Execute the job.
     * Si el turno no tiene un paciente asignado, es porque el paciente no confirmó
     * la reserva en el tiempo establecido. Por lo tanto, el turno queda disponible
     * para otro paciente que quiera reservarlo.
     * @return void
     */
    public function handle()
    {
        if (!$this->turno->paciente) {
            $this->turno->reservado = null;
            $this->turno->save();
        }
    }
}
