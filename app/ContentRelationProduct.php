<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentRelationProduct extends Model
{
    protected $table = 'sys_content_relation_product';
     protected $fillable = [
            'relation', 
            'parent_id', 
            'child_id',
        ];
    
    public $timestamps = false;
}
