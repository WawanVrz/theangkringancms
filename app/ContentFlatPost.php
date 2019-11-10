<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentFlatPost extends Model
{
    use SoftDeletes;
    
    protected $table = 'content_flat_post';

    protected $dates = ['deleted_at'];
}
