<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'periodo_id',
        'grado_id',
        'paralelo_id',
        'asignatura_id',
        'alumno_id',
        'observacion',
        'imagen',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Observaciones';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'periodo_id',
        'grado_id',
        'paralelo_id',
        'asignatura_id',
        'alumno_id',
        'observacion',
        'imagen',
        'status',
        'user_create',
        'user_update'
    ];
}
