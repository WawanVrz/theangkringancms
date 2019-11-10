@extends('backend.layouts.'.config('sys_data.setting.adminpanel_layout').'.main')

@section('page_module', ucwords(trans('backend/core.user')) )
@section('page_module_url', url(env('BACKEND_ROUTE').'/user/account') )
@section('page_submodule', ucwords(trans('backend/core.account')))
@section('page_submodule_url', url(env('BACKEND_ROUTE').'/user/account')) 
@section('page_title', ucwords(trans('backend/core.create_account')) )


@push('styles')
<style>
    .content-box-delete:hover{
        color: red;
    }
</style>
@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/'.config('sys_data.setting.adminpanel_layout').'/js/plugins/notifications/sweet_alert.min.js') }}"></script>
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
    <!-- Info alert -->
    <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
        <h6 class="alert-heading text-semibold">
            Account
        </h6>
            Creating a Account takes quite a few steps. Fill out the account's content below to present users relevant information of our website. 
        <br><br>
        <span style="color:red; ">NB : For Image Upload, We Suggestion To Upload Image With 500 x 250 Pixel Dimension.</span>
    </div>
     <!-- /Info alert -->
    <!-- Basic datatable -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ ucwords(trans('backend/core.create_new_account')) }}</h5>
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
            <form role="form" action="{{ Route('Account.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
                <fieldset class="content-group">
                    <legend class="text-bold">Account Data</legend>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Role</label>
                        <!-- <div class="col-lg-10">
                            <select class="select-fixed" name="role_id">
                                <option value="1">Administrator</option>
                                <option value="2" selected="selected">Author</option>
                                <option value="3">Student</option>
                            </select>
                        </div> -->
                        <div class="col-lg-10">
                            <select name="role_id" class="selectpicker" required>
                                @foreach($roleData as $data)
                                    <option value="{{ $data->id }}">{{ $data->role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-lg-2">Username</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">First Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="first_name" placeholder="Firstname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Last Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="last_name" placeholder="Lastname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Telphone</label>
                        <div class="col-lg-10">
                        <input type="text" class="form-control validation-valid" data-mask="+99 999 ?999 999 999" id="phone" name="phone" data-rule-phone="true" data-msg="Phone Number Required" data-msg-phone="Please input valid phone number" placeholder="Enter your phone" value="" aria-invalid="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Re-Type Your Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password_repeat" value="" placeholder="Re Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Photo Profile</label>
                        <div class="col-lg-10">
                            <input type="file" class="form-control" name="image" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Active</label>
                        <div class="col-lg-10">
                            <select class="select-fixed" name="active">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <div class="pull-right">
                    <a href="{{ url(env('BACKEND_ROUTE').'/user/account') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">Save Account<i class="icon-check position-right"></i></button>
                </div>
           </form>
        </div>

        
    </div>
    <!-- /basic datatable -->

</div>
<!-- /content area -->
@endif

@endsection