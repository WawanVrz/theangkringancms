<?php

function field_readonly()
{
    return ' readonly="readonly" ';
}

function field_disabled()
{
    return ' disabled="disabled" ';
}

function field_default($target = '', $checked = true)
{
    $content = '<div class="checkbox pull-right">
                    <label>
                        <input data-target="'.$target.'" type="checkbox" class="use-default-checkbox control-info" '.(($checked) ? 'checked="checked"' : '').'>
                        <span class="text-size-small">'.ucwords(trans('backend/core.use_default')).'</span>
                    </label>
                </div>';
    
    return $content;
}







?>