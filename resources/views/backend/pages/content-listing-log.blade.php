@extends('backend.layouts.'.config('sys_data.setting.adminpanel_layout').'.main')

@section('page_module', ucwords(trans('backend/core.content')) )
@section('page_module_url', '' )
@section('page_submodule', 'Log History' )
@section('page_submodule_url', '') 
@section('page_title', 'Log History' )

@push('styles')

@endpush


@push('scripts_header')
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
            <h5 class="panel-title">Log History Listing</h5>
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
        </div>
        <table class="table datatable-basic-v2">
            <thead>
                <tr>
                    <th class="text-center">Website</th>
                    <th class="text-center">Url</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Content Type</th>
                    <th class="text-center">Notes</th>
                    <th class="text-center">Updated By</th>
                    <th class="text-center">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $obj)
                    <tr>
                        <td class="text-center">{{ $obj->name }}</td>
                        <td>{{ $obj->url }}</td>
                        @if($obj->status == 'Create')
                            <td class="text-center"><span class="label label-primary">{{ $obj->status }}</span></td>
                        @elseif($obj->status == 'Update')
                            <td class="text-center"><span class="label label-success">{{ $obj->status }}</span></td>
                        @else
                            <td class="text-center"><span class="label label-danger">{{ $obj->status }}</span></td>
                        @endif
                        <td class="text-center">{{ $obj->content_type }}</td>
                        <td>{{ $obj->notes }}</td>
                        <td class="text-center">{{ $obj->fullname }}</td>
                        <td class="text-center">{{ date('F j, Y',strtotime($obj->updated_at)) }}<br>{{ date('g:i a',strtotime($obj->updated_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic datatable -->
</div>
<!-- /content area -->
@endif

@endsection

                    