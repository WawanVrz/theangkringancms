<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
<meta name="csrf-token" content="{{ csrf_token() }}" />
	@if(config('sys.setting.website_title') != null)
	<title>@yield('page_title') - {{ ucwords(trans('backend/core.admin_panel').' | '.config('sys.setting.website_title')) }}</title>
	@else
	<title>@yield('page_title') - {{ ucwords(trans('backend/core.admin_panel').' | '.env('WEBSITE_TITLE')) }}</title>
	@endif
	<link rel="shortcut icon" href="{{ url('assets/frontend/images/descotis_logo.png') }}">

	<!-- Global stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/icons/icomoon/styles.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/icons/fontawesome/styles.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/components.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/colors.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/extras/animate.min.css') }}">
	<!-- /global stylesheets -->

	<!-- Custom stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/custom.css') }}">
	<!-- /custom stylesheets -->

    @stack('styles')

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/pickers/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery_ui/datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/ui/headroom/headroom.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/ui/headroom/headroom_jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/ui/nicescroll.min.js') }}"></script>

	<script type="text/javascript" src="{{ url('assets/backend/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/pages/layout_fixed_custom.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/pages/layout_navbar_hideable_sidebar.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/selects/bootstrap_select.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/velocity/velocity.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/velocity/velocity.ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/tags/tagsinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/inputs/maxlength.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/forms/styling/switch.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/notifications/bootbox.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/system.js') }}"></script>
	<!-- /theme JS files -->

    @stack('scripts_header')

</head>
