<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SysUserRole extends Model
{
    use SoftDeletes;

    protected $table = 'sys_user_roles';

    protected $fillable = [
        'role', 
        'created_at', 
        'updated_at', 
    ];

    protected $dates = ['deleted_at'];
}
