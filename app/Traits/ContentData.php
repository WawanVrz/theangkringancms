<?php 

namespace App\Traits;

use Illuminate\Database\Schema\Blueprint;

use Config;
use File;
use Schema;

use App\SysContentData;

trait ContentData
{

    protected $content_media_dir = 'media/content/';
    protected $accepted_field_type = array(
        'text',
        'digit',
        'number',
        'username',
        'password',
        'passwordgenerator',
        'email',
        'url',
        'slug',
        'tag',
        'textarea',
        'textareacounter',
        'editor',
        'datepicker',
        'file',
        'avatar',
        'phone',
        'creditcard',
        'radio',
        'checkbox',
        'toggle',
        'switch',
        'select',
    );
    protected $content_settings;
    
    
    public function load_content_setting()
    {
        $this->content_settings = Config::get('content');
    }


    public function build_validator_rule($input = '')
    {
        $rules = array();
        $message = array();
        if($input != '' && is_array($input) && count($input) > 0)
        {
            $type = $input['type'];
            foreach($this->content_settings[$type]['field_container'] as $fc_index => $fc)
            {
                if($fc['type'] == 'custom')
                {
                    foreach($fc['field'] as $fcf_index => $fcf)
                    {
                        if(in_array($fcf['type'],$this->accepted_field_type) && array_key_exists($fcf['name'],$input))
                        {
                            // Rules
                            if($fcf['type'] == 'checkbox' OR $fcf['type'] == 'toggle') $rules[$fcf['name'].'.*'] = 'bail';
                            elseif($fcf['type'] == 'select' && array_key_exists('multiselect',$fcf) && $fcf['multiselect'] == 'yes') $rules[$fcf['name'].'.*'] = 'bail';
                            else $rules[$fcf['name']] = 'bail';
                            if(array_key_exists('required',$fcf) && $fcf['required'] == 'yes')
                            {
                                $rules[$fcf['name']] .= '|required';
                                if(array_key_exists('message_error',$fcf) && array_key_exists('required',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.required'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['required']);
                                }
                            }
                            if($fcf['type'] == 'text')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'string' : '|string';
                                if(array_key_exists('minlength',$fcf))
                                {
                                    $rules[$fcf['name']] .= '|min:'.$fcf['minlength'];
                                    if(array_key_exists('message_error',$fcf) && array_key_exists('minlength',$fcf['message_error']))
                                    {
                                        $message[$fcf['name'].'.min'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['minlength']);
                                    }
                                }
                                if(array_key_exists('maxlength',$fcf))
                                {
                                    $rules[$fcf['name']] .= '|max:'.$fcf['maxlength'];
                                    if(array_key_exists('message_error',$fcf) && array_key_exists('maxlength',$fcf['message_error']))
                                    {
                                        $message[$fcf['name'].'.max'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['maxlength']);
                                    }
                                }
                            }
                            elseif($fcf['type'] == 'digit')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'numeric' : '|numeric';
                                if(array_key_exists('message_error',$fcf) && array_key_exists('digits',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.numeric'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['digits']);
                                }
                            }
                            elseif($fcf['type'] == 'number')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'numeric' : '|numeric';
                                if(array_key_exists('message_error',$fcf) && array_key_exists('number',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.numeric'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['number']);
                                }
                            }
                            elseif($fcf['type'] == 'username')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'string|min:4|alpha_num' : '|string|min:4|alpha_num';
                            }
                            elseif($fcf['type'] == 'password')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'string|min:6' : '|string|min:6';
                                $rules[$fcf['name'].'_repeat'] = (array_key_exists('required',$fcf) && $fcf['required'] == 'yes') ? 'bail|required|string|same:'.$fcf['name'] : 'bail|string|same:'.$fcf['name'];
                                if(array_key_exists('message_error',$fcf) && array_key_exists('password',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.min'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['password']);
                                }
                                if(array_key_exists('message_error',$fcf) && array_key_exists('equalTo',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'_repeat.same'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['equalTo']);
                                }
                            }
                            elseif($fcf['type'] == 'passwordgenerator')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'string|min:6' : '|string|min:6';
                                if(array_key_exists('message_error',$fcf) && array_key_exists('password_strong',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.min'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['password_strong']);
                                }
                            }
                            elseif($fcf['type'] == 'email')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'email' : '|email';
                                if(array_key_exists('message_error',$fcf) && array_key_exists('email',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.email'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['email']);
                                }
                            }
                            elseif($fcf['type'] == 'url')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'url' : '|url';
                                if(array_key_exists('message_error',$fcf) && array_key_exists('url',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.url'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['url']);
                                }
                            }
                            elseif($fcf['type'] == 'slug')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'alpha_dash' : '|alpha_dash';
                                if(array_key_exists('message_error',$fcf) && array_key_exists('slug',$fcf['message_error']))
                                {
                                    $message[$fcf['name'].'.alpha_dash'] = trans_custom('backend/content.'.$type.'.field_container.'.$fc_index.'.field.'.$fcf_index.'.label', $fcf['message_error']['slug']);
                                }
                            }
                            elseif($fcf['type'] == 'textareacounter')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'string|max:'.$fcf['maxlength'] : '|string|max:'.$fcf['maxlength'];
                            }
                            elseif($fcf['type'] == 'file' OR $fcf['type'] == 'avatar')
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'file' : '|file';
                            }
                            elseif($fcf['type'] == 'checkbox' OR $fcf['type'] == 'toggle')
                            {
                                $rules[$fcf['name'].'.*'] .= ($rules[$fcf['name'].'.*'] == '') ? 'string' : '|string';
                            }
                            elseif($fcf['type'] == 'select' && array_key_exists('multiselect',$fcf) && $fcf['multiselect'] == 'yes')
                            {
                                $rules[$fcf['name'].'.*'] .= ($rules[$fcf['name'].'.*'] == '') ? 'string' : '|string';
                            }
                            else
                            {
                                $rules[$fcf['name']] .= ($rules[$fcf['name']] == '') ? 'string' : '|string';
                            }
                        }
                    }
                }
            }
        }

        $validator['rules'] = $rules;
        $validator['message'] = $message;

        return $validator;
    }


    public function populate_content_data($input = '', $edit = false)
    {
        $content_data = array('parent' => array(), 'child' => array(), 'files' => array(), 'removed_file' => array());
        $default_field_list = [];
        if($edit)
        {
            $default_field_list = json_decode($input['default_field_list'],true);
            unset($input['default_field_list']);
        }
        if($input != '' && is_array($input) && count($input) > 0)
        {
            $ignored_input = array('_token','object_id');
            $data_parent_list = array('author','type','modified_by');
            foreach($input as $k => $v)
            {
                if(in_array($k,$ignored_input)) continue;
                if(in_array($k,$data_parent_list))
                {
                    $content_data['parent'][$k]['type'] = 'text';
                    if(is_array($v)) $content_data['parent'][$k]['data'] = json_encode($v);
                    else $content_data['parent'][$k]['data'] = $v;
                }
                else
                {
                    $content_data['child'][$k]['type'] = 'text';
                    if(is_array($v)) $content_data['child'][$k]['data'] = json_encode($v);
                    else $content_data['child'][$k]['data'] = $v;
                }
            }
            foreach($this->content_settings[$input['type']]['field_container'] as $fc_index => $fc)
            {
                if($fc['type'] == 'custom')
                {
                    foreach($fc['field'] as $fcf_index => $fcf)
                    {
                        if(in_array($fcf['type'],$this->accepted_field_type))
                        {
                            if(!array_key_exists($fcf['name'],$content_data['parent']) && !array_key_exists($fcf['name'],$content_data['child']))
                            {
                                if(($fcf['type'] == 'file' OR $fcf['type'] == 'avatar') && $edit)
                                {
                                    if(in_array($fcf['name'],$default_field_list))
                                    {
                                        $content_data['removed_file'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['removed_file'][$fcf['name']]['data'] = '';
                                        if(array_key_exists($fcf['name'].'_delete_file',$content_data['parent'])) unset($content_data['parent'][$fcf['name'].'_delete_file']);
                                        if(array_key_exists($fcf['name'].'_delete_file',$content_data['child'])) unset($content_data['child'][$fcf['name'].'_delete_file']);
                                    }
                                    elseif(in_array($fcf['name'],$data_parent_list))
                                    {
                                        if($content_data['parent'][$fcf['name'].'_delete_file']['data'] == '1')
                                        {
                                            $content_data['parent'][$fcf['name']]['type'] = $fcf['type'];
                                            $content_data['parent'][$fcf['name']]['data'] = '';
                                            $content_data['removed_file'][$fcf['name']]['type'] = $fcf['type'];
                                            $content_data['removed_file'][$fcf['name']]['data'] = '';
                                        }
                                        unset($content_data['parent'][$fcf['name'].'_delete_file']);
                                    }
                                    else
                                    {
                                        if($content_data['child'][$fcf['name'].'_delete_file']['data'] == '1')
                                        {
                                            $content_data['child'][$fcf['name']]['type'] = $fcf['type'];
                                            $content_data['child'][$fcf['name']]['data'] = '';
                                            $content_data['removed_file'][$fcf['name']]['type'] = $fcf['type'];
                                            $content_data['removed_file'][$fcf['name']]['data'] = '';
                                        }
                                        unset($content_data['child'][$fcf['name'].'_delete_file']);
                                    }
                                }
                                else
                                {
                                    if(in_array($fcf['name'],$data_parent_list))
                                    {
                                        $content_data['parent'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['parent'][$fcf['name']]['data'] = '';
                                    }
                                    else
                                    {
                                        $content_data['child'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['child'][$fcf['name']]['data'] = '';
                                    }
                                }
                            }
                            else
                            {
                                if($fcf['type'] == 'password' OR $fcf['type'] == 'passwordgenerator')
                                {
                                    if(in_array($fcf['name'],$data_parent_list))
                                    {
                                        $content_data['parent'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['parent'][$fcf['name']]['data'] = bcrypt($content_data['parent'][$fcf['name']]['data']);
                                        if($fcf['type'] == 'password') unset($content_data['parent'][$fcf['name'].'_repeat']);
                                    }
                                    else
                                    {
                                        $content_data['child'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['child'][$fcf['name']]['data'] = bcrypt($content_data['child'][$fcf['name']]['data']);
                                        if($fcf['type'] == 'password') unset($content_data['child'][$fcf['name'].'_repeat']);
                                    }
                                }
                                elseif($fcf['type'] == 'phone')
                                {
                                    if(in_array($fcf['name'],$data_parent_list))
                                    {
                                        $content_data['parent'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['parent'][$fcf['name']]['data'] = str_replace(' ','',$content_data['parent'][$fcf['name']]['data']);
                                        $content_data['parent'][$fcf['name']]['data'] = str_replace('_','',$content_data['parent'][$fcf['name']]['data']);
                                    }
                                    else
                                    {
                                        $content_data['child'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['child'][$fcf['name']]['data'] = str_replace(' ','',$content_data['child'][$fcf['name']]['data']);
                                        $content_data['child'][$fcf['name']]['data'] = str_replace('_','',$content_data['child'][$fcf['name']]['data']);
                                    }
                                }
                                elseif($fcf['type'] == 'file' OR $fcf['type'] == 'avatar')
                                {
                                    $content_data['child'][$fcf['name']]['type'] = $fcf['type'];
                                    $file = $content_data['child'][$fcf['name']]['data'];
                                    $filename = substr($file->getClientOriginalName(), 0, strrpos($file->getClientOriginalName(), "."));
                                    $filename = substr($filename, 0, 30).'_'.str_replace('.','',microtime(true)).'.'.$file->getClientOriginalExtension();
                                    $content_data['child'][$fcf['name']]['data'] = $filename;
                                    $content_data['files'][] = $fcf['name'];
                                    if(in_array($fcf['name'],$data_parent_list)) unset($content_data['parent'][$fcf['name'].'_delete_file']);
                                    else unset($content_data['child'][$fcf['name'].'_delete_file']);
                                }
                                elseif($fcf['type'] == 'switch')
                                {
                                    if(in_array($fcf['name'],$data_parent_list))
                                    {
                                        $content_data['parent'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['parent'][$fcf['name']]['data'] = '';
                                    }
                                    else
                                    {
                                        $content_data['child'][$fcf['name']]['type'] = $fcf['type'];
                                        $content_data['child'][$fcf['name']]['data'] = '';
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
        }

        return $content_data;
    }


    public function create_content_flat_table($content_data)
    {
        // dd($content_data);
        if(is_array($content_data) && count($content_data) > 0)
        {
            Schema::dropIfExists('content_flat_'.$content_data['parent']['type']['data']);
            Schema::create('content_flat_'.$content_data['parent']['type']['data'], function (Blueprint $table) use ($content_data) {
                $table->engine = 'InnoDB';
                $table->bigIncrements('id');
                $table->integer('website_id');
                $table->bigInteger('content_id');
                $table->text('content_type');
                $table->bigInteger('author');
                $table->bigInteger('modified_by')->nullable();
                $table->text('template')->nullable();
                foreach($content_data['child'] as $k => $v)
                {
                    if($k == 'website_id' OR $k == 'template') continue;
                    $table->longText($k)->nullable();
                }
                $table->timestamp('created_at');
                $table->timestamp('updated_at');
            });
        }
    }


    public function get_file_fields($content_type)
    {
        $file_fields = array();
        foreach($this->content_settings[$content_type]['field_container'] as $fc_index => $fc)
        {
            if($fc['type'] == 'custom')
            {
                foreach($fc['field'] as $fcf_index => $fcf)
                {
                    if(($fcf['type'] == 'file' OR $fcf['type'] == 'avatar')) $file_fields[] = $fcf['name'];
                }
            }
        }

        return $file_fields;
    }


    public function delete_file($website_id, $content_id, $content_type, $field)
    {
        $old_file = SysContentData::where('content_id',$content_id)->where('website_id',$website_id)->where('data_key',$field)->first();
        if($old_file)
        {
            if($old_file->data_value != '' && $old_file->data_value != null)
            {
                $file = $this->content_media_dir.$content_type.'/'.$old_file->data_value;
                if(File::exists($file)) File::delete($file);
            }
        }
    }

}