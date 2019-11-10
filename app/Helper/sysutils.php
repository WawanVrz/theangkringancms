<?php

function convert_to_byte($size)
{
    $unit = array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}


function trans_custom($key = '', $default = '')
{
    if(Lang::has($key)) return trans($key);
    else return $default;
}

if(!function_exists('__')){
    function __($key){
        return trans($key);
    }
}

if(!function_exists('web_id_by_lang')){
    function web_id_by_lang($code){
        $i = 0;
        foreach(config('locale.languages') as $c => $lang){
            if($c == $code){
                return $i;
            }
            $i++;
        }
        return $i;
    }
}


if(!function_exists('renderhomecontent')){
    function renderhomecontent($content,$mark,$locale){
        return isset($content->$mark->{ $locale })?(!empty($content->$mark->{ $locale })?$content->$mark->{ $locale }:$content->$mark->en):$content->$mark->en;
    }
}


if(!function_exists('renderlangcustom')){
    $locale = 'en';
    function renderlangcustom($contentkey, $locale){
        $code = $locale;
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);
        $swaplangcustom = $jsonString[$contentkey];

        return $swaplangcustom;
    }
}

if(!function_exists('optional')){
    function optional($obj){
        return $obj?:collect([]);
    }
}
