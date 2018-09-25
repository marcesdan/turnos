<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

	protected $table = 'paciente';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'email', 'documento', 'telefono'
    ];

    /**
     * Devuelve todos los turnos reservados por este paciente
     */
    public function turnos()
    {
        return $this->hasMany('App\Turno');
    }
}
