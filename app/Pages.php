<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    
    protected $table = 'pages';
    public $timestamps = false;
    
    
    public function box() 
    {
        return $this->hasMany('App\PagesBox', 'page_id', 'id');
    }

    
    public function template() 
    {
        return $this->belongsTo('App\PagesTemplate','template');
    }


}
