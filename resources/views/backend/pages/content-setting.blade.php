@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.content')) )
@section('page_module_url', '' )
@section('page_submodule', ucwords(trans('backend/core.setting')) )
@section('page_submodule_url', '' ) 
@section('page_title', ucwords(trans('backend/core.content_settings')) )


@push('styles')
@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/ui/prism.min.js') }}"></script>
@endpush


@push('scripts_footer')
@endpush


@section('content')
<!-- Content area -->
<div class="content">
    
    <!-- Info alert -->
    <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
        <h6 class="alert-heading text-semibold">
            {{ ucwords(trans('backend/core.content_settings')) }}
        </h6>
        This list contain configuration for website content such as Page, Blog post, and other type content. This list provides data abstraction for each content types. Use "example" content type below as a reference for build another content type.
    </div>
    <!-- /Info alert -->
    
    @php $i = 0; @endphp
    @foreach($content_setting as $type => $cs)
        <div class="panel panel-flat {{ ($i > 0) ? 'panel-collapsed' : '' }}">
            <div class="panel-heading">
                <h6 class="panel-title text-bold text-uppercase" style="font-size: 12px;">
                    {{ $cs['module_name'] }}
                </h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse" {!! ($i > 0) ? 'class="rotate-180"' : '' !!}></a></li>
                    </ul>
                </div>
                <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <pre class="language-php line-numbers content-group">
                            <code>{!! var_export(array($type => $content_setting[$type])) !!}</code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
        @php $i++; @endphp
    @endforeach

</div>
<!-- /content area -->

@endsection