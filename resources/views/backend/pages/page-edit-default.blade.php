@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.pages')) )
@section('page_module_url', url(env('BACKEND_ROUTE').'/pages') )
@section('page_submodule', ucwords(trans('backend/core.edit_page')) )
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
            {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/pages/update'), 'id' => 'page_form', 'class' => 'form-validate-jquery form-horizontal', 'method' => 'post']) !!}
            <input type="hidden" name="type" value="page-default">
            <input id="page_publish_time" type="hidden" name="publish_time" value="{{ $object->publish_time }}">
            <input id="page_publish_status" type="hidden" name="status" value="{{ $object->status }}">
            <input id="page_template" type="hidden" name="template" value="{{ $object->template }}">
            <input id="page_order" type="hidden" name="order" value="{{ $object->order }}">
            <input id="website_id" type="hidden" name="website_id" value="{{ (isset($_GET['website'])) ? $_GET['website'] : '0' }}">
            <input id="baseurl" type="hidden" value="{{ url('') }}">
            <input id="object_id" type="hidden" name="object_id" value="{{ $object->id }}">

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
                                value="{{ $object->title }}">
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
                                placeholder="{{ ucfirst(trans('backend/core.content_short_description')) }}">{{ $object->excerpt }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-12">{{ ucwords(trans('backend/core.content')) }}</label>
                        <div class="col-lg-12">
                            <textarea id="editor" name="content" rows="4" cols="4">{!! $object->content !!}</textarea>
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
                                    <div class="featured-image-thumb-container" style="{{ (array_key_exists('featured_image',$object->data)) ? 'display:block;' : '' }}">    
                                        <i class="icon-cross featured-image-delete" title="{{ ucfirst(trans('backend/core.delete_featured_image')) }}"></i>
                                        @if(array_key_exists('featured_image',$object->data))
                                        <img id="featured_image_thumb" src="{{ (array_key_exists('featured_image',$object->data)) ? url('').'/'.$object->data['featured_image'] : '' }}" style="display:block;">
                                        @else
                                        <img id="featured_image_thumb">
                                        @endif
                                    </div>
                                    <i class="icon-image2 featured-image-icon" style="{{ (array_key_exists('featured_image',$object->data)) ? 'display:none;' : '' }}"></i>
                                    <div class="featured-image-meta-container" style="{{ (array_key_exists('featured_image',$object->data)) ? 'display:block;' : '' }}">
                                        <input 
                                            id="featured_image_field" 
                                            name="featured_image" 
                                            type="hidden" 
                                            value="{{ (array_key_exists('featured_image',$object->data)) ? url('').'/'.$object->data['featured_image'] : '' }}">
                                        <label>{{ ucwords(trans('backend/core.image_title')) }}</label>
                                        <input 
                                            id="featured_image_title" 
                                            class="form-control featured-image-meta"
                                            name="featured_image_title" 
                                            type="text" 
                                            style="margin-bottom: 10px;"
                                            value="{{ (array_key_exists('featured_image_title',$object->data)) ? $object->data['featured_image_title'] : '' }}">
                                        <label>{{ ucwords(trans('backend/core.alt_text')) }}</label>
                                        <input 
                                            id="featured_image_alt_text" 
                                            class="form-control featured-image-meta"
                                            name="featured_image_alt_text" 
                                            type="text" 
                                            style="margin-bottom: 10px;"
                                            value="{{ (array_key_exists('featured_image_alt_text',$object->data)) ? $object->data['featured_image_alt_text'] : '' }}">
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
                                            data-delete-image-message="{{ ucfirst(trans('backend/core.delete_image_gallery_message')) }}">
                                            @if(array_key_exists('images_gallery',$object->data))
                                                <?php 
                                                    $images_gallery = json_decode($object->data['images_gallery'],true);
                                                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB' );
                                                    foreach($images_gallery as $ig):
                                                        $file_path = base_path('public').'/'.$ig['url'];
                                                        list($img_width, $img_height, $img_type, $attr)=@getimagesize($file_path);
                                                        $size = filesize($file_path);
                                                        $u = 0;
                                                        while ((round($size / 1024) > 0) && ($u < 4))
                                                        {
                                                            $size = $size / 1024;
                                                            $u++;
                                                        }
                                                        $data_image = '';
                                                        $data_image .= ' data-url="'.url('').'/'.$ig['url'].'" ';
                                                        $data_image .= ' data-filename="'.basename($file_path).'" ';
                                                        $data_image .= ' data-dimension="'.$img_width.'x'.$img_height.'" ';
                                                        $data_image .= ' data-size="'.number_format($size, 0) . " " . $units[ $u ].'" ';
                                                        $data_image .= ' data-date="'.date('F d, Y',filemtime($file_path)).'" ';
                                                        $data_image .= ' data-title="'.$ig['title'].'" ';
                                                        $data_image .= ' data-alt="'.$ig['alt'].'" ';
                                                        $data_image .= ' data-label="'.$ig['label'].'" ';
                                                ?>
                                                        <div class="images-galley-thumb-container" {!! $data_image !!} >
                                                            <img id="featured_image_thumb" src="{{ url('').'/'.$ig['url'] }}">
                                                            <div class="images-galley-thumb-action">
                                                                <i class="icon-arrow-left32 action-move-up" title="{{ ucwords(trans('backend/core.move_up')) }}"></i>
                                                                <i class="icon-arrow-right32 action-move-down" title="{{ ucwords(trans('backend/core.move_down')) }}"></i>
                                                                <i class="icon-trash-alt pull-right action-delete" title="{{ ucwords(trans('backend/core.delete_image')) }}"></i>
                                                            </div>
                                                        </div>
                                                <?php endforeach; ?>
                                            @endif
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
                                    <input type="hidden" id="featured_video_used" name="featured_video_used" value="{{ (array_key_exists('featured_video_used',$object->data)) ? $object->data['featured_video_used'] : 'external' }}">
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
                                                    placeholder="{{ ucfirst(trans('backend/core.external_video_link')) }}"
                                                    value="{{ (array_key_exists('featured_video_external',$object->data)) ? $object->data['featured_video_external'] : '' }}">
                                                <span class="input-group-btn">
                                                    <button id="preview_external_video" type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right">
                                                        <b><i class="icon-circle-right2"></i></b> {{ ucfirst(trans('backend/core.preview')) }}
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="featured-video-thumb" style="{{ (array_key_exists('featured_video_external',$object->data)) ? 'display:block;' : '' }}">
                                                <div class="thumbnail">
                                                    <div class="video-container">
                                                        <iframe 
                                                            allowfullscreen="" 
                                                            frameborder="0" 
                                                            mozallowfullscreen="" 
                                                            webkitallowfullscreen=""
                                                            src="{{ (array_key_exists('featured_video_external',$object->data)) ? $object->data['featured_video_external'] : '' }}">
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
                                            <input 
                                                type="hidden" 
                                                name="featured_video_internal" 
                                                id="featured_video_internal"
                                                value="{{ (array_key_exists('featured_video_internal',$object->data)) ? url('').'/'.$object->data['featured_video_internal'] : '' }}">
                                            <div class="featured-video-thumb" style="{{ (array_key_exists('featured_video_internal',$object->data) && $object->data['featured_video_internal'] != '') ? 'display:block;' : '' }} ">
                                                <div><b>{{ ucfirst(trans('backend/core.file_name')) }}:</b> <span class="internal-video-filename"> {{ (array_key_exists('featured_video_internal',$object->data)) ? basename(base_path('public').'/'.$object->data['featured_video_internal']) : ' - ' }} </span></div>
                                                <div class="thumbnail">
                                                    <div class="video-container" data-message="{{ ucfirst(trans('backend/core.browser_not_support_video')) }}">
                                                        @if(array_key_exists('featured_video_internal',$object->data))
                                                            @if($object->data['featured_video_internal'] != '')
                                                            <video width="100%" preload="auto" controls>
                                                                <source src="{{ url('').'/'.$object->data['featured_video_internal'] }}" type="video/mp4">
                                                                <source src="{{ url('').'/'.$object->data['featured_video_internal'] }}" type="video/ogg">
                                                                {{ ucfirst(trans('backend/core.browser_not_support_video')) }}
                                                            </video>
                                                            @endif
                                                        @endif
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
                                            {{ (array_key_exists('meta_title',$object->data)) ? $object->data['meta_title'].' | ' : '' }} {{ ucwords($site_title) }}
                                        </h6>
                                        <h6 
                                            class="snippet-slug"
                                            data-baseurl="{{ url('') }}">
                                            <span>{{ url('').'/'.$object->slug }}</span><i class="icon-arrow-down5"></i>
                                        </h6>
                                        <div 
                                            class="snippet-meta-desc"
                                            data-message="{{ ucfirst(trans('backend/core.provide_meta_description')) }}">
                                            {{ (array_key_exists('meta_description',$object->data)) ? $object->data['meta_description'] : ucfirst(trans('backend/core.provide_meta_description')) }}
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
                                        style="margin-bottom: 10px;"
                                        value="{{ (array_key_exists('meta_title',$object->data)) ? $object->data['meta_title'] : '' }}">
                                    <label>{{ ucwords(trans('backend/core.slug')) }}</label>
                                    <input
                                        class="form-control seo-field-slug"
                                        type="text" 
                                        name="slug"
                                        placeholder="{{ ucwords(trans('backend/core.url_slug')) }}" 
                                        style="margin-bottom: 10px;"
                                        value="{{ $object->slug }}">
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
                                        style="margin-bottom: 10px;">{{ (array_key_exists('meta_description',$object->data)) ? $object->data['meta_description'] : '' }}</textarea>
                                    <div class="seo-field-meta-desc-indicator progress progress-xxs"><div></div></div>
                                    <label>{{ ucwords(trans('backend/core.meta_keywords')) }}</label>
                                    <input
                                        class="form-control tags-input"
                                        type="text" 
                                        name="meta_keywords"
                                        style="margin-bottom: 10px;"
                                        value="{{ (array_key_exists('meta_keywords',$object->data)) ? $object->data['meta_keywords'] : '' }}">
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
                                        data-error-message="Please use valid slug characters: a-z, 0-9, /, or -"
                                        value="{{ (array_key_exists('canonical_url',$object->data)) ? $object->data['canonical_url'] : '' }}">
                                <label style="margin-top: 20px;">{{ ucfirst(trans('backend/core.meta_robots_index')) }}</label>
                                <div class="form-group" style="margin-left:0; margin-bottom:5px;">
                                    <select name="meta_robots_index" class="bootstrap-select" data-width="190px" style="display:none;">
                                        <option {{ ($object->data['meta_robots_index'] == 'default') ? 'selected' : '' }} class="text-size-small" value="default" selected="selected">{{ ucfirst(trans('backend/core.use_system_default')) }}</option>
                                        <option {{ ($object->data['meta_robots_index'] == 'index') ? 'selected' : '' }} class="text-size-small" value="index">{{ trans('backend/core.index') }}</option>
                                        <option {{ ($object->data['meta_robots_index'] == 'noindex') ? 'selected' : '' }} class="text-size-small" value="noindex">{{ trans('backend/core.noindex') }}</option>
                                    </select>
                                </div>
                                <div class="meta-robots-index-warning text-danger">{{ ucfirst(trans('backend/core.meta_robots_index_warning')) }}</div>
                                <label>{{ ucfirst(trans('backend/core.meta_robots_follow')) }}</label>
                                <div class="form-group" style="margin-left:0;">
                                    <label class="radio-inline">
                                        <input type="radio" name="meta_robots_follow" value="follow" class="radio-control-primary" {{ ($object->data['meta_robots_follow'] == 'follow') ? 'checked="checked"' : '' }}>
                                        {{ trans('backend/core.follow') }}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="meta_robots_follow" value="nofollow" class="radio-control-primary" {{ ($object->data['meta_robots_follow'] == 'nofollow') ? 'checked="checked"' : '' }}>
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

    @include('backend.layouts.page-crud-edit-sidebar')

</div>
<!-- /content area -->
@endif

@endsection