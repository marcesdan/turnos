<?php

use Illuminate\Database\Seeder;
use App\Paciente;
class PacienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Paciente::class, 60)->create();

        // me creo como paciente :)
        Paciente::create([
            'nombre' => 'Mariano César',
            'apellido' => "D'Angelo",
            'email' => 'marianod93@gmail.com',
            'telefono' => '2901-606964',
            'documento' => '37533200'
        ]);
    }
}
