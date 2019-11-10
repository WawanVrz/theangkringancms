@extends('backend.layouts.'.config('sys_data.setting.adminpanel_layout').'.main')

@section('page_module', ucwords(trans('backend/core.content')) )
@section('page_module_url', '' )
@section('page_submodule', 'Social Media' )
@section('page_submodule_url', url(env('BACKEND_ROUTE').'/setting/social/media') ) 
@section('page_title', 'Social Media' )

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

            @if(count($list) != 3 )
            <div class="text-right">
                <a href="{{ url(env('BACKEND_ROUTE').'/setting/social/media/create') }}" class="btn btn-success"><i class="icon-file-plus position-left"></i> Add New </a>
            </div>
            @else

            @endif
        </div>

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Url</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($list as $obj)
                <tr>
                    <td class="text-center">{{ $obj->name }}</td>
                    <td class="text-center">{{ $obj->url }}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ url(env('BACKEND_ROUTE').'/setting/social/media/edit/'.$obj->id) }}"><i class="icon-pencil"></i> Edit</a></li>
                                    <li><a href="{{ url(env('BACKEND_ROUTE').'/setting/social/media/delete/'.$obj->id) }}" class="delete-page"><i class="icon-trash"></i> Delete</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
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

                    