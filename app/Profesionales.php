<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Profesionales extends Model
{
    use LogsActivity;

    protected $fillable = [
        'usuario_id',
        'empresa_id',
        'telefono',
        'direccion',
        'ciudad',
        'celular',
        'email',
        'genero_id',
        'tipo_documento',
        'n_documento',
        'fecha_nacimiento',
        'civil_id',
        'estudios',
        'perfil',
        'experiencia',
        'imagen',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Profesionales';

    protected static $logAttributes = [
        'usuario_id',
        'empresa_id',
        'telefono',
        'direccion',
        'ciudad',
        'celular',
        'email',
        'genero_id',
        'tipo_documento',
        'n_documento',
        'fecha_nacimiento',
        'civil_id',
        'estudios',
        'perfil',
        'experiencia',
        'imagen',
        'status',
        'user_create',
        'user_update'
    ];
}


            