<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagesTemplate extends Model
{
    
    protected $table = 'pages_template';
    public $timestamps = false;
    
    
    public function page() 
    {
        return $this->hasMany('App\Pages', 'template', 'id');
    }


}
