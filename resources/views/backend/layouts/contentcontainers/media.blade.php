@if(array_key_exists('use_panel',$container) && $container['use_panel'] == 'yes')
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
@endif
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-top">
                @php $media_active = 'active'; @endphp
                @if(in_array('image',$container['feature']))
                    <li class="{{ $media_active }}"><a href="#tab_featured_image" data-toggle="tab">{{ ucwords(trans('backend/core.featured_image')) }}</a></li>
                    @php $media_active = ''; @endphp
                @endif
                @if(in_array('gallery',$container['feature']))
                    <li class="{{ $media_active }}"><a href="#tab_images_gallery" data-toggle="tab">{{ ucwords(trans('backend/core.images_gallery')) }}</a></li>
                    @php $media_active = ''; @endphp
                @endif
                @if(in_array('video',$container['feature']))
                    <li class="{{ $media_active }}"><a href="#tab_featured_video" data-toggle="tab">{{ ucwords(trans('backend/core.featured_video')) }}</a></li>
                    @php $media_active = ''; @endphp
                @endif
            </ul>
            <div class="tab-content page-media-container">
                @php $media_active = 'active'; @endphp
                @if(in_array('image',$container['feature']))
                    @php
                        $featured_image_thumb = '';
                        if(isset($object) && array_key_exists('featured_image',$object->data) && $object->data['featured_image'] != '')
                        {
                            $featured_image_thumb = url($object->data['featured_image']);
                        }
                        $featured_image_title = '';
                        if(isset($object) && array_key_exists('featured_image_title',$object->data) && $object->data['featured_image_title'] != '')
                        {
                            $featured_image_title = $object->data['featured_image_title'];
                        }
                        $featured_image_alt = '';
                        if(isset($object) && array_key_exists('featured_image_alt_text',$object->data) && $object->data['featured_image_alt_text'] != '')
                        {
                            $featured_image_alt = $object->data['featured_image_alt_text'];
                        }
                    @endphp
                    <div class="tab-pane {{ $media_active }}" id="tab_featured_image">
                        <div class="featured-image-container">
                            <div class="featured-image-thumb-container" @if($featured_image_thumb != '') style="display:block;" @endif>
                                <i class="icon-cross featured-image-delete" title="{{ ucfirst(trans('backend/core.delete_featured_image')) }}"></i>
                                <img id="featured_image_thumb" @if($featured_image_thumb != '') src="{{ $featured_image_thumb }}" @endif>
                            </div>
                            <i class="icon-image2 featured-image-icon" @if($featured_image_thumb != '') style="display:none;" @endif></i>
                            <div class="featured-image-meta-container" @if($featured_image_thumb != '') style="display:block;" @endif>
                                <input id="featured_image_field" name="featured_image" type="hidden" @if($featured_image_thumb != '') value="{{ $object->data['featured_image'] }}" @endif >
                                <label>{{ ucwords(trans('backend/core.image_title')) }}</label>
                                <input 
                                    id="featured_image_title" 
                                    class="form-control featured-image-meta"
                                    name="featured_image_title" 
                                    type="text"
                                    @if($featured_image_title != '') value="{{ $featured_image_title }}" @endif
                                    style="margin-bottom: 10px;">
                                <label>{{ ucwords(trans('backend/core.alt_text')) }}</label>
                                <input 
                                    id="featured_image_alt_text" 
                                    class="form-control featured-image-meta"
                                    name="featured_image_alt_text" 
                                    type="text" 
                                    @if($featured_image_alt != '') value="{{ $featured_image_alt }}" @endif
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
                    @php $media_active = ''; @endphp
                @endif
                @if(in_array('gallery',$container['feature']))
                    @php
                        $images_gallery = '';
                        if(isset($object) && array_key_exists('images_gallery',$object->data) && $object->data['images_gallery'] != '')
                        {
                            $images_gallery_list = json_decode($object->data['images_gallery'],true);
                            foreach($images_gallery_list as $igl)
                            {
                                $image_dimension = getimagesize(public_path(urldecode($igl['url'])));
                                $images_gallery_data = '';
                                $images_gallery_data .= ' data-url="'.url($igl['url']).'" ';
                                $images_gallery_data .= ' data-filename="'.basename($igl['url']).'" ';
                                $images_gallery_data .= ' data-dimension="'.$image_dimension[0].'x'.$image_dimension[1].'" ';
                                $images_gallery_data .= ' data-size="'.convert_to_byte(filesize(public_path(urldecode($igl['url'])))).'" ';
                                $images_gallery_data .= ' data-date="'.date ('F j, Y.',filemtime(public_path(urldecode($igl['url'])))).'" ';
                                $images_gallery_data .= ' data-title="'.$igl['title'].'" ';
                                $images_gallery_data .= ' data-alt="'.$igl['alt'].'" ';
                                $images_gallery_data .= ' data-label="'.$igl['label'].'" ';
                                $images_gallery .= '<div class="images-galley-thumb-container" '.$images_gallery_data.'>';
                                $images_gallery .= '<img id="featured_image_thumb" src="'.url($igl['url']).'">';
                                $images_gallery .= '<div class="images-galley-thumb-action">';
                                $images_gallery .= '<i class="icon-arrow-left32 action-move-up" title="'.ucwords(trans('backend/core.move_up')).'"></i>';
                                $images_gallery .= '<i class="icon-arrow-right32 action-move-down" title="'.ucwords(trans('backend/core.move_down')).'"></i>';
                                $images_gallery .= '<i class="icon-trash-alt pull-right action-delete" title="'.ucwords(trans('backend/core.delete_image')).'"></i>';
                                $images_gallery .= '</div>';
                                $images_gallery .= '</div>';
                            }
                        }
                    @endphp
                    <div class="tab-pane {{ $media_active }}" id="tab_images_gallery">
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
                                    {!! $images_gallery !!}
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
                    @php $media_active = ''; @endphp
                @endif
                @if(in_array('video',$container['feature']))
                    @php
                        $featured_video_external_wistia = '';
                        if(isset($object) && array_key_exists('featured_video_external_wistia',$object->data) && $object->data['featured_video_external_wistia'] != '')
                        {
                            $featured_video_external_wistia = $object->data['featured_video_external_wistia'];
                        }
                        $featured_video_external = '';
                        if(isset($object) && array_key_exists('featured_video_external',$object->data) && $object->data['featured_video_external'] != '')
                        {
                            $featured_video_external = $object->data['featured_video_external'];
                        }
                        $featured_video_internal = '';
                        if(isset($object) && array_key_exists('featured_video_internal',$object->data) && $object->data['featured_video_internal'] != '')
                        {
                            $featured_video_internal = $object->data['featured_video_internal'];
                        }
                        $featured_video_used = 'wistia';
                        if(isset($object) && array_key_exists('featured_video_used',$object->data) && $object->data['featured_video_used'] != '')
                        {
                            $featured_video_used = $object->data['featured_video_used'];
                        }
                    @endphp
                    <div class="tab-pane {{ $media_active }}" id="tab_featured_video">
                        <div class="featured-video-container">
                            <input type="hidden" id="featured_video_used" name="featured_video_used" value="wistia">
                            <div class="featured-video-button" style="display:none;">
                                <ul class="breadcrumb-elements" style="margin-right: 0;">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="padding: 8px 0;">
                                            <i class="icon-file-video position-left"></i>
                                            {{ ucwords(trans('backend/core.video_source')) }}
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#" class="featured-video-selector select-external-video-wistia">{{ ucfirst(trans('backend/core.use_external_video_wistia')) }}</a></li>
                                            <li><a href="#" class="featured-video-selector select-external-video">{{ ucfirst(trans('backend/core.use_external_video')) }}</a></li>
                                            <li><a href="#" class="featured-video-selector select-internal-video">{{ ucfirst(trans('backend/core.choose_video')) }}</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured-video-body">
                                <div class="external-video-wistia-field" {!! ($featured_video_used == 'wistia') ? 'style="display:block;"' : 'style="display:none;"' !!}>
                                    <p class="text-muted" style="margin-bottom:5px;">{{ ucfirst(trans('backend/core.external_link_wistia_desc')) }}</p>
                                    <div class="input-group">
                                        <input 
                                            id="featured_video_external_wistia_link" 
                                            class="form-control"
                                            name="featured_video_external_wistia" 
                                            type="text" 
                                            @if($featured_video_external_wistia != '') value="{{ $featured_video_external_wistia }}" @endif
                                            placeholder="{{ ucfirst(trans('backend/core.external_video_wistia_code')) }}">
                                        <span class="input-group-btn">
                                            <button id="preview_external_video_wistia" type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right">
                                                <b><i class="icon-circle-right2"></i></b> {{ ucfirst(trans('backend/core.preview')) }}
                                            </button>
                                        </span>
                                    </div>
                                    <div class="featured-video-thumb" @if($featured_video_external_wistia != '') style="display:block;" @endif>
                                        <div class="thumbnail">
                                            <div class="video-container">
                                                <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-pl no-pr academy-video">
                                                    <div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
                                                        <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                                                            @if($featured_video_external_wistia != '')
                                                                <div id="video_wistia_container" class="wistia_embed wistia_async_{{ $featured_video_external_wistia }} videoFoam=true" style="height:100%;width:100%">&nbsp;</div>
                                                            @else
                                                                <div id="video_wistia_container" class="wistia_embed videoFoam=true" style="height:100%;width:100%">&nbsp;</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="external-video-field" {!! ($featured_video_used == 'external') ? 'style="display:block;"' : 'style="display:none;"' !!}>
                                    <p class="text-muted" style="margin-bottom:5px;">{{ ucfirst(trans('backend/core.external_link_desc')) }}</p>
                                    <div class="input-group">
                                        <input 
                                            id="featured_video_external_link" 
                                            class="form-control"
                                            name="featured_video_external" 
                                            type="text" 
                                            @if($featured_video_external != '') value="{{ $featured_video_external }}" @endif
                                            placeholder="{{ ucfirst(trans('backend/core.external_video_link')) }}">
                                        <span class="input-group-btn">
                                            <button id="preview_external_video" type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right">
                                                <b><i class="icon-circle-right2"></i></b> {{ ucfirst(trans('backend/core.preview')) }}
                                            </button>
                                        </span>
                                    </div>
                                    <div class="featured-video-thumb" @if($featured_video_external != '') style="display:block;" @endif>
                                        <div class="thumbnail">
                                            <div class="video-container">
                                                <iframe 
                                                    allowfullscreen="" 
                                                    frameborder="0" 
                                                    mozallowfullscreen="" 
                                                    webkitallowfullscreen=""
                                                    src="@if($featured_video_external != '') {{ $featured_video_external }} @endif">
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="internal-video-field input-group" {!! ($featured_video_used == 'internal') ? 'style="display:block;"' : 'style="display:none;"' !!}>
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
                                        @if($featured_video_internal != '') value="{{ $featured_video_internal }}" @endif
                                        id="featured_video_internal">
                                    <div class="featured-video-thumb" @if($featured_video_internal != '') style="display:block;" @endif>
                                        <div><b>{{ ucfirst(trans('backend/core.file_name')) }}:</b> <span class="internal-video-filename"> {{ ($featured_video_internal != '') ? basename($featured_video_internal) : '-' }} </span></div>
                                        <div class="thumbnail">
                                            <div class="video-container" data-message="{{ ucfirst(trans('backend/core.browser_not_support_video')) }}">
                                                @if($featured_video_internal != '') 
                                                    <video width="100%" preload="auto" controls>
                                                        <source src="{{ url($featured_video_internal) }}" type="video/mp4">
                                                        <source src="{{ url($featured_video_internal) }}" type="video/ogg">
                                                        {{ ucfirst(trans('backend/core.browser_not_support_video')) }}
                                                    </video>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $media_active = ''; @endphp
                @endif
            </div>
        </div>
@if(array_key_exists('use_panel',$container) && $container['use_panel'] == 'yes')
    </div>
</div>
@endif