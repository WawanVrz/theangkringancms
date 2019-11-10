@extends('backend.layouts.main')

@section('page_module', ucwords(trans('backend/core.language')) )
@section('page_module_url', '' )
@section('page_submodule', '')
@section('page_submodule_url', '') 
@section('page_title', ucwords(trans('backend/core.manage_language')) )


@push('styles')

@endpush


@push('scripts_header')
<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery_ui/effects.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/trees/fancytree_all.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/backend/js/plugins/trees/fancytree_childcounter.js') }}"></script>
@endpush


@push('scripts_footer')
<script type="text/javascript">

    menuActive = '0';

    $(function() {

        $(".list-menu").niceScroll();

        // Embed JSON data
        $(".tree-drag").fancytree({
            // extensions: ["dnd"],
            // dnd: {
            //     autoExpandMS: 400,
            //     focusOnClick: true,
            //     preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
            //     preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
            //     draggable: { 
            //         scroll: false
            //     },
            //     dragStart: function(node, data) {
            //         return true;
            //     },
            //     dragEnter: function(node, data) {
            //         // Don't allow dropping *over* a node (would create a child). Just allow changing the order:
            //         return ["before", "after"];
            //         // Accept everything:
            //         // return true;
            //     },
            //     dragDrop: function(node, data) {
            //         // This function MUST be defined to enable dropping of items on the tree.
            //         data.otherNode.moveTo(node, data.hitMode);
            //     }
            // },
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
                if(res.code == '200'){
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
                                        'data-type="content"'+
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
                type: 'page'
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
            }
            else {
                $('#menu_'+menu+'_label').val(data.node.title);
                $('#menu_'+menu+'_url').val(data.node.data.url);
                $('#menu_'+menu+'_url_container').show();
            }
        }

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
                    @include('backend.layouts.website-scope-url-v3')
                    <!-- /configuration scope -->

                    <!-- Custom Link -->
                    <div class="sidebar-category">
                        <div class="category-title category-collapsed">
                            <span>{{ ucwords(trans('backend/core.custom_text')) }}</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse" class="rotate-180"></a></li>
                            </ul>
                        </div>
                        <div class="category-content" style="display:block; padding-top: 10px;">
                            <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.custom_text')) }}</label>
                                <input id="menu_custom_label" type="text" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                                <label class="text-bold">{{ ucwords(trans('backend/core.url')) }}</label>
                                <input id="menu_custom_url" type="url" class="form-control" placeholder="http://">
                            </div> -->
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
                    <span class="pb-10">{{ ucwords(trans('backend/core.language_data')) }}</span>
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

@endif

@endsection