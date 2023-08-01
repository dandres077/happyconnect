<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'mensaje_id',
        'asunto',
        'mensaje',
        'adjunto',
        'usuario_envia',
        'usuario_recibe',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Respuestas';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'mensaje_id',
        'asunto',
        'mensaje',
        'adjunto',
        'usuario_envia',
        'usuario_recibe',
        'status',
        'user_create',
        'user_update'
    ];
}


            