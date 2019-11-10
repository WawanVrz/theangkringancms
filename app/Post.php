<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $table = 'posts';
    public $timestamps = false;
    
    
    public function comment() 
    {
        return $this->hasMany('App\PostComment', 'post_id', 'id');
    }

    
    public function category() 
    {
        return $this->belongsTo('App\PostCategory','post_category');
    }
    
    
    public function author() 
    {
        return $this->belongsTo('App\User','post_author');
    }


}
