@extends('backend.layouts.'.config('sys_data.setting.adminpanel_layout').'.main')

@section('page_module', ucwords(trans('backend/module/'.session('sys_module.id').'.'.session('sys_module.label'))) )
@section('page_module_url', url(env('BACKEND_ROUTE').'/'.session('sys_module.baseurl')) )
@section('page_submodule', ucwords('sub module title') )
@section('page_submodule_url', url(env('BACKEND_ROUTE').'/'.session('sys_module.baseurl').'/submodule')) 
@section('page_title', ucwords('Form on Create') )


@push('styles')

@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/tags/tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/inputs/maxlength.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/inputs/passy.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/validation/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/validation/additional_methods.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/editors/ckeditor_full/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/pickers/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/uploaders/fileinput.min.js') }}"></script>
@endpush


@push('scripts_footer')
<script type="text/javascript">
    
    // Form Validation
    var validator = $(".form-validate-jquery").validate({
        ignore: 'input[type=hidden], .select2-input', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function(error, element) {

            element.removeClass('validation-valid');
            element.addClass('has-error');

            // password generator
            if(element.parent().parent().hasClass('label-indicator-absolute')){
                error.appendTo( element.parent().parent().parent() );
            }
            // Styled checkboxes, radios, bootstrap switch
            else if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }
            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }
            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }
            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }
            else {
                error.insertAfter(element);
            }
        },
        success: function(label, element) {
            label.remove();
            $(element).removeClass('has-error');
            $(element).addClass('validation-valid');
        },
        rules: {
            text1: {
                required: true
            },
            text2: {
                required: true,
                minlength: 5
            },
            text3: {
                required: true,
                maxlength: 7
            },
            text_digit: {
                required: true,
                digits: true
            },
            text_number: {
                required: true,
                number: true
            },
            text_username: {
                required: true,
                minlength: 4,
                alphanumeric: true
            },
            text_password: {
                required: true,
                password: true
            },
            text_password_repeat: {
                required: true,
                equalTo: '#password'
            },
            text_password_strong: {
                required: true,
                password_strong: true
            },
            text_email: {
                required: true,
                email: true
            },
            text_url: {
                required: true,
                url: true
            },
            text_slug: {
                required: true,
                slug: true
            },
            text_slug_auto: {
                required: true,
                slug: true
            }
        },
        messages: {
            text1: {
                required: "Text 1 Required"
            },
            text2: {
                required: "Text 2 Required",
                minlength: "Min 5 characters"
            },
            text3: {
                required: "Text 3 Required",
                maxlength: "Max 7 characters"
            },
            text_digit: {
                digits: "Please enter only digits"
            },
            text_number: {
                number: "Please enter a valid number"
            },
            text_username: {
                required: "Username required",
                minlength: "Username must be at least 4 characters",
                alphanumeric: "Letters, numbers, and underscores only are allowed"
            },
            text_password: {
                required: "Password required",
                password: "Password must be at least 6 characters and contain letter and numeric (A-Z,0-9)"
            },
            text_password_strong: {
                required: "Password required",
                password_strong: "Password must be at least 6 characters and contain letter, numeric, & symbol (A-Z,0-9,!#$&()*+<=>@[]^)"
            },
            text_password_repeat: {
                required: "Please confirm your password",
                equalTo: "Password doesn't match"
            },
            text_email: {
                required: "Email required",
                email: "Please enter a valid email address"
            },
            text_url: {
                url: "Please enter a valid email URL. Don't forget to use http:// or https://"
            },
            text_slug: {
                slug: "Please use valid slug characters: a-z, 0-9, /, or -"
            },
            text_slug_auto: {
                slug: "Please use valid slug characters: a-z, 0-9, /, or -"
            },
        }
    });

    // Passy - password generator
    // ------------------------------

    // Input labels &  Output labels
    var $inputLabelAbsolute = $('.label-indicator-absolute input');
    var $outputLabelAbsolute = $('.label-indicator-absolute > span');
    
    // Min input length
    $.passy.requirements.length.min = 6;

    // Strength meter
    var feedback = [
        {color: '#D55757', text: 'Weak', textColor: '#fff'},
        {color: '#EB7F5E', text: 'Normal', textColor: '#fff'},
        {color: '#3BA4CE', text: 'Good', textColor: '#fff'},
        {color: '#40B381', text: 'Strong', textColor: '#fff'}
    ];
    
    // Setup strength meter
    $inputLabelAbsolute.passy(function(strength) {
        $outputLabelAbsolute.text(feedback[strength].text);
        $outputLabelAbsolute.css('background-color', feedback[strength].color).css('color', feedback[strength].textColor);
    });

    // Absolute label
    $('.generate-label-absolute').click(function() {
        $inputLabelAbsolute.passy( 'generate', 10 );
    });

    // Show or hide password
    $('.show-hide-password').click(function() {
        var target = $(this).attr('data-target');
        if($(target).attr('type') == 'text'){
            $(target).attr('type','password');
            $(this).find('i').removeClass('icon-eye2');
            $(this).find('i').addClass('icon-eye-blocked2');
        }
        else{
            $(target).attr('type','text');
            $(this).find('i').removeClass('icon-eye-blocked2');
            $(this).find('i').addClass('icon-eye2');
        }
    });


    // Slug
    function slugify(element){
        var text = $(element).val();
        var target = $(element).attr('data-target');
        var slug = text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
        $(target).val(slug);
    }


    // Max Length
    $('.maxlength-textarea').maxlength({
        alwaysShow: true
    });


    // Tags input
    $('.tags-input').tagsinput();


    // Editor
    CKEDITOR.replace( 'editor', {
        height: '400px',
        toolbar: [
            { name: 'document', items: [ 'Source'] },	
            { name: 'tools', items: [ 'Maximize' ] },	
            { name: 'editing', items: [ 'Scayt' ] },	
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },	
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },	 											
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'styles', items: [ 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor' ] }
        ],
        skin: 'bootstrapck',
        extraPlugins: 'codemirror',
        codemirror:{
            theme: 'material',
        },
        filebrowserBrowseUrl: '{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout')) }}' + '/js/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl: '{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout')) }}' + '/js/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl: '{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout')) }}' + '/js/plugins/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
    });
    
    
    // Date Picker
    $('.daterange-single').daterangepicker({ 
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'dddd MMMM D, YYYY'
        }
    });

    // File Upload Single
    $('.file-input-single').fileinput({
        browseLabel: 'Select',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: 'Remove',
        uploadLabel: 'Upload',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected"
    });

    $('.file-input-custom').fileinput({
        previewFileType: 'image',
        browseLabel: 'Select',
        browseClass: 'btn bg-slate-700',
        browseIcon: '<i class="icon-image2 position-left"></i> ',
        removeLabel: 'Remove',
        removeClass: 'btn btn-danger',
        removeIcon: '<i class="icon-cancel-square position-left"></i> ',
        uploadClass: 'btn bg-teal-400',
        uploadIcon: '<i class="icon-file-upload position-left"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected"
    });



</script>
@endpush


@section('content')

@if(Session::has('sys_error_code') && Session::get('sys_error_code') == '401')
<div class="alert alert-{{ Session::get('sys_error_type') }}" style="padding:5px; text-align:center;">
    {{ Session::get('sys_error_message') }}
</div>
@else
<!-- Content area -->
<div class="content">
    <!-- Basic datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Create New Data</h5>
        </div>
        
        <div class="panel-body">
            @if($errors->any())
                <div class="alert alert-warning alert-styled-left">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if(Session::has('sys_error_code'))
                <div class="alert alert-{{ Session::get('sys_error_type') }} alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    {{ Session::get('sys_error_message') }}
                </div>
            @endif
            {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/zz/store'), 'class' => 'form-horizontal form-validate-jquery', 'method' => 'post']) !!}
                
                <fieldset class="content-group">
                    <legend class="text-bold">Text Type</legend>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Text 1 <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text1" required="required" placeholder="Text Required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Text 2 <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text2" required="required" placeholder="Text Required & Min 5 chars">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Text 3 <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text3" required="required" placeholder="Text Required & Max 7 chars">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Digit only<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text_digit" required="required" placeholder="Enter digits only">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Number only <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text_number" required="required" placeholder="Enter decimal number only">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Username <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text_username" required="required" placeholder="Use unique username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Password Standard<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input id="password" type="password" class="form-control" name="text_password" required="required" placeholder="Password must be at least 6 characters and contain letter and numeric (A-Z,0-9)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Repeat Password <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input id="password_repeat" type="password" class="form-control" name="text_password_repeat" required="required" placeholder="Confirm your password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Auto Generated Password <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <div class="label-indicator-absolute">
                                    <div class="input-group">
                                        <span data-target="#password_strong" class="input-group-addon show-hide-password" style="cursor:pointer;"><i class="icon-eye2"></i></span>
                                        <input id="password_strong" type="text" class="form-control" name="text_password_strong" placeholder="Enter your password">
                                    </div>
                                    <span class="label password-indicator-label-absolute" style="z-index:2;"></span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-info generate-label-absolute">Generate 10 characters password</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Email <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" name="text_email" required="required" placeholder="info@example.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">URL <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="url" class="form-control" name="text_url" required="required" placeholder="http://www.google.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Slug <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text_slug" required="required" placeholder="URL Slug">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Title with slug <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="text_title" required="required" placeholder="Post title" onkeyup="slugify(this)" data-target="#slug_auto">
                            <br>
                            <input id="slug_auto" type="text" class="form-control" name="text_slug_auto" required="required" placeholder="Post slug">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Max Length</label>
                        <div class="col-lg-10">
                            <textarea rows="3" cols="3" maxlength="170" class="form-control maxlength-textarea" placeholder="This textarea has a limit of 170 chars."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Tags</label>
                        <div class="col-lg-10">
                            <input type="text" required="required" class="form-control tags-input" name="tag" value="These,are,tokens">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Editor</label>
                        <div class="col-lg-10">
                            <textarea  id="editor" name="editor" rows="4" cols="4"></textarea>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="content-group">
                    <legend class="text-bold">Picker</legend>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Date <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" class="form-control daterange-single" value="" name="date_single" readonly="readonly">
                                <div class="form-control-feedback">
                                    <i class="icon-calendar2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="content-group">
                    <legend class="text-bold">File Upload</legend>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Single File Upload</label>
                        <div class="col-lg-10">
                            <input type="file" class="file-input-single" name="file_single">
							<span class="help-block">Automatically convert a file input to a bootstrap file input widget by setting its class as <code>file-input</code>.</span>
                        </div>
                    </div>
                </fieldset>
                <div class="pull-left">
                    <!--<button type="button" class="btn btn-success content-box-add"><i class="icon-add position-left"></i> Add Box</button>-->
                </div>
                <div class="pull-right">
                    <a href="{{ url(env('BACKEND_ROUTE').'/'.session('sys_module.baseurl')) }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save <i class="icon-check position-right"></i></button>
                </div>
            {!! Form::close() !!}
        </div>
        
    </div>
    <!-- /basic datatable -->

</div>
<!-- /content area -->
@endif

@endsection