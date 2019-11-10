<!-- Detached sidebar -->
<div class="page-crud-sidebar sidebar-detached">
    <div class="sidebar sidebar-default sidebar-separate">
        <div class="sidebar-content">

            @include('backend.layouts.website-configuration-scope')

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
                            <div class="sidebar-action-container flex-between" style="justify-content: space-between;">
                                <button id="button_delete" type="submit" class="btn btn-warning" data-action="{{ $action['delete'] }}">
                                    <i class="icon-trash-alt" style="font-size: 14px; margin-right: 5px;"></i>
                                    {{ ucwords(trans('backend/core.delete')) }}
                                </button>
                                <button id="button_preview" type="submit" class="btn btn-default" data-action="{{ $action['preview'] }}">
                                    <i class="icon-file-eye" style="font-size: 14px; margin-right: 5px;"></i>
                                    {{ ucwords(trans('backend/core.preview')) }}
                                </button>
                            </div>
                        </li>
                        <li>
                            <a class="publish-attribute">
                                <i class="icon-info22"></i> 
                                {{ ucwords(trans('backend/core.status')) }}&nbsp;&nbsp;:&nbsp;&nbsp;
                                <select id="publish_status" class="bootstrap-select" data-width="144px" style="display:none;">
                                    <option {{ ($object->status == '1')? 'selected' : '' }} class="text-size-small" value="1" selected="selected">{{ ucwords(trans('backend/core.publish')) }}</option>
                                    <option {{ ($object->status == '0')? 'selected' : '' }} class="text-size-small" value="0">{{ ucwords(trans('backend/core.draft')) }}</option>
                                </select>
                            </a>
                        </li>
                        <li>
                            <a class="publish-attribute">
                                <i class="icon-calendar2"></i> 
                                {{ ucwords(trans('backend/core.publish')) }}&nbsp;&nbsp;:&nbsp;&nbsp;
                                <span 
                                    id="content_publish_time" 
                                    data-text="{{ ucwords(trans('backend/core.immediately')) }}" 
                                    data-val="{{ ($object->publish_time == NULL)? '0' : $object->publish_time }}">
                                    {{ ($object->publish_time == NULL)? ucwords(trans('backend/core.immediately')) : date('M d, Y H:i',strtotime($object->publish_time)) }}
                                </span>
                            </a>
                            <div id="content_publish_time_container" style="display:none;">
                                <div class="radio">
                                    <label>
                                        <input id="radio_publish_default" type="radio" name="stacked-radio-left" class="styled publish-default" {{ ($object->publish_time == NULL)? 'checked="checked"' : '' }}>
                                        {{ ucwords(trans('backend/core.immediately')) }}
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input id="radio_publish_date" type="radio" name="stacked-radio-left" class="styled" {{ ($object->publish_time != NULL)? 'checked="checked"' : '' }}>
                                        {{ ucwords(trans('backend/core.set_date_time')) }}
                                        <div class="input-group date-time-container" style="{{ ($object->publish_time != NULL)? '' : 'display:none;' }}">
                                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                            <input type="text" class="form-control" id="publish_time_picker" value="{{ date('M d, Y H:i',strtotime($object->publish_time)) }}">
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

            <!-- Sidebar page attribute -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>{{ trans('backend/core.page_attributes') }}</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content no-padding">
                    <ul class="navigation navigation-alt navigation-accordion">
                        <li>
                            <a>
                                <label>{{ ucwords(trans('backend/core.page_template')) }}</label>
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
                                        if(strstr($filename,'page-'))
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
                                <select id="page_template_selector" class="bootstrap-select" data-width="100%" style="display:none;">
                                    @foreach($page_templates as $k => $pt)
                                    <option {{ ($pt['code'] == $object->template )? 'selected' : '' }} class="text-size-small" value="{{ $pt['code'] }}" {{ ($k == 0) ? 'selected="selected"' : '' }}>{{ ucwords($pt['name']) }}</option>
                                    @endforeach
                                </select>
                            </a>
                        </li>
                        <li>
                            <a>
                                {{ ucwords(trans('backend/core.order')) }}
                                <input id="page_order_field" type="number" class="form-control"  min="0" value="{{ $object->order }}" style="width:65px; text-align: center; padding-right: 1px;">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /sidebar page attribute -->


        </div>
    </div>
</div>
<!-- /detached sidebar -->