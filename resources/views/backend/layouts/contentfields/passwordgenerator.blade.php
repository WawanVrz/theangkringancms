<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            <div class="label-indicator-absolute">
                <div class="input-group">
                    <span data-target="#password_strong" class="input-group-addon show-hide-password" style="cursor:pointer;"><i class="icon-eye2"></i></span>
                    <input
                        type="text" 
                        class="form-control"
                        id="{{ $f['id'] }}"  
                        name="{{ $f['name'] }}" 
                        {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                        data-rule-password_strong="true"
                        @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif
                        @if(is_array($f['message_error']) && array_key_exists('password_strong',$f['message_error'])) data-msg-password_strong="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.password_strong', $f['message_error']['password_strong'])) }}" @endif
                        @if(array_key_exists('placeholder',$f)) placeholder="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) }}" @endif
                        value="{{ old($f['name']) }}">  
                </div>
                <span class="label password-indicator-label-absolute" style="z-index:2;"></span>
            </div>
            <button type="button" class="btn btn-info generate-label-absolute" style="margin-top: 5px;">
                {{ ucfirst(trans('backend/core.generate_10_password')) }}
            </button>
        </div>
    </div>
</div>