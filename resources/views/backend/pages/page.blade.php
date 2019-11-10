@extends('backend.layouts.'.config('sys_data.setting.adminpanel_layout').'.main')

@section('page_module', ucwords(trans('backend/core.pages')) )
@section('page_module_url', url(env('BACKEND_ROUTE').'/pages') )
@section('page_submodule', '')
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.all_pages')) )


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
                    text: "{{ trans('backend/core.not_able_recover_page') }}",
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
            <h5 class="panel-title">{{ ucwords(trans('backend/core.pages')) }}</h5>
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
            <div class="text-right">
                <a href="{{ url(env('BACKEND_ROUTE').'/pages/create') }}" class="btn btn-success"><i class="icon-file-plus position-left"></i> New Page</a>
            </div>
        </div>

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>URL Key</th>
                    <th>Status</th>
                    <th class="text-center">Template</th>
                    <th class="text-center">Creator</th>
                    <th class="text-center">Last Modified</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($object as $o)
                <tr>
                    <td>{{ ucwords($o->title) }}</td>
                    <td><a href="{{ url($o->url) }}" target="_blank">{{ $o->url }}</a></td>
                    @if($o->status == '1')
                        <td><span class="label label-success">Published</span></td>
                    @else
                        <td><span class="label label-default">Draft</span></td>
                    @endif
                    <td class="text-center">{{ ucwords($o->template()->first()->title) }}</td>
                    <td class="text-center">Mika</td>
                    <td class="text-center">{{ date('F j, Y',strtotime($o->updated_at)) }}<br>{{ date('g:i a',strtotime($o->updated_at)) }}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ url(env('BACKEND_ROUTE').'/pages/edit/'.$o->id) }}"><i class="icon-pencil"></i> Edit</a></li>
                                    <li><a href="{{ url(env('BACKEND_ROUTE').'/pages/delete/'.$o->id) }}" class="delete-page"><i class="icon-trash"></i> Delete</a></li>
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