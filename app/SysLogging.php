<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SysLogging extends Model
{
    use SoftDeletes;

    protected $table = 'sys_logging';

    protected $fillable = [
        'user_id', 
        'fullname', 
        'user_role', 
        'status', 
        'website_id', 
        'content_type',
        'url',
        'notes',
        'ac',
        'created_at', 
        'updated_at', 
    ];

    protected $dates = ['deleted_at'];
}
