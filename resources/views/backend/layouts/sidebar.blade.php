<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left">
                        <img src="{{ url('media/upload/avatar/avatar.png') }}" class="img-circle" alt="" style="width: 50px; height:50px;">
                    </a>
                    <div class="media-body">
                        <span class="media-heading">{{ ucwords(Auth::user()->username) }}</span>
                        <div class="text-size-mini text-muted">
                        @if(Auth::user()->role_id == 4)
                            <i class="icon-user-tie text-size-small"></i> &nbsp;Staff
                        @else
                            <i class="icon-user-tie text-size-small"></i> &nbsp;Administrator
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->
    
        @if(Auth::user()->role_id == 4)
             <!-- Main navigation -->
             <div class="sidebar-category sidebar-category-visible">
                <div class="category-content no-padding">
                    <ul class="navigation navigation-main navigation-accordion">
                        <li><a class="{{ (session('sys_module')['id'] == 'dashboard') ? 'active': '' }} " href="{{ url(env('BACKEND_ROUTE')) }}/dashboard"><i class="icon-home9"></i> <span>{{ ucwords(trans('backend/core.dashboard')) }}</span></a></li>
                        <li class="navigation-header"><span>{{ ucwords(trans('backend/core.ecommerce_management')) }}</span> <i class="icon-menu"></i></li>
                        <li><a href="{{ url(env('BACKEND_ROUTE').'/ambassador/listing') }}"><i class="icon-users"></i>{{ ucwords(trans('backend/core.affiliate')) }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- /main navigation -->
        @else
            <!-- Main navigation -->
            <div class="sidebar-category sidebar-category-visible">
                <div class="category-content no-padding">
                    <ul class="navigation navigation-main navigation-accordion">

                        <li><a class="{{ (session('sys_module')['id'] == 'dashboard') ? 'active': '' }} " href="{{ url(env('BACKEND_ROUTE')) }}"><i class="icon-home9"></i> <span>{{ ucwords(trans('backend/core.dashboard')) }}</span></a></li>
                        <li class="navigation-header"><span>{{ ucwords(trans('backend/core.content_management')) }}</span> <i class="icon-menu"></i></li>
                        <li>
                            <a href="#"><i class="icon-newspaper"></i>{{ ucwords(trans('backend/core.blogs')) }}</a>
                            <ul>
                                <li><a href="{{ url(env('BACKEND_ROUTE').'/content/blog/category/listing?content_type=category_post') }}"><span class="ml-25">{{ ucwords(trans('backend/core.categories')) }}</span></a></li>
                                <li><a href="{{ url(env('BACKEND_ROUTE').'/content/blog/listing?content_type=post') }}"><span class="ml-25">{{ ucwords(trans('backend/core.all_posts')) }}</span></a></li>
                            </ul>
                        </li>
                        <li> <a href="#"><i class="icon-images2"></i>Sliders</a></li>
                        <li><a href="{{ url(env('BACKEND_ROUTE').'/media') }}"><i class="icon-camera"></i>Media</a></li>

                        <li class="navigation-header"><span>E-Recipes Management</span> <i class="icon-menu"></i></li>
                        <li><a href=""><i class="icon-user-tie"></i>Members</a></li>
                        <li>
                            <a href="#"><i class="icon-cube"></i>Recipes</a>
                            <ul>
                                <li><a href=""><span class="ml-25">Category Recipe</span></a></li>
                                <li><a href=""><span class="ml-25">Listing Recipe</span></a></li>
                            </ul>
                        </li>
                        <li><a href=""><i class="icon-comments"></i>Reviews</a></li>
                        <li><a href=""><i class="icon-heart5"></i>Whislist</a></li>
                        <!-- <li><a href=""><i class="icon-earth"></i>{{ ucwords(trans('backend/core.locations')) }}</a></li> -->
       

                        <li class="navigation-header"><span>{{ ucwords(trans('backend/core.system_configuration')) }}</span> <i class="icon-menu"></i></li>
                        <li>
                            <a href="#"><i class="icon-users4"></i>{{ ucwords(trans('backend/core.users')) }}</a>
                            <ul>
                                <li><a href="{{ url(env('BACKEND_ROUTE').'/user/role') }}"><span class="ml-25">User Role</span></a></li>
                                <li><a href="{{ url(env('BACKEND_ROUTE').'/user/account') }}"><span class="ml-25">{{ ucwords(trans('backend/core.accounts')) }}</span></a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url(env('BACKEND_ROUTE').'/website') }}"><i class="icon-earth"></i>{{ ucwords(trans('backend/core.website')) }}</a></li>
                        <li><a href="{{ url(env('BACKEND_ROUTE').'/log/listing') }}"><i class="icon-history"></i>Log History</a></li>
                        <li>
                            <a href="#"><i class="fa fa-cogs"></i>{{ ucwords(trans('backend/core.settings')) }}</a>
                            <ul>
                                <li><a href="{{ url(env('BACKEND_ROUTE').'/setting/general') }}"><span class="ml-25">{{ ucwords(trans('backend/core.general')) }}</span></a></li>
                                <li><a href="{{ url(env('BACKEND_ROUTE').'/setting/social/media') }}"><span class="ml-25">Social Media</span></a></li>
                                <li><a href="{{ url(env('BACKEND_ROUTE').'/setting/other/1') }}"><span class="ml-25">Other Settings</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /main navigation -->
        @endif
    </div>
</div>
<!-- /main sidebar -->
