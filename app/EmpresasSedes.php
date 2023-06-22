<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class EmpresasSedes extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'nombre',
        'documento',
        'email',
        'telefono',
        'celular',
        'direccion',
        'departamento_id',
        'ciudad_id',
        'estrato_id',
        'sector_id',
        'zona_id',
        'calendario_id',
        'jornada_id',
        'genero_id',
        'rector',
        'imagen',
        'texto',
        'facebook',
        'instagram',
        'youtube',
        'tiktok',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Sedes';

    protected static $logAttributes = [
        'empresa_id',
        'nombre',
        'documento',
        'email',
        'telefono',
        'celular',
        'direccion',
        'departamento_id',
        'ciudad_id',
        'estrato_id',
        'sector_id',
        'zona_id',
        'calendario_id',
        'jornada_id',
        'genero_id',
        'rector',
        'imagen',
        'texto',
        'facebook',
        'instagram',
        'youtube',
        'tiktok',
        'status',
        'user_create',
        'user_update'
    ];
}
