<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogsContentData extends Model
{
    protected $table = 'sys_blogs_data';
    
    public function blog() 
    {
        return $this->belongsTo('App\Blogs','content_id');
    }
}
