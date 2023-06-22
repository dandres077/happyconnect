<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Paralelos extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'temporada_id',
        'grado_id',
        'director_id',
        'nombre',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Paralelos';

    protected static $logAttributes = [
        'empresa_id',
        'temporada_id',
        'grado_id',
        'director_id',
        'nombre',
        'status',
        'user_create',
        'user_update'
    ];
}


            