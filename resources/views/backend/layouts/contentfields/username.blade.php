<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            <input
                type="text" 
                class="form-control"
                id="{{ $f['id'] }}"  
                name="{{ $f['name'] }}" 
                {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                data-rule-minlength="4"
                data-rule-alphanumeric="true"
                @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif
                @if(is_array($f['message_error']) && array_key_exists('minlength',$f['message_error'])) data-msg-minlength="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.minlength', $f['message_error']['minlength'])) }}" @endif
                @if(is_array($f['message_error']) && array_key_exists('alphanumeric',$f['message_error'])) data-msg-alphanumeric="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.alphanumeric', $f['message_error']['alphanumeric'])) }}" @endif
                @if(array_key_exists('placeholder',$f)) placeholder="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) }}" @endif
                value="{{ (isset($object) && $object->data[$f['name']]) ? $object->data[$f['name']] : '' }}">
        </div>
    </div>
</div>