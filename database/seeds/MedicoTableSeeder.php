<?php

use Illuminate\Database\Seeder;
use App\Medico;
use App\Role;

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
        factory(Medico::class, 20)
        	->create()
        	->each(function ($u) use ($rol_medico) {
        		$u->user->role()->associate($rol_medico);
        		$u->user->save();
    		});
    }
}
