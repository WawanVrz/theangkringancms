@extends('backend.layouts.'.config('sys_data.setting.adminpanel_layout').'.main')

@section('page_module', ucwords(trans('backend/core.pages')) )
@section('page_module_url', url(env('BACKEND_ROUTE').'/pages') )
@section('page_submodule', '')
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.create_page')) )


@push('styles')
<style>
    .content-box-delete:hover{
        color: red;
    }
</style>
@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/selects/select2.min.js') }}"></script>
@endpush


@push('scripts_footer')
<script type="text/javascript">

    $(function(){

        $('.select-fixed').select2({
            minimumResultsForSearch: "-1",
            width: 250
        });

        $('.content-box-add').click(function(){
            var html = '<fieldset class="content-group">'+
                            '<legend class="text-bold">Content Box<div class="pull-right"><i class="icon-cross2 content-box-delete" title="Delete Content Box" style="cursor:pointer;"></i></div></legend>'+
                            '<div class="form-group">'+
                                '<label class="control-label col-lg-2">Box Title</label>'+
                                '<div class="col-lg-10">'+
                                    '<input type="text" class="form-control" name="box_title[]">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label class="control-label col-lg-2">Content</label>'+
                                '<div class="col-lg-10">'+
                                    '<textarea class="form-control" name="box_content[]" rows="5"></textarea>'+
                                '</div>'+
                            '</div>'+
                        '</fieldset>';
            $(html).insertAfter('form fieldset:last');
        });

    });
    
    $(document).on('click', '.content-box-delete', function(){
        $(this).parents('fieldset').remove();
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
            <h5 class="panel-title">{{ ucwords(trans('backend/core.create_new_page')) }}</h5>
        </div>
        
        <div class="panel-body">
            @if($errors->any())
                <div class="alert alert-warning alert-styled-left">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
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
            {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/pages/store'), 'class' => 'form-horizontal', 'method' => 'post']) !!}
                <fieldset class="content-group">
                    <legend class="text-bold">General</legend>
                    @if($template->count() > 0)
                    <div class="form-group">
                        <label class="control-label col-lg-2">Template</label>
                        <div class="col-lg-10">
                            <select class="select-fixed" name="template">
                                @foreach($template as $t)
                                    <option value="{{ $t->id }}">{{ ucwords($t->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-lg-2">Title</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Sub Title</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="subtitle">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">URL Key</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="url">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Meta Title</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="meta_title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Meta Description</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="meta_description" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Publish</label>
                        <div class="col-lg-10">
                            <select class="select-fixed" name="status">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <div class="pull-left">
                    <button type="button" class="btn btn-success content-box-add"><i class="icon-add position-left"></i> Add Box</button>
                </div>
                <div class="pull-right">
                    <a href="{{ url(env('BACKEND_ROUTE').'/pages') }}" class="btn btn-default">Cancel</a>
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