<?php

use Illuminate\Database\Seeder;
// use Database\Factories\AlumnosFactory;
// use App\Alumnos;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PaisesSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(CiudadesSeeder::class);
        $this->call(GeneralidadesSeeder::class);
        $this->call(CatalogosSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class); 
        $this->call(EmpresasSeeder::class); 
        $this->call(EmpresasSedesSeeder::class); 
        $this->call(AreasSeeder::class); 
        $this->call(AsignaturasSeeder::class); 
        $this->call(NivelesSeeder::class); 
        $this->call(GradosSeeder::class); 
        $this->call(TemporadasSeeder::class); 
        $this->call(PeriodosSeeder::class); 
        $this->call(ParalelosSeeder::class);
        $this->call(AlumnosSeeder::class); 
        $this->call(PadresSeeder::class); 
        $this->call(MatriculasSeeder::class); 
        $this->call(ParalelosHorariosSeeder::class); 
        $this->call(ActividadesSeeder::class); 
        $this->call(CobrosSeeder::class); 
        $this->call(PreguntasFrecuentesSeeder::class); 
        $this->call(ComunicadosSeeder::class); 
        $this->call(ProveedoresSeeder::class); 
        $this->call(RutasSeeder::class); 
        $this->call(RutasAlumnosSeeder::class); 
        $this->call(BlogsSeeder::class); 
        $this->call(ProfesionalesSeeder::class); 
        $this->call(TareasSeeder::class); 
    }
}