<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Catalogos extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id', 
        'generalidad_id', 
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];

    protected static $logName = 'Catalogos';

    protected static $logAttributes = [
        'empresa_id', 
        'generalidad_id', 
        'nombre', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
