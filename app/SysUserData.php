<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysUserData extends Model
{
    
    protected $table = 'sys_user_data';


    public function user() 
    {
        return $this->belongsTo('App\SysUser','user_id');
    }


}
