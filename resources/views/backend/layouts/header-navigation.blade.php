<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url(env('BACKEND_ROUTE','managepage')) }}">
            <div class="title" style="left: 20px;">Admin Panel</div>
            <span style="left: 20px;">Angkringan Website</span>
        </a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            <li><a class="sidebar-mobile-detached-toggle"><i class="icon-grid7"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown language-switch">
                <a href="{{ Route('homepage') }}" target="_blank">
                    <i class="icon-home5 position-left"></i>
                    Go To Homepage
                </a>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user text-size-small"></i>
                    <span>{{ ucwords(Auth::user()->username) }}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="divider"></li>
                    <li><a href="{{ url(env('BACKEND_ROUTE','managepage').'/auth/logout') }}"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->