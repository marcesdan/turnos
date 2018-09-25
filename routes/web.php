<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::redirect('/register', '/admin/usuario/nuevo');

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('admin')->group(function () {
        Route::group(['middleware' => 'can:admin'], function () {
            Route::redirect('/', '/admin/usuario');
            Route::get('/usuario', 'UserController@index');
            Route::get('/usuario/nuevo', 'UserController@create');
            Route::post('/usuario', 'Auth\RegisterController@register');
            Route::get('/usuario/{id}/editar', 'UserController@edit');
            Route::put('/usuario/{id}', 'UserController@update');
            Route::delete('/usuario/{id}', 'UserController@destroy');
        });
    });

    Route::view('/turnos', 'turnos.turnos');

    Route::prefix('atencion')->group(function () {
        Route::group(['middleware' => 'can:medico'], function () {

        });
    });

    Route::group(['middleware' => 'can:recepcionista'], function () {
        Route::redirect('/', '/paciente');
        Route::get('/paciente', 'PacienteController@index');
        Route::post('/paciente', 'PacienteController@store');
        Route::get('/paciente/nuevo', 'PacienteController@create');
        Route::get('/paciente/{id}/editar', 'PacienteController@edit');
        Route::put('/paciente/{id}', 'PacienteController@update');
        Route::delete('/paciente/{id}', 'PacienteController@destroy');
    });


    Route::view('/', 'welcome');
});
