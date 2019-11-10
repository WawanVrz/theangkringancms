<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SysUser extends Model
{
    use SoftDeletes;
    
    protected $table = 'sys_users';
    protected $table_user_data = 'sys_user_data';
    protected $table_user_role = 'sys_user_roles';

    protected $fillable = [
        'username', 
        'firstname',
        'lastname', 
        'email',
        'telphone', 
        'password',
        'role_id', 
        'avatar',
        'status', 
        'api_token',    
        'created_at',
        'updated_at', 
    ];

    protected $dates = ['deleted_at'];
    public function getNameAttribute(){
        return $this->firstname.' '.$this->lastname;
    }
    public function data() 
    {
        return $this->hasMany('App\SysUserData', 'user_id', 'id');
    }


    public function scopeUser_List($query, $role = '')
    {   
        if($role == '') $where = " <> '".$role."' ";
        else $where = " = '".$role."' ";

        $sql = "SELECT a.*
                FROM ".$this->table." AS a
                WHERE a.role_id IN (SELECT b.id FROM ".$this->table_user_role." AS b WHERE b.id ".$where.")";
        $result = \DB::select($sql);
        
        if($result)
        {
            $sql = "SELECT
                    c.*
                    FROM ".$this->table_user_data." AS c
                    WHERE user_id IN (
                        SELECT
                        a.id
                        FROM ".$this->table." AS a
                        WHERE a.role_id IN (SELECT b.id FROM ".$this->table_user_role." AS b WHERE b.id ".$where.")
                    )
                    ORDER BY c.user_id, c.id";
            $result_data = \DB::select($sql);

            $object = array();
            foreach($result as $r) $object[$r->id] = $r;
            foreach($result_data as $r) $object[$r->user_id]->{$r->data_key} = $r->data_value;
            
            return $object;
        }
        
        return false;
    }


    public function scopeGet_User($query, $id = '')
    {   
        $sql = "SELECT a.*
                FROM ".$this->table." AS a
                WHERE a.id = '".$id."'";
        $result = \DB::select($sql);

        if($result)
        {
            $sql = "SELECT
                    c.*
                    FROM ".$this->table_user_data." AS c
                    WHERE user_id IN (
                        SELECT
                        a.id
                        FROM ".$this->table." AS a
                        WHERE a.id = '".$id."'
                    )";
            $result_data = \DB::select($sql);
            $object = $result[0];
            foreach($result_data as $r) $object->{$r->data_key} = $r->data_value;
            
            return $object;
        }
        
        return false;
    }


    public function scopeBulk_User($query, $selected_items, $action = '')
    { 
        $ids = $where = $where_data = '';
        if(is_array($selected_items) && count($selected_items['items']) > 0)
        {
            foreach($selected_items['items'] as $item) if($item != '') $ids .= "'".$item."',";
            $ids = rtrim($ids,',');
            if($ids != '') 
            {
                if($selected_items['flag'] == 'in') 
                {
                    $where = "WHERE id IN(".$ids.")";
                    if($action == 'delete') $where_data = "WHERE user_id IN(".$ids.")";
                }
                else 
                {
                    $where = "WHERE id NOT IN(".$ids.")";
                    if($action == 'delete') $where_data = "WHERE user_id NOT IN(".$ids.")";
                }
            }
        }
        if($action == 'enable') \DB::statement("UPDATE ".$this->table." SET status = '1' ".$where);
        else if($action == 'disable') \DB::statement("UPDATE ".$this->table." SET status = '0' ".$where);
        else if($action == 'delete') 
        {
            \DB::statement("DELETE FROM ".$this->table."  ".$where);
            \DB::statement("DELETE FROM ".$this->table_user_data."  ".$where_data);
        }
    }


    public function datatable_model($role = '')
    {
        if($role == '') $where = " <> '".$role."' ";
        else $where = " = '".$role."' ";

        return "SELECT 
                a.*,
                (SELECT b.data_value FROM ".$this->table_user_data." AS b WHERE b.user_id = a.id AND data_key = 'first_name' LIMIT 1) AS first_name,
                (SELECT group_concat(b.data_value SEPARATOR ' ') FROM ".$this->table_user_data." as b WHERE b.user_id = a.id AND b.data_key IN ('first_name','last_name')) AS name
                FROM ".$this->table." AS a WHERE a.role_id ".$where;
        
    }


}
