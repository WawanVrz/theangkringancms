<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            <input
                type="text" 
                class="form-control"
                data-mask="+99 999 ?999 999 999"
                id="{{ $f['id'] }}"  
                name="{{ $f['name'] }}" 
                data-rule-phone="true"
                {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif
                @if(is_array($f['message_error']) && array_key_exists('phone',$f['message_error'])) data-msg-phone="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.phone', $f['message_error']['phone'])) }}" @endif
                @if(array_key_exists('placeholder',$f)) placeholder="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) }}" @endif
                @if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes' && $website != 0 && !array_key_exists($f['name'],$object_website)) disabled="disabled" @endif
                value="{{ (isset($object) && $object->data[$f['name']]) ? $object->data[$f['name']] : old($f['name']) }}">
            @if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes' && $website != 0)
            @php 
                $same_as_default_checked = true;
                if(array_key_exists($f['name'],$object_website)) $same_as_default_checked = false;
            @endphp
            <div class="checkbox pull-right">
                <label>
                    <input data-target="{{ $f['id'] }}" type="checkbox" class="use-default-checkbox control-info" {!! ($same_as_default_checked) ? 'checked="checked"' : '' !!}>
                    <span class="text-size-small">{{ ucfirst(trans('backend/core.same_as_default')) }}</span>
                </label>
            </div>
            @endif
        </div>
    </div>
</div>