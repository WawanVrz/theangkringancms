<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysWebsite extends Model
{
    
    protected $table = 'sys_websites';

    
    public function language() 
    {
        return $this->belongsTo('App\SysLocale','locale','code');
    }

}
