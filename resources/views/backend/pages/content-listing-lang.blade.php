@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.home')) )
@section('page_module_url', url(env('BACKEND_ROUTE','panel')) )
@section('page_title', ucwords('Languages'))


@push('styles')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<style>
.input-sm{
    cursor: not-allowed;
    pointer-events: none; 
}
.editable-clear-x{
    display:none !important;
}
</style>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
@endpush

@push('scripts_footer')
<script type="text/javascript" src="{{ url('assets/backend/js/content-crud.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.translate').editable({
        params: function(params) {
            params.code = $(this).editable().data('code');
            return params;
        }
    });


    $('.translate-key').editable({
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Key is required';
            }
        }
    });


    $('body').on('click', '.remove-key', function(){
        var cObj = $(this);


        if (confirm("Are you sure want to remove this item?")) {
            $.ajax({
                url: cObj.data('action'),
                method: 'DELETE',
                success: function(data) {
                    cObj.parents("tr").remove();
                    alert("Your imaginary file has been deleted.");
                }
            });
        }


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
            <h5 class="panel-title"><b>Language Translation Listing</b></h5>
        </div>
        <div class="panel-body" style="font-size:15px;">
            <form method="POST" action="{{ route('translations.create') }}">
            {{ csrf_field() }}
                <div class="row" style="margin-bottom: 50px;">
                    <div class="col-md-4">
                        <label>Key:</label>
                        <input type="text" name="key" class="form-control" placeholder="Enter Key...">
                    </div>
                    <div class="col-md-4">
                        <label>Value:</label>
                        <input type="text" name="value" class="form-control" placeholder="Enter Value...">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary" style="margin-top: 28px; width: 20%;">Add New</button>
                        <a href="" class="btn btn-success" style="margin-top: 28px; width: 20%;"> Refresh </a>
                    </div>
                </div>
            </form>
            <table class="table table-hover table-bordered datatable-basic">
                <thead>
                <tr>
                    <th>Key</th>
                    @if($languages->count() > 0)
                        @foreach($languages as $language)
                            <th>{{ $language->name }}({{ $language->code }})</th>
                        @endforeach
                    @endif
                    <th width="80px;">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if($columnsCount > 0)
                        @foreach($columns[0] as $columnKey => $columnValue)
                            <tr>
                                <td><a href="#" class="translate-key" data-title="Enter Key" data-type="text" data-pk="{{ $columnKey }}" data-url="{{ route('translation.update.json.key') }}">{{ $columnKey }}</a></td>
                                @for($i=1; $i<=$columnsCount; ++$i)
                                <td><a href="#" data-title="Enter Translate" class="translate" data-code="{{ $columns[$i]['lang'] }}" data-type="textarea" data-pk="{{ $columnKey }}" data-url="{{ route('translation.update.json') }}">{{ isset($columns[$i]['data'][$columnKey]) ? $columns[$i]['data'][$columnKey] : '' }}</a></td>
                                @endfor
                                <td><button data-action="{{ route('translations.destroy', $columnKey) }}" class="btn btn-danger btn-xs remove-key">Delete</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
         </div>
    </div>
    <!-- /basic datatable -->
</div>
<!-- /content area -->
@endif

@endsection
