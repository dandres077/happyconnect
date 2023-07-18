<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use LogsActivity;

    protected $fillable = [
        'empresa_id',
        'categoria_id',
        'titulo',
        'slug',
        'texto',
        'imagen',
        'keywords',
        'status',
        'user_create',
        'user_update'
    ];

    protected static $logName = 'Blog';

    protected static $logAttributes = [
        'empresa_id',
        'categoria_id',
        'titulo',
        'slug',
        'texto',
        'imagen',
        'keywords',
        'status',
        'user_create',
        'user_update'
    ];
}



            