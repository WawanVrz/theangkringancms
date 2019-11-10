<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'sys_blogs';
    protected $table_product_data = 'sys_blogs_data';
    public $timestamps = false;
    
    public function data() 
    {
        return $this->hasMany('App\BlogsContentData', 'content_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Blogs::class, 'id', 'id')->where('type','category_post');
    }

    public function blogs()
    {
        return $this->belongsToMany(Blogs::class, 'id', 'id')->where('type','post');
    }
}
