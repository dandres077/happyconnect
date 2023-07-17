<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Rutas extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'proveedor_id',
        'nombre',
        'marca',
        'modelo',
        'placa',
        'imagen',
        'conductor',
        'tel_conductor',
        'monitor',
        'tel_monitor',
        'observaciones',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Rutas';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'proveedor_id',
        'nombre',
        'marca',
        'modelo',
        'placa',
        'imagen',
        'conductor',
        'tel_conductor',
        'monitor',
        'tel_monitor',
        'observaciones',
        'status',
        'user_create',
        'user_update'
    ];
}

            