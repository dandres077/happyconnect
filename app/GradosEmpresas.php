<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradosEmpresas extends Model
{
    protected $fillable = [
        'empresa_id',
        'grado_id',
        'user_create',
        'user_update'         
    ];
}
