<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creamos los roles...
        App\Role::create(['nombre' => 'Administrador']);
        App\Role::create(['nombre' => 'Recepcionista']);
        App\Role::create(['nombre' => 'Médico']);
    }
}
