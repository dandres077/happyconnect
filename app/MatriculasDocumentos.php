<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class MatriculasDocumentos extends Model
{
    use LogsActivity;

    protected $fillable = [
        'matricula_id',
        'nombre',
        'archivo',
        'status',
        'user_create',
        'user_update',  
    ];

    protected static $logName = 'Matriculas documentos';

    protected static $logAttributes = [
        'matricula_id',
        'nombre',
        'archivo',
        'status',
        'user_create',
        'user_update',  
    ];
}
