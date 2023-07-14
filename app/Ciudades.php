<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use LogsActivity;

    protected $fillable = [
        'pais_id',
        'departamento_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'Ciudades';

    protected static $logAttributes = [
        'pais_id',
        'departamento_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
