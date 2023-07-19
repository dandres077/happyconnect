<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'roles.store']); 
		Permission::create(['name' => 'roles.index']); 
		Permission::create(['name' => 'roles.create']);  
		Permission::create(['name' => 'roles.update']); 
		Permission::create(['name' => 'roles.show']);  
		Permission::create(['name' => 'roles.destroy']); 
		Permission::create(['name' => 'roles.edit']); 
		Permission::create(['name' => 'roles.active']); 
		Permission::create(['name' => 'roles.inactive']); 

		Permission::create(['name' => 'permisos.store']); 
		Permission::create(['name' => 'permisos.index']); 
		Permission::create(['name' => 'permisos.create']);  
		Permission::create(['name' => 'permisos.edit']); 
		Permission::create(['name' => 'permisos.show']);  
		Permission::create(['name' => 'permisos.destroy']);

		Permission::create(['name' => 'usuarios.store']);  
		Permission::create(['name' => 'usuarios.index']); 
		Permission::create(['name' => 'usuarios.create']);
		Permission::create(['name' => 'usuarios.update']); 
		Permission::create(['name' => 'usuarios.show']);
		Permission::create(['name' => 'usuarios.destroy']); 
		Permission::create(['name' => 'usuarios.edit']);
		Permission::create(['name' => 'usuarios.active']); 
		Permission::create(['name' => 'usuarios.inactive']);
		Permission::create(['name' => 'usuarios.editarperfil']); 
		Permission::create(['name' => 'usuarios.updateperfil']); 
		Permission::create(['name' => 'usuarios.pwd']); 

		Permission::create(['name' => 'paises.store']);
		Permission::create(['name' => 'paises.index']);
		Permission::create(['name' => 'paises.create']);
		Permission::create(['name' => 'paises.update']);
		Permission::create(['name' => 'paises.show']);
		Permission::create(['name' => 'paises.destroy']);
		Permission::create(['name' => 'paises.edit']);
		Permission::create(['name' => 'paises.active']);
		Permission::create(['name' => 'paises.inactive']);

		Permission::create(['name' => 'departamentos.store']); 
		Permission::create(['name' => 'departamentos.index']); 
		Permission::create(['name' => 'departamentos.create']); 
		Permission::create(['name' => 'departamentos.update']); 
		Permission::create(['name' => 'departamentos.show']); 
		Permission::create(['name' => 'departamentos.destroy']); 
		Permission::create(['name' => 'departamentos.edit']); 
		Permission::create(['name' => 'departamentos.active']); 
		Permission::create(['name' => 'departamentos.inactive']); 

		Permission::create(['name' => 'ciudades.store']); 
		Permission::create(['name' => 'ciudades.index']); 
		Permission::create(['name' => 'ciudades.create']); 
		Permission::create(['name' => 'ciudades.update']); 
		Permission::create(['name' => 'ciudades.show']); 
		Permission::create(['name' => 'ciudades.destroy']); 
		Permission::create(['name' => 'ciudades.edit']); 
		Permission::create(['name' => 'ciudades.active']); 
		Permission::create(['name' => 'ciudades.inactive']);

		Permission::create(['name' => 'generalidades.store']); 
		Permission::create(['name' => 'generalidades.index']); 
		Permission::create(['name' => 'generalidades.create']); 
		Permission::create(['name' => 'generalidades.update']); 
		Permission::create(['name' => 'generalidades.destroy']); 
		Permission::create(['name' => 'generalidades.edit']); 
		Permission::create(['name' => 'generalidades.active']); 
		Permission::create(['name' => 'generalidades.inactive']); 

		Permission::create(['name' => 'catalogos.store']); 
		Permission::create(['name' => 'catalogos.index']); 
		Permission::create(['name' => 'catalogos.create']); 
		Permission::create(['name' => 'catalogos.update']); 
		Permission::create(['name' => 'catalogos.destroy']); 
		Permission::create(['name' => 'catalogos.edit']); 
		Permission::create(['name' => 'catalogos.active']); 
		Permission::create(['name' => 'catalogos.inactive']); 

		Permission::create(['name' => 'empresas.store']); 
		Permission::create(['name' => 'empresas.index']); 
		Permission::create(['name' => 'empresas.create']); 
		Permission::create(['name' => 'empresas.update']); 
		Permission::create(['name' => 'empresas.destroy']); 
		Permission::create(['name' => 'empresas.edit']); 
		Permission::create(['name' => 'empresas.active']); 
		Permission::create(['name' => 'empresas.inactive']); 

		Permission::create(['name' => 'sedes.store']); 
		Permission::create(['name' => 'sedes.index']); 
		Permission::create(['name' => 'sedes.create']); 
		Permission::create(['name' => 'sedes.update']); 
		Permission::create(['name' => 'sedes.destroy']); 
		Permission::create(['name' => 'sedes.edit']); 
		Permission::create(['name' => 'sedes.active']); 
		Permission::create(['name' => 'sedes.inactive']); 

		Permission::create(['name' => 'areas.store']); 
		Permission::create(['name' => 'areas.index']); 
		Permission::create(['name' => 'areas.create']); 
		Permission::create(['name' => 'areas.update']); 
		Permission::create(['name' => 'areas.destroy']); 
		Permission::create(['name' => 'areas.edit']); 
		Permission::create(['name' => 'areas.active']); 
		Permission::create(['name' => 'areas.inactive']); 

		Permission::create(['name' => 'asignaturas.store']); 
		Permission::create(['name' => 'asignaturas.index']); 
		Permission::create(['name' => 'asignaturas.create']); 
		Permission::create(['name' => 'asignaturas.update']); 
		Permission::create(['name' => 'asignaturas.destroy']); 
		Permission::create(['name' => 'asignaturas.edit']); 
		Permission::create(['name' => 'asignaturas.active']); 
		Permission::create(['name' => 'asignaturas.inactive']); 

		Permission::create(['name' => 'niveles.store']); 
		Permission::create(['name' => 'niveles.index']); 
		Permission::create(['name' => 'niveles.create']); 
		Permission::create(['name' => 'niveles.update']); 
		Permission::create(['name' => 'niveles.destroy']); 
		Permission::create(['name' => 'niveles.edit']); 
		Permission::create(['name' => 'niveles.active']); 
		Permission::create(['name' => 'niveles.inactive']); 

		Permission::create(['name' => 'grados.store']); 
		Permission::create(['name' => 'grados.index']); 
		Permission::create(['name' => 'grados.create']); 
		Permission::create(['name' => 'grados.update']); 
		Permission::create(['name' => 'grados.destroy']); 
		Permission::create(['name' => 'grados.edit']); 
		Permission::create(['name' => 'grados.active']); 
		Permission::create(['name' => 'grados.inactive']); 

		Permission::create(['name' => 'temporadas.store']); 
		Permission::create(['name' => 'temporadas.index']); 
		Permission::create(['name' => 'temporadas.create']); 
		Permission::create(['name' => 'temporadas.update']); 
		Permission::create(['name' => 'temporadas.destroy']); 
		Permission::create(['name' => 'temporadas.edit']); 
		Permission::create(['name' => 'temporadas.active']); 
		Permission::create(['name' => 'temporadas.inactive']); 

		Permission::create(['name' => 'periodos.store']); 
		Permission::create(['name' => 'periodos.index']); 
		Permission::create(['name' => 'periodos.create']); 
		Permission::create(['name' => 'periodos.update']); 
		Permission::create(['name' => 'periodos.destroy']); 
		Permission::create(['name' => 'periodos.edit']); 
		Permission::create(['name' => 'periodos.active']); 
		Permission::create(['name' => 'periodos.inactive']); 

		Permission::create(['name' => 'paralelos.store']); 
		Permission::create(['name' => 'paralelos.index']); 
		Permission::create(['name' => 'paralelos.create']); 
		Permission::create(['name' => 'paralelos.update']); 
		Permission::create(['name' => 'paralelos.destroy']); 
		Permission::create(['name' => 'paralelos.edit']); 
		Permission::create(['name' => 'paralelos.active']); 
		Permission::create(['name' => 'paralelos.inactive']); 

		Permission::create(['name' => 'profesionales.store']); 
		Permission::create(['name' => 'profesionales.index']); 
		Permission::create(['name' => 'profesionales.create']); 
		Permission::create(['name' => 'profesionales.update']); 
		Permission::create(['name' => 'profesionales.destroy']); 
		Permission::create(['name' => 'profesionales.edit']); 
		Permission::create(['name' => 'profesionales.active']); 
		Permission::create(['name' => 'profesionales.inactive']); 
		Permission::create(['name' => 'profesionales.show']); 

		Permission::create(['name' => 'alumnos.store']); 
		Permission::create(['name' => 'alumnos.index']); 
		Permission::create(['name' => 'alumnos.create']); 
		Permission::create(['name' => 'alumnos.update']); 
		Permission::create(['name' => 'alumnos.show']); 
		Permission::create(['name' => 'alumnos.destroy']); 
		Permission::create(['name' => 'alumnos.edit']); 
		Permission::create(['name' => 'alumnos.active']); 
		Permission::create(['name' => 'alumnos.inactive']); 
		Permission::create(['name' => 'alumnos.view']); 
		Permission::create(['name' => 'alumnos.padre_alumno']); 
		Permission::create(['name' => 'alumnos.padres']); 
		Permission::create(['name' => 'alumnos.padre_create']); 
		Permission::create(['name' => 'alumnos.padres_store']); 

		Permission::create(['name' => 'matriculas.index']);
		Permission::create(['name' => 'matriculas.create']);
		Permission::create(['name' => 'matriculas.store']);
		Permission::create(['name' => 'matriculas.edit']);
		Permission::create(['name' => 'matriculas.update']);
		Permission::create(['name' => 'matriculas.destroy']);
		Permission::create(['name' => 'matriculas.active']);
		Permission::create(['name' => 'matriculas.inactive']);
		Permission::create(['name' => 'matriculas.store2']);
		Permission::create(['name' => 'matriculas.store3']);
		Permission::create(['name' => 'matriculas.reporte']);
		Permission::create(['name' => 'matriculas.validar']);
		Permission::create(['name' => 'matriculas.ampliar']);

		Permission::create(['name' => 'horarios_paralelos.store']); 
		Permission::create(['name' => 'horarios_paralelos.index']); 
		Permission::create(['name' => 'horarios_paralelos.create']); 
		Permission::create(['name' => 'horarios_paralelos.update']); 
		Permission::create(['name' => 'horarios_paralelos.destroy']); 
		Permission::create(['name' => 'horarios_paralelos.edit']); 
		Permission::create(['name' => 'horarios_paralelos.active']); 
		Permission::create(['name' => 'horarios_paralelos.inactive']); 

		Permission::create(['name' => 'actividades.store']); 
		Permission::create(['name' => 'actividades.index']);
		Permission::create(['name' => 'actividades.create']); 
		Permission::create(['name' => 'actividades.update']); 
		Permission::create(['name' => 'actividades.edit']); 
		Permission::create(['name' => 'actividades.destroy']); 
		Permission::create(['name' => 'actividades.show']); 
		Permission::create(['name' => 'actividades.inactive']); 

	    Permission::create(['name' => 'cobros.index']); 
		Permission::create(['name' => 'cobros.alumnos']); 
		Permission::create(['name' => 'cobros.create']);
		Permission::create(['name' => 'cobros.store']); 
		Permission::create(['name' => 'cobros.edit']); 
		Permission::create(['name' => 'cobros.update']); 
		Permission::create(['name' => 'cobros.destroy']); 	
		Permission::create(['name' => 'cobros.reenvio']);
		Permission::create(['name' => 'cobros.reporte']);
		Permission::create(['name' => 'cobros.show']);

		Permission::create(['name' => 'faq.store']); 
		Permission::create(['name' => 'faq.index']); 
		Permission::create(['name' => 'faq.create']); 
		Permission::create(['name' => 'faq.update']); 
		Permission::create(['name' => 'faq.destroy']); 
		Permission::create(['name' => 'faq.edit']); 
		Permission::create(['name' => 'faq.active']); 
		Permission::create(['name' => 'faq.inactive']); 
		Permission::create(['name' => 'faq.show']); 

		Permission::create(['name' => 'comunicados.store']); 
		Permission::create(['name' => 'comunicados.index']); 
		Permission::create(['name' => 'comunicados.create']); 
		Permission::create(['name' => 'comunicados.update']); 
		Permission::create(['name' => 'comunicados.destroy']); 
		Permission::create(['name' => 'comunicados.edit']); 
		Permission::create(['name' => 'comunicados.active']); 
		Permission::create(['name' => 'comunicados.inactive']); 
		Permission::create(['name' => 'comunicados.show']);
		Permission::create(['name' => 'comunicados.view']); 
		Permission::create(['name' => 'comunicados.destroy_documento']); 

		Permission::create(['name' => 'tareas.store']); 
		Permission::create(['name' => 'tareas.index']); 
		Permission::create(['name' => 'tareas.create']); 
		Permission::create(['name' => 'tareas.update']); 
		Permission::create(['name' => 'tareas.destroy']); 
		Permission::create(['name' => 'tareas.edit']); 
		Permission::create(['name' => 'tareas.active']); 
		Permission::create(['name' => 'tareas.inactive']); 
		Permission::create(['name' => 'tareas.show']); 

		Permission::create(['name' => 'proveedores.store']); 
		Permission::create(['name' => 'proveedores.index']); 
		Permission::create(['name' => 'proveedores.create']); 
		Permission::create(['name' => 'proveedores.update']); 
		Permission::create(['name' => 'proveedores.destroy']); 
		Permission::create(['name' => 'proveedores.edit']); 
		Permission::create(['name' => 'proveedores.active']); 
		Permission::create(['name' => 'proveedores.inactive']); 

		Permission::create(['name' => 'rutas.store']); 
		Permission::create(['name' => 'rutas.index']); 
		Permission::create(['name' => 'rutas.create']); 
		Permission::create(['name' => 'rutas.update']); 
		Permission::create(['name' => 'rutas.destroy']); 
		Permission::create(['name' => 'rutas.edit']); 
		Permission::create(['name' => 'rutas.active']); 
		Permission::create(['name' => 'rutas.inactive']); 
		Permission::create(['name' => 'rutas.index_alumnos']); 
		Permission::create(['name' => 'rutas.alumnos_store']); 

		Permission::create(['name' => 'blog.store']); 
		Permission::create(['name' => 'blog.index']); 
		Permission::create(['name' => 'blog.create']); 
		Permission::create(['name' => 'blog.update']); 
		Permission::create(['name' => 'blog.destroy']); 
		Permission::create(['name' => 'blog.edit']); 
		Permission::create(['name' => 'blog.active']); 
		Permission::create(['name' => 'blog.inactive']); 
		Permission::create(['name' => 'blog.show']); 

		Permission::create(['name' => 'administracion.index']);

		

        // create roles and assign created permissions       

        $role = Role::create(['name' => 'SuperAdministrador']);
        $role->givePermissionTo(Permission::all());

		// or may be done by chaining
        $role = Role::create(['name' => 'Docente'])
            ->givePermissionTo([
            					'tareas.store',
								'tareas.index',
								'tareas.create',
								'tareas.update',
								'tareas.destroy',
								'tareas.edit',
								'tareas.active',
								'tareas.inactive',	
								'profesionales.index',
								'profesionales.update',
								'profesionales.edit',
								'tareas.store',
								'tareas.index',
								'tareas.create',
								'tareas.update',
								'tareas.destroy',
								'tareas.edit',
								'tareas.active',
								'tareas.inactive'
			]);

		$role = Role::create(['name' => 'Coordinador'])
            ->givePermissionTo([

            	'catalogos.store',
				'catalogos.index',
				'catalogos.create',
				'catalogos.update',
				'catalogos.edit',
				'catalogos.active',
				'catalogos.inactive',
				'empresas.index',
				'empresas.update',
				'empresas.edit',
				'sedes.index',
				'sedes.update',
				'sedes.edit',
				'areas.store',
				'areas.index',
				'areas.create',
				'areas.update',
				'areas.edit',
				'areas.active',
				'areas.inactive',
				'asignaturas.store',
				'asignaturas.index',
				'asignaturas.create',
				'asignaturas.update',
				'asignaturas.edit',
				'asignaturas.active',
				'asignaturas.inactive',
				'grados.index',
				'grados.update',
				'grados.edit',
				'grados.active',
				'grados.inactive',
				'temporadas.index',
				'periodos.index',
				'periodos.update',
				'periodos.edit',
				'paralelos.store',
				'paralelos.index',
				'paralelos.create',
				'paralelos.update',
				'paralelos.edit',
				'paralelos.active',
				'paralelos.inactive',
				'profesionales.store',
				'profesionales.index',
				'profesionales.create',
				'profesionales.update',
				'profesionales.edit',
				'profesionales.active',
				'profesionales.inactive',
				'alumnos.store',
				'alumnos.index',
				'alumnos.create',
				'alumnos.update',
				'alumnos.show',
				'alumnos.edit',
				'alumnos.active',
				'alumnos.inactive',
				'alumnos.view',
				'alumnos.padre_alumno',
				'alumnos.padres',
				'alumnos.padre_create',
				'alumnos.padres_store',
				'matriculas.index',
				'matriculas.create',
				'matriculas.store',
				'matriculas.edit',
				'matriculas.update',
				'matriculas.active',
				'matriculas.inactive',
				'matriculas.store2',
				'matriculas.store3',
				'matriculas.reporte',
				'matriculas.validar',
				'matriculas.ampliar',
				'horarios_paralelos.store',
				'horarios_paralelos.index',
				'horarios_paralelos.create',
				'horarios_paralelos.update',
				'horarios_paralelos.edit',
				'horarios_paralelos.active',
				'horarios_paralelos.inactive',
				'actividades.store',
				'actividades.index',
				'actividades.create',
				'actividades.update',
				'actividades.edit',
				'actividades.destroy',
			    'cobros.index',
				'cobros.alumnos',
				'cobros.create',
				'cobros.store',
				'cobros.edit',
				'cobros.update',
				'cobros.destroy',
				'cobros.reenvio',
				'cobros.reporte',
				'faq.store',
				'faq.index',
				'faq.create',
				'faq.update',
				'faq.destroy',
				'faq.edit',
				'faq.active',
				'faq.inactive',
				'comunicados.store',
				'comunicados.index',
				'comunicados.create',
				'comunicados.update',
				'comunicados.destroy',
				'comunicados.edit',
				'comunicados.active',
				'comunicados.inactive',
				'comunicados.show',
				'comunicados.view',
				'comunicados.destroy_documento',
				'tareas.store',
				'tareas.index',
				'tareas.create',
				'tareas.update',
				'tareas.edit',
				'tareas.active',
				'tareas.inactive',
				'proveedores.store',
				'proveedores.index',
				'proveedores.create',
				'proveedores.update',
				'proveedores.destroy',
				'proveedores.edit',
				'proveedores.active',
				'proveedores.inactive',
				'rutas.store',
				'rutas.index',
				'rutas.create',
				'rutas.update',
				'rutas.destroy',
				'rutas.edit',
				'rutas.active',
				'rutas.inactive',
				'rutas.index_alumnos',
				'rutas.alumnos_store',
				'blog.store',
				'blog.index',
				'blog.create',
				'blog.update',
				'blog.destroy',
				'blog.edit',
				'blog.active',
				'blog.inactive',
				'blog.show',
				'administracion.index',
			]);

		$role = Role::create(['name' => 'Secretaria'])
            ->givePermissionTo([

            	'catalogos.store',
				'catalogos.index',
				'catalogos.create',
				'catalogos.update',
				'catalogos.edit',
				'catalogos.active',
				'catalogos.inactive',
				'empresas.index',
				'empresas.update',
				'empresas.edit',
				'sedes.index',
				'sedes.update',
				'sedes.edit',
				'areas.index',				
				'asignaturas.index',				
				'grados.index',				
				'temporadas.index',
				'periodos.index',
				'profesionales.store',
				'profesionales.index',
				'profesionales.create',
				'profesionales.update',
				'profesionales.edit',
				'profesionales.active',
				'profesionales.inactive',
				'alumnos.store',
				'alumnos.index',
				'alumnos.create',
				'alumnos.update',
				'alumnos.show',
				'alumnos.edit',
				'alumnos.active',
				'alumnos.inactive',
				'alumnos.view',
				'alumnos.padre_alumno',
				'alumnos.padres',
				'alumnos.padre_create',
				'alumnos.padres_store',
				'matriculas.index',
				'matriculas.create',
				'matriculas.store',
				'matriculas.edit',
				'matriculas.update',
				'matriculas.active',
				'matriculas.inactive',
				'matriculas.store2',
				'matriculas.store3',
				'matriculas.reporte',
				'matriculas.validar',
				'matriculas.ampliar',
				'horarios_paralelos.store',
				'horarios_paralelos.index',
				'horarios_paralelos.create',
				'horarios_paralelos.update',
				'horarios_paralelos.edit',
				'horarios_paralelos.active',
				'horarios_paralelos.inactive',
				'actividades.store',
				'actividades.index',
				'actividades.create',
				'actividades.update',
				'actividades.edit',
			    'cobros.index',
				'cobros.alumnos',
				'cobros.create',
				'cobros.store',
				'cobros.edit',
				'cobros.update',
				'cobros.reenvio',
				'cobros.reporte',
				'faq.store',
				'faq.index',
				'faq.create',
				'faq.update',
				'faq.destroy',
				'faq.edit',
				'faq.active',
				'faq.inactive',
				'comunicados.store',
				'comunicados.index',
				'comunicados.create',
				'comunicados.update',
				'comunicados.destroy',
				'comunicados.edit',
				'comunicados.active',
				'comunicados.inactive',
				'comunicados.show',
				'comunicados.view',
				'comunicados.destroy_documento',
				'tareas.index',
				'proveedores.store',
				'proveedores.index',
				'proveedores.create',
				'proveedores.update',
				'proveedores.destroy',
				'proveedores.edit',
				'proveedores.active',
				'proveedores.inactive',
				'rutas.store',
				'rutas.index',
				'rutas.create',
				'rutas.update',
				'rutas.destroy',
				'rutas.edit',
				'rutas.active',
				'rutas.inactive',
				'rutas.index_alumnos',
				'rutas.alumnos_store',
				'blog.store',
				'blog.index',
				'blog.create',
				'blog.update',
				'blog.destroy',
				'blog.edit',
				'blog.active',
				'blog.inactive',
				'blog.show',
				'administracion.index',
			]);


		$role = Role::create(['name' => 'Director'])
            ->givePermissionTo([
            	'roles.store',
				'roles.index',
				'roles.create',
				'roles.update',
				'roles.show',
				'roles.destroy',
				'roles.edit',
				'roles.active',
				'roles.inactive',
				'permisos.store',
				'permisos.index',
				'permisos.create',
				'permisos.edit',
				'permisos.show',
				'permisos.destroy',
				'usuarios.store',
				'usuarios.index',
				'usuarios.create',
				'usuarios.update',
				'usuarios.show',
				'usuarios.edit',
				'usuarios.active',
				'usuarios.inactive',
				'usuarios.editarperfil',
				'usuarios.updateperfil',
				'usuarios.pwd',
				'paises.store',
				'paises.index',
				'paises.create',
				'paises.update',
				'paises.show',
				'paises.destroy',
				'paises.edit',
				'paises.active',
				'paises.inactive',
				'departamentos.store',
				'departamentos.index',
				'departamentos.create',
				'departamentos.update',
				'departamentos.show',
				'departamentos.destroy',
				'departamentos.edit',
				'departamentos.active',
				'departamentos.inactive',
				'ciudades.store',
				'ciudades.index',
				'ciudades.create',
				'ciudades.update',
				'ciudades.show',
				'ciudades.destroy',
				'ciudades.edit',
				'ciudades.active',
				'ciudades.inactive',
				'catalogos.store',
				'catalogos.index',
				'catalogos.create',
				'catalogos.update',
				'catalogos.destroy',
				'catalogos.edit',
				'catalogos.active',
				'catalogos.inactive',
				'empresas.index',
				'empresas.update',
				'empresas.edit',
				'sedes.index',
				'sedes.update',
				'sedes.edit',
				'sedes.active',
				'sedes.inactive',
				'areas.store',
				'areas.index',
				'areas.create',
				'areas.update',
				'areas.destroy',
				'areas.edit',
				'areas.active',
				'areas.inactive',
				'asignaturas.store',
				'asignaturas.index',
				'asignaturas.create',
				'asignaturas.update',
				'asignaturas.destroy',
				'asignaturas.edit',
				'asignaturas.active',
				'asignaturas.inactive',
				'niveles.store',
				'niveles.index',
				'niveles.create',
				'niveles.update',
				'niveles.destroy',
				'niveles.edit',
				'niveles.active',
				'niveles.inactive',
				'grados.store',
				'grados.index',
				'grados.create',
				'grados.update',
				'grados.destroy',
				'grados.edit',
				'grados.active',
				'grados.inactive',
				'temporadas.store',
				'temporadas.index',
				'temporadas.create',
				'temporadas.update',
				'temporadas.destroy',
				'temporadas.edit',
				'temporadas.active',
				'temporadas.inactive',
				'periodos.store',
				'periodos.index',
				'periodos.create',
				'periodos.update',
				'periodos.destroy',
				'periodos.edit',
				'periodos.active',
				'periodos.inactive',
				'paralelos.store',
				'paralelos.index',
				'paralelos.create',
				'paralelos.update',
				'paralelos.destroy',
				'paralelos.edit',
				'paralelos.active',
				'paralelos.inactive',
				'profesionales.store',
				'profesionales.index',
				'profesionales.create',
				'profesionales.update',
				'profesionales.edit',
				'profesionales.active',
				'profesionales.inactive',
				'alumnos.store',
				'alumnos.index',
				'alumnos.create',
				'alumnos.update',
				'alumnos.show',
				'alumnos.destroy',
				'alumnos.edit',
				'alumnos.active',
				'alumnos.inactive',
				'alumnos.view',
				'alumnos.padre_alumno',
				'alumnos.padres',
				'alumnos.padre_create',
				'alumnos.padres_store',
				'matriculas.index',
				'matriculas.create',
				'matriculas.store',
				'matriculas.edit',
				'matriculas.update',
				'matriculas.destroy',
				'matriculas.active',
				'matriculas.inactive',
				'matriculas.store2',
				'matriculas.store3',
				'matriculas.reporte',
				'matriculas.validar',
				'matriculas.ampliar',
				'horarios_paralelos.store',
				'horarios_paralelos.index',
				'horarios_paralelos.create',
				'horarios_paralelos.update',
				'horarios_paralelos.destroy',
				'horarios_paralelos.edit',
				'horarios_paralelos.active',
				'horarios_paralelos.inactive',
				'actividades.store',
				'actividades.index',
				'actividades.create',
				'actividades.update',
				'actividades.edit',
				'actividades.destroy',
				'actividades.show',
				'actividades.inactive',
			    'cobros.index',
				'cobros.alumnos',
				'cobros.create',
				'cobros.store',
				'cobros.edit',
				'cobros.update',
				'cobros.destroy',
				'cobros.reenvio',
				'cobros.reporte',
				'faq.store',
				'faq.index',
				'faq.create',
				'faq.update',
				'faq.destroy',
				'faq.edit',
				'faq.active',
				'faq.inactive',
				'faq.show',
				'comunicados.store',
				'comunicados.index',
				'comunicados.create',
				'comunicados.update',
				'comunicados.destroy',
				'comunicados.edit',
				'comunicados.active',
				'comunicados.inactive',
				'comunicados.show',
				'comunicados.view',
				'comunicados.destroy_documento',
				'tareas.store',
				'tareas.index',
				'tareas.create',
				'tareas.update',
				'tareas.destroy',
				'tareas.edit',
				'tareas.active',
				'tareas.inactive',
				'tareas.show',
				'proveedores.store',
				'proveedores.index',
				'proveedores.create',
				'proveedores.update',
				'proveedores.destroy',
				'proveedores.edit',
				'proveedores.active',
				'proveedores.inactive',
				'rutas.store',
				'rutas.index',
				'rutas.create',
				'rutas.update',
				'rutas.destroy',
				'rutas.edit',
				'rutas.active',
				'rutas.inactive',
				'rutas.index_alumnos',
				'rutas.alumnos_store',
				'blog.store',
				'blog.index',
				'blog.create',
				'blog.update',
				'blog.destroy',
				'blog.edit',
				'blog.active',
				'blog.inactive',
				'blog.show',
				'administracion.index',

			]);

        // SuperAdministrador
		DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\User',
            'model_id' => 1
        ]);

		//Docente
        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => 'App\User',
            'model_id' => 2
        ]);

        //Docente
        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => 'App\User',
            'model_id' => 3
        ]);

        //Coordinador
        DB::table('model_has_roles')->insert([
            'role_id' => 3,
            'model_type' => 'App\User',
            'model_id' => 4
        ]);

        //Secretaria
        DB::table('model_has_roles')->insert([
            'role_id' => 4,
            'model_type' => 'App\User',
            'model_id' => 5
        ]);

        //Director
        DB::table('model_has_roles')->insert([
            'role_id' => 5,
            'model_type' => 'App\User',
            'model_id' => 6
        ]);
    }
}



	