<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class PreguntasFrecuentes extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'categoria_id',
        'nombre',
        'descripcion',
        'archivo',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Preguntas frecuentes';

    protected static $logAttributes = [
        'empresa_id',
        'categoria_id',
        'nombre',
        'descripcion',
        'archivo',
        'status',
        'user_create',
        'user_update'
    ];
}


            