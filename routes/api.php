<?php

//Route::get('/turnos', 'Api\TurnoController@getTurnosSinConfirmar');
Route::post('ingreso', 'Api\PacienteController@ingreso');

Route::get('medicos', 'Api\MedicoController@index');
Route::get('especialidades', 'Api\EspecialidadController@index');
Route::get('turnos/medico/{medico}', 'Api\TurnoController@disponiblesPorMedico');
Route::get('turnos/especialidad/{medico}', 'Api\TurnoController@disponiblesPorEspecialidad');
Route::get('turnos/especialidad/{medico}', 'Api\TurnoController@disponiblesPorEspecialidad');
Route::post('turnos/reservar', 'Api\TurnoController@reservarTurnoPublico');

