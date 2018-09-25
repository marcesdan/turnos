<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        //$this->call(EspecialidadTableSeeder::class);
        $this->call(MedicoTableSeeder::class);
        $this->call(PacienteTableSeeder::class);
        $this->call(TurnoTableSeeder::class);
    }
}
