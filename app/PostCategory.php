<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    
    protected $table = 'post_categories';
    public $timestamps = false;
    
    
    public function post() 
    {
        return $this->hasMany('App\Post', 'post_category', 'id');
    }


}
