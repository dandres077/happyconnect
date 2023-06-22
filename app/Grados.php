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

    protected static $logName = 'Grados';

    protected static $logAttributes = [
        'empresa_id',
        'nivel_id',
        'nombre',
        'edad',
        'status',
        'user_create',
        'user_update'
    ];

    public function empresas(){
        return $this->belongsToMany(Empresas::class, 'grados_colegios','empresa_id', 'grado_id');
    }
}


            