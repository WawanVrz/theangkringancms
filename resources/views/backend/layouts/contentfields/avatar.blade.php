<div class="col-sm-{{ $f['width'] }}">
    <div class="form-group">
        <label class="control-label col-sm-12">
            {{ ucwords(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.label', $f['label'])) }} {!! ($f['required'] == 'yes' ) ? '<span class="text-danger">*</span>' : '' !!}
        </label>
        <div class="col-sm-12">
            @if(array_key_exists('placeholder',$f)) 
                <span class="help-block" style="margin-top:0;">
                    {!! ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.placeholder', $f['placeholder'])) !!}
                </span> 
            @endif
            
            <div class="thumb 
                @if(array_key_exists('shape',$f) && $f['shape'] == 'rounded')
                thumb-rounded 
                @endif
                thumb-slide" 
                style="max-width:120px; float:left;">
                <img 
                    style="height: 120px; width: 120px; border: 1px solid #ddd;" 
                    id="{{ $f['id'] }}_previvew_image" 
                    data-default-src="{{ url('assets/backend/images/placeholder.jpg') }}" 
                    src="{{ (isset($object) && $object->data[$f['name']]) ? url('media/content/'.$type.'/'.$object->data[$f['name']]) : url('assets/backend/images/placeholder.jpg') }}">
                <div class="caption">
                    <span>
                        <button id="{{ $f['id'] }}_trigger_button" type="button" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-file-picture"></i></button>
                        <input 
                            type="file"
                            id="{{ $f['id'] }}"  
                            name="{{ $f['name'] }}" 
                            {!! ($f['required'] == 'yes' ) ? 'required="required"' : '' !!} 
                            @if(is_array($f['message_error']) && array_key_exists('required',$f['message_error'])) data-msg="{{ ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.required', $f['message_error']['required'])) }}" @endif
                            accept="image/*"
                            @if(array_key_exists('maxfilesize',$f)) data-max-file-size='{{ $f['maxfilesize'] }}' @endif
                            style="display:none;">
                    </span>
                </div>
            </div>
            <i id="{{ $f['id'] }}_clear_thumbnail" class="icon-cross" style="cursor:pointer; {{ (isset($object) && $object->data[$f['name']]) ? '' : 'display:none;' }}"></i>
            @if(is_array($f['message_error']) && array_key_exists('filesize',$f['message_error']))
                <label id="{{ $f['id'] }}_error_label" class="validation-error-label" style="display:none; width: 100%; float: left;">
                    {!! ucfirst(trans_custom('backend/content.'.$type.'.field_container.'.$index.'.field.'.$i.'.message_error.filesize', $f['message_error']['filesize'])) !!}
                </label>
            @endif
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#{{ $f['id'] }}_trigger_button').on('click', function() {
            $('#{{ $f['id'] }}').click();
        });
        $('#{{ $f['id'] }}').change(function(){
            $('#{{ $f['id'] }}_error_label').hide();
            $('#{{ $f['id'] }}_clear_thumbnail').hide();
            if (this.files && this.files[0]) {
                var fs = this.files[0].size / 1024; // read in KB
                if(fs <= $('#{{ $f['id'] }}').attr('data-max-file-size')){
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#{{ $f['id'] }}_previvew_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    $('#{{ $f['id'] }}_clear_thumbnail').show();
                }
                else{
                    $('#{{ $f['id'] }}_error_label').show();
                    $('#{{ $f['id'] }}').val('');
                    $('#{{ $f['id'] }}_previvew_image').attr('src', $('#{{ $f['id'] }}_previvew_image').attr('data-default-src'));
                }
            }
        });
        $('#{{ $f['id'] }}_clear_thumbnail').on('click', function(){
            $(this).hide();
            $('#{{ $f['id'] }}').val('');
            $('#{{ $f['id'] }}_previvew_image').attr('src', $('#{{ $f['id'] }}_previvew_image').attr('data-default-src'));
        });
    });
</script>