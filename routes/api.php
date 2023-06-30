<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/departamentos/{pais_id}/', 'EmpresasController@departamentos'); //Departamentos por país
Route::get('/ciudades/{departamento_id}/', 'EmpresasController@ciudades'); //ciudades por departamento
Route::get('/paralelos/{empresa_id}/{temporada_id}/{grado_id}', 'ParalelosController@paralelos'); //Paralelos por empresa, temporada y grado
Route::get('/actividades/{empresa_id}/empresa', 'ActividadesController@consulta');  //Actividades por empresa