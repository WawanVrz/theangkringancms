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
            @php
                $meta_title = '';
                if(isset($object) && array_key_exists('meta_title',$object->data) && $object->data['meta_title'] != '')
                {
                    $meta_title = $object->data['meta_title'];
                }
                $meta_description = '';
                if(isset($object) && array_key_exists('meta_description',$object->data) && $object->data['meta_description'] != '')
                {
                    $meta_description = $object->data['meta_description'];
                }
                $meta_keywords = '';
                if(isset($object) && array_key_exists('meta_keywords',$object->data) && $object->data['meta_keywords'] != '')
                {
                    $meta_keywords = $object->data['meta_keywords'];
                }
                $slug = '';
                if(isset($object) && array_key_exists('slug',$object->data) && $object->data['slug'] != '')
                {
                    $slug = $object->data['slug'];
                }
                $canonical_url = '';
                if(isset($object) && array_key_exists('canonical_url',$object->data) && $object->data['canonical_url'] != '')
                {
                    $canonical_url = $object->data['canonical_url'];
                }
                $meta_robots_index = '';
                if(isset($object) && array_key_exists('meta_robots_index',$object->data) && $object->data['meta_robots_index'] != '')
                {
                    $meta_robots_index = $object->data['meta_robots_index'];
                }
                $meta_robots_follow = '';
                if(isset($object) && array_key_exists('meta_robots_follow',$object->data) && $object->data['meta_robots_follow'] != '')
                {
                    $meta_robots_follow = $object->data['meta_robots_follow'];
                }
            @endphp
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
                                @if($meta_title != ''){{ $meta_title.' | ' }}@endif{{ ucwords($site_title) }}
                            </h6>
                            <h6 
                                class="snippet-slug"
                                data-baseurl="{{ url('') }}">
                                <span>{{ url('') }}@if($slug != ''){{ '/'.$slug }}@endif</span><i class="icon-arrow-down5"></i>
                            </h6>
                            <div 
                                class="snippet-meta-desc"
                                data-message="{{ ucfirst(trans('backend/core.provide_meta_description')) }}">
                                @if($meta_description != '')
                                {{ $meta_description }}
                                @else
                                {{ ucfirst(trans('backend/core.provide_meta_description')) }}
                                @endif
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
                            @if($meta_title != '') value="{{ $meta_title }}" @endif 
                            style="margin-bottom: 10px;">
                        <label>{{ ucwords(trans('backend/core.slug')) }}</label>
                        <input
                            class="form-control seo-field-slug"
                            type="text" 
                            name="slug"
                            placeholder="{{ ucwords(trans('backend/core.url_slug')) }}" 
                            @if($slug != '') value="{{ $slug }}" @endif 
                            style="margin-bottom: 10px;">
                        <label>{{ ucwords(trans('backend/core.meta_description')) }}</label>
                        <textarea 
                            class="form-control seo-field-meta-desc" 
                            name="meta_description"
                            rows="3" 
                            cols="3"
                            threshold="195" 
                            maxlength="230" 
                            warning-color="#ee7c1b"
                            fine-color="#7ad03a"
                            placeholder="{{ ucfirst(trans('backend/core.modify_meta_description')) }}"
                            style="margin-bottom: 10px;">@if($meta_description != ''){{ $meta_description }}@endif</textarea>
                        <div class="seo-field-meta-desc-indicator progress progress-xxs">
                            @if(strlen($meta_description) == 0)
                            <div></div>
                            @else
                                @php $meta_description_width = (strlen($meta_description)/230)*100; @endphp
                                @if(strlen($meta_description) < 195)
                                    <div style="width:{{ $meta_description_width }}%; background:#ee7c1b;"></div>
                                @else
                                    <div style="width:{{ $meta_description_width }}%; background:#7ad03a;"></div>
                                @endif
                            @endif
                        </div>
                        <label>{{ ucwords(trans('backend/core.meta_keywords')) }}</label>
                        <input
                            class="form-control tags-input"
                            type="text" 
                            name="meta_keywords"
                            @if($meta_keywords != '') value="{{ $meta_keywords }}" @endif 
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
                            @if($canonical_url != '') value="{{ $canonical_url }}" @endif 
                            data-error-message="Please use valid slug characters: a-z, 0-9, /, or -">
                    <label style="margin-top: 20px;">{{ ucfirst(trans('backend/core.meta_robots_index')) }}</label>
                    <div class="form-group" style="margin-left:0; margin-bottom:5px;">
                        <select name="meta_robots_index" class="bootstrap-select" data-width="190px" style="display:none;">
                            <option class="text-size-small" value="default" @if($meta_robots_index == '') selected="selected" @endif>{{ ucfirst(trans('backend/core.use_system_default')) }}</option>
                            <option class="text-size-small" value="index" @if($meta_robots_index == 'index') selected="selected" @endif>{{ trans('backend/core.index') }}</option>
                            <option class="text-size-small" value="noindex" @if($meta_robots_index == 'noindex') selected="selected" @endif>{{ trans('backend/core.noindex') }}</option>
                        </select>
                    </div>
                    <div class="meta-robots-index-warning text-danger">{{ ucfirst(trans('backend/core.meta_robots_index_warning')) }}</div>
                    <label>{{ ucfirst(trans('backend/core.meta_robots_follow')) }}</label>
                    <div class="form-group" style="margin-left:0;">
                        <label class="radio-inline">
                            <input type="radio" name="meta_robots_follow" value="follow" class="radio-control-primary" @if($meta_robots_follow == '' OR $meta_robots_follow == 'follow') checked="checked" @endif>
                            {{ trans('backend/core.follow') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="meta_robots_follow" value="nofollow" class="radio-control-primary" @if($meta_robots_follow == 'nofollow') checked="checked" @endif>
                            {{ trans('backend/core.nofollow') }}
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>