@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.menus')) )
@section('page_module_url', '' )
@section('page_submodule', '')
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.manage_menu')) )


@push('styles')

@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery_ui/effects.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/trees/fancytree_all.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/trees/fancytree_childcounter.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/uploaders/fileinput.min.js') }}"></script>
@endpush


@push('scripts_footer')
<script type="text/javascript">

    menuActive = '0';

    $(function() {

        $(".list-menu").niceScroll();

        // Embed JSON data
        $(".tree-drag").fancytree({
            extensions: ["dnd"],
            dnd: {
                autoExpandMS: 400,
                focusOnClick: true,
                preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
                preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
                draggable: { 
                    scroll: false
                },
                dragStart: function(node, data) {
                    return true;
                },
                dragEnter: function(node, data) {
                    // Don't allow dropping *over* a node (would create a child). Just allow changing the order:
                    if  (node.getLevel() > 4 ) {
                        // Don't allow dropping *over* a node (would create a child). Just
                        // allow changing the order:
                        return ["before", "after"];
                    }
                    // Accept everything:
                    return true;
                },
                dragDrop: function(node, data) {
                    // This function MUST be defined to enable dropping of items on the tree.
                    data.otherNode.moveTo(node, data.hitMode);
                }
            }, 
            init: function(event, data) {
                $('.has-tooltip .fancytree-title').tooltip();
            },
            activate: function(event, data){
                var menu = $(this).attr('data-menu');
                loadTreeNode(menu, event, data);
            },
        });

        $('.select-menu').on('change', function(e){
            var panel = $(this).val();
            if($('.'+panel).attr('data-status') != 'active'){
                $('.setting-panel').attr('data-status','inactive');
                $('.setting-panel').velocity("transition.fadeOut", { 
                    stagger: 50,
                    duration: 50,
                    complete: function() { 
                        $('.'+panel).velocity("transition.slideDownIn", { 
                            stagger: 300,
                            duration: 300
                        });
                        $('.'+panel).attr('data-status','active');
                    }
                });
                menuActive = $('.'+panel).attr('data-menu');
            }
            e.preventDefault();
        });

        $('.ok-menu-button').on('click', function(){
            var menu = $(this).attr('data-menu');
            var node = $('#menu-tree-'+menu).fancytree('getActiveNode');
            if( !node ) return;
            node.setTitle($('#menu_'+menu+'_label').val());
            node.data.icons = $('#menu_'+menu+'_icons').val();
            node.data.image = $('#menu_'+menu+'_image').val();
            node.data.shortdesc = $('#menu_'+menu+'_shortdesc').val()
            if(node.data.type == 'custom') node.data.url = $('#menu_'+menu+'_url').val();
            $('.menu-'+menu+' .menu-tree-form').hide();
            updateMenu(menu);
        });

        $('.remove-menu-button').on('click', function(){
            var menu = $(this).attr('data-menu');
            var node = $('#menu-tree-'+menu).fancytree('getActiveNode');
            if( !node ) return;
            node.remove();
            $('.menu-'+menu+' .menu-tree-form').hide();
            updateMenu(menu);
        });

        $('.menu-form').on('submit', function(e){
            e.preventDefault();
            var menu = $(this).attr('data-menu');
            var container = $('.menu-'+menu);
            $('#menu_data_'+menu+'_title').val($('#menu_'+menu+'_title').val());
            updateMenu(menu);
            blockContainer(container);
            $.post($(this).attr('action'), $(this).serialize()).always(function(response){
                var res = JSON.parse(response);
                if(res.code == '200') unBlockContainer(container,res.message);
                else unBlockContainerWithError(container,'{{ ucwords(trans('backend/core.error')) }}', res);
                setTimeout(function(){ location.reload(); }, 800);
            });
        });

        $('.select-content-type').on('click', function(e){
            e.preventDefault();
            var type = $(this).attr('data-type');
            var container = $('.list-menu');
            blockContainer(container);
            $.get('{{ url(env('BACKEND_ROUTE').'/menu/get_content') }}'+'/'+type, function(response){
                var res = JSON.parse(response);
                if(res.code == '200')
                {
                    if(res.type != 'product')
                    {
                        var contentName = res.content.name.toLowerCase().replace(/\b[a-z]/g, function(letter) { return letter.toUpperCase(); }); // make ucwords
                        $('.content-name').html(contentName);
                        $('.content-count').html('('+res.content.count+')');
                        var html = '';
                        if(res.data.length > 0){
                            for(var i=0; i<res.data.length; i++){
                                if('title' in res.data[i].data) var title = res.data[i].data['title'].charAt(0).toUpperCase() + res.data[i].data['title'].slice(1); // make ucfirst
                                else var title = '';
                                if('slug' in res.data[i].data) var url = res.data[i].data['slug'];
                                else var url = '';
                                html += '<a href="#" class="list-group-item list-menu-item list-menu-item-content"'+
                                            'data-title="'+title+'"'+
                                            'data-id="'+res.data[i].id+'"'+
                                            'data-type="page"'+
                                            'data-url="'+url+'"'+
                                        '>'+
                                            '<div class="list-menu-item-icon"><i class="icon-file-text2"></i></div>'+
                                            '<div class="list-menu-item-text">'+title+'</div>'+
                                        '</a>';
                            }
                        }
                        $('.list-menu-item-container').html(html);
                        unBlockContainer(container,res.message);
                    }
                    else
                    {
                        var contentName = res.content.name.toLowerCase().replace(/\b[a-z]/g, function(letter) { return letter.toUpperCase(); }); // make ucwords
                        $('.content-name').html(contentName);
                        $('.content-count').html('('+res.content.count+')');
                        var html = '';
                        if(res.data.length > 0){
                            for(var i=0; i<res.data.length; i++){
                                if('product_name' in res.data[i].data) var title = res.data[i].data['product_name'].charAt(0).toUpperCase() + res.data[i].data['product_name'].slice(1); // make ucfirst
                                else var title = '';
                                if('product_slug' in res.data[i].data) var url = res.data[i].data['product_slug'];
                                else var url = '';
                                html += '<a href="#" class="list-group-item list-menu-item list-menu-item-content"'+
                                            'data-title="'+title+'"'+
                                            'data-id="'+res.data[i].id+'"'+
                                            'data-type="product"'+
                                            'data-url="'+url+'"'+
                                        '>'+
                                            '<div class="list-menu-item-icon"><i class="icon-file-text2"></i></div>'+
                                            '<div class="list-menu-item-text">'+title+'</div>'+
                                        '</a>';
                            }
                        }
                        $('.list-menu-item-container').html(html);
                        unBlockContainer(container,res.message);
                    }
                }
                else unBlockContainerWithError(container,'{{ ucwords(trans('backend/core.error')) }}', res);
            });
        });
        
        $(document).on('click', '.list-menu-item-content', function(e){
            e.preventDefault();
            $('.list-menu-item-content').removeClass('active');
            $(this).addClass('active');
            $('.add-menu-content').attr('data-title',$(this).attr('data-title'));
            $('.add-menu-content').attr('data-id',$(this).attr('data-id'));
            $('.add-menu-content').attr('data-type',$(this).attr('data-type'));
            $('.add-menu-content').attr('data-url',$(this).attr('data-url'));
            $('.add-menu-content-container button').removeAttr('disabled');
        });

        $('.add-menu-content').on('click', function(){
            var rootNode = $('#menu-tree-'+menuActive).fancytree('getRootNode');
            var childNode = rootNode.addChildren({
                id: $(this).attr('data-id'),
                title: $(this).attr('data-title'),
                url: $(this).attr('data-url'),
                type: $(this).attr('data-type'),
            });
            $('.menu-'+menuActive+' .menu-tree-form').hide();
            updateMenu(menuActive);
        });

        $('.add-menu-custom').on('click', function(){
            if($('#menu_custom_label').val() != '' && $('#menu_custom_url').val() != ''){
                var rootNode = $('#menu-tree-'+menuActive).fancytree('getRootNode');
                var childNode = rootNode.addChildren({
                    title: $('#menu_custom_label').val(),
                    url: $('#menu_custom_url').val(),
                    type: 'custom'
                });
                $('.menu-'+menuActive+' .menu-tree-form').hide();
                updateMenu(menuActive);
                $('#menu_custom_label').val('');
                $('#menu_custom_url').val('');
            }
            else{
                bootbox.alert({
                    title: '{{ ucwords(trans('backend/core.attention')) }}',
                    message: '{{ ucwords(trans('backend/core.field_cant_empty')) }}',
                    closeButton: false,
                    size: 'small', // large or small
                    className: 'modal-dialog-confirm'
                });
            }
        });

        function updateMenu(menu){
            var m = $("#menu-tree-"+menu).fancytree("getTree").toDict(true);
            $('#menu_data_'+menu+'_tree').val(JSON.stringify(m));
        }

        function loadTreeNode(menu, event, data){
            $('.menu-'+menu+' .menu-tree-form').show();
            if(data.node.data.type != 'custom'){
                $('#menu_'+menu+'_url_container').hide();
                $('#menu_'+menu+'_label').val(data.node.title);
                $('#menu_'+menu+'_icons').val(data.node.data.icons);
                $('#menu_'+menu+'_image').val(data.node.data.image);
                $('#menu_'+menu+'_shortdesc').val(data.node.data.shortdesc);
            }
            else {
                $('#menu_'+menu+'_label').val(data.node.title);
                $('#menu_'+menu+'_url').val(data.node.data.url);
                $('#menu_'+menu+'_icons').val(data.node.data.icons);
                $('#menu_'+menu+'_image').val(data.node.data.image);
                $('#menu_'+menu+'_shortdesc').val(data.node.data.shortdesc);
                $('#menu_'+menu+'_url_container').show();
            }
        }

    });

        $('.filemanager-trigger').on('click', function() {
            var filemanager = $(this).attr('data-filemanager');
            var trigger = $(this).attr('rel');
            $('.iframe-modal').on('shown.bs.modal', function() {
                $(this).attr('data-trigger', trigger);
                $(this).find('iframe').attr('src', filemanager);
            });
        });

        $('.iframe-modal').on('hidden.bs.modal', function() {
            $(this).find('iframe').removeAttr('src');
            var trigger = $(this).attr('data-trigger');
              if ($('#'+trigger+'_image_field').val() != '') {

                  $('.'+trigger+'-image-thumb-container').show();
                  $('.'+trigger+'-image-icon').hide();
                  $('#'+trigger+'_image_thumb').attr('src', $('#'+trigger+'_image_field').val());

              } else {
                  $('.'+trigger+'-image-icon').show();
                  $('.'+trigger+'-image-thumb-container').hide();
              }
        });

        $('.delete-image').click(function(){
          var trigger = $(this).attr('rel');
          $('.'+trigger+'-image-thumb-container').hide();
          $('.'+trigger+'-image-icon').show();
          $('#'+trigger+'_image_thumb').attr('src', "");
          $('#'+trigger+'_image_field').val("");
        });



</script>
@endpush


@section('content')

@if(Session::has('sys_error_code') && Session::get('sys_error_code') == '401')
    <div class="alert alert-{{ Session::get('sys_error_type') }}" style="padding:5px; text-align:center;">
        {{ Session::get('sys_error_message') }}
    </div>
@else
    
    <div class="has-detached-left">
        
        <!-- Detached sidebar -->
        <div class="sidebar-detached">
            <div class="sidebar sidebar-default sidebar-separate">
                <div class="sidebar-content">

                    <!-- Configuration scope -->
                    @include('backend.layouts.website-scope-url-v2')
                    <!-- /configuration scope -->

                    <!-- Page -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>{{ ucwords(trans('backend/core.content')) }}</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse"></a></li>
                            </ul>
                        </div>
                        <div class="category-content" style="padding-top: 10px;">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="content-group">
                                        <h6 class="text-semibold heading-divided">
                                            <i class="icon-folder6 position-left"></i> 
                                            <span class="content-name">{{ ucwords($content_settings[$listed_contents[0]]['module_name']) }}</span> <small class="position-right content-count">({{ count($contents) }})</small>
                                            @if(count($listed_contents) > 0)
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btn-xs btn-flat btn-icon dropdown-toggle" data-toggle="dropdown" style="position:relative; top: -5px;">
                                                    <i class="icon-triangle2 rotate-180" style="font-size:10px;"></i></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    @foreach($listed_contents as $content_type)
                                                    <li>
                                                        <a class="select-content-type" data-type="{{ $content_type }}" href="#">{{ ucwords($content_settings[$content_type]['module_name']) }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </h6>
                                        <div class="list-group list-group-borderless list-menu">
                                            <div class="blockui-message">
                                                <i class="icon-spinner10 spinner"></i> <span class="display-block blockui-message-text"></span>
                                            </div>
                                            <div class="list-menu-item-container">
                                                @foreach($contents as $content)
                                                    <a href="#" class="list-group-item list-menu-item list-menu-item-content"
                                                        data-title="{{ (array_key_exists('title',$content->data)) ? ucfirst($content->data['title']) : '' }}"
                                                        data-id="{{ $content->id }}"
                                                        data-type="content"
                                                        data-url="{{ (array_key_exists('slug',$content->data)) ? $content->data['slug'] : '' }}"
                                                    >
                                                        <div class="list-menu-item-icon"><i class="icon-file-text2"></i></div>
                                                        <div class="list-menu-item-text">{{ (array_key_exists('title',$content->data)) ? ucfirst($content->data['title']) : '' }}</div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top:0;">
                            <div class="add-menu-content-container form-group" style="margin-bottom: 30px;">
                                <button 
                                disabled
                                type="button" 
                                class="add-menu-content btn btn-default pull-right"
                                data-title=""
                                data-id=""
                                data-type=""
                                data-url=""
                                >
                                    {{ ucwords(trans('backend/core.add_to_menu')) }}
                                    <i class="icon-arrow-right13"></i>
                                    <!-- <i class="icon-arrow-right14"></i> -->
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /page -->

                    <!-- Custom Link -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>{{ ucwords(trans('backend/core.custom_link')) }}</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse" class="rotate-180"></a></li>
                            </ul>
                        </div>
                        <div class="category-content" style="display:none; padding-top: 10px;">
                            <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.title')) }}</label>
                                <input id="menu_custom_label" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.url')) }}</label>
                                <input id="menu_custom_url" type="url" class="form-control" placeholder="http://">
                            </div>
                            <br>
                            <hr>
                            <div class="add-menu-custom-container form-group" style="margin-bottom: 30px;">
                                <button
                                type="button" 
                                class="add-menu-custom btn btn-default pull-right"
                                data-title=""
                                data-type=""
                                data-url=""
                                >
                                    {{ ucwords(trans('backend/core.add_to_menu')) }}
                                    <i class="icon-arrow-right13"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /custom link -->

                </div>
            </div>
        </div>
        <!-- /detached sidebar -->
        
        <div class="container-detached">
            <div class="content-detached">
                
                <div class="navbar navbar-default navbar-xs navbar-component">
                    <div class="navbar-collapse collapse" id="navbar-filter" style="padding: 10px 0 5px;">
                        <span class="navbar-text" style="margin-right: 10px;">{{ ucwords(trans('backend/core.select_menu')) }} : </span>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon-list3"></i>
                            </div>
                            <select class="bootstrap-select select-menu" data-width="100%" style="display:none;">
                                @foreach($menus as $k => $m)
                                <option class="text-size-small" value="menu-{{ $k }}">{{ ucwords($m['name']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center text-muted content-divider">
                    <span class="pb-10">{{ ucwords(trans('backend/core.menu_data')) }}</span>
                </div>
                
                <!-- Menu Tree -->
                @php $i = 0; @endphp
                @foreach($menus as $k => $m)
                <div data-menu="{{ $k }}" class="menu-{{ $k }} setting-panel panel panel-flat border-left-primary" {!! ($i == 0) ? 'data-status="active"' : 'style="display:none;"' !!}>
                    {!! Form::open(['url' => url(env('BACKEND_ROUTE').'/menu/update'), 'class' => 'menu-form form-horizontal', 'method' => 'post', 'data-menu' => $k]) !!}
                    <input id="menu_data_{{ $k }}_key" type="hidden" name="menu[key]" value="{{ $k }}">
                    <input id="menu_data_{{ $k }}_name" type="hidden" name="menu[name]" value="{{ $m['name'] }}">
                    <input id="menu_data_{{ $k }}_title" type="hidden" name="menu[title]" value="{{ $m['title'] }}">
                    <input id="menu_data_{{ $k }}_tree" type="hidden" name="menu[tree]" value="{{ $m['tree'] }}">
                    <input type="hidden" name="website" value="{{ $_GET['website'] }}">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ ucwords($m['name']) }}</h5>
                        <div class="heading-elements">
                            <!-- <button type="submit" class="btn btn-primary">{{ ucwords(trans('backend/core.save')) }} <i class="icon-check position-right"></i></button> -->
                            <a href="" class="btn btn-success">Refresh  <i class="icon-database-refresh position-right"></i></a>
                            <button type="submit" class="btn btn-primary">{{ ucwords(trans('backend/core.save')) }} <i class="icon-check position-right"></i></button>
                            <div class="blockui-message">
                                <i class="icon-spinner10 spinner"></i> <span class="display-block blockui-message-text">{{ ucwords(trans('backend/core.saving_data')) }}</span>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="panel-body">
                        <hr>
                        <div class="form-group">
                            <label class="text-bold">{{ ucwords(trans('backend/core.menu_title')) }}</label>
                            <input id="menu_{{ $k }}_title" name="menu_{{ $k }}_title" value="{{ $m['title'] }}" type="text" class="form-control">
                        </div>
                        <div class="menu-tree">
                            <div id="menu-tree-{{ $k }}" class="tree-drag well form-group" data-type="json" data-menu="{{ $k }}">
                                <div class="hidden">{{ $m['tree'] }}</div>
                            </div>
                            <div class="menu-tree-form">
                                <div class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.title')) }}</label>
                                    <input id="menu_{{ $k }}_label" name="menu_{{ $k }}_label" value="" type="text" class="form-control">
                                </div>
                                <div id="menu_{{ $k }}_url_container" class="form-group">
                                    <label class="text-bold">{{ ucwords(trans('backend/core.url')) }}</label>
                                    <input id="menu_{{ $k }}_url" name="menu_{{ $k }}_url" value="" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">Icons</label>
                                    <input id="menu_{{ $k }}_icons" name="menu_{{ $k }}_icons" type="text" class="form-control" value="">
                                    <br>
                                    <div rel="icons" id="menu_{{ $k }}_icons" class="featured-image-title filemanager-trigger" data-toggle="modal" data-target="#iframe_modal" data-filemanager="{{ url('assets/backend/js/plugins/filemanager/dialog.php?type=1&langCode=en&akey=w1n&sort_by=date&descending=1&field_id=menu_'.$k.'_icons&multiSelect=0&fldr=') }}">{{ ucwords(trans('backend/core.set_featured_image')) }}</div>
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">Menu Image</label>
                                    <input id="menu_{{ $k }}_image" name="menu_{{ $k }}_image" type="text" class="form-control" value="">
                                    <br>
                                    <div rel="icons" id="menu_{{ $k }}_image" class="featured-image-title filemanager-trigger" data-toggle="modal" data-target="#iframe_modal" data-filemanager="{{ url('assets/backend/js/plugins/filemanager/dialog.php?type=1&langCode=en&akey=w1n&sort_by=date&descending=1&field_id=menu_'.$k.'_image&multiSelect=0&fldr=') }}">{{ ucwords(trans('backend/core.set_featured_image')) }}</div>
                                </div>
                                <div class="form-group">
                                    <label class="text-bold">Short Description</label>
                                    <input id="menu_{{ $k }}_shortdesc" name="menu_{{ $k }}_shortdesc" value="" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button data-menu="{{ $k }}" type="button" class="ok-menu-button btn btn-info pull-right">{{ ucwords(trans('backend/core.ok')) }}</button>
                                    @if($m['key'] == 'menu_5')
                                        <input type="hidden" id="menuID" value="$m['key']">
                                        <button disabled data-menu="{{ $k }}" type="button" class="remove-menu-button btn btn-default"><i class="icon-trash"></i> {{ ucwords(trans('backend/core.remove')) }}</button>
                                    @else
                                        <button data-menu="{{ $k }}" type="button" class="remove-menu-button btn btn-default"><i class="icon-trash"></i> {{ ucwords(trans('backend/core.remove')) }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $i++; @endphp
                @endforeach
                <!-- /menu tree -->

            </div>
        </div>
    
    </div>
    <!-- /feature -->
    <div id="iframe_modal" class="iframe-modal modal fade" data-trigger="">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header bg-slate-800" style="background-color: #31373D;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">&nbsp;</h6>
                </div>
                <div class="modal-body">
                    <iframe></iframe>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection