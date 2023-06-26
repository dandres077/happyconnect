<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Matriculas;
use Faker\Generator as Faker;
use App\Grados;
use App\Paralelos;
use App\Alumnos;

$factory->define(Matriculas::class, function (Faker $faker) {
    return [
        'empresa_id' => 1,
        'sede_id' => 1,
        'temporada_id' => 1,
        // 'grado_id',
        // 'paralelo_id',
        'alumno_id' => $faker->unique(true)->numberBetween(1, 300),
        'direccion_r' => $faker->address,
        'barrio_r'  => $faker->city,
        'comuna_r'  => $faker->city,
        'municipio_r'  => $faker->city,
        'departamento_id' => $faker->numberBetween(1, 28),
        'estrato_id' => $faker->numberBetween(37, 42),
        'tipo_vivienda_id' => $faker->numberBetween(57, 59),
        'zona_id' => $faker->numberBetween(60, 63),
        'telefono_est' => $faker->phoneNumber,
        'celular_est' => $faker->phoneNumber,
        'email_est' => $faker->email,
        'vive_con' => $faker->randomElement(['Padre', 'Madre', 'Abuelo']),
        'n_personas_hogar' => $faker->numberBetween(1, 5),
        'n_hermanos' => $faker->numberBetween(0, 4),
        'n_hermanos_col' => $faker->numberBetween(0, 5),
        'telefono_f' => $faker->phoneNumber,
        'icbf' => $faker->randomElement(['Sí', 'No']),
        'f_accion' => $faker->randomElement(['Sí', 'No']),
        // 'nee_id',
        // 'nee_texto',
        'nuevo_antiguo' => $faker->randomElement(['Sí', 'No']),
        'col_procede' => $faker->text(50),
        'ciudad_procede' => $faker->city,
        'dpto_id' => $faker->numberBetween(1, 28),
        'repitente' => $faker->randomElement(['Sí', 'No']),
        'jornada_id' => 27,
        'estatura' => '1.45',
        'peso' => '40kg',
        'hijo_heroe' => $faker->randomElement(['Sí', 'No']),
        'desvinculado' => $faker->randomElement(['Sí', 'No']),
        'desmovilizado' => $faker->randomElement(['Sí', 'No']),
        'nombres_acu' => $faker->firstName,
        'apellidos_acu' => $faker->lastName,
        'tipo_doc_id' => 2,
        'n_documento_acu' => 1015879632,
        'expedida_acu' => $faker->city,
        'direccion_acu' => $faker->address,
        'telefono_acu' => $faker->phoneNumber,
        'celular_acu'=> $faker->phoneNumber,
        'email_acu' => $faker->email,
        'empresa_acu' => $faker->company,
        'profesion_acu' => $faker->jobTitle,
        'parentesco_acu' => $faker->randomElement(['Padre', 'Madre', 'Abuelo']),
        'nombre_eps' => $faker->firstName,
        'beneficiario_sisben' => $faker->randomElement(['Sí', 'No']),
        'alergias' => $faker->randomElement(['Sí', 'No']), 
        'medicamentos' => $faker->randomElement(['Sí', 'No']), 
        'discapacidad'=> $faker->randomElement(['Sí', 'No']), 
        'etnia'=> $faker->randomElement(['Sí', 'No']), 
        'resguardo'=> $faker->randomElement(['Sí', 'No']), 
        'conflicto'=> $faker->randomElement(['Sí', 'No']), 
        'nombres_fac' => $faker->firstName,
        'tipo_doc_fac_id' => 2,
        'n_documento_fac'=> 1015879654,
        'direccion_fac' => $faker->address,
        'email_fac' => $faker->email,
        'celular_fac' => $faker->phoneNumber
    ];
});


$factory->state(Matriculas::class, 'inicio1_1', function (Faker $faker) { return ['alumno_id' =>1, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_2', function (Faker $faker) { return ['alumno_id' =>2, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_3', function (Faker $faker) { return ['alumno_id' =>3, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_4', function (Faker $faker) { return ['alumno_id' =>4, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_5', function (Faker $faker) { return ['alumno_id' =>5, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_6', function (Faker $faker) { return ['alumno_id' =>6, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_7', function (Faker $faker) { return ['alumno_id' =>7, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_8', function (Faker $faker) { return ['alumno_id' =>8, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_9', function (Faker $faker) { return ['alumno_id' =>9, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_10', function (Faker $faker) { return ['alumno_id' =>10, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_11', function (Faker $faker) { return ['alumno_id' =>11, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_12', function (Faker $faker) { return ['alumno_id' =>12, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_13', function (Faker $faker) { return ['alumno_id' =>13, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_14', function (Faker $faker) { return ['alumno_id' =>14, 'grado_id' => 7, 'paralelo_id' => 13 ]; });
$factory->state(Matriculas::class, 'inicio1_15', function (Faker $faker) { return ['alumno_id' =>15, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_16', function (Faker $faker) { return ['alumno_id' =>16, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_17', function (Faker $faker) { return ['alumno_id' =>17, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_18', function (Faker $faker) { return ['alumno_id' =>18, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_19', function (Faker $faker) { return ['alumno_id' =>19, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_20', function (Faker $faker) { return ['alumno_id' =>20, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_21', function (Faker $faker) { return ['alumno_id' =>21, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_22', function (Faker $faker) { return ['alumno_id' =>22, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_23', function (Faker $faker) { return ['alumno_id' =>23, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_24', function (Faker $faker) { return ['alumno_id' =>24, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_25', function (Faker $faker) { return ['alumno_id' =>25, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_26', function (Faker $faker) { return ['alumno_id' =>26, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_27', function (Faker $faker) { return ['alumno_id' =>27, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_28', function (Faker $faker) { return ['alumno_id' =>28, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_29', function (Faker $faker) { return ['alumno_id' =>29, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_30', function (Faker $faker) { return ['alumno_id' =>30, 'grado_id' => 7, 'paralelo_id' => 14 ]; });
$factory->state(Matriculas::class, 'inicio1_31', function (Faker $faker) { return ['alumno_id' =>31, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_32', function (Faker $faker) { return ['alumno_id' =>32, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_33', function (Faker $faker) { return ['alumno_id' =>33, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_34', function (Faker $faker) { return ['alumno_id' =>34, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_35', function (Faker $faker) { return ['alumno_id' =>35, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_36', function (Faker $faker) { return ['alumno_id' =>36, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_37', function (Faker $faker) { return ['alumno_id' =>37, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_38', function (Faker $faker) { return ['alumno_id' =>38, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_39', function (Faker $faker) { return ['alumno_id' =>39, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_40', function (Faker $faker) { return ['alumno_id' =>40, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_41', function (Faker $faker) { return ['alumno_id' =>41, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_42', function (Faker $faker) { return ['alumno_id' =>42, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_43', function (Faker $faker) { return ['alumno_id' =>43, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_44', function (Faker $faker) { return ['alumno_id' =>44, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_45', function (Faker $faker) { return ['alumno_id' =>45, 'grado_id' => 8, 'paralelo_id' => 15 ]; });
$factory->state(Matriculas::class, 'inicio1_46', function (Faker $faker) { return ['alumno_id' =>46, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_47', function (Faker $faker) { return ['alumno_id' =>47, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_48', function (Faker $faker) { return ['alumno_id' =>48, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_49', function (Faker $faker) { return ['alumno_id' =>49, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_50', function (Faker $faker) { return ['alumno_id' =>50, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_51', function (Faker $faker) { return ['alumno_id' =>51, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_52', function (Faker $faker) { return ['alumno_id' =>52, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_53', function (Faker $faker) { return ['alumno_id' =>53, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_54', function (Faker $faker) { return ['alumno_id' =>54, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_55', function (Faker $faker) { return ['alumno_id' =>55, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_56', function (Faker $faker) { return ['alumno_id' =>56, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_57', function (Faker $faker) { return ['alumno_id' =>57, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_58', function (Faker $faker) { return ['alumno_id' =>58, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_59', function (Faker $faker) { return ['alumno_id' =>59, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_60', function (Faker $faker) { return ['alumno_id' =>60, 'grado_id' => 8, 'paralelo_id' => 16 ]; });
$factory->state(Matriculas::class, 'inicio1_61', function (Faker $faker) { return ['alumno_id' =>61, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_62', function (Faker $faker) { return ['alumno_id' =>62, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_63', function (Faker $faker) { return ['alumno_id' =>63, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_64', function (Faker $faker) { return ['alumno_id' =>64, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_65', function (Faker $faker) { return ['alumno_id' =>65, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_66', function (Faker $faker) { return ['alumno_id' =>66, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_67', function (Faker $faker) { return ['alumno_id' =>67, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_68', function (Faker $faker) { return ['alumno_id' =>68, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_69', function (Faker $faker) { return ['alumno_id' =>69, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_70', function (Faker $faker) { return ['alumno_id' =>70, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_71', function (Faker $faker) { return ['alumno_id' =>71, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_72', function (Faker $faker) { return ['alumno_id' =>72, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_73', function (Faker $faker) { return ['alumno_id' =>73, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_74', function (Faker $faker) { return ['alumno_id' =>74, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_75', function (Faker $faker) { return ['alumno_id' =>75, 'grado_id' => 9, 'paralelo_id' => 17 ]; });
$factory->state(Matriculas::class, 'inicio1_76', function (Faker $faker) { return ['alumno_id' =>76, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_77', function (Faker $faker) { return ['alumno_id' =>77, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_78', function (Faker $faker) { return ['alumno_id' =>78, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_79', function (Faker $faker) { return ['alumno_id' =>79, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_80', function (Faker $faker) { return ['alumno_id' =>80, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_81', function (Faker $faker) { return ['alumno_id' =>81, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_82', function (Faker $faker) { return ['alumno_id' =>82, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_83', function (Faker $faker) { return ['alumno_id' =>83, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_84', function (Faker $faker) { return ['alumno_id' =>84, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_85', function (Faker $faker) { return ['alumno_id' =>85, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_86', function (Faker $faker) { return ['alumno_id' =>86, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_87', function (Faker $faker) { return ['alumno_id' =>87, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_88', function (Faker $faker) { return ['alumno_id' =>88, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_89', function (Faker $faker) { return ['alumno_id' =>89, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_90', function (Faker $faker) { return ['alumno_id' =>90, 'grado_id' => 9, 'paralelo_id' => 18 ]; });
$factory->state(Matriculas::class, 'inicio1_91', function (Faker $faker) { return ['alumno_id' =>91, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_92', function (Faker $faker) { return ['alumno_id' =>92, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_93', function (Faker $faker) { return ['alumno_id' =>93, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_94', function (Faker $faker) { return ['alumno_id' =>94, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_95', function (Faker $faker) { return ['alumno_id' =>95, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_96', function (Faker $faker) { return ['alumno_id' =>96, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_97', function (Faker $faker) { return ['alumno_id' =>97, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_98', function (Faker $faker) { return ['alumno_id' =>98, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_99', function (Faker $faker) { return ['alumno_id' =>99, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_100', function (Faker $faker) { return ['alumno_id' =>100, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_101', function (Faker $faker) { return ['alumno_id' =>101, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_102', function (Faker $faker) { return ['alumno_id' =>102, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_103', function (Faker $faker) { return ['alumno_id' =>103, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_104', function (Faker $faker) { return ['alumno_id' =>104, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_105', function (Faker $faker) { return ['alumno_id' =>105, 'grado_id' => 10, 'paralelo_id' => 19 ]; });
$factory->state(Matriculas::class, 'inicio1_106', function (Faker $faker) { return ['alumno_id' =>106, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_107', function (Faker $faker) { return ['alumno_id' =>107, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_108', function (Faker $faker) { return ['alumno_id' =>108, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_109', function (Faker $faker) { return ['alumno_id' =>109, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_110', function (Faker $faker) { return ['alumno_id' =>110, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_111', function (Faker $faker) { return ['alumno_id' =>111, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_112', function (Faker $faker) { return ['alumno_id' =>112, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_113', function (Faker $faker) { return ['alumno_id' =>113, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_114', function (Faker $faker) { return ['alumno_id' =>114, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_115', function (Faker $faker) { return ['alumno_id' =>115, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_116', function (Faker $faker) { return ['alumno_id' =>116, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_117', function (Faker $faker) { return ['alumno_id' =>117, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_118', function (Faker $faker) { return ['alumno_id' =>118, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_119', function (Faker $faker) { return ['alumno_id' =>119, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_120', function (Faker $faker) { return ['alumno_id' =>120, 'grado_id' => 10, 'paralelo_id' => 20 ]; });
$factory->state(Matriculas::class, 'inicio1_121', function (Faker $faker) { return ['alumno_id' =>121, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_122', function (Faker $faker) { return ['alumno_id' =>122, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_123', function (Faker $faker) { return ['alumno_id' =>123, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_124', function (Faker $faker) { return ['alumno_id' =>124, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_125', function (Faker $faker) { return ['alumno_id' =>125, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_126', function (Faker $faker) { return ['alumno_id' =>126, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_127', function (Faker $faker) { return ['alumno_id' =>127, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_128', function (Faker $faker) { return ['alumno_id' =>128, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_129', function (Faker $faker) { return ['alumno_id' =>129, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_130', function (Faker $faker) { return ['alumno_id' =>130, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_131', function (Faker $faker) { return ['alumno_id' =>131, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_132', function (Faker $faker) { return ['alumno_id' =>132, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_133', function (Faker $faker) { return ['alumno_id' =>133, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_134', function (Faker $faker) { return ['alumno_id' =>134, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_135', function (Faker $faker) { return ['alumno_id' =>135, 'grado_id' => 11, 'paralelo_id' => 21 ]; });
$factory->state(Matriculas::class, 'inicio1_136', function (Faker $faker) { return ['alumno_id' =>136, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_137', function (Faker $faker) { return ['alumno_id' =>137, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_138', function (Faker $faker) { return ['alumno_id' =>138, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_139', function (Faker $faker) { return ['alumno_id' =>139, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_140', function (Faker $faker) { return ['alumno_id' =>140, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_141', function (Faker $faker) { return ['alumno_id' =>141, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_142', function (Faker $faker) { return ['alumno_id' =>142, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_143', function (Faker $faker) { return ['alumno_id' =>143, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_144', function (Faker $faker) { return ['alumno_id' =>144, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_145', function (Faker $faker) { return ['alumno_id' =>145, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_146', function (Faker $faker) { return ['alumno_id' =>146, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_147', function (Faker $faker) { return ['alumno_id' =>147, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_148', function (Faker $faker) { return ['alumno_id' =>148, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_149', function (Faker $faker) { return ['alumno_id' =>149, 'grado_id' => 11, 'paralelo_id' => 22 ]; });
$factory->state(Matriculas::class, 'inicio1_150', function (Faker $faker) { return ['alumno_id' =>150, 'grado_id' => 11, 'paralelo_id' => 22 ]; });

$factory->state(Matriculas::class, 'inicio1_30', function (Faker $faker) { return ['alumno_id' =>30, 'grado_id' => 7, 'paralelo_id' => 14 ]; });







