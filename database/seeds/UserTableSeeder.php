<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // obtenemos los roles...
        $role_administrador = Role::where('nombre', 'Administrador')->first();
        $role_recepcionista = Role::where('nombre','Recepcionista')->first();
        $role_medico = Role::where('nombre', 'Médico')->first();

        // creamos 10 recepcionistas
    	factory(User::class, 10)
            ->create()
            ->each(function ($u) use ($role_recepcionista) {
                $u->role()->associate($role_recepcionista);
                $u->save();
            });

        // me creo como administrador
        User::create([
            'nombre' => 'Mariano César',
            'apellido' => "D'Angelo",
            'email' => 'marianod93@gmail.com',
            'role_id' => $role_administrador->id,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' //secret
        ]);

        // por si acaso...
        User::create([
            'nombre' => 'Mariano César',
            'apellido' => "D'Angelo",
            'email' => 'marcesdan@gmail.com',
            'role_id' => $role_administrador->id,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' //secret
        ]);

        // me creo como médico
        User::create([
            'nombre' => 'Mariano César',
            'apellido' => "D'Angelo",
            'email' => 'marianod_93@hotmail.com',
            'role_id' => $role_medico->id,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' //secret
        ]);

        // y como recepcionista
        User::create([
            'nombre' => 'Mariano César',
            'apellido' => "D'Angelo",
            'email' => 'marianodeush@hotmail.com',
            'role_id' => $role_recepcionista->id,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm' //secret
        ]);
    }
}
