<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'AREAS';

    protected static $logAttributes = [
        'empresa_id',
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
