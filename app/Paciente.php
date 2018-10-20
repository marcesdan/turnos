<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed nombre
 * @property mixed apellido
 * @property mixed email
 * @property mixed documento
 * @property mixed telefono
 * @property mixed turno
 */
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
     * Devuelve todos los turno reservados por este paciente
     */
    public function turnos()
    {
        return $this->hasMany('App\Turno');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
