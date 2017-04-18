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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'usuarios'], function()
{
	Route::resource('/', 'UsuariosController');
	Route::put('update', 'UsuariosController@update');
	Route::get('gestionUsuarios', 'UsuariosController@gestionUsuarios');
	Route::post('importarUsuarios', 'UsuariosController@importarUsuarios');
	Route::post('eliminar', 'UsuariosController@destroy');
});