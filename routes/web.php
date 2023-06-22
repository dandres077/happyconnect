<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();



Route::middleware(['auth'])->group(function(){

	Route::get('admin/home', 'HomeController@index')->name('home');
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Roles
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/roles/store', 'RoleController@store')->middleware('permiso:roles.store'); 
	Route::get('admin/roles', 'RoleController@index')->middleware('permiso:roles.index'); 
	Route::get('admin/roles/create', 'RoleController@create')->middleware('permiso:roles.create'); 
	Route::post('admin/roles/{id}/edit', 'RoleController@update')->middleware('permiso:roles.update'); 
	Route::get('admin/roles/{id}', 'RoleController@show')->middleware('permiso:roles.show'); 
	Route::delete('admin/roles/{id}', 'RoleController@destroy')->middleware('permiso:roles.destroy'); 
	Route::get('admin/roles/{id}/edit', 'RoleController@edit')->middleware('permiso:roles.edit'); 

/*
|--------------------------------------------------------------------------
| Permisos
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/permisos/store', 'PermisosController@store')->middleware('permiso:permisos.store'); 
	Route::get('admin/permisos', 'PermisosController@index')->middleware('permiso:permisos.index'); 
	Route::get('admin/permisos/create', 'PermisosController@create')->middleware('permiso:permisos.create'); 
	Route::put('admin/permisos/{role}', 'PermisosController@edit')->middleware('permiso:permisos.edit'); 
	Route::get('admin/permisos/{role}', 'PermisosController@show')->middleware('permiso:permisos.show'); 
	Route::delete('admin/permisos/{role}', 'PermisosController@destroy')->middleware('permiso:permisos.destroy'); 
	Route::get('admin/permisos/{role}/edit', 'PermisosController@edit')->middleware('permiso:permisos.edit'); 

/*
|--------------------------------------------------------------------------
| Usuarios
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/usuarios/store', 'UserController@store')->middleware('permiso:usuarios.store'); 
	Route::get('admin/usuarios', 'UserController@index')->middleware('permiso:usuarios.index'); 
	Route::get('admin/usuarios/create', 'UserController@create')->middleware('permiso:usuarios.create'); 
	Route::post('admin/usuarios/{id}/edit', 'UserController@update')->middleware('permiso:usuarios.update'); 
	Route::get('admin/usuarios/{role}', 'UserController@show')->middleware('permiso:usuarios.show'); 
	Route::delete('admin/usuarios/{id}', 'UserController@destroy')->middleware('permiso:usuarios.destroy'); 
	Route::get('admin/usuarios/{id}/edit', 'UserController@edit')->middleware('permiso:usuarios.edit'); 
	Route::post('admin/usuarios/{id}/active', 'UserController@active')->middleware('permiso:usuarios.active'); 
	Route::post('admin/usuarios/{id}/inactive', 'UserController@inactive')->middleware('permiso:usuarios.inactive'); 
	Route::post('admin/usuarios/pwd', 'UserController@pwd')->name('usuarios.pwd'); 

	Route::get('admin/perfil', 'UserController@show')->middleware('permiso:usuarios.show'); 
	Route::get('admin/perfil/{id}/edit', 'UserController@editarperfil')->middleware('permiso:usuarios.editarperfil'); 
	Route::post('admin/perfil/{id}/edit', 'UserController@updateperfil')->middleware('permiso:usuarios.updateperfil'); 


/*
|--------------------------------------------------------------------------
| Paises
|--------------------------------------------------------------------------
|
*/

	Route::post('admin/paises/store', 'PaisesController@store')->middleware('permiso:paises.store'); 
	Route::get('admin/paises', 'PaisesController@index')->middleware('permiso:paises.index'); 
	Route::get('admin/paises/create', 'PaisesController@create')->middleware('permiso:paises.create'); 
	Route::post('admin/paises/{id}/edit', 'PaisesController@update')->middleware('permiso:paises.update'); 
	Route::get('admin/paises/{id}/edit', 'PaisesController@edit')->middleware('permiso:paises.edit'); 
	Route::post('admin/paises/{id}', 'PaisesController@destroy')->middleware('permiso:paises.destroy'); 
	Route::post('admin/paises/{id}/active', 'PaisesController@active')->middleware('permiso:paises.active'); 
	Route::post('admin/paises/{id}/inactive', 'PaisesController@inactive')->middleware('permiso:paises.inactive'); 

/*
|--------------------------------------------------------------------------
| Departamentos
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/departamentos/store', 'DepartamentosController@store')->middleware('permiso:departamentos.store'); 
	Route::get('admin/departamentos', 'DepartamentosController@index')->middleware('permiso:departamentos.index'); 
	Route::get('admin/departamentos/create', 'DepartamentosController@create')->middleware('permiso:departamentos.create'); 
	Route::post('admin/departamentos/{id}/edit', 'DepartamentosController@update')->middleware('permiso:departamentos.update'); 
	Route::post('admin/departamentos/{id}', 'DepartamentosController@destroy')->middleware('permiso:departamentos.destroy'); 
	Route::get('admin/departamentos/{id}/edit', 'DepartamentosController@edit')->middleware('permiso:departamentos.edit'); 
	Route::post('admin/departamentos/{id}/active', 'DepartamentosController@active')->middleware('permiso:departamentos.active'); 
	Route::post('admin/departamentos/{id}/inactive', 'DepartamentosController@inactive')->middleware('permiso:departamentos.inactive'); 


/*
|--------------------------------------------------------------------------
| Ciudades
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/ciudades/store', 'CiudadesController@store')->middleware('permiso:ciudades.store'); 
	Route::get('admin/ciudades', 'CiudadesController@index')->middleware('permiso:ciudades.index'); 
	Route::get('admin/ciudades/create', 'CiudadesController@create')->middleware('permiso:ciudades.create'); 
	Route::post('admin/ciudades/{id}/edit', 'CiudadesController@update')->middleware('permiso:ciudades.update'); 
	Route::get('admin/ciudades/{id}', 'CiudadesController@show')->middleware('permiso:ciudades.show'); 
	Route::post('admin/ciudades/{id}', 'CiudadesController@destroy')->middleware('permiso:ciudades.destroy'); 
	Route::get('admin/ciudades/{id}/edit', 'CiudadesController@edit')->middleware('permiso:ciudades.edit'); 
	Route::post('admin/ciudades/{id}/active', 'CiudadesController@active')->middleware('permiso:ciudades.active'); 
	Route::post('admin/ciudades/{id}/inactive', 'CiudadesController@inactive')->middleware('permiso:ciudades.inactive'); 



/*
|--------------------------------------------------------------------------
| Generalidades
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/generalidades/store', 'GeneralidadesController@store')->middleware('permiso:generalidades.store'); 
	Route::get('admin/generalidades', 'GeneralidadesController@index')->middleware('permiso:generalidades.index'); 
	Route::get('admin/generalidades/create', 'GeneralidadesController@create')->middleware('permiso:generalidades.create'); 
	Route::post('admin/generalidades/{id}/edit', 'GeneralidadesController@update')->middleware('permiso:generalidades.update'); 
	Route::post('admin/generalidades/{id}', 'GeneralidadesController@destroy')->middleware('permiso:generalidades.destroy'); 
	Route::get('admin/generalidades/{id}/edit', 'GeneralidadesController@edit')->middleware('permiso:generalidades.edit'); 
	Route::post('admin/generalidades/{id}/active', 'GeneralidadesController@active')->middleware('permiso:generalidades.active'); 
	Route::post('admin/generalidades/{id}/inactive', 'GeneralidadesController@inactive')->middleware('permiso:generalidades.inactive'); 

/*
|--------------------------------------------------------------------------
| Catálogos
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/catalogos/store', 'CatalogosController@store')->middleware('permiso:catalogos.store'); 
	Route::get('admin/catalogos', 'CatalogosController@index')->middleware('permiso:catalogos.index'); 
	Route::get('admin/catalogos/create', 'CatalogosController@create')->middleware('permiso:catalogos.create'); 
	Route::post('admin/catalogos/{id}/edit', 'CatalogosController@update')->middleware('permiso:catalogos.update'); 
	Route::post('admin/catalogos/{id}', 'CatalogosController@destroy')->middleware('permiso:catalogos.destroy'); 
	Route::get('admin/catalogos/{id}/edit', 'CatalogosController@edit')->middleware('permiso:catalogos.edit'); 
	Route::post('admin/catalogos/{id}/active', 'CatalogosController@active')->middleware('permiso:catalogos.active'); 
	Route::post('admin/catalogos/{id}/inactive', 'CatalogosController@inactive')->middleware('permiso:catalogos.inactive'); 

/*
|--------------------------------------------------------------------------
| Empresas
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/empresas/store', 'EmpresasController@store')->middleware('permiso:empresas.store'); 
	Route::get('admin/empresas', 'EmpresasController@index')->middleware('permiso:empresas.index'); 
	Route::get('admin/empresas/create', 'EmpresasController@create')->middleware('permiso:empresas.create'); 
	Route::post('admin/empresas/{id}/edit', 'EmpresasController@update')->middleware('permiso:empresas.update'); 
	Route::post('admin/empresas/{id}', 'EmpresasController@destroy')->middleware('permiso:empresas.destroy'); 
	Route::get('admin/empresas/{id}/edit', 'EmpresasController@edit')->middleware('permiso:empresas.edit'); 
	Route::post('admin/empresas/{id}/active', 'EmpresasController@active')->middleware('permiso:empresas.active'); 
	Route::post('admin/empresas/{id}/inactive', 'EmpresasController@inactive')->middleware('permiso:empresas.inactive'); 


/*
|--------------------------------------------------------------------------
| Sedes
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/sedes/store', 'EmpresasSedesController@store')->middleware('permiso:sedes.store'); 
	Route::get('admin/sedes', 'EmpresasSedesController@index')->middleware('permiso:sedes.index'); 
	Route::get('admin/sedes/create', 'EmpresasSedesController@create')->middleware('permiso:sedes.create'); 
	Route::post('admin/sedes/{id}/edit', 'EmpresasSedesController@update')->middleware('permiso:sedes.update'); 
	Route::post('admin/sedes/{id}', 'EmpresasSedesController@destroy')->middleware('permiso:sedes.destroy'); 
	Route::get('admin/sedes/{id}/edit', 'EmpresasSedesController@edit')->middleware('permiso:sedes.edit'); 
	Route::post('admin/sedes/{id}/active', 'EmpresasSedesController@active')->middleware('permiso:sedes.active'); 
	Route::post('admin/sedes/{id}/inactive', 'EmpresasSedesController@inactive')->middleware('permiso:sedes.inactive'); 

/*
|--------------------------------------------------------------------------
| Areas
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/areas/store', 'AreasController@store')->middleware('permiso:areas.store'); 
	Route::get('admin/areas', 'AreasController@index')->middleware('permiso:areas.index'); 
	Route::get('admin/areas/create', 'AreasController@create')->middleware('permiso:areas.create'); 
	Route::post('admin/areas/{id}/edit', 'AreasController@update')->middleware('permiso:areas.update'); 
	Route::post('admin/areas/{id}', 'AreasController@destroy')->middleware('permiso:areas.destroy'); 
	Route::get('admin/areas/{id}/edit', 'AreasController@edit')->middleware('permiso:areas.edit'); 
	Route::post('admin/areas/{id}/active', 'AreasController@active')->middleware('permiso:areas.active'); 
	Route::post('admin/areas/{id}/inactive', 'AreasController@inactive')->middleware('permiso:areas.inactive'); 


/*
|--------------------------------------------------------------------------
| Asignaturas
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/asignaturas/store', 'AsignaturasController@store')->middleware('permiso:asignaturas.store'); 
	Route::get('admin/asignaturas', 'AsignaturasController@index')->middleware('permiso:asignaturas.index'); 
	Route::get('admin/asignaturas/create', 'AsignaturasController@create')->middleware('permiso:asignaturas.create'); 
	Route::post('admin/asignaturas/{id}/edit', 'AsignaturasController@update')->middleware('permiso:asignaturas.update'); 
	Route::post('admin/asignaturas/{id}', 'AsignaturasController@destroy')->middleware('permiso:asignaturas.destroy'); 
	Route::get('admin/asignaturas/{id}/edit', 'AsignaturasController@edit')->middleware('permiso:asignaturas.edit'); 
	Route::post('admin/asignaturas/{id}/active', 'AsignaturasController@active')->middleware('permiso:asignaturas.active'); 
	Route::post('admin/asignaturas/{id}/inactive', 'AsignaturasController@inactive')->middleware('permiso:asignaturas.inactive'); 

/*
|--------------------------------------------------------------------------
| Niveles
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/niveles/store', 'NivelesController@store')->middleware('permiso:niveles.store'); 
	Route::get('admin/niveles', 'NivelesController@index')->middleware('permiso:niveles.index'); 
	Route::get('admin/niveles/create', 'NivelesController@create')->middleware('permiso:niveles.create'); 
	Route::post('admin/niveles/{id}/edit', 'NivelesController@update')->middleware('permiso:niveles.update'); 
	Route::post('admin/niveles/{id}', 'NivelesController@destroy')->middleware('permiso:niveles.destroy'); 
	Route::get('admin/niveles/{id}/edit', 'NivelesController@edit')->middleware('permiso:niveles.edit'); 
	Route::post('admin/niveles/{id}/active', 'NivelesController@active')->middleware('permiso:niveles.active'); 
	Route::post('admin/niveles/{id}/inactive', 'NivelesController@inactive')->middleware('permiso:niveles.inactive'); 


/*
|--------------------------------------------------------------------------
| Grados
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/grados/store', 'GradosController@store')->middleware('permiso:grados.store'); 
	Route::get('admin/grados', 'GradosController@index')->middleware('permiso:grados.index'); 
	Route::get('admin/grados/create', 'GradosController@create')->middleware('permiso:grados.create'); 
	Route::post('admin/grados/{id}/edit', 'GradosController@update')->middleware('permiso:grados.update'); 
	Route::post('admin/grados/{id}', 'GradosController@destroy')->middleware('permiso:grados.destroy'); 
	Route::get('admin/grados/{id}/edit', 'GradosController@edit')->middleware('permiso:grados.edit'); 
	Route::post('admin/grados/{id}/active', 'GradosController@active')->middleware('permiso:grados.active'); 
	Route::post('admin/grados/{id}/inactive', 'GradosController@inactive')->middleware('permiso:grados.inactive'); 


/*
|--------------------------------------------------------------------------
| Temporadas
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/temporadas/store', 'TemporadasController@store')->middleware('permiso:temporadas.store'); 
	Route::get('admin/temporadas', 'TemporadasController@index')->middleware('permiso:temporadas.index'); 
	Route::get('admin/temporadas/create', 'TemporadasController@create')->middleware('permiso:temporadas.create'); 
	Route::post('admin/temporadas/{id}/edit', 'TemporadasController@update')->middleware('permiso:temporadas.update'); 
	Route::post('admin/temporadas/{id}', 'TemporadasController@destroy')->middleware('permiso:temporadas.destroy'); 
	Route::get('admin/temporadas/{id}/edit', 'TemporadasController@edit')->middleware('permiso:temporadas.edit'); 
	Route::post('admin/temporadas/{id}/active', 'TemporadasController@active')->middleware('permiso:temporadas.active'); 
	Route::post('admin/temporadas/{id}/inactive', 'TemporadasController@inactive')->middleware('permiso:temporadas.inactive'); 


/*
|--------------------------------------------------------------------------
| Periodos
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/periodos/store', 'PeriodosController@store')->middleware('permiso:periodos.store'); 
	Route::get('admin/periodos', 'PeriodosController@index')->middleware('permiso:periodos.index'); 
	Route::get('admin/periodos/create', 'PeriodosController@create')->middleware('permiso:periodos.create'); 
	Route::post('admin/periodos/{id}/edit', 'PeriodosController@update')->middleware('permiso:periodos.update'); 
	Route::post('admin/periodos/{id}', 'PeriodosController@destroy')->middleware('permiso:periodos.destroy'); 
	Route::get('admin/periodos/{id}/edit', 'PeriodosController@edit')->middleware('permiso:periodos.edit'); 
	Route::post('admin/periodos/{id}/active', 'PeriodosController@active')->middleware('permiso:periodos.active'); 
	Route::post('admin/periodos/{id}/inactive', 'PeriodosController@inactive')->middleware('permiso:periodos.inactive'); 

});