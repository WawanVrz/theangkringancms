<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysOtherSetting extends Model
{
    protected $table = 'sys_other_setting';

    protected $fillable = [
        'logo', 
        'google_analytics', 
        'facebook_pixel', 
        'google_map_api_key', 
        'mailchimp_api_key', 
        'status',
        'created_at', 
        'updated_at', 
    ];
}
