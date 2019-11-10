<div class="col-sm-{{ $f['width'] }}">
<div class="form-group">
    <label class="control-label col-sm-12">
        {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <div class="col-sm-12">
        <div class="form-group has-feedback has-feedback-left">
            <input type="hidden" id="fileinput_text_select" value="{{ ucfirst(trans('backend/core.select')) }}">
            <input type="hidden" id="fileinput_text_remove" value="{{ ucfirst(trans('backend/core.remove')) }}">
            <input type="hidden" id="fileinput_text_upload" value="{{ ucfirst(trans('backend/core.upload')) }}">
            @if($edit == 1)
            <input type="hidden" id="{{ $f['name'].'_delete_file' }}" name="{{ $f['name'].'_delete_file' }}" value="0">
            @endif
            @php
                $afe = $accept = '';
                if(array_key_exists('allowed_extension',$f) && is_array($f['allowed_extension']))
                {
                    if(count($f['allowed_extension']) > 0)
                    {
                        $afe = '[';
                        foreach($f['allowed_extension'] as $fa)
                        {
                            $accept .= '.'.$fa.',';
                            $afe .= '"'.$fa.'",';
                        }
                        $afe = rtrim($afe,',');
                        $accept = rtrim($accept,',');
                        $afe .= ']';
                    }
                }
                if(array_key_exists('allowed_type',$f) && is_array($f['allowed_type']))
                {
                    if(count($f['allowed_type']) > 0)
                    {
                        foreach($f['allowed_type'] as $fa) $accept .= $fa.'/*,';
                        $accept = rtrim($accept,',');
                    }
                }
            @endphp
            <input
                type="file" 
                class="form-control file-input-single {{ ($edit == 1) ? 'old-value' : '' }}"
                data-show-upload="false"
                @if($accept != '') accept="{{ $accept }}" @endif
                id="{{ $f['id'] }}"  
                name="{{ $f['name'] }}" 
                data-container="{{ $container['tab'] }}"
                {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif
                @if(array_key_exists('placeholder',$f)) placeholder="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) }}" @endif
                @if($afe != '') data-allowed-file-extensions='{!! $afe !!}' @endif
                @if(array_key_exists('maxfilesize',$f)) data-max-file-size='{{ $f['maxfilesize'] }}' @endif
                @if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes' && $website != 0 && !array_key_exists($f['name'],$object_website)) disabled="disabled" @endif
                >
            @if(array_key_exists('placeholder',$f))<span class="help-block">{!! ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) !!}</span> @endif
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
</div>
<script type="text/javascript">
@php
    if(isset($object) && array_key_exists($f['name'],$object->data))
    {
        if($object->data[$f['name']] != '') $data_file_preview = url('media/content/'.$type.'/'.$object->data[$f['name']]);
        else $data_file_preview = '';
    }
    else $data_file_preview = '';
@endphp
$(document).ready(function(){
    $('#{{ $f['id'] }}').fileinput({
        autoReplace: true,
        maxFileCount: 1,
        browseLabel: $('#fileinput_text_select').val(),
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: $('#fileinput_text_remove').val(),
        uploadLabel: $('#fileinput_text_upload').val(),
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-file-plus"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        @if($data_file_preview != '')
        initialPreview: ["<img src='{{ $data_file_preview }}' class='file-preview-image'>"],
        @endif
        initialCaption: "{{ ($data_file_preview == '') ? ucfirst(trans('backend/core.no_file_selected')) : $object->data[$f['name']] }}"
    });

    // $('#{{ $f['id'] }}').on('filecleared', function(event) {
    //     $('#{{ $f['id'].'_delete_file' }}').val('1');
    // });

    $('#{{ $f['id'] }}').on('filecleared', function(event) {
        if($(this).hasClass('old-value')){
            $(this).fileinput('refresh');
        }
        else{
            $('#{{ $f['id'].'_delete_file' }}').val('1');
        }
    });

    $('#{{ $f['id'] }}').on('fileclear', function(event) {
        if($(this).hasClass('old-value')){
            $(this).removeClass('old-value');
        }
    });

    $('#{{ $f['id'] }}').on('fileselect', function(event, numFiles, label) {
        $(this).parents('.file-input').find('.file-caption-name').html(label);
        @if($edit == 1)
        $('#{{ $f['id'].'_delete_file' }}').val('1');
        @endif
    });
    
    @if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes' && $website != 0 && !array_key_exists($f['name'],$object_website))
        $('#{{ $f['id'] }}').fileinput('disable');
    @endif
});
</script>