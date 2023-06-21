<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use LogsActivity;

    protected $fillable = [
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'Marcas';

    protected static $logAttributes = [
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
