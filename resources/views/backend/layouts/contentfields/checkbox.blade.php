<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            @php
                $checkbox_data = false;
                if(isset($object) && array_key_exists($f['name'],$object->data)) 
                {
                    if($object->data[$f['name']] != '') $checkbox_data = json_decode($object->data[$f['name']],true);
                    else $checkbox_data = true;
                }
            @endphp
            @if(array_key_exists('data',$f) && is_array($f['data']) && count($f['data']) > 0)
                @php  $i = 0; @endphp
                @foreach($f['data'] as $d)
                    @if(array_key_exists('style',$f) && $f['style']== 'inline')
                        <label class="checkbox-inline">
                    @else 
                        <div class="checkbox"><label>
                    @endif
                            <input
                                type="checkbox" 
                                class="radio-control-primary"
                                id="{{ $f['id'].'_'.$i }}"  
                                name="{{ $f['name'].'[]' }}" 
                                {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                                @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif 
                                @if(!$checkbox_data)
                                    @if($d['checked'] == 'checked') checked="checked" @endif
                                @else
                                    @if(is_array($checkbox_data))
                                        @if(in_array($d['value'],$checkbox_data)) checked="checked" @endif
                                    @endif
                                @endif                                
                                value="{{ $d['value'] }}" >
                                {!! $d['label'] !!}
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