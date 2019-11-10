<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysContentData extends Model
{
    
    protected $table = 'sys_content_data';


    public function user() 
    {
        return $this->belongsTo('App\SysContent','content_id');
    }


}
