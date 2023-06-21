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
        	'name' => 'David', 
        	'last' => 'C', 
        	'email' => 'admin@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
        	'name' => 'Andres', 
        	'last' => 'C', 
        	'email' => 'piloto1@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

        User::create([
        	'name' => 'Camilo', 
        	'last' => 'C', 
        	'email' => 'piloto2@gmail.com', 
        	'password' => bcrypt('123456'),
            'imagen' => 'https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male-128.png'
        ]);

    }
}
