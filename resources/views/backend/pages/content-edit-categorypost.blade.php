@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.content')) )
@section('page_module_url', '' )
@section('page_submodule', ucwords(trans_custom('backend/content.'.$type.'.module_name', $cs['module_name'])) )
@section('page_submodule_url', url(env('BACKEND_ROUTE').'/content/blog/category/listing?content_type='.$type) ) 
@section('page_title', ucwords(trans('backend/core.edit').' '.trans_custom('backend/content.'.$type.'.module_name', $cs['module_name'])) )


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
                filebrowserBrowseUrl: '{{ url('assets/backend') }}' + '/js/plugins/filemanager/dialog.php?type=2&akey=w1n&editor=ckeditor&fldr=',
                filebrowserUploadUrl: '{{ url('assets/backend') }}' + '/js/plugins/filemanager/dialog.php?type=2&akey=w1n&editor=ckeditor&fldr=',
                filebrowserImageBrowseUrl: '{{ url('assets/backend') }}' + '/js/plugins/filemanager/dialog.php?type=1&akey=w1n&editor=ckeditor&fldr=',
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
            {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/content/blog/category/update'), 'files'=>'true', 'id' => 'content_form', 'class' => 'form-validate-jquery form-horizontal', 'method' => 'post']) !!}
            <input type="hidden" name="type" value="{{ $type }}">
            <input id="object_id" type="hidden" name="object_id" value="{{ $id }}">
            <input id="website_id" type="hidden" name="website_id" value="{{ $website}}">
            <input id="author" type="hidden" name="author" value="{{ $object->author }}">
            <input id="modified_by" type="hidden" name="modified_by" value="{{ Auth::user()->id }}">
            <input id="c_template" type="hidden" name="template" value="{{ $object->data['template'] }}">
            <input id="c_publish_status" type="hidden" name="status" value="{{ $object->data['status'] }}">

            <input id="c_publish_time" type="hidden" name="publish_time" value="{{ date('M d, Y H:i',strtotime($object->data['publish_time'])) }}">
            <input id="baseurl" type="hidden" value="{{ url('') }}">
            
            @php
            $default_field_list = [];
            if($website != 0)
            {
                if(count($cs['field_container']) > 0)
                {
                    foreach($cs['field_container'] as $index => $container)
                    {
                        if($container['type'] == 'custom')
                        {
                            if(count($container['field']) > 0)
                            {
                                foreach($container['field'] as $i => $f)
                                {
                                    if(array_key_exists('same_as_default',$f) && $f['same_as_default'] == 'yes')
                                    {
                                        if(!array_key_exists($f['name'],$object_website)) $default_field_list[] = $f['name'];
                                    }
                                }
                            }
                        }
                    }
                }
            }
            @endphp
            <input id="default_field_list" type="hidden" name="default_field_list" value="{{ json_encode($default_field_list) }}">
        
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

            <!-- Configuration scope -->
            @include('backend.layouts.website-scope-url')
            <!-- /configuration scope -->

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
                                    <option class="text-size-small" value="1" {{ ($object->data['status'] == '1') ? 'selected="selected"' : '' }}>{{ ucwords(trans('backend/core.publish')) }}</option>
                                    <option class="text-size-small" value="0" {{ ($object->data['status'] == '0') ? 'selected="selected"' : '' }}>{{ ucwords(trans('backend/core.draft')) }}</option>
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

                    <div class="category-content no-padding" style="min-height: 80px;">
                        <ul class="navigation navigation-alt navigation-accordion">
                            <li>
                                <a class="publish-attribute">
                                    <i class="icon-sort"></i> 
                                    Order&nbsp;&nbsp;:&nbsp;&nbsp;
                                    <input id="content_order_field" type="number" class="form-control"  min="0" value="0" style="width:150px; text-align: left; padding-right: 1px;">
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