<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><span class="text-semibold">@yield('page_module')</span> - @yield('page_title')</h4>
        </div>
        <!--
        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div>
        -->
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb" {{ Session::get('sys_module')['id'] }}>
            <li>
                @if(array_key_exists('page_module_url', View::getSections()))
                <a href="@yield('page_module_url')">
                @else
                <a style="cursor:text;">
                @endif
                @if(Session::get('sys_module')['id'] == 'setting_general')
                <i class="fa fa-cogs position-left"></i>
                @else
                <i class="icon-home2 position-left"></i>
                @endif
                @yield('page_module')
                </a>
            </li>
            @if (array_key_exists('page_submodule', View::getSections()))
                @if(array_key_exists('page_submodule_url', View::getSections()))
                <li><a href="@yield('page_submodule_url')">@yield('page_submodule')</a></li>
                @else
                <li>@yield('page_submodule')</li>
                @endif
            @endif
            <li class="active">@yield('page_title')</li>
        </ul>
    </div>
</div>
<!-- /page header -->