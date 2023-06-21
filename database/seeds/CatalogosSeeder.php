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
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '1','opcion' => 'RUT']);//1
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Cédula de Ciudadanía']);//2
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Tarjeta de Identidad']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Cedula de Extranjería']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Registro Civil']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Numero de Identificación Personal (NIP)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Número Unico de Identificación Personal (NUIP)']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'NES']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Certificado de Cabildo']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Pasaporte']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '2','opcion' => 'Permiso Especial de Residencia (PEP)']);//11       
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','opcion' => 'Efectivo']);//12
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','opcion' => 'Tarjeta Débito']);//6
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','opcion' => 'Tarjeta Crédito']);//7
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','opcion' => 'Transferencia']);//8
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '3','opcion' => 'Cheque']);//16
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '4','opcion' => 'Mujer']);//17
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '4','opcion' => 'Hombre']);//11
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '4','opcion' => 'Otro']);//19
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '5','opcion' => 'A']);//20
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '5','opcion' => 'B']);//21        
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '6','opcion' => 'Oficial']);//22
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '6','opcion' => 'No oficial']);//23
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '7','opcion' => 'Masculino']);//24
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '7','opcion' => 'Femenino']);//25
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '7','opcion' => 'Mixto']);//26
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '8','opcion' => 'Mañana']);//27
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '8','opcion' => 'Tarde']);//28
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '8','opcion' => 'Completa']);//29
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','opcion' => 'Académica']);//30
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','opcion' => 'Agropecuaria']);//31
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','opcion' => 'Comercial']);//32
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','opcion' => 'Industrial']);//33
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','opcion' => 'Pedagógica']);//34
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '9','opcion' => 'Promoción social']);//35
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => '0']);//36
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => '1']);//30
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => '2']);//31
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => '3']);//32
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => '4']);//33
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => '5']);//34
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => '6']);//35
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '10','opcion' => 'No aplica']);//43
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '11','opcion' => 'Urbana']);//17
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '11','opcion' => 'Rural']);//18
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '11','opcion' => 'Urbana y Rural']);//46
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '12','opcion' => 'Padre']);//17
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '12','opcion' => 'Madre']);//48
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'O+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'O-']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'A+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'A-']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'B+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'B-']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'AB+']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '13','opcion' => 'AB-']);//56
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '14','opcion' => 'Propia']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '14','opcion' => 'Arrendada']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '14','opcion' => 'Familiar']);//59
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','opcion' => 'Zona norte']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','opcion' => 'Zon sur']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','opcion' => 'Zona oriente']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '15','opcion' => 'Zona occidente']);//63
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','opcion' => 'A']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','opcion' => 'B']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','opcion' => 'C']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','opcion' => 'D']);       
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '16','opcion' => 'E']);//68  
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '17','opcion' => 'Matricula']);//69 
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','opcion' => 'Discapacidad físicas']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','opcion' => 'Deficiencias visuales']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','opcion' => 'Problemas auditivos']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','opcion' => 'Discapacidad intelectual']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','opcion' => 'Transtornos del desarrollo']);
        Catalogos::create(['empresa_id' => 1, 'generalidad_id' => '18','opcion' => 'Enfermedades raras y crónicas']); //75

    }
}




