<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use LogsActivity;

    protected $fillable = [
        'marca_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'Modelo';

    protected static $logAttributes = [
        'marca_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];


}
