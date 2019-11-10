@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.website')) )
@section('page_module_url', '' )
@section('page_submodule', '')
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.manage_website')) )


@push('styles')

@endpush


@push('scripts_header')

@endpush


@push('scripts_footer')
<script type="text/javascript">
     $(function() {
        
        $('.website-add').on('click', function(e){
            var transition = $(this).data('transition');
            var container = $(this).parents('.website-container');
            $(container).velocity('transition.' + transition, { 
                stagger: 500,
                duration: 500,
            });

            var form = $(container).find('.website-container-form');
            $(form).find('#name').val('');
            $(form).find('#code').val('');
            $(form).find('#enable').prop('checked', true);
            $(form).find('.switch').bootstrapSwitch('destroy');
            $(form).find('.switch').bootstrapSwitch();

            $(container).find('.website-container-data').hide(); 
            $(container).find('.website-container-form').show(); 
            e.preventDefault();
        });

        $('.website-edit').on('click', function(e){
            var transition = $(this).data('transition');
            var container = $(this).parents('.website-container');
            $(container).velocity('transition.' + transition, { 
                stagger: 500,
                duration: 500,
            });

            var form = $(container).find('.website-container-form');
            var id = $(container).data('id');
            $(form).find('#name_'+id).val($('#website_name_'+id).val());
            $(form).find('#code_'+id).val($('#website_code_'+id).val());
            if($(form).find('#website_enable_'+id).val() == '1') $(form).find('#enable_'+id).prop('checked', true);
            else $(form).find('#enable_'+id).prop('checked', false);
            $(form).find('.switch').bootstrapSwitch('destroy');
            $(form).find('.switch').bootstrapSwitch();

            $(container).find('.website-container-data').hide(); 
            $(container).find('.website-container-form').show(); 
            e.preventDefault();
        });

        $('.website-form-close').on('click', function(e){
            var transition = $(this).data('transition');
            var container = $(this).parents('.website-container');
            $(container).velocity('transition.' + transition, { 
                stagger: 500,
                duration: 500,
            });
            $(container).find('.form-message').hide();
            $(container).find('.website-container-form').hide(); 
            $(container).find('.website-container-data').show(); 
            e.preventDefault();
        });

        $('.website-submit').on('click', function(e){
            e.preventDefault();
            container = $(this).parents('.panel-body');
            form = $(this).parents('form');
            blockContainer(container);
            $.post($(form).attr('action'), $(form).serialize()).always(function(response){
                var res = JSON.parse(response);
                if(res.code == '200'){
                    unBlockContainerWithSuccess(container, res.message, function(){
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    });
                }
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
    
    
        
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            {{ Session::get('flash_message_success') }}
        </div>
    @endif

    <div class="row website-panel">

        @foreach($object as $o)
        <div class="col-lg-4 col-md-6 website-container" data-id="{{ $o->id }}">
            <div class="panel panel-body">
                <div class="website-container-form">
                    <h5 class="panel-title" style="border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                        {{ ucwords(trans('backend/core.edit_website_data')) }}
                        <div class="pull-right"><a href="#" class="website-form-close text-default" data-transition="flipYIn"><i class="icon-cross2"></i></a></div>
                    </h5>
                    <div class="form-message form-message-small alert alert-success alert-styled-left"></div>
                    <div class="form-message form-message-small alert alert-warning alert-styled-left"></div>
                    {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/website/update'), 'class' => 'form-horizontal','method' => 'post']) !!}
                        <input type="hidden" id="website_id_{{ $o->id }}" value="{{ $o->id }}" name="id">
                        <input type="hidden" id="website_name_{{ $o->id }}" value="{{ $o->name }}">
                        <input type="hidden" id="website_code_{{ $o->id }}" value="{{ $o->code }}">
                        <input type="hidden" id="website_enable_{{ $o->id }}" value="{{ $o->enable }}">
                        <div class="panel-body" style="border-bottom: 1px solid #ddd; margin-bottom: 10px;">
                            <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.name')) }} <span class="text-danger">*</span></label>
                                <input id="name_{{ $o->id }}" name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.website_code')) }} <span class="text-danger">*</span></label>
                                <input id="code_{{ $o->id }}" name="code" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="enable_{{ $o->id }}" name="enable" type="checkbox" data-on-color="primary" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="switch" checked="checked">
                            </div>
                        </div>
                        @if($o->id != 0)
                        <div class="pull-left">
                            <button type="button" class="btn btn-delete btn-ladda bg-slate-400 content-box-add"
                            data-title="{{ ucfirst(trans('backend/core.confirmation')) }}"
                            data-message="{{ ucfirst(trans('backend/core.delete_website_confirm')) }}"
                            data-action="{{ url(env('BACKEND_ROUTE').'/website/delete/'.$o->id) }}"
                            data-label-confirm="{{ ucwords(trans('backend/core.ok')) }}"
                            data-label-cancel="{{ ucwords(trans('backend/core.cancel')) }}"
                            data-size="small"
                            >
                                <i class="icon-trash position-left"></i> {{ ucwords(trans('backend/core.delete')) }}
                            </button>
                        </div>
                        @endif
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary website-submit">{{ ucwords(trans('backend/core.save')) }} <i class="icon-check position-right"></i></button>
                            <div class="blockui-message">
                                <i class="icon-spinner10 spinner"></i> <span class="display-block blockui-message-text">{{ ucwords(trans('backend/core.saving_data')) }}</span>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="website-container-data media">
                    <div class="media-left">
                        <i style="font-size:70px; {{ ($o->default) ? 'color:#2196f3;' : '' }}" class="icon-earth"></i>
                        <div style="text-align:center; padding-top:5px;">
                            {{ ($o->default) ? '('.ucwords(trans('backend/core.default')).')' : '&nbsp;' }}
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="media-heading" style="margin-bottom:0px;">{{ ucwords($o->name) }}</div>
                        <div><i class="fa fa-external-link text-muted text-size-small"></i> <a class="text-muted" href="{{ $o->base_url }}" target="_blank">{{ $o->base_url }}</a></div>
                        <div style="margin-top:5px;">{{ ucwords(trans('backend/core.code')) }}: {{ $o->code }}</div>
                        <div>{{ ucwords(trans('backend/core.language')) }}: {{ $o->language()->first()->name }}</div>
                        <ul class="icons-list">
                            @if($o->enable == '1')
                            <li><div style="padding-top:3px;" class="text-primary">{{ ucwords(trans('backend/core.enable')) }}</div style="padding-top:3px;"></li>
                            @else
                            <li><div style="padding-top:3px;" class="text-muted">{{ ucwords(trans('backend/core.disabled')) }}</div style="padding-top:3px;"></li>
                            @endif
                            <li><a class="website-edit" href="#" data-popup="tooltip" title="{{ ucwords(trans('backend/core.edit')) }}" data-container="body" data-transition="flipYIn"><i class="icon-pencil7"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Add New Website -->
        <div class="col-lg-4 col-md-6 website-container" data-id="{{ $o->id }}">
            <div class="panel panel-body">
                <div class="website-container-form">
                    <h5 class="panel-title" style="border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                        {{ ucwords(trans('backend/core.new_website_data')) }}
                        <div class="pull-right"><a href="#" class="website-form-close text-default" data-transition="flipYIn"><i class="icon-cross2"></i></a></div>
                    </h5>
                    <div class="form-message form-message-small alert alert-success alert-styled-left"></div>
                    <div class="form-message form-message-small alert alert-warning alert-styled-left"></div>
                    {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/website/store'), 'class' => 'form-horizontal','method' => 'post']) !!}
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.name')) }} <span class="text-danger">*</span></label>
                                <input id="name" name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.website_code')) }} <span class="text-danger">*</span></label>
                                <input id="code" name="code" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="enable" name="enable" type="checkbox" data-on-color="primary" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="switch" checked="checked">
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary website-submit">{{ ucwords(trans('backend/core.save')) }} <i class="icon-check position-right"></i></button>
                            <div class="blockui-message">
                                <i class="icon-spinner10 spinner"></i> <span class="display-block blockui-message-text"></span>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="website-container-data media">
                    <div class="media-left">
                        <i style="font-size:70px; color:#ddd;" class="icon-earth"></i>
                    </div>
                    <div class="media-body">                            
                        <div style="text-align: center; min-height: 85px; padding: 12px 0 30px">
                            <div class="media-heading text-muted" style="width: 100%; font-size: 16px; margin-bottom: 5px">{{ ucwords(trans('backend/core.new_website')) }}</div>
                            <a class="website-add" href="#" data-popup="tooltip" title="{{ ucwords(trans('backend/core.add_new_website')) }}" data-container="body" data-transition="flipYIn">
                                <i class="icon-plus3 text-muted" style="font-size: 34px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add New Website -->
        
    </div>

@endif

@endsection