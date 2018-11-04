<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @property mixed nombre
 * @property mixed apellido
 * @property mixed email
 * @property mixed telefono
 * @property mixed password
 * @property mixed role
 * @property mixed medico
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'email', 'telefono', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Los roles que posee éste desarrollador.
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * Si posee o no el rol dado
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role->nombre == $role;
    }

    /**
     * Asigna un rol a un usuario. Se debe llamar luego al método save()
     * @param $role , el rol a asignar al usuario
     */
    public function setRole($role)
    {
        $this->role()->associate(
            Role::where('nombre', $role)->first()
        );
    }

    public function medico()
    {
        return $this->hasOne('App\Medico');
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

    /**
     * User constructor.
     * @param array $attributes
     * @param $rol
     */
    public function __construct(array $attributes = [], $rol = null)
    {
        parent::__construct($attributes);
        if (isset($rol)) {
            $this->password = Hash::make(str_random(8));
            $this->setRole($rol);
            $this->save();
        }
    }

    /**
     * Actualiza los datos del usuario
     * @param array $input
     * @return $this
     */
    public function actualizar(array $input) {
        $this->fill($input);
        // si está presente en el array y es un nuevo rol...
        if ( array_has($input, 'rol') )
            $this->setRole($input['rol']);

        $this->save();
        return $this;
    }
}
