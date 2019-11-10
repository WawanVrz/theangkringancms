<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysContent extends Model
{
    
    protected $table = 'sys_contents';
    protected $table_user_data = 'sys_content_data';
    protected $fillable = ['author','type','status','title','slug','content','excerpt','template','publish_time','order','parent','comment_status','modified_by'];

    public function theauthor(){
      return $this->belongsTo(SysUser::class, 'author');
    }

    public function data()
    {
        return $this->hasMany('App\SysContentData', 'content_id', 'id');
    }


    public static function getId($id = '')
    {
        $data = [];
        $content = SysContent::find($id);
        if(count($content) > 0)
        {
            $content_data = $content->data()->where('website_id','0')->get();
            if(count($content_data) > 0) foreach($content_data as $cd) $data[$cd->data_key] = $cd->data_value;
            $content->data = $data;
        }

        return $content;
    }


    public static function getType($type = '')
    {
        $contents = SysContent::where('type',$type)->get();
        if(count($contents) > 0)
        {
            foreach($contents as $content)
            {
                $data = [];
                $content_data = $content->data()->where('website_id','0')->get();
                if(count($content_data) > 0) foreach($content_data as $cd) $data[$cd->data_key] = $cd->data_value;
                $content->data = $data;
            }
        }

        return $contents;
    }


    public function datatable_model($type)
    {
        if($type == 'page')
        {
            return "SELECT
                    a.content_id as id,
                    a.title,
                    a.slug,
                    a.created_at,
                    a.status,
                    (SELECT CONCAT(b.first_name,' ',b.last_name) FROM flat_data_user_administrator AS b WHERE a.author = b.user_id) AS author_name
                    FROM flat_data_content_".$type." AS a WHERE a.website_id = 0";
        }
        else
        {
            return "SELECT
                    a.content_id as id,
                    a.first_name,
                    a.last_name,
                    a.email,
                    a.created_at,
                    a.status
                    FROM flat_data_content_".$type." AS a WHERE a.website_id = 0";
        }


    }

}
