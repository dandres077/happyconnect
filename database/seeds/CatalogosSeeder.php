<?php

use Illuminate\Database\Seeder;
use App\Catalogos;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '1','nombre' => 'RUT']);//1
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Cédula de Ciudadanía']);//2
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Tarjeta de Identidad']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Cedula de Extranjería']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Registro Civil']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Numero de Identificación Personal (NIP)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Número Unico de Identificación Personal (NUIP)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'NES']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Certificado de Cabildo']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Pasaporte']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','nombre' => 'Permiso Especial de Residencia (PEP)']);//11       
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','nombre' => 'Efectivo']);//12
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','nombre' => 'Tarjeta Débito']);//6
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','nombre' => 'Tarjeta Crédito']);//7
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','nombre' => 'Transferencia']);//8
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','nombre' => 'Cheque']);//16
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '4','nombre' => 'Mujer']);//17
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '4','nombre' => 'Hombre']);//11
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '4','nombre' => 'Otro']);//19
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '5','nombre' => 'A']);//20
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '5','nombre' => 'B']);//21        
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '6','nombre' => 'Oficial']);//22
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '6','nombre' => 'No oficial']);//23
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '7','nombre' => 'Masculino']);//24
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '7','nombre' => 'Femenino']);//25
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '7','nombre' => 'Mixto']);//26
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '8','nombre' => 'Mañana']);//27
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '8','nombre' => 'Tarde']);//28
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '8','nombre' => 'Completa']);//29
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','nombre' => 'Académica']);//30
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','nombre' => 'Agropecuaria']);//31
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','nombre' => 'Comercial']);//32
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','nombre' => 'Industrial']);//33
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','nombre' => 'Pedagógica']);//34
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','nombre' => 'Promoción social']);//35
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => '0']);//36
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => '1']);//30
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => '2']);//31
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => '3']);//32
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => '4']);//33
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => '5']);//34
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => '6']);//35
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','nombre' => 'No aplica']);//43
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '11','nombre' => 'Urbana']);//17
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '11','nombre' => 'Rural']);//18
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '11','nombre' => 'Urbana y Rural']);//46
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '12','nombre' => 'Padre']);//17
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '12','nombre' => 'Madre']);//48
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'O+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'O-']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'A+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'A-']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'B+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'B-']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'AB+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','nombre' => 'AB-']);//56
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '14','nombre' => 'Propia']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '14','nombre' => 'Arrendada']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '14','nombre' => 'Familiar']);//59
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','nombre' => 'Zona norte']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','nombre' => 'Zon sur']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','nombre' => 'Zona oriente']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','nombre' => 'Zona occidente']);//63
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','nombre' => 'A']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','nombre' => 'B']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','nombre' => 'C']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','nombre' => 'D']);       
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','nombre' => 'E']);//68  
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '17','nombre' => 'Matricula']);//69 
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','nombre' => 'Discapacidad físicas']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','nombre' => 'Deficiencias visuales']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','nombre' => 'Problemas auditivos']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','nombre' => 'Discapacidad intelectual']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','nombre' => 'Transtornos del desarrollo']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','nombre' => 'Enfermedades raras y crónicas']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '19','nombre' => 'Soltero(a)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '19','nombre' => 'Casado(a)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '19','nombre' => 'Viudo(a)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '19','nombre' => 'Separado(a)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '19','nombre' => 'Divorciado(a)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '19','nombre' => 'Unión libre']);

    }
}




