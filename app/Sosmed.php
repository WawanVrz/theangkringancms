<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    protected $table = 'sys_sosmed';

    protected $fillable = [
        'website_id', 
        'author', 
        'name', 
        'url', 
        'icon', 
        'status',
        'created_at', 
        'updated_at', 
    ];
}
