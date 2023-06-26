<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'nombre1',
        'apellido1',
        'nombre2',
        'apellido2',
        'tipo_id',
        'n_documento',
        'exp_fecha',
        'pais_exp',
        'departamento_exp',
        'ciudad_exp',
        'pais_origen',
        'departamento_origen',
        'ciudad_origen', 
        'sangre_id',
        'genero_id',
        'edad',
        'fecha_nacimiento',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'AREAS';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'nombre1',
        'apellido1',
        'nombre2',
        'apellido2',
        'tipo_id',
        'n_documento',
        'exp_fecha',
        'pais_exp',
        'departamento_exp',
        'ciudad_exp',
        'pais_origen',
        'departamento_origen',
        'ciudad_origen',        
        'sangre_id',
        'genero_id',
        'edad',
        'fecha_nacimiento',
        'status',
        'user_create',
        'user_update'
    ];

    // protected static function newFactory()
    // {
    //     return AlumnosFactory::new();
    // }

}


            