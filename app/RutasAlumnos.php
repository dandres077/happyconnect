<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class RutasAlumnos extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'ruta_id',
        'grado_id',
        'paralelo_id',
        'alumno_id',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Rutas';

    protected static $logAttributes = [
        'empresa_id',
        'ruta_id',
        'grado_id',
        'paralelo_id',
        'alumno_id',
        'status',
        'user_create',
        'user_update'
    ];
}

            