<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            @if(array_key_exists('button_select_all',$f) OR array_key_exists('button_deselect_all',$f)) <div class="input-group"> @endif
                <select
                    class="show-tick select-all-values"
                    id="{{ $f['id'] }}"  
                    {!! (array_key_exists('multiselect',$f) && $f['multiselect'] == 'yes') ? 'name="'.$f['name'].'[]"' : 'name="'.$f['name'].'"' !!}
                    name="{{ $f['name'] }}"
                    data-selected-text-format="count > 7" 
                    {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                    {!! (array_key_exists('selectwidth',$f) && $f['selectwidth'] == 'auto') ? 'data-width="auto"' : 'data-width="100%"' !!}
                    @if(array_key_exists('multiselect',$f) && $f['multiselect'] == 'yes') multiple="multiple" @endif
                    @if(array_key_exists('search',$f) && $f['search'] == 'yes') data-live-search="true" @endif
                    @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif
                    @if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes' && $website != 0 && !array_key_exists($f['name'],$object_website)) disabled="disabled" @endif
                    @if(array_key_exists('placeholder',$f)) title="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) }}" @endif >
                    <?php
                        if(isset($object) && array_key_exists($f['name'],$object->data))
                        {
                            if(array_key_exists('multiselect',$f) && $f['multiselect'] == 'yes')
                            {
                                if($object->data[$f['name']] != '') $selectbox_data = json_decode($object->data[$f['name']], true);
                                else $selectbox_data = array();
                            }
                            else
                            {
                                $selectbox_data = array($object->data[$f['name']]);
                            }
                        }
                        else
                        {
                            $selectbox_data = array();
                        }
                    ?>
                    @if(array_key_exists('data',$f) && count($f['data']) > 0)
                        @foreach($f['data'] as $i)
                            @if(array_key_exists('grouplabel',$i))
                                <optgroup label="{{ $i['grouplabel'] }}">
                                    @foreach($i['option'] as $oi)
                                        @php $option_selected = (in_array($oi['value'],$selectbox_data)) ? 'selected="selected"' : ''; @endphp
                                        <option value="{{ $oi['value'] }}" data-icon="{{ $oi['icon'] }}" {{ $option_selected }}>{!! $oi['text'] !!}</option>
                                    @endforeach
                                </optgroup>
                            @else
                                @php $option_selected = (in_array($i['value'],$selectbox_data)) ? 'selected="selected"' : ''; @endphp
                                <option value="{{ $i['value'] }}" data-icon="{{ $i['icon'] }}" {{ $option_selected }}>{!! $i['text'] !!}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            @if(array_key_exists('button_select_all',$f) OR array_key_exists('button_deselect_all',$f))
                <div class="input-group-btn">
                    @if($f['button_select_all'] == 'yes')
                        <button 
                            type="button" 
                            class="btn btn-info" 
                            @if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes' && $website != 0 && !array_key_exists($f['name'],$object_website)) disabled="disabled" @endif
                            id="{{ $f['id'] }}_select-all-values">{{ ucfirst(trans('backend/core.select_all')) }}</button>
                    @endif
                    @if($f['button_deselect_all'] == 'yes')
                        <button 
                            type="button" 
                            class="btn btn-default" 
                            @if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes' && $website != 0 && !array_key_exists($f['name'],$object_website)) disabled="disabled" @endif
                            id="{{ $f['id'] }}_deselect-all-values">{{ ucfirst(trans('backend/core.deselect_all')) }}</button>
                    @endif
                </div>
            </div>
            @endif
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
<script type="text/javascript">
    <?php
        if(isset($object) && array_key_exists($f['name'],$object->data))
        {
            if(array_key_exists('multiselect',$f) && $f['multiselect'] == 'yes')
            {
                if($object->data[$f['name']] != '') echo 'var '.$f['id'].'_selectData = '.$object->data[$f['name']].';';
                else echo 'var '.$f['id'].'_selectData = [];';
            }
            else
            {
                echo 'var '.$f['id'].'_selectData = ["'.$object->data[$f['name']].'"];';
            }
        }
        else
        {
            echo 'var '.$f['id'].'_selectData = [];';
        }
    ?>
    $(document).ready(function(){
        @if(! array_key_exists('data',$f) && array_key_exists('datasource',$f))
            var items = JSON.parse($('{{ $f['datasource'] }}').val());
            $.each(items, function (k, v) {
                if('grouplabel' in v){
                    var opt = document.createElement("optgroup"); 
                    $(opt).attr('label',v.grouplabel);
                    $.each(v.option, function (sk, sv){
                        var o = $('<option>', { 
                            value: sv.value,
                            text : sv.text
                        });
                        $(o).attr('data-icon',sv.icon);
                        if({{ $f['id'].'_selectData' }}.indexOf(sv.value) > -1) $(o).attr('selected','selected');
                        $(opt).append($(o));
                    });
                    $('#{{ $f['id'] }}').append($(opt));
                }
                else{
                    var o = $('<option>', { 
                        value: v.value,
                        text : v.text
                    });
                    $(o).attr('data-icon',v.icon);
                    if({{ $f['id'].'_selectData' }}.indexOf(v.value) > -1) $(o).attr('selected','selected');
                    $('#{{ $f['id'] }}').append($(o));
                }
            });
        @endif
        
        $('#{{ $f['id'] }}').selectpicker('render');
        @if(array_key_exists('button_select_all',$f) OR array_key_exists('button_deselect_all',$f))
        $('#{{ $f['id'] }}_select-all-values').on('click', function() {
            $('#{{ $f['id'] }}').selectpicker('selectAll');
        });
        $('#{{ $f['id'] }}_deselect-all-values').on('click', function() {
            $('#{{ $f['id'] }}').selectpicker('deselectAll');
        });
        @endif
    });
</script>