<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'empresa_id' => 1,
            'name' => 'David', 
        	'last' => 'Contreras', 
        	'email' => 'admin@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
        	'empresa_id' => 1,
            'name' => 'Andres', 
        	'last' => 'Cristancho', 
        	'email' => 'docente1@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
        	'empresa_id' => 1,
            'name' => 'Camilo', 
        	'last' => 'Cuellar', 
        	'email' => 'docente2@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
            'empresa_id' => 1,
            'name' => 'Carolina', 
            'last' => 'Camargo', 
            'email' => 'coordinador@gmail.com', 
            'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
            'empresa_id' => 1,
            'name' => 'Lorena', 
            'last' => 'Diaz', 
            'email' => 'secretaria@gmail.com', 
            'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
            'empresa_id' => 1,
            'name' => 'Gloria Patricia', 
            'last' => 'Azuero', 
            'email' => 'director@gmail.com', 
            'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
            'empresa_id' => 1,
            'name' => 'Juan David', 
            'last' => 'Contreras ', 
            'email' => 'alumno@gmail.com', 
            'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

    }
}
