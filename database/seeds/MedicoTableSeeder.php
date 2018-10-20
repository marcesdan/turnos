<?php

use Illuminate\Database\Seeder;
use App\Medico;
use App\User;
use App\Role;
use App\Especialidad;

class MedicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_medico = Role::where('nombre','Médico')->first();
        /*
        factory(Medico::class, 5)
        	->create()
        	->each(function ($u) use ($rol_medico) {
        		$u->user->role()->associate($rol_medico);
        		$u->user->save();
    		});
        */

         // me creo como médico
        $user = User::create([
            'nombre' => 'Mariano César',
            'apellido' => "D'Angelo",
            'email' => 'marianod_93@hotmail.com',
            'telefono' => '2901-606964',
            'role_id' => $rol_medico->id,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' //secret
        ]);
        $medico = new Medico();
        $especialidad = factory(Especialidad::class)->create();
        $medico->user()->associate($user);
        $medico->especialidad()->associate($especialidad);
        $medico->save();
    }
}
