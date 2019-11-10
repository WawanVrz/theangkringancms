@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.home')) )
@section('page_module_url', url(env('BACKEND_ROUTE','panel')) )
@section('page_title', ucwords('media'))


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
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/pages/datatables_basic.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/notifications/sweet_alert.min.js') }}"></script>
@endpush

@push('scripts_footer')
<script type="text/javascript" src="{{ url('assets/backend/js/content-crud.js') }}"></script>
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
            <h5 class="panel-title"><b>Media Listing</b></h5>
        </div>
            <div class="panel-body" style="font-size:15px;">
                <div class="featured-image-container">
                    <div class="featured-image-thumb-container" style="display:none;">
                        <i class="icon-cross featured-image-delete" title="{{ ucfirst(trans('backend/core.delete_featured_image')) }}"></i>
                        <img id="featured_image_thumb" class="img-responsive">
                    </div>
                    <i class="icon-image2 featured-image-icon"></i>
                    <div class="featured-image-meta-container">
                        <input id="featured_image_field" name="image" type="hidden" value="">
                    </div>
                </div>
                <div
                    id="feature-image-trigger"
                    class="featured-image-title filemanager-trigger"
                    data-toggle="modal"
                    data-target="#iframe_modal"
                    data-filemanager="{{ url('assets/backend/js/plugins/filemanager/dialog.php?type=1&langCode=en&akey=w1n&sort_by=date&descending=1&field_id=featured_image_field&multiSelect=0&fldr=') }}">
                        Upload Media Here <span style="color:red;">*</span>
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
            </div>
    </div>
    <!-- /basic datatable -->
</div>
<!-- /content area -->
@endif

@endsection
