<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'grado_id',
        'paralelo_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'adjunto',
        'imagen',
        'link',
        'observaciones',
        'status',
        'user_create',
        'user_update'
];

    protected static $logName = 'Actividades';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'grado_id',
        'paralelo_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'adjunto',
        'imagen',
        'link',
        'observaciones',
        'status',
        'user_create',
        'user_update'
    ];
}


            
            