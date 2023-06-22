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


		Permission::create(['name' => 'administracion.index']);
		

        // create roles and assign created permissions       

        $role = Role::create(['name' => 'SuperAdministrador']);
        $role->givePermissionTo(Permission::all());

		// or may be done by chaining
        $role = Role::create(['name' => 'Docente'])
            ->givePermissionTo([
								
			]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\User',
            'model_id' => 1
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => 'App\User',
            'model_id' => 2
        ]);
    }
}