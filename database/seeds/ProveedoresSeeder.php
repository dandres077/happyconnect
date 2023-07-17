<?php

use Illuminate\Database\Seeder;
use App\Proveedores;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedores::create([
            'empresa_id'  => '1',
            'empresa'  => 'Transportes Galaxia S.A.',
            'contacto'  => 'Juan Diego Pardo',
            'n_documento'  => '321654987',
            'email'  => 'contacto@galaxia.com',
            'celular'  => '3186932058',
            'direccion'  => 'Calle 72 A N° 52-42 Of.502',
            'ciudad'  => 'Bogotá D.C.',
            'observaciones'  => 'Empresa con flota de transporte para nivel local y nacional'
        ]);

        Proveedores::create([
            'empresa_id'  => '1',
            'empresa'  => 'Flota La Macarena',
            'contacto'  => 'Camilo Cifuentes',
            'n_documento'  => '987654321',
            'email'  => 'contacto@macarena.com',
            'celular'  => '3115628798',
            'direccion'  => 'Carrera 85 96-96 Of. 201',
            'ciudad'  => 'Bogotá D.C.',
            'observaciones'  => 'Empresa con flota de transporte internacional'
        ]);
    }
}



        
