<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{

    use LogsActivity;

    protected $fillable = [
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'Paises';

    protected static $logAttributes = [
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
