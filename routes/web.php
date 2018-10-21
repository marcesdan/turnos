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

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/email','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function () {

    Route::prefix('admin')->group(function () {
        Route::group(['middleware' => 'can:admin'], function () {

            Route::get('', 'UserController@index');
            Route::prefix('/usuarios')->group(function () {
                Route::get('', 'UserController@index');
                Route::get('nuevo', 'UserController@create');
                Route::post('', 'UserController@register');
                Route::get('{id}/editar', 'UserController@edit');
                Route::put('{id}', 'UserController@update');
                Route::delete('{id}', 'UserController@destroy');
            });

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

    Route::group(['middleware' => 'can:medico'], function () {
        Route::view('/turnos', 'turno.index');
        Route::get('/api/turno', 'Api\TurnoController@misTurnosActuales');
        Route::post('/api/turno', 'Api\TurnoController@store');
    });


    Route::prefix('atencion')->group(function () {

    });

    Route::group(['middleware' => 'can:recepcionista'], function () {
        Route::get('/', 'PacienteController@index');
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
    });

    Route::get('/perfil', 'ProfileController@edit');
    Route::put('/perfil-medico', 'ProfileController@updateMedico');
    Route::put('/perfil-user', 'ProfileController@updateUser');

    Route::get('password/change', 'Auth\ChangePasswordController@showChangePasswordForm');
    Route::put('password/change', 'Auth\ChangePasswordController@changePassword');

    Route::view('/', 'welcome');
});
