<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Padres extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'tipo_familiar',
        'alumno_id',
        'nombres',
        'apellidos',
        'tipo_doc_id',
        'n_documento',
        'exp_municipio',
        'direccion',
        'telefono',
        'celular',
        'email',
        'profesion',
        'nivel_educativo',
        'empr_nombre',
        'empr_ocupacion',
        'empr_direccion',
        'empr_telefono',
        'empr_email',
        'status',
        'user_create',
        'user_update',
    ];

    protected static $logName = 'Niveles';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'tipo_familiar',
        'alumno_id',
        'nombres',
        'apellidos',
        'tipo_doc_id',
        'n_documento',
        'exp_municipio',
        'direccion',
        'telefono',
        'celular',
        'email',
        'profesion',
        'nivel_educativo',
        'empr_nombre',
        'empr_ocupacion',
        'empr_direccion',
        'empr_telefono',
        'empr_email',
        'status',
        'user_create',
        'user_update',
    ];
}
