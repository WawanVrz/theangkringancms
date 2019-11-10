@extends('backend.layouts.'.config('sys_data.setting.adminpanel_layout').'.main')

@section('page_module', ucwords(trans('backend/core.content')) )
@section('page_module_url', '' )
@section('page_submodule', 'Social Media' )
@section('page_submodule_url', url(env('BACKEND_ROUTE').'/setting/social/media') ) 
@section('page_title', 'Social Media' )

@push('styles')
<style>
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){
    width:100% !important;
}
</style>
@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/inputs/passy.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/product-default.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/pages/datatables_basic.js') }}"></script>
@endpush


@push('scripts_footer')
<script type="text/javascript">
    
    $(function(){
        
        // Delete
        $('.delete-page').on('click', function() {
            var t = $(this);
            event.preventDefault();
            swal({
                    title: "{{ trans('backend/core.are_you_sure') }}",
                    text: "{{ trans('backend/core.not_able_recover_this_data') }}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF7043",
                    confirmButtonText: "{{ trans('backend/core.yes_delete_it') }}",
                },
                function(){
                    window.location.href = t.attr('href');
                }
            );
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
<div class="content">
    <!-- Basic datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Social Media</h5>
        </div>

        <div class="panel-body">
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

            <form role="form" action="{{ Route('sosmed.update', $sosmed_data->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH">
            <input id="website_id" type="hidden" name="website_id" value="{{ $sosmed_data->website_id }}">
            <input id="author" type="hidden" name="author" value="{{ Auth::user()->id }}">

            <div class="col-lg-12">
                    <fieldset class="content-group">
                        <legend class="text-bold" style="padding-top:48px;">Update Social Media</legend>

                        <div class="col-lg-6">
                            <div class="form-group" style="margin:0px;">
                                <label class="control-label">Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ $sosmed_data->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" style="margin:0px;">
                                <label class="control-label">Url <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="url" value="{{ $sosmed_data->url }}">
                            </div>
                        </div>
                    </fieldset>
                    <div class="pull-left"></div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Update <i class="icon-check position-right"></i></button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- /basic datatable -->
</div>
<!-- /content area -->
@endif

@endsection