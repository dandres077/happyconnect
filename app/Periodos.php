<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'final',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Periodos';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'final',
        'status',
        'user_create',
        'user_update'
    ];
}


            