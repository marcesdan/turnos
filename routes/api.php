<?php

//Route::get('/turnos', 'Api\TurnoController@getTurnosSinConfirmar');
Route::post('ingreso', 'Api\PacienteController@ingreso');
Route::get('medicos', 'Api\MedicoController@index');
Route::get('especialidades', 'Api\EspecialidadController@index');
Route::get('turnos/medico/{medico}', 'Api\MedicoController@turnosdisponibles');
Route::get('turnos/especialidad/{especialidad}', 'Api\EspecialidadController@turnosDisponibles');
Route::post('turnos/solicitar', 'Api\SolicitudController@solicitarTurno');
Route::get('turnos/solicitar/{turno}/{paciente}', 'Api\SolicitudController@confirmarSolicitud')
	->name('solicitud.confirmar')
	->middleware('signed');

