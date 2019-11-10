<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            <input
                type="password" 
                class="form-control"
                id="{{ $f['id'] }}"  
                name="{{ $f['name'] }}" 
                {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                data-rule-password="true"
                @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif
                @if(is_array($f['message_error']) && array_key_exists('password',$f['message_error'])) data-msg-password="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.password', $f['message_error']['password'])) }}" @endif
                @if(array_key_exists('placeholder',$f)) placeholder="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) }}" @endif
                value="{{ old($f['name']) }}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label_confirm', $f['label_confirm'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            <input
                type="password" 
                class="form-control"
                id="{{ $f['id'].'_repeat' }}"  
                name="{{ $f['name'].'_repeat' }}" 
                {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                data-rule-equalTo="#{{ $f['id'] }}"
                @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required_confirm', $f['message_error']['required_confirm'])) }}" @endif
                @if(is_array($f['message_error']) && array_key_exists('equalTo',$f['message_error'])) data-msg-equalTo="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.equalTo', $f['message_error']['equalTo'])) }}" @endif
                @if(array_key_exists('placeholder_confirm',$f)) placeholder="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder_confirm', $f['placeholder_confirm'])) }}" @endif
                value="{{ old($f['name']) }}">
        </div>
    </div>
</div>