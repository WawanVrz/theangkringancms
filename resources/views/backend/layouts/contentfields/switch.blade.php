<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }}
        </label>
        <div class="col-sm-12">
            @php
                $switch_button_data = null;
                if(isset($object) && array_key_exists($f['name'],$object->data)) $switch_button_data = $object->data[$f['name']];
            @endphp
            @if(array_key_exists('data',$f) && is_array($f['data']) && count($f['data']) == 2)
                <div class="checkbox checkbox-switch">
                    <label>
                        <input
                            type="checkbox" 
                            class="switch"
                            id="{{ $f['id'] }}"  
                            name="{{ $f['name'] }}" 
                            {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                            @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif 
                            data-size="small"
                            data-on-text='{!! $f['data']['on']['label'] !!}'
                            data-off-text='{!! $f['data']['off']['label'] !!}'
                            data-on-color='{{ $f['data']['on']['color'] }}'
                            data-off-color='{{ $f['data']['off']['color'] }}' 
                            @if($switch_button_data == null)
                                @if($f['checked'] == 'checked') checked="checked" @endif
                            @else
                                @if($switch_button_data == 'on') checked="checked" @endif
                            @endif
                            >
                    </label>
                </div>
            @endif
        </div>
    </div>
</div>