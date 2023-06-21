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
        	'last' => 'C', 
        	'email' => 'admin@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
        	'empresa_id' => 1,
            'name' => 'Andres', 
        	'last' => 'C', 
        	'email' => 'piloto1@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
        	'empresa_id' => 1,
            'name' => 'Camilo', 
        	'last' => 'C', 
        	'email' => 'piloto2@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

    }
}
