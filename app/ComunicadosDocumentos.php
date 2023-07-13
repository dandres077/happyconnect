<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ComunicadosDocumentos extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'comunicado_id',
        'grado_id',
        'paralelo_id',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Comunicados Documentos';

    protected static $logAttributes = [
        'empresa_id',
        'comunicado_id',
        'grado_id',
        'paralelo_id',
        'status',
        'user_create',
        'user_update'
    ];
}
