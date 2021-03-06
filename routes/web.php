<?php

Route::view('/', 'portada')->name('portada');
Route::view('/ingreso', 'ingreso')->name('ingreso');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | Rutas solo para el usuario administrador
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::group(['middleware' => 'can:admin'], function () {
            Route::get('', 'UserController@index');

            // Gestión de usuarios
            Route::prefix('/usuarios')->group(function () {
                Route::get('', 'UserController@index');
                Route::get('nuevo', 'UserController@create');
                Route::post('', 'UserController@register');
                Route::get('{id}/editar', 'UserController@edit');
                Route::put('{id}', 'UserController@update');
                Route::delete('{id}', 'UserController@destroy');
            });

            // Gestión de médicos
            Route::prefix('/medicos')->group(function () {
                Route::get('', 'MedicoController@index');
                Route::get('nuevo', 'MedicoController@create');
                Route::post('', 'MedicoController@register');
                Route::get('{id}/editar', 'MedicoController@edit');
                Route::put('{id}', 'MedicoController@update');
                Route::delete('{id}', 'MedicoController@destroy');
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas solo para los médicos
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => 'can:medico'], function () {
        // Gestión de turnos
        Route::prefix('/turnos')->group(function () {
              Route::view('', 'turno.index');
              Route::view('confirmados', 'turno.confirmados');
        });

        // Gestión de turnos vía api DANGER
        Route::prefix('/internal-api/turnos')->group(function () {
            Route::get('', 'InternalApi\MedicoController@turnosActuales');
            Route::get('confirmados', 'InternalApi\MedicoController@turnosConfirmados');
            Route::post('', 'InternalApi\TurnoController@planificarHorarios');
            Route::put('{turno}/finalizar', 'InternalApi\TurnoController@finalizarTurno');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas para los usuarios recepcionistas
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => 'can:recepcionista'], function () {
        Route::prefix('/pacientes')->group(function () {
            Route::get('', 'PacienteController@index');
            Route::post('', 'PacienteController@store');
            Route::get('/nuevo', 'PacienteController@create');
            Route::get('{id}/editar', 'PacienteController@edit');
            Route::put('{id}', 'PacienteController@update');
            Route::delete('{id}', 'PacienteController@destroy');
            Route::get('{id}/turnos/nuevo', 'TurnoController@create');
            Route::get('turnos/nuevo', 'TurnoController@create');
        });

        Route::prefix('/turnos')->group(function () {
            Route::get('/sin-confirmar', 'TurnoController@getTurnosSinConfirmar');
        });


        Route::prefix('/internal-api')->group(function () {
            Route::prefix('/turnos')->group(function () {

                // DANGER
                Route::get('especialidad/{id}', 'Api\EspecialidadController@disponiblesPorEspecialidad');
                Route::get('medico/{id}', 'Api\MedicoController@turnosDisponibles');

                // works
                Route::post('{turno}/paciente/{paciente}', 'InternalApi\TurnoController@reservarTurno');
                Route::get('sin-confirmar', 'InternalApi\TurnoController@getTurnosSinConfirmar');
                Route::put('{turno}/confirmar', 'InternalApi\TurnoController@confirmarTurno');
                Route::put('{turno}/cancelar', 'InternalApi\TurnoController@cancelarTurno');
            });
        });  
    });

    Route::get('/perfil', 'ProfileController@edit');
    Route::put('/perfil-medico', 'ProfileController@updateMedico');
    Route::put('/perfil-user', 'ProfileController@updateUser');

    Route::get('password/change', 'Auth\ChangePasswordController@showChangePasswordForm');
    Route::put('password/change', 'Auth\ChangePasswordController@changePassword');
});
