<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Asignaturas extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'area_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'Asignaturas';

    protected static $logAttributes = [
        'empresa_id',
        'area_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
