<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysLang extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'id', 
        'name', 
        'code', 
        'created_at', 
        'updated_at', 
    ];
}
