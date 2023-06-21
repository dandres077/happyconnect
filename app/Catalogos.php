<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogos extends Model
{
    protected $fillable = [
        'empresa_id', 
        'generalidad_id', 
        'nombre', 
        'opcion', 
        'status', 
        'user_create', 
        'user_update'
    ];
}
