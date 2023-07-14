<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $fillable = [
        'pais_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'Departamentos';

    protected static $logAttributes = [
        'pais_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
