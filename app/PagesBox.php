<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagesBox extends Model
{
    
    protected $table = 'pages_box';
    public $timestamps = false;
    
    
    public function page() 
    {
        return $this->belongsTo('App\Pages','page_id');
    }

}
