<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class GradosEmpresas extends Model
{

    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'grado_id',
        'user_create',
        'user_update'  
    ];

    protected static $logName = 'Grados';

    protected static $logAttributes = [
        'empresa_id',
        'grado_id',
        'user_create',
        'user_update'  
    ];
}
