<?php

use Illuminate\Database\Seeder;
use App\Profesionales;

class ProfesionalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profesionales::create([            
            'usuario_id' => '2',
            'empresa_id' => '1',
            'telefono' => '3115694763',
            'direccion' => 'Cra 76 35-45',
            'ciudad' => 'Bogotá D.C.',
            'celular' => '3114563421',
            'email' => 'docente1@gmail.com',
            'genero_id' => '18',
            'tipo_documento' => '2',
            'n_documento' => '1012345456',
            'fecha_nacimiento' => '1987-07-21',
            'civil_id' => '77',
            'estudios' => 'Pregrado en licenciatura, posgrado en convivencia y gestión del conocimiento',
            'perfil' => 'Profesional con 10 años de experiencia en primaria y avance tecnologico para la enseñanza',
            'experiencia' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        Profesionales::create([            
            'usuario_id' => '3',
            'empresa_id' => '1',
            'telefono' => '3123455679',
            'direccion' => 'Cra 90 35-45',
            'ciudad' => 'Bogotá D.C.',
            'celular' => '3114563421',
            'email' => 'docente2@gmail.com',
            'genero_id' => '18',
            'tipo_documento' => '2',
            'n_documento' => '1010234543',
            'fecha_nacimiento' => '1985-09-21',
            'civil_id' => '77',
            'estudios' => 'Pregrado en ingeniería, posgrado en ingeniería de software y gestión del conocimiento',
            'perfil' => 'Profesional con 5 años de experiencia en primaria y avance tecnologico para la enseñanza',
            'experiencia' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);
    }
}
