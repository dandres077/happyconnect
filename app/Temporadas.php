<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Temporadas extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Temporadas';

    protected static $logAttributes = [
        'empresa_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'status',
        'user_create',
        'user_update'
    ];
}


            