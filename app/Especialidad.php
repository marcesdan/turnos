<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
	protected $table = 'especialidad';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];
	
    /**
     * Devuelve los médicos asociados a esta especialidad
     */
    public function medicos()
    {
        return $this->hasMany('App\Medico');
    }
}
