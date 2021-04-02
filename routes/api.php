<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/empresarios', 'EmpresariosController@index');
Route::post('/empresarios', 'EmpresariosController@cadastroEmpresarios');
Route::get('/empresarios/rede/{id}', 'EmpresariosController@rede');
Route::delete('/empresarios/{id}', 'EmpresariosController@delete');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
