<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    
    protected $table = 'post_comments';
    public $timestamps = false;

    
    public function post() 
    {
        return $this->belongsTo('App\Post','post_id');
    }


}
