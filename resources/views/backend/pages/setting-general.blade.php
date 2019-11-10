@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.settings')) )
@section('page_module_url', '' )
@section('page_submodule', '')
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.general_settings')) )


@push('styles')

@endpush


@push('scripts_header')

@endpush


@push('scripts_footer')
<script type="text/javascript">
    $(function() {
        
        $('.setting-menu').on('click', function(e){
            $('.setting-menu').removeClass('active');
            $(this).addClass('active');
            var panel = $(this).attr('data-target');
            if($('.'+panel).attr('data-status') != 'active'){
                $('.setting-panel').attr('data-status','inactive');
                $('.setting-panel').velocity("transition.slideLeftOut", { 
                    stagger: 100,
                    duration: 100,
                    complete: function() { 
                        $('.'+panel).velocity("transition.slideRightIn", { 
                            stagger: 500,
                            duration: 500
                        });
                        $('.'+panel).attr('data-status','active');
                    }
                });
            }
            e.preventDefault();
        });

        $('#setting-general-info').on('submit', function(e){
            e.preventDefault();
            container = $('.setting-general-info');
            blockContainer(container);
            $.post($(this).attr('action'), $(this).serialize()).always(function(response){
                var res = JSON.parse(response);
                if(res.code == '200') unBlockContainer(container,res.message);
                else unBlockContainerWithError(container,'{{ ucwords(trans('backend/core.error')) }}', res);
            });
        });

        $('#setting-contact').on('submit', function(e){
            e.preventDefault();
            container = $('.setting-contact');
            blockContainer(container);
            $.post($(this).attr('action'), $(this).serialize()).always(function(response){
                var res = JSON.parse(response);
                if(res.code == '200') unBlockContainer(container,res.message);
                else unBlockContainerWithError(container,'{{ ucwords(trans('backend/core.error')) }}', res);
            });
        });

        $('#setting-seo-url').on('submit', function(e){
            e.preventDefault();
            container = $('.setting-seo-url');
            blockContainer(container);
            $.post($(this).attr('action'), $(this).serialize()).always(function(response){
                var res = JSON.parse(response);
                if(res.code == '200') location.reload();
                else unBlockContainerWithError(container,'{{ ucwords(trans('backend/core.error')) }}', res);
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
    
    <div class="has-detached-left">
        
        <!-- Detached sidebar -->
        <div class="sidebar-detached">
            <div class="sidebar sidebar-default">
                <div class="sidebar-content">

                    <!-- Website scope -->
                    <div class="category-title">
                        <span>{{ ucwords(trans('backend/core.current_setting_scope')) }}</span>
                    </div>
                    @include('backend.layouts.website-scope')
                    <!-- /website scope -->


                    <!-- Sub navigation -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>{{ ucwords(trans('backend/core.general_settings')) }}</span>
                        </div>

                        <div class="category-content no-padding">
                            <ul class="navigation navigation-alt navigation-accordion">
                                <li><a class="setting-menu active" data-target="setting-general-info" href="#">{{ ucwords(trans('backend/core.general_information')) }}</a></li>
                                <li><a class="setting-menu" data-target="setting-contact" href="#">{{ ucwords(trans('backend/core.contact')) }}</a></li>
                                <li><a class="setting-menu" data-target="setting-seo-url" href="#">{{ strtoupper(trans('backend/core.seo_url')) }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sub navigation -->

                </div>
            </div>
        </div>
        <!-- /detached sidebar -->
        

        <div class="container-detached">
            <div class="content-detached">
                
                <!-- General Info -->
                <div class="setting-general-info setting-panel panel panel-flat border-left-info" data-status="active">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ ucwords(trans('backend/core.general_information')) }}</h5>
                    </div>

                    <div class="panel-body">
                        <!--<div class="text-size-small">Common problem of templates is that all code is deeply integrated into the core. This limits your freedom in decreasing amount of code, i.e. it becomes pretty difficult to remove unnecessary code from the project. Limitless allows you to remove unnecessary and extra code easily just by removing the path to specific LESS file with component styling. All plugins and their options are also in separate files. Use only components you actually need!</div>-->
                        <hr>
                        <div class="form-message alert alert-warning alert-styled-left"></div>
                        {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/setting/general/store_general'), 'class' => 'form-horizontal', 'id' => 'setting-general-info','method' => 'post']) !!}
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.website_title')) }}</label>
                                    <input id="{{ $object['website_title']['key'] }}" name="{{ $object['website_title']['key'] }}" value="{{ $object['website_title']['value'] }}" {{ $object['website_title']['readonly'] }} type="text" class="form-control">
                                    {!! $object['website_title']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.site_language')) }}</label>
                                    <select id="{{ $object['locale']['key'] }}" name="{{ $object['locale']['key'] }}" {{ $object['locale']['readonly'] }} class="select-search" data-width="100%">
                                        @foreach($locale as $l)
                                        <option value="{{ $l->code }}" {{ ($l->code == $object['locale']['value'])? 'selected="selected"' : '' }} >{{ ucwords($l->name) }}</option>
                                        @endforeach
                                    </select>
                                    {!! $object['locale']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.timezone')) }}</label>
                                    <select id="{{ $object['timezone']['key'] }}" name="{{ $object['timezone']['key'] }}" {{ $object['timezone']['readonly'] }} class="select-search" data-width="100%">
                                        <?php $group = ''; ?>
                                        @foreach($timezone as $g => $tz)
                                            <?php if($group != $g): ?>
                                            <?php $group = $g; ?>
                                            <optgroup label="{{ $group }}">
                                            <?php endif; ?>
                                            @foreach($tz as $t)
                                                <option value="{{ $t['value'] }}" {{ ($t['value'] == $object['timezone']['value'])? 'selected="selected"' : '' }} >{{ $t['name'] }}</option>
                                            @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    {!! $object['timezone']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.week_starts_on')) }}</label>
                                    <select id="{{ $object['start_of_week']['key'] }}" name="{{ $object['start_of_week']['key'] }}" {{ $object['start_of_week']['readonly'] }} class="select" data-width="100%">
                                        <option value="0" {{ ('0' == $object['start_of_week']['value'])? 'selected="selected"' : '' }} >{{ ucwords(trans('backend/core.sunday')) }}</option>
                                        <option value="1" {{ ('1' == $object['start_of_week']['value'])? 'selected="selected"' : '' }} >{{ ucwords(trans('backend/core.monday')) }}</option>
                                        <option value="2" {{ ('2' == $object['start_of_week']['value'])? 'selected="selected"' : '' }} >{{ ucwords(trans('backend/core.tuesday')) }}</option>
                                        <option value="3" {{ ('3' == $object['start_of_week']['value'])? 'selected="selected"' : '' }} >{{ ucwords(trans('backend/core.wednesday')) }}</option>
                                        <option value="4" {{ ('4' == $object['start_of_week']['value'])? 'selected="selected"' : '' }} >{{ ucwords(trans('backend/core.thursday')) }}</option>
                                        <option value="5" {{ ('5' == $object['start_of_week']['value'])? 'selected="selected"' : '' }} >{{ ucwords(trans('backend/core.friday')) }}</option>
                                        <option value="6" {{ ('6' == $object['start_of_week']['value'])? 'selected="selected"' : '' }} >{{ ucwords(trans('backend/core.saturday')) }}</option>
                                    </select>
                                    {!! $object['start_of_week']['default'] !!}
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">{{ ucwords(trans('backend/core.save')) }} <i class="icon-check position-right"></i></button>
                                <div class="blockui-message">
                                    <i class="icon-spinner10 spinner"></i> <span class="display-block blockui-message-text">{{ ucwords(trans('backend/core.saving_data')) }}</span>
								</div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /general info -->

                <!-- Contact -->
                <div class="setting-contact setting-panel panel panel-flat border-left-info" style="display:none;">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ ucwords(trans('backend/core.contact')) }}</h5>
                    </div>

                    <div class="panel-body">
                        <!--<div class="text-size-small">Common problem of templates is that all code is deeply integrated into the core. This limits your freedom in decreasing amount of code, i.e. it becomes pretty difficult to remove unnecessary code from the project. Limitless allows you to remove unnecessary and extra code easily just by removing the path to specific LESS file with component styling. All plugins and their options are also in separate files. Use only components you actually need!</div>-->
                        <hr>
                        <div class="form-message alert alert-warning alert-styled-left"></div>
                        {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/setting/general/store_contact'), 'class' => 'form-horizontal', 'id' => 'setting-contact','method' => 'post']) !!}
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.contact_email')) }}</label>
                                    <input id="{{ $object['contact_email']['key'] }}" name="{{ $object['contact_email']['key'] }}" value="{{ $object['contact_email']['value'] }}" {{ $object['contact_email']['readonly'] }} type="text" class="form-control">
                                    {!! $object['contact_email']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.phone_number')) }}</label>
                                    <input id="{{ $object['phone']['key'] }}" name="{{ $object['phone']['key'] }}" value="{{ $object['phone']['value'] }}" {{ $object['phone']['readonly'] }} type="text" class="form-control">
                                    {!! $object['phone']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.country')) }}</label>
                                    <select id="{{ $object['country']['key'] }}" name="{{ $object['country']['key'] }}" {{ $object['country']['readonly'] }} class="select-search" data-width="100%">
                                        @foreach($country as $o)
                                        <option value="{{ $o->country_code }}" {{ ($o->country_code == $object['country']['value'])? 'selected="selected"' : '' }} >{{ ucwords($o->country_name) }}</option>
                                        @endforeach
                                    </select>
                                    {!! $object['country']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.postal_code')) }}</label>
                                    <input id="{{ $object['postal_code']['key'] }}" name="{{ $object['postal_code']['key'] }}" value="{{ $object['postal_code']['value'] }}" {{ $object['postal_code']['readonly'] }} type="text" class="form-control">
                                    {!! $object['postal_code']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.address')) }}</label>
                                    <textarea rows="4" id="{{ $object['address']['key'] }}" name="{{ $object['address']['key'] }}" {{ $object['address']['readonly'] }} class="form-control">{{ $object['address']['value'] }}</textarea>
                                    {!! $object['address']['default'] !!}
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">{{ ucwords(trans('backend/core.save')) }} <i class="icon-check position-right"></i></button>
                                <div class="blockui-message">
                                    <i class="icon-spinner10 spinner"></i> <span class="display-block blockui-message-text">{{ ucwords(trans('backend/core.saving_data')) }}</span>
								</div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /contact -->

                <!-- SEO & URL -->
                <div class="setting-seo-url setting-panel panel panel-flat border-left-info" style="display:none;">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ ucwords(trans('backend/core.seo_url')) }}</h5>
                    </div>

                    <div class="panel-body">
                        <!--<div class="text-size-small">Common problem of templates is that all code is deeply integrated into the core. This limits your freedom in decreasing amount of code, i.e. it becomes pretty difficult to remove unnecessary code from the project. Limitless allows you to remove unnecessary and extra code easily just by removing the path to specific LESS file with component styling. All plugins and their options are also in separate files. Use only components you actually need!</div>-->
                        <hr>
                        <div class="form-message alert alert-warning alert-styled-left"></div>
                        {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/setting/general/store_seo_url'), 'class' => 'form-horizontal', 'id' => 'setting-seo-url','method' => 'post']) !!}
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.website_base_url')) }}</label>
                                    <input id="{{ $object['base_url']['key'] }}" name="{{ $object['base_url']['key'] }}" value="{{ $object['base_url']['value'] }}" {{ $object['base_url']['readonly'] }} type="url" class="form-control" placeholder="http://www.example.com/">
                                    {!! $object['base_url']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.tagline')) }}</label>
                                    <input id="{{ $object['tagline']['key'] }}" name="{{ $object['tagline']['key'] }}" value="{{ $object['tagline']['value'] }}" {{ $object['tagline']['readonly'] }} type="text" class="form-control">
                                    {!! $object['tagline']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.default_description')) }}</label>
                                    <textarea rows="4" maxlength="160" id="{{ $object['meta_description']['key'] }}" name="{{ $object['meta_description']['key'] }}" {{ $object['meta_description']['readonly'] }} class="form-control maxlength-textarea" placeholder="{{ trans('backend/core.meta_description_suggest') }}">{{ $object['meta_description']['value'] }}</textarea>
                                    {!! $object['meta_description']['default'] !!}
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.default_keywords')) }}</label>
                                    <input id="{{ $object['meta_keyword']['key'] }}" name="{{ $object['meta_keyword']['key'] }}" value="{{ $object['meta_keyword']['value'] }}" {{ $object['meta_keyword']['readonly'] }} type="text" class="form-control tags-input">
                                    {!! $object['meta_keyword']['default'] !!}
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">{{ ucwords(trans('backend/core.save')) }} <i class="icon-check position-right"></i></button>
                                <div class="blockui-message">
                                    <i class="icon-spinner10 spinner"></i> <span class="display-block blockui-message-text">{{ ucwords(trans('backend/core.saving_data')) }}</span>
								</div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /seo & url -->

            </div>
        </div>
    
    </div>

@endif

@endsection