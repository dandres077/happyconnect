<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| Recuperar contraseña
|--------------------------------------------------------------------------
|
*/
	Route::post('/usuarios/recuperar_pwd', 'UserController@recuperar_envio'); // Envio de correo electrónico para recuperar la contraseña
	Route::get('/usuarios/recuperar/{token}', 'UserController@recuperar_pwd'); // Formulario para registrar la nueva contraseña
	Route::post('/usuarios/nueva_pwd', 'UserController@nueva_pwd'); // Actualización de contraseña


	

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


/*
|--------------------------------------------------------------------------
| Paralelos
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/paralelos/store', 'paralelosController@store')->middleware('permiso:paralelos.store'); 
	Route::get('admin/paralelos', 'paralelosController@index')->middleware('permiso:paralelos.index'); 
	Route::get('admin/paralelos/create', 'paralelosController@create')->middleware('permiso:paralelos.create'); 
	Route::post('admin/paralelos/{id}/edit', 'paralelosController@update')->middleware('permiso:paralelos.update'); 
	Route::post('admin/paralelos/{id}', 'paralelosController@destroy')->middleware('permiso:paralelos.destroy'); 
	Route::get('admin/paralelos/{id}/edit', 'paralelosController@edit')->middleware('permiso:paralelos.edit'); 
	Route::post('admin/paralelos/{id}/active', 'paralelosController@active')->middleware('permiso:paralelos.active'); 
	Route::post('admin/paralelos/{id}/inactive', 'paralelosController@inactive')->middleware('permiso:paralelos.inactive'); 


/*
|--------------------------------------------------------------------------
| Profesionales
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/profesionales/store', 'ProfesionalesController@store')->middleware('permiso:profesionales.store'); 
	Route::get('admin/profesionales', 'ProfesionalesController@index')->middleware('permiso:profesionales.index'); 
	Route::get('admin/profesionales/create', 'ProfesionalesController@create')->middleware('permiso:profesionales.create'); 
	Route::post('admin/profesionales/{id}/edit', 'ProfesionalesController@update')->middleware('permiso:profesionales.update'); 
	Route::post('admin/profesionales/{id}', 'ProfesionalesController@destroy')->middleware('permiso:profesionales.destroy'); 
	Route::get('admin/profesionales/{id}/edit', 'ProfesionalesController@edit')->middleware('permiso:profesionales.edit'); 
	Route::post('admin/profesionales/{id}/active', 'ProfesionalesController@active')->middleware('permiso:profesionales.active'); 
	Route::post('admin/profesionales/{id}/inactive', 'ProfesionalesController@inactive')->middleware('permiso:profesionales.inactive'); 
	Route::get('admin/profesionales/show', 'ProfesionalesController@show')->middleware('permiso:profesionales.show'); 


/*
|--------------------------------------------------------------------------
| Alumnos
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/alumnos/store', 'AlumnosController@store')->name('alumnos.store')->middleware('permiso:alumnos.store');
	Route::get('admin/alumnos', 'AlumnosController@index')->name('alumnos.index')->middleware('permiso:alumnos.index');
	Route::get('admin/alumnos/create', 'AlumnosController@create')->name('alumnos.create')->middleware('permiso:alumnos.create');
	Route::post('admin/alumnos/{id}/edit', 'AlumnosController@update')->name('alumnos.update')->middleware('permiso:alumnos.update');
	Route::get('admin/alumnos/{id}', 'AlumnosController@show')->name('alumnos.show')->middleware('permiso:alumnos.show');
	Route::delete('admin/alumnos/{id}', 'AlumnosController@destroy')->name('alumnos.destroy')->middleware('permiso:alumnos.destroy');
	Route::get('admin/alumnos/{id}/edit', 'AlumnosController@edit')->name('alumnos.edit')->middleware('permiso:alumnos.edit');
	Route::post('admin/alumnos/{id}/active', 'AlumnosController@active')->name('alumnos.active')->middleware('permiso:alumnos.active');
	Route::post('admin/alumnos/{id}/inactive', 'AlumnosController@inactive')->name('alumnos.inactive')->middleware('permiso:alumnos.inactive');
	Route::get('admin/alumnos/{id}/view', 'AlumnosController@view')->name('alumnos.view')->middleware('permiso:alumnos.view');


	Route::get('admin/alumnos/{id}/padres', 'AlumnosController@padre_alumno')->name('alumnos.padre_alumno')->middleware('permiso:alumnos.padre_alumno');
	Route::post('admin/alumnos/padres', 'AlumnosController@padres')->name('alumnos.padres')->middleware('permiso:alumnos.padres');
	Route::get('admin/alumnos/padres/{id}/create', 'AlumnosController@padre_create')->name('alumnos.padre_create')->middleware('permiso:alumnos.padre_create');
	Route::post('admin/alumnos/padres/store', 'AlumnosController@padres_store')->name('alumnos.padres_store')->middleware('permiso:alumnos.padres_store');


/*
|--------------------------------------------------------------------------
| Matriculas
|--------------------------------------------------------------------------
|
*/
	Route::get('admin/matriculas', 'MatriculasController@index')->name('matriculas.index')->middleware('permiso:matriculas.index'); 
	Route::get('admin/matriculas/create', 'MatriculasController@create')->name('matriculas.create')->middleware('permiso:matriculas.create'); 
	Route::post('admin/matriculas/store', 'MatriculasController@store')->name('matriculas.store')->middleware('permiso:matriculas.store'); 
	Route::get('admin/matriculas/{id}/edit', 'MatriculasController@edit')->name('matriculas.edit')->middleware('permiso:matriculas.edit'); 
	Route::post('admin/matriculas/{id}/edit', 'MatriculasController@update')->name('matriculas.update')->middleware('permiso:matriculas.update'); 
	Route::post('admin/matriculas/{id}/delete', 'MatriculasController@destroy')->name('matriculas.destroy')->middleware('permiso:matriculas.destroy'); 
	Route::post('admin/matriculas/{id}/active', 'MatriculasController@active')->name('matriculas.active')->middleware('permiso:matriculas.active'); 
	Route::post('admin/matriculas/{id}/inactive', 'MatriculasController@inactive')->name('matriculas.inactive')->middleware('permiso:matriculas.inactive');
	Route::post('admin/matriculas/store2', 'MatriculasController@store2')->name('matriculas.store2')->middleware('permiso:matriculas.store2'); 
	Route::post('admin/matriculas/store3', 'MatriculasController@store3')->name('matriculas.store3')->middleware('permiso:matriculas.store3'); 
	Route::get('admin/matriculas/reporte', 'MatriculasController@reporte')->name('matriculas.reporte')->middleware('permiso:matriculas.reporte'); 
	Route::post('admin/matriculas/validar', 'MatriculasController@validar')->name('matriculas.validar')->middleware('permiso:matriculas.validar');
	Route::get('admin/matriculas/{id}/ampliar', 'MatriculasController@ampliar')->name('matriculas.ampliar')->middleware('permiso:matriculas.ampliar');
    Route::post('admin/matriculas/masivo', 'MatriculasController@importarExcel')->name('matriculas.ampliar')->middleware('permiso:matriculas.importarExcel');



/*
|--------------------------------------------------------------------------
| Horarios paralelos
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/horarios_paralelos/store', 'ParalelosHorariosController@store')->middleware('permiso:horarios_paralelos.store'); 
	Route::get('admin/horarios_paralelos/{id}', 'ParalelosHorariosController@index')->middleware('permiso:horarios_paralelos.index'); 
	Route::get('admin/horarios_paralelos/{id}/create', 'ParalelosHorariosController@create')->middleware('permiso:horarios_paralelos.create'); 
	Route::post('admin/horarios_paralelos/{id}/edit', 'ParalelosHorariosController@update')->middleware('permiso:horarios_paralelos.update'); 
	Route::post('admin/horarios_paralelos/{id}', 'ParalelosHorariosController@destroy')->middleware('permiso:horarios_paralelos.destroy'); 
	Route::get('admin/horarios_paralelos/{id}/edit', 'ParalelosHorariosController@edit')->middleware('permiso:horarios_paralelos.edit'); 
	Route::post('admin/horarios_paralelos/{id}/active', 'ParalelosHorariosController@active')->middleware('permiso:horarios_paralelos.active'); 
	Route::post('admin/horarios_paralelos/{id}/inactive', 'ParalelosHorariosController@inactive')->middleware('permiso:horarios_paralelos.inactive'); 
	Route::get('admin/horarios_paralelos/', 'ParalelosHorariosController@show')->middleware('permiso:horarios_paralelos.show'); 

/*
|--------------------------------------------------------------------------
| Actividades
|--------------------------------------------------------------------------
|
*/

	Route::post('admin/actividades/store', 'ActividadesController@store')->middleware('permiso:actividades.store'); 
	Route::get('admin/actividades', 'ActividadesController@index')->middleware('permiso:actividades.index');
	Route::get('admin/actividades/{reserva_id}/informacion', 'ActividadesController@reserva');
	Route::get('admin/actividades/create', 'ActividadesController@create')->middleware('permiso:actividades.create'); 
	Route::post('admin/actividades/update', 'ActividadesController@update')->middleware('permiso:actividades.update'); 
	Route::get('admin/actividades/{id}/edit', 'ActividadesController@edit')->middleware('permiso:actividades.edit'); 
	Route::get('admin/actividades/{id}/eliminar', 'ActividadesController@destroy')->middleware('permiso:actividades.destroy'); 
	Route::get('admin/actividades/general', 'ActividadesController@show')->middleware('permiso:actividades.show'); 
	Route::get('admin/actividades/{id}/inactive', 'ActividadesController@inactive'); 


/*
|--------------------------------------------------------------------------
| Cobros mensuales, cuotas extraordinarias, multas
|--------------------------------------------------------------------------
|
*/
	Route::get('admin/cobros', 'CobrosController@index')->middleware('permiso:cobros.index'); 
	Route::get('admin/cobros/paralelo/{paralelo_id}', 'CobrosController@alumnos')->middleware('permiso:cobros.alumnos'); 
	Route::get('admin/cobros/create', 'CobrosController@create')->middleware('permiso:cobros.create');
	Route::post('admin/cobros/store', 'CobrosController@store')->middleware('permiso:cobros.store'); 
	Route::get('admin/cobros/{id}/edit', 'CobrosController@edit')->middleware('permiso:cobros.edit'); 
	Route::post('admin/cobros/{id}/edit', 'CobrosController@update')->middleware('permiso:cobros.update'); 
	Route::get('admin/cobros/{id}/delete', 'CobrosController@destroy')->middleware('permiso:cobros.destroy'); 	
	Route::get('admin/cobros/{id}/reenvio', 'CobrosController@reenvio')->middleware('permiso:cobros.reenvio');
	Route::get('admin/cobros/show', 'CobrosController@show')->middleware('permiso:cobros.show');
	Route::get('admin/cobros/{alumno_id}/reporte/{paralelo_id}', 'CobrosController@reporte')->middleware('permiso:cobros.reporte');


/*
|--------------------------------------------------------------------------
| FAQ
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/faq/store', 'PreguntasFrecuentesController@store')->middleware('permiso:faq.store'); 
	Route::get('admin/faq', 'PreguntasFrecuentesController@index')->middleware('permiso:faq.index'); 
	Route::get('admin/faq/create', 'PreguntasFrecuentesController@create')->middleware('permiso:faq.create'); 
	Route::post('admin/faq/{id}/edit', 'PreguntasFrecuentesController@update')->middleware('permiso:faq.update'); 
	Route::post('admin/faq/{id}', 'PreguntasFrecuentesController@destroy')->middleware('permiso:faq.destroy'); 
	Route::get('admin/faq/{id}/edit', 'PreguntasFrecuentesController@edit')->middleware('permiso:faq.edit'); 
	Route::post('admin/faq/{id}/active', 'PreguntasFrecuentesController@active')->middleware('permiso:faq.active'); 
	Route::post('admin/faq/{id}/inactive', 'PreguntasFrecuentesController@inactive')->middleware('permiso:faq.inactive'); 
	Route::get('admin/faq/{id}/show', 'PreguntasFrecuentesController@show')->middleware('permiso:faq.show'); 


/*
|--------------------------------------------------------------------------
| Comunicados
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/comunicados/store', 'ComunicadosController@store')->middleware('permiso:comunicados.store'); 
	Route::get('admin/comunicados', 'ComunicadosController@index')->middleware('permiso:comunicados.index'); 
	Route::get('admin/comunicados/create', 'ComunicadosController@create')->middleware('permiso:comunicados.create'); 
	Route::post('admin/comunicados/{id}/edit', 'ComunicadosController@update')->middleware('permiso:comunicados.update'); 
	Route::post('admin/comunicados/{id}', 'ComunicadosController@destroy')->middleware('permiso:comunicados.destroy'); 
	Route::get('admin/comunicados/{id}/edit', 'ComunicadosController@edit')->middleware('permiso:comunicados.edit'); 
	Route::post('admin/comunicados/{id}/active', 'ComunicadosController@active')->middleware('permiso:comunicados.active'); 
	Route::post('admin/comunicados/{id}/inactive', 'ComunicadosController@inactive')->middleware('permiso:comunicados.inactive'); 
	Route::get('admin/comunicados/show', 'ComunicadosController@show')->middleware('permiso:comunicados.show');
	Route::get('admin/comunicados/{id}/view', 'ComunicadosController@show')->middleware('permiso:comunicados.view'); 
	Route::get('admin/comunicados/{id}/destroy/{archivo}', 'ComunicadosController@destroy_documento')->middleware('permiso:comunicados.destroy_documento'); 


/*
|--------------------------------------------------------------------------
| Tareas
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/tareas/store', 'TareasController@store')->middleware('permiso:tareas.store'); 
	Route::get('admin/tareas', 'TareasController@index')->middleware('permiso:tareas.index'); 
	Route::get('admin/tareas/create', 'TareasController@create')->middleware('permiso:tareas.create'); 
	Route::post('admin/tareas/{id}/edit', 'TareasController@update')->middleware('permiso:tareas.update'); 
	Route::post('admin/tareas/{id}', 'TareasController@destroy')->middleware('permiso:tareas.destroy'); 
	Route::get('admin/tareas/{id}/edit', 'TareasController@edit')->middleware('permiso:tareas.edit'); 
	Route::post('admin/tareas/{id}/active', 'TareasController@active')->middleware('permiso:tareas.active'); 
	Route::post('admin/tareas/{id}/inactive', 'TareasController@inactive')->middleware('permiso:tareas.inactive'); 
	Route::get('admin/tareas/{id}', 'TareasController@show')->middleware('permiso:tareas.show'); 


/*
|--------------------------------------------------------------------------
| Proveedores
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/proveedores/store', 'ProveedoresController@store')->middleware('permiso:proveedores.store'); 
	Route::get('admin/proveedores', 'ProveedoresController@index')->middleware('permiso:proveedores.index'); 
	Route::get('admin/proveedores/create', 'ProveedoresController@create')->middleware('permiso:proveedores.create'); 
	Route::post('admin/proveedores/{id}/edit', 'ProveedoresController@update')->middleware('permiso:proveedores.update'); 
	Route::post('admin/proveedores/{id}', 'ProveedoresController@destroy')->middleware('permiso:proveedores.destroy'); 
	Route::get('admin/proveedores/{id}/edit', 'ProveedoresController@edit')->middleware('permiso:proveedores.edit'); 
	Route::post('admin/proveedores/{id}/active', 'ProveedoresController@active')->middleware('permiso:proveedores.active'); 
	Route::post('admin/proveedores/{id}/inactive', 'ProveedoresController@inactive')->middleware('permiso:proveedores.inactive'); 


/*
|--------------------------------------------------------------------------
| Rutas
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/rutas/store', 'RutasController@store')->middleware('permiso:rutas.store'); 
	Route::get('admin/rutas', 'RutasController@index')->middleware('permiso:rutas.index'); 
	Route::get('admin/rutas/create', 'RutasController@create')->middleware('permiso:rutas.create'); 
	Route::post('admin/rutas/{id}/edit', 'RutasController@update')->middleware('permiso:rutas.update'); 
	Route::post('admin/rutas/{id}', 'RutasController@destroy')->middleware('permiso:rutas.destroy'); 
	Route::get('admin/rutas/{id}/edit', 'RutasController@edit')->middleware('permiso:rutas.edit'); 
	Route::post('admin/rutas/{id}/active', 'RutasController@active')->middleware('permiso:rutas.active'); 
	Route::post('admin/rutas/{id}/inactive', 'RutasController@inactive')->middleware('permiso:rutas.inactive'); 
	Route::get('admin/rutas/show', 'RutasController@show')->middleware('permiso:rutas.show'); 

	Route::get('admin/rutas/{ruta_id}/alumnos', 'RutasController@index_alumnos')->middleware('permiso:rutas.index_alumnos');
	Route::post('admin/rutas/alumnos/store', 'RutasController@alumnos_store')->middleware('permiso:rutas.alumnos_store');



/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
|
*/
	Route::post('admin/blog/store', 'BlogsController@store')->middleware('permiso:blog.store'); 
	Route::get('admin/blog', 'BlogsController@index')->middleware('permiso:blog.index'); 
	Route::get('admin/blog/create', 'BlogsController@create')->middleware('permiso:blog.create'); 
	Route::post('admin/blog/{id}/edit', 'BlogsController@update')->middleware('permiso:blog.update'); 
	Route::post('admin/blog/{id}', 'BlogsController@destroy')->middleware('permiso:blog.destroy'); 
	Route::get('admin/blog/{id}/edit', 'BlogsController@edit')->middleware('permiso:blog.edit'); 
	Route::post('admin/blog/{id}/active', 'BlogsController@active')->middleware('permiso:blog.active'); 
	Route::post('admin/blog/{id}/inactive', 'BlogsController@inactive')->middleware('permiso:blog.inactive'); 
	Route::get('admin/blog/show', 'BlogsController@show')->middleware('permiso:blog.show'); 
	Route::get('admin/blog/{id}/show', 'BlogsController@show_entrada'); 


});