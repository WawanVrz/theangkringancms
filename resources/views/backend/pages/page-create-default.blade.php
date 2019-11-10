@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.pages')) )
@section('page_module_url', url(env('BACKEND_ROUTE').'/pages') )
@section('page_submodule', ucwords(trans('backend/core.create_page')) )
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.default_page')) )


@push('styles')
@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/pickers/anytime.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/editors/ckeditor_full/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/validation/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/validation/additional_methods.js') }}"></script>
@endpush


@push('scripts_footer')
<script type="text/javascript" src="{{ url('assets/backend/js/page-crud.js') }}"></script>
<script type="text/javascript">
    
    // Editor
    CKEDITOR.replace( 'editor', {
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
                <h6 class="alert-heading text-semibold">{{ ucwords(trans('backend/core.create_new_default_page')) }}</h6>
                {{ trans('backend/core.create_new_default_page_description') }}
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
            {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/pages/store'), 'id' => 'page_form', 'class' => 'form-validate-jquery form-horizontal', 'method' => 'post']) !!}
            <input type="hidden" name="type" value="page-default">
            <input id="page_publish_time" type="hidden" name="publish_time" value="0">
            <input id="page_publish_status" type="hidden" name="status" value="1">
            <input id="page_template" type="hidden" name="template" value="page-default">
            <input id="page_order" type="hidden" name="order" value="0">
            <input id="website_id" type="hidden" name="website_id" value="0">
            <input id="baseurl" type="hidden" value="{{ url('') }}">

            <div class="panel panel-flat">
                <div class="panel-body">
                    <legend class="text-bold">{{ trans('backend/core.general') }}</legend>
                    <div class="form-group">
                        <label class="control-label col-lg-12">{{ ucwords(trans('backend/core.title')) }} <span class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <input 
                                type="text" 
                                class="title form-control" 
                                name="title" 
                                required="required" 
                                data-error-message="{{ ucfirst(trans('backend/core.title_required')) }}"
                                placeholder="{{ ucfirst(trans('backend/core.enter_page_title')) }}"
                                value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-12">{{ ucwords(trans('backend/core.short_description')) }}</label>
                        <div class="col-lg-12">
                            <textarea 
                                id="excerpt" 
                                class="form-control" 
                                name="excerpt" 
                                rows="2" 
                                cols="4"
                                placeholder="{{ ucfirst(trans('backend/core.content_short_description')) }}">{{ old('excerpt') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-12">{{ ucwords(trans('backend/core.content')) }}</label>
                        <div class="col-lg-12">
                            <textarea id="editor" name="content" rows="4" cols="4">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title text-bold text-uppercase" style="font-size: 12px;">{{ trans('backend/core.media') }}</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                    <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-top">
                            <li class="active"><a href="#tab_featured_image" data-toggle="tab">{{ ucwords(trans('backend/core.featured_image')) }}</a></li>
                            <li><a href="#tab_images_gallery" data-toggle="tab">{{ ucwords(trans('backend/core.images_gallery')) }}</a></li>
                            <li><a href="#tab_featured_video" data-toggle="tab">{{ ucwords(trans('backend/core.featured_video')) }}</a></li>
                        </ul>
                        <div class="tab-content page-media-container">
                            <div class="tab-pane active" id="tab_featured_image">
                                <div class="featured-image-container">
                                    <div class="featured-image-thumb-container">
                                        <i class="icon-cross featured-image-delete" title="{{ ucfirst(trans('backend/core.delete_featured_image')) }}"></i>
                                        <img id="featured_image_thumb">
                                    </div>
                                    <i class="icon-image2 featured-image-icon"></i>
                                    <div class="featured-image-meta-container">
                                        <input id="featured_image_field" name="featured_image" type="hidden">
                                        <label>{{ ucwords(trans('backend/core.image_title')) }}</label>
                                        <input 
                                            id="featured_image_title" 
                                            class="form-control featured-image-meta"
                                            name="featured_image_title" 
                                            type="text" 
                                            style="margin-bottom: 10px;">
                                        <label>{{ ucwords(trans('backend/core.alt_text')) }}</label>
                                        <input 
                                            id="featured_image_alt_text" 
                                            class="form-control featured-image-meta"
                                            name="featured_image_alt_text" 
                                            type="text" 
                                            style="margin-bottom: 10px;">
                                    </div>
                                </div>
                                <div 
                                    id="feature-image-trigger"
                                    class="featured-image-title filemanager-trigger" 
                                    data-toggle="modal" 
                                    data-target="#iframe_modal" 
                                    data-filemanager="{{ url('assets/backend/js/plugins/filemanager/dialog.php?type=1&langCode=en&akey=w1n&sort_by=date&descending=1&field_id=featured_image_field&multiSelect=0&fldr=') }}">
                                        {{ ucwords(trans('backend/core.set_featured_image')) }}
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_images_gallery">
                                <div class="images-gallery-container">
                                    <div class="images-gallery-field">
                                        <div class="images-gallery-field-header">
                                            <button 
                                                id="images-gallery-trigger"
                                                type="button" 
                                                class="btn bg-teal-400 filemanager-trigger"
                                                data-toggle="modal" 
                                                data-target="#iframe_modal" 
                                                data-filemanager="{{ url('assets/backend/js/plugins/filemanager/dialog.php?type=1&langCode=en&view=0&akey=w1n&sort_by=date&descending=1&field_id=images_gallery_field_temp&multiSelect=1&fldr=') }}">
                                                    <i class="icon-plus22"></i>
                                                    {{ ucwords(trans('backend/core.add_image')) }}
                                            </button>
                                            <input id="images_gallery_field_temp" name="images_gallery" type="hidden">
                                        </div>
                                        <div 
                                            class="images-gallery-field-body"
                                            data-moveup="{{ ucwords(trans('backend/core.move_up')) }}"
                                            data-movedown="{{ ucwords(trans('backend/core.move_down')) }}"
                                            data-delete-image="{{ ucwords(trans('backend/core.delete_image')) }}"
                                            data-delete-image-message="{{ ucfirst(trans('backend/core.delete_image_gallery_message')) }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="images-gallery-meta">
                                        <div class="images-gallery-meta-title">{{ trans('backend/core.image_details') }}</div>
                                        <div class="images-gallery-meta-body">
                                            <div class="images-gallery-meta-images">
                                                <img>
                                            </div>
                                            <div class="images-gallery-info">
                                                <div><b>{{ ucfirst(trans('backend/core.file_name')) }}:</b> <span class="filename"></span></div>
                                                <div><b>{{ ucfirst(trans('backend/core.upload_on')) }}:</b> <span class="uploaddate"></span></div>
                                                <div><b>{{ ucfirst(trans('backend/core.file_size')) }}:</b> <span class="filesize"></span></div>
                                                <div><b>{{ ucfirst(trans('backend/core.dimension')) }}:</b> <span class="dimension"></span></div>
                                            </div>
                                            <div class="images-gallery-meta-data">
                                                <label>{{ ucwords(trans('backend/core.image_title')) }}</label>
                                                <input
                                                    class="form-control images-gallery-meta-input title"
                                                    type="text" 
                                                    style="margin-bottom: 10px;">
                                                <label>{{ ucwords(trans('backend/core.alt_text')) }}</label>
                                                <input 
                                                    class="form-control images-gallery-meta-input alt"
                                                    type="text" 
                                                    style="margin-bottom: 10px;">
                                                <label>{{ ucwords(trans('backend/core.label')) }}</label>
                                                <input 
                                                    class="form-control images-gallery-meta-input text-label"
                                                    type="text" 
                                                    style="margin-bottom: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_featured_video">
                                <div class="featured-video-container">
                                    <input type="hidden" id="featured_video_used" name="featured_video_used" value="external">
                                    <div class="featured-video-button">
                                        <ul class="breadcrumb-elements" style="margin-right: 0;">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="padding: 8px 0;">
                                                    <i class="icon-file-video position-left"></i>
                                                    {{ ucwords(trans('backend/core.video_source')) }}
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#" class="featured-video-selector select-external-video">{{ ucfirst(trans('backend/core.use_external_video')) }}</a></li>
                                                    <li><a href="#" class="featured-video-selector select-internal-video">{{ ucfirst(trans('backend/core.choose_video')) }}</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="featured-video-body">
                                        <div class="external-video-field">
                                            <div class="input-group">
                                                <input 
                                                    id="featured_video_external_link" 
                                                    class="form-control"
                                                    name="featured_video_external" 
                                                    type="text" 
                                                    placeholder="{{ ucfirst(trans('backend/core.external_video_link')) }}">
                                                <span class="input-group-btn">
                                                    <button id="preview_external_video" type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right">
                                                        <b><i class="icon-circle-right2"></i></b> {{ ucfirst(trans('backend/core.preview')) }}
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="featured-video-thumb">
                                                <div class="thumbnail">
                                                    <div class="video-container">
                                                        <iframe 
                                                            allowfullscreen="" 
                                                            frameborder="0" 
                                                            mozallowfullscreen="" 
                                                            webkitallowfullscreen=""
                                                            src="">
                                                        </iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="internal-video-field input-group">
                                            <button 
                                                id="feature-video-trigger"
                                                type="button" 
                                                class="btn bg-teal-400 filemanager-trigger"
                                                data-toggle="modal" 
                                                data-target="#iframe_modal" 
                                                data-filemanager="{{ url('assets/backend/js/plugins/filemanager/dialog.php?type=3&langCode=en&akey=w1n&sort_by=date&descending=1&field_id=featured_video_internal&multiSelect=0&fldr=') }}">
                                                    {{ ucfirst(trans('backend/core.choose_video')) }}
                                            </button>
                                            <input type="hidden" name="featured_video_internal"  id="featured_video_internal">
                                            <div class="featured-video-thumb">
                                                <div><b>{{ ucfirst(trans('backend/core.file_name')) }}:</b> <span class="internal-video-filename"> - </span></div>
                                                <div class="thumbnail">
                                                    <div class="video-container" data-message="{{ ucfirst(trans('backend/core.browser_not_support_video')) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-flat panel-collapsed">
                <div class="panel-heading">
                    <h6 class="panel-title text-bold text-uppercase" style="font-size: 12px;">{{ trans('backend/core.search_engine_optimization') }}</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse" class="rotate-180"></a></li>
                        </ul>
                    </div>
                    <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                </div>
                <div class="panel-body">
                    <div class="seo-container">
                        <ul class="media-list content-group seo-container-content-group">
                            <li class="media date-step content-divider">
                                <span><i class="icon-clippy"></i>&nbsp;&nbsp;{{ ucwords(trans('backend/core.keywords')) }}</span>
                            </li>
                            <li class="seo-field">
                                <div>{{ ucfirst(trans('backend/core.snippet_preview')) }}</div>
                                <div class="panel panel-body">
                                    <div class="media-left">
                                        <i class="icon-google text-primary icon-2x no-edge-top mt-5"></i>
                                    </div>
                                    <div class="media-body">
                                        @php
                                            $site_title = (config('sys.setting.website_title') != null) ? config('sys.setting.website_title') : env('WEBSITE_TITLE');
                                        @endphp
                                        <h6 
                                            class="snippet-meta-title media-heading text-semibold"
                                            data-site-title="{{ ucwords($site_title) }}">
                                            {{ ucwords($site_title) }}
                                        </h6>
                                        <h6 
                                            class="snippet-slug"
                                            data-baseurl="{{ url('') }}">
                                            <span>{{ url('') }}</span><i class="icon-arrow-down5"></i>
                                        </h6>
                                        <div 
                                            class="snippet-meta-desc"
                                            data-message="{{ ucfirst(trans('backend/core.provide_meta_description')) }}">
                                            {{ ucfirst(trans('backend/core.provide_meta_description')) }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label>{{ ucwords(trans('backend/core.meta_title')) }}</label>
                                    <input
                                        class="form-control seo-field-meta-title"
                                        type="text"
                                        name="meta_title"
                                        placeholder="{{ ucwords(trans('backend/core.seo_title')) }}" 
                                        style="margin-bottom: 10px;">
                                    <label>{{ ucwords(trans('backend/core.slug')) }}</label>
                                    <input
                                        class="form-control seo-field-slug"
                                        type="text" 
                                        name="slug"
                                        placeholder="{{ ucwords(trans('backend/core.url_slug')) }}" 
                                        style="margin-bottom: 10px;">
                                    <label>{{ ucwords(trans('backend/core.meta_description')) }}</label>
                                    <textarea 
                                        class="form-control seo-field-meta-desc" 
                                        name="meta_description"
                                        rows="3" 
                                        cols="3"
                                        threshold="135" 
                                        maxlength="160" 
                                        warning-color="#ee7c1b"
                                        fine-color="#7ad03a"
                                        placeholder="{{ ucfirst(trans('backend/core.modify_meta_description')) }}"
                                        style="margin-bottom: 10px;"></textarea>
                                    <div class="seo-field-meta-desc-indicator progress progress-xxs"><div></div></div>
                                    <label>{{ ucwords(trans('backend/core.meta_keywords')) }}</label>
                                    <input
                                        class="form-control tags-input"
                                        type="text" 
                                        name="meta_keywords"
                                        style="margin-bottom: 10px;">
                                </div>
                                <br>
                                <br>
                            </li>
                            <li class="media date-step content-divider">
                                <span class="seo-advanced-field"><i class="icon-cog"></i>&nbsp;&nbsp;{{ ucwords(trans('backend/core.advanced')) }}</span>
                            </li>
                            <li class="seo-field seo-advanced-field-data">
                                <label>{{ ucfirst(trans('backend/core.canonical_url')) }}</label>
                                <input
                                        class="form-control canonical_url"
                                        type="text" 
                                        name="canonical_url"
                                        placeholder="{{ trans('backend/core.example_about_us') }}"
                                        data-error-message="Please use valid slug characters: a-z, 0-9, /, or -">
                                <label style="margin-top: 20px;">{{ ucfirst(trans('backend/core.meta_robots_index')) }}</label>
                                <div class="form-group" style="margin-left:0; margin-bottom:5px;">
                                    <select name="meta_robots_index" class="bootstrap-select" data-width="190px" style="display:none;">
                                        <option class="text-size-small" value="default" selected="selected">{{ ucfirst(trans('backend/core.use_system_default')) }}</option>
                                        <option class="text-size-small" value="index">{{ trans('backend/core.index') }}</option>
                                        <option class="text-size-small" value="noindex">{{ trans('backend/core.noindex') }}</option>
                                    </select>
                                </div>
                                <div class="meta-robots-index-warning text-danger">{{ ucfirst(trans('backend/core.meta_robots_index_warning')) }}</div>
                                <label>{{ ucfirst(trans('backend/core.meta_robots_follow')) }}</label>
                                <div class="form-group" style="margin-left:0;">
                                    <label class="radio-inline">
                                        <input type="radio" name="meta_robots_follow" value="follow" class="radio-control-primary" checked="checked">
                                        {{ trans('backend/core.follow') }}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="meta_robots_follow" value="nofollow" class="radio-control-primary">
                                        {{ trans('backend/core.nofollow') }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
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

    @include('backend.layouts.page-crud-create-sidebar')

</div>
<!-- /content area -->
@endif

@endsection