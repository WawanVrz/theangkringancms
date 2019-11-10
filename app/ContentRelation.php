<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentRelation extends Model
{
    protected $table = 'sys_content_relation';
     protected $fillable = [
            'relation', 
            'parent_id', 
            'child_id',
        ];
    
    public $timestamps = false;
}
