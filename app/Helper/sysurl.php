<?php

function baseurl($path = '')
{
    return url($path);
}


function url_css_frontend($path = '')
{
    return baseurl('assets/frontend/css/'.$path);
}


function url_css_backend($path = '')
{
    return baseurl('assets/backend/css/'.$path);
}


function url_js_frontend($path = '')
{
    return baseurl('assets/frontend/js/'.$path);
}


function url_js_backend($path = '')
{
    return baseurl('assets/backend/js/'.$path);
}


function url_img_frontend($path = '')
{
    return baseurl('assets/frontend/img/'.$path);
}


function url_img_backend($path = '')
{
    return baseurl('assets/backend/img/'.$path);
}


function url_assets_frontend($path = '')
{
    return baseurl('assets/frontend/'.$path);
}


function url_assets_backend($path = '')
{
    return baseurl('assets/backend/'.$path);
}


function url_media($path = '')
{
    return baseurl('media/'.$path);
}


?>