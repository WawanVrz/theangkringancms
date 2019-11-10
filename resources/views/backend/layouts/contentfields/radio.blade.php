<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            @php
                $radio_button_data = null;
                if(isset($object) && array_key_exists($f['name'],$object->data)) $radio_button_data = $object->data[$f['name']];
            @endphp
            @if(array_key_exists('data',$f) && is_array($f['data']) && count($f['data']) > 0)
                @php $i = 0; @endphp
                @foreach($f['data'] as $v => $l)
                    @if(array_key_exists('style',$f) && $f['style']== 'inline')
                        <label class="radio-inline">
                    @else 
                        <div class="radio"><label>
                    @endif
                            <input
                                type="radio" 
                                class="radio-control-primary"
                                id="{{ $f['id'].'_'.$i }}"  
                                name="{{ $f['name'] }}" 
                                {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                                @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif 
                                @if($radio_button_data == null)
                                    @if($i == 0) checked="checked" @endif
                                @else
                                    @if($v == $radio_button_data) checked="checked" @endif
                                @endif
                                value="{{ $v }}" >
                                {!! $l !!}
                    @if(array_key_exists('style',$f) && $f['style']== 'inline')
                        </label>
                    @else 
                        </label></div>
                    @endif
                    @php $i++; @endphp
                @endforeach
            @endif
        </div>
    </div>
</div>