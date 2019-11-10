@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.home')) )
@section('page_module_url', url(env('BACKEND_ROUTE','managepage')) )
@section('page_submodule', 'Dashboard')
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.dashboard')) )


@push('styles')

@endpush


@push('scripts_header')

@endpush


@push('scripts_footer')

@endpush


@section('content')

@if(Session::has('sys_error_code') && Session::get('sys_error_code') == '401')
    <div class="alert alert-{{ Session::get('sys_error_type') }}" style="padding:5px; text-align:center;">
        {{ Session::get('sys_error_message') }}
    </div>
@else
    
    <!-- Data error -->
    @if($errors->any())
        <div class="alert alert-warning alert-styled-left">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- /Data error -->

    <!-- Submit Message -->
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
    <!-- /Submit Message -->


     <!-- Content area -->
     <div class="col-md-12">
        <div class="col-md-3" style="padding-left: 0px;">
            <div class="card bg-blue-400">
                <div class="card-body" style="padding: 1.25rem;">
                    <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0" style="font-weight: bold;font-size: 30px;letter-spacing:1px;">0</h3>
                            <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div>
                    </div>      	
                    <div style="color: #fff;font-size: 13px;letter-spacing: 1px;text-transform: capitalize;">
                        Total Orders
                    </div>
                </div>
                <div id="today-revenue" style="padding: 10px 10px 10px 10px;background: #419fdc;text-align: center;">
                    <a href="" style="color: #fff;text-transform: capitalize;letter-spacing: 1px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="padding-left: 0px;">
            <div class="card bg-danger-400">
                <div class="card-body" style="padding: 1.25rem;">
                    <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0" style="font-weight: bold;font-size: 30px;letter-spacing:1px;">0</h3>
                            <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div>
                    </div>      	
                    <div style="color: #fff;font-size: 13px;letter-spacing: 1px;text-transform: capitalize;">
                        Products
                    </div>
                </div>
                <div id="today-revenue" style="padding: 10px 10px 10px 10px;background: #d23330;text-align: center;">
                    <a href="" style="color: #fff;text-transform: capitalize;letter-spacing: 1px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="padding-left: 0px;">
            <div class="card bg-success-400">
                <div class="card-body" style="padding: 1.25rem;">
                    <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0" style="font-weight: bold;font-size: 30px;letter-spacing:1px;">0</h3>
                            <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div>
                    </div>      	
                    <div style="color: #fff;font-size: 13px;letter-spacing: 1px;text-transform: capitalize;">
                        Customers
                    </div>
                </div>
                <div id="today-revenue" style="padding: 10px 10px 10px 10px;background: #1da024;text-align: center;">
                    <a href="" style="color: #fff;text-transform: capitalize;letter-spacing: 1px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="padding-left: 0px;">
            <div class="card bg-orange-400">
                <div class="card-body" style="padding: 1.25rem;">
                    <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0" style="font-weight: bold;font-size: 30px;letter-spacing:1px;">0</h3>
                            <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div>
                    </div>      	
                    <div style="color: #fff;font-size: 13px;letter-spacing: 1px;text-transform: capitalize;">
                        Ambassadors
                    </div>
                </div>
                <div id="today-revenue" style="padding: 10px 10px 10px 10px;background: #d29021;text-align: center;">
                    <a href="0" style="color: #fff;text-transform: capitalize;letter-spacing: 1px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="content" style="padding-left: 0px;padding-right: 0px;">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><b>DESCOTIS DASHBOARD</b></h5>
                </div>
                <div class="panel-body" style="font-size:15px;">
                    Welcome, <br><br>
                    Hi Administrator, welcome to the Angkringan Dashboard page.<br>
                    Please click on the options menu on the left to manage your website content.<br>
                    <hr>
                    <span style="float: right;font-size: 13px;">
                            <?php
                            date_default_timezone_set("Asia/Makassar");
                            $today = date("j F Y | h:i:s A");
                            echo "Date : $today (GMT+8)"
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
    
@endif

@endsection