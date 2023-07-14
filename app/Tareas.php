<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'periodo_id',
        'grado_id',
        'paralelo_id',
        'asignatura_id',
        'tarea',
        'imagen',
        'fecha_entrega',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Tareas';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'periodo_id',
        'grado_id',
        'paralelo_id',
        'asignatura_id',
        'tarea',
        'imagen',
        'fecha_entrega',
        'status',
        'user_create',
        'user_update'
    ];
}


            