<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Cobros extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'mes_id',
        'concepto_id',
        'alumno_id',
        'banco_id',
        'grado_id',
        'paralelo_id',
        'fecha',
        'valor',
        'observacion',
        'notificacion',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Cobros';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'mes_id',
        'concepto_id',
        'alumno_id',
        'banco_id',
        'grado_id',
        'paralelo_id',
        'fecha',
        'valor',
        'observacion',
        'notificacion',
        'status',
        'user_create',
        'user_update'
    ];
}


            