<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Comunicados extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'categoria_id',
        'temporada_id',
        'grado_id',
        'paralelo_id',
        'nombre',
        'descripcion',
        'imagen',
        'archivo1',
        'archivo2',
        'archivo3',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Comunicados';

    protected static $logAttributes = [
        'empresa_id',
        'categoria_id',
        'temporada_id',
        'grado_id',
        'paralelo_id',
        'nombre',
        'descripcion',
        'imagen',
        'archivo1',
        'archivo2',
        'archivo3',
        'status',
        'user_create',
        'user_update'
    ];
}


            