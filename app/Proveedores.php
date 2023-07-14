<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'empresa',
        'contacto',
        'n_documento',
        'email',
        'celular',
        'direccion',
        'ciudad',
        'observaciones',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Proveedores';

    protected static $logAttributes = [
        'empresa_id',
        'empresa',
        'contacto',
        'n_documento',
        'email',
        'celular',
        'direccion',
        'ciudad',
        'observaciones',
        'status',
        'user_create',
        'user_update'
    ];
}

            
