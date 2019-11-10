@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.content')) )
@section('page_module_url', '' )
@section('page_submodule', ucwords(trans_custom('backend/content.'.$type.'.module_name', $cs['module_name'])) )
@section('page_submodule_url', url(env('BACKEND_ROUTE').'/content/listing?content_type='.$type) ) 
@section('page_title', ucwords(trans('backend/core.create').' '.trans_custom('backend/content.'.$type.'.module_name', $cs['module_name'])) )


@push('styles')
@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/inputs/passy.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/uploaders/fileinput.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/pickers/anytime.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/styling/switch.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/editors/ckeditor_full/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/validation/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/validation/additional_methods.js') }}"></script>
@endpush


@push('scripts_footer')
<script type="text/javascript" src="{{ url('assets/backend/js/content-crud.js') }}"></script>
<script type="text/javascript">
    
    // Editor
    $(function(){
        $('.editor').each(function(){
            CKEDITOR.replace( this.id, {
                height: '320px',
                toolbar: [
                    { name: 'document', items: [ 'Source'] },   
                    { name: 'tools', items: [ 'Maximize' ] },   
                    { name: 'editing', items: [ 'Scayt' ] },
                    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },   
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },   
                    { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe' ] },                                             
                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','CreateDiv' ] },
                    '/',
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                    { name: 'styles', items: [ 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor' ] }
                ],
                skin: 'bootstrapck',
                extraPlugins: 'codemirror',
                codemirror:{
                    theme: 'material',
                },
                filebrowserBrowseUrl: '{{ url('assets/backend') }}' + '/js/plugins/filemanager/dialog.php?type=0&view=0&akey=w1n&editor=ckeditor&fldr=',
                filebrowserUploadUrl: '{{ url('assets/backend') }}' + '/js/plugins/filemanager/dialog.php?type=0&view=0&akey=w1n&editor=ckeditor&fldr=',
                filebrowserImageBrowseUrl: '{{ url('assets/backend') }}' + '/js/plugins/filemanager/dialog.php?type=0&view=0&akey=w1n&editor=ckeditor&fldr=',
            });
        });
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
<div class="has-detached-right">

    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">

            <!-- Info alert -->
            <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                <h6 class="alert-heading text-semibold">
                    {{ ucwords(trans_custom('backend/content.'.$type.'.module_name', $cs['module_name'])) }}
                </h6>
                {{ trans_custom('backend/content.'.$type.'.instruction', $cs['instruction']) }}
                <br><br>
                <span style="color:red; ">NB : For Featured Image Upload, We Suggestion To Upload Image With 2000 x 1125 Pixel Dimension.</span>
            </div>
            <!-- /Info alert -->

            <!-- Data error -->
            @if($errors->any())
                <div class="alert alert-warning alert-styled-left">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <!-- /Data error -->

            <!-- Submit Message -->
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    {{ Session::get('flash_message_success') }}
                </div>
            @endif
            @if(Session::has('flash_message_warning'))
                <div class="alert alert-warning alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    {{ Session::get('flash_message_warning') }}
                </div>
            @endif
            @if(Session::has('flash_message_danger'))
                <div class="alert alert-danger alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    {{ Session::get('flash_message_danger') }}
                </div>
            @endif
            <!-- /Submit Message -->

            <!-- Sidebars overview -->
            {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/content/store?content_type='.$type), 'id' => 'content_form', 'class' => 'form-validate-jquery form-horizontal', 'method' => 'post']) !!}
            <input type="hidden" name="type" value="{{ $type }}">
            <input id="c_publish_time" type="hidden" name="publish_time" value="0">
            <input id="c_publish_status" type="hidden" name="status" value="1">
            <input id="c_template" type="hidden" name="template" value="page-default">
            <input id="c_order" type="hidden" name="order" value="0">
            <input id="website_id" type="hidden" name="website_id" value="0">
            <input id="baseurl" type="hidden" value="{{ url('') }}">

            @if(count($cs['field_container']) > 0)
                @foreach($cs['field_container'] as $index => $container)
                    @php $container_display = ($container['default_display'] == 'show') ? true : false; @endphp
                    @if($container['type'] == 'custom')
                        <div class="panel panel-flat {{ (!$container_display) ? 'panel-collapsed' : '' }}">
                            <div class="panel-heading">
                                <h6 class="panel-title text-bold text-uppercase" style="font-size: 12px;">
                                    {{ trans_custom('backend/content.'.$type.'.field_container.'.$index.'.label', $container['label']) }}
                                </h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"  {!! (!$container_display) ? 'class="rotate-180"' : '' !!}></a></li>
                                    </ul>
                                </div>
                                <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                            </div>
                            <div class="panel-body">
                                @if(count($container['field']) > 0)
                                    @foreach($container['field'] as $i => $f)
                                        @include('backend.layouts.contentfields.'.$f['type'])
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @else @include('backend.layouts.contentcontainers.'.$container['type'])
                    @endif
                @endforeach
            @endif
            
            <div id="iframe_modal" class="iframe-modal modal fade" data-trigger="">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header bg-slate-800" style="background-color: #31373D;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title">&nbsp;</h6>
                        </div>
                        <div class="modal-body">
                            <iframe></iframe>
                        </div>
                    </div>
                </div>
            </div>
            
            {!! Form::close() !!}
            <!-- /sidebars overview -->

        </div>
    </div>

    <!-- Detached sidebar -->
    <div class="page-crud-sidebar sidebar-detached">
        <div class="sidebar sidebar-default sidebar-separate">
            <div class="sidebar-content">

                <!-- Sidebar publish -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>{{ trans('backend/core.publish') }}</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content no-padding">
                        <ul class="navigation navigation-alt navigation-accordion">
                            <li>
                                <a class="publish-attribute">
                                    <i class="icon-info22"></i> 
                                    {{ ucwords(trans('backend/core.status')) }}&nbsp;&nbsp;:&nbsp;&nbsp;
                                    <select id="publish_status" class="bootstrap-select" data-width="144px" style="display:none;">
                                        <option class="text-size-small" value="1" selected="selected">{{ ucwords(trans('backend/core.publish')) }}</option>
                                        <option class="text-size-small" value="0">{{ ucwords(trans('backend/core.draft')) }}</option>
                                    </select>
                                </a>
                            </li>
                            <li>
                                <a class="publish-attribute">
                                    <i class="icon-calendar2"></i> 
                                    {{ ucwords(trans('backend/core.publish')) }}&nbsp;&nbsp;:&nbsp;&nbsp;
                                    <span id="content_publish_time" data-text="{{ ucwords(trans('backend/core.immediately')) }}" data-val="0">{{ ucwords(trans('backend/core.immediately')) }}</span>
                                </a>
                                <div id="content_publish_time_container" style="display:none;">
                                    <div class="radio">
                                        <label>
                                            <input id="radio_publish_default" type="radio" name="stacked-radio-left" class="styled publish-default" checked="checked">
                                            {{ ucwords(trans('backend/core.immediately')) }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input id="radio_publish_date" type="radio" name="stacked-radio-left" class="styled">
                                            {{ ucwords(trans('backend/core.set_date_time')) }}
                                            <div class="input-group date-time-container" style="display:none;">
                                                <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                                <input type="text" class="form-control" id="publish_time_picker">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="publish-time-action">
                                        <span class="publish-time-action-button button-ok">{{ ucwords(trans('backend/core.ok')) }}</span>
                                        <span class="publish-time-action-button button-cancel">{{ ucwords(trans('backend/core.cancel')) }}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="navigation-divider"></li>
                            <li>
                                <div class="sidebar-action-container">
                                    <button id="button_cancel" type="button" class="btn btn-default" data-action="{{ $action['cancel'] }}">
                                        {{ ucwords(trans('backend/core.cancel')) }}
                                    </button>
                                    <button id="button_save" type="button" class="btn btn-primary">
                                        {{ ucwords(trans('backend/core.save')) }} 
                                        <i class="icon-check position-right"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar publish -->

                <!-- Sidebar content attribute -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>{{ trans('backend/core.content_attributes') }}</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content no-padding">
                        <ul class="navigation navigation-alt navigation-accordion">
                            <li>
                                <a>
                                    <label>{{ ucwords(trans('backend/core.content_template')) }}</label>
                                    <?php
                                        function get_string_between($string, $start, $end){
                                            $string = ' ' . $string;
                                            $ini = strpos($string, $start);
                                            if ($ini == 0) return '';
                                            $ini += strlen($start);
                                            $len = strpos($string, $end, $ini) - $ini;
                                            return substr($string, $ini, $len);
                                        }

                                        $template_files = Storage::disk('views')->files('frontend/templates');
                                        $page_templates = array(); $i = 0;
                                        foreach($template_files as $tf)
                                        {
                                            $filename = basename($tf,'.blade.php');
                                            if(strstr($filename,$type.'-'))
                                            {
                                                $content = Storage::disk('views')->get($tf);
                                                $parsed = trim(get_string_between($content, '/*', '*/'));
                                                $parsed = explode('Template Name:', $parsed);
                                                if(count($parsed) > 1)
                                                {
                                                    $page_template_name = trim(end($parsed));
                                                    if($page_template_name != NULL && $page_template_name != '')
                                                    {
                                                        $page_templates[$i]['code'] = $filename;
                                                        $page_templates[$i]['name'] = $page_template_name;
                                                        $i++;
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                    <select id="content_template_selector" class="bootstrap-select" data-width="100%" style="display:none;">
                                        @foreach($page_templates as $k => $pt)
                                        <option class="text-size-small" value="{{ $pt['code'] }}" {{ ($k == 0) ? 'selected="selected"' : '' }}>{{ ucwords($pt['name']) }}</option>
                                        @endforeach
                                    </select>
                                </a>
                            </li>
                            <li>
                                <a>
                                    {{ ucwords(trans('backend/core.order')) }}
                                    <input id="content_order_field" type="number" class="form-control"  min="0" value="0" style="width:65px; text-align: center; padding-right: 1px;">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar content attribute -->

            </div>
        </div>
    </div>
    <!-- /detached sidebar -->

</div>
<!-- /content area -->
@endif

@endsection