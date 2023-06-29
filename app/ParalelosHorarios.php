<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ParalelosHorarios extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'periodo_id',
        'paralelo_id',
        'dia_id',
        'asignatura_id',
        'docente_id',
        'bloque_id',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Paralelos';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'periodo_id',
        'paralelo_id',
        'dia_id',
        'asignatura_id',
        'docente_id',
        'bloque_id',
        'status',
        'user_create',
        'user_update'
];
}


            