<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Grados extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'nivel_id',
        'nombre',
        'edad',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'GRADOS';

    protected static $logAttributes = [
        'empresa_id',
        'nivel_id',
        'nombre',
        'edad',
        'status',
        'user_create',
        'user_update'
    ];
}


            