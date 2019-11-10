<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">

	<title> {{ ucwords(trans('backend/core.login')) }} | {{ ucwords(trans('backend/core.admin_panel').' - '.config('sys.setting.website_title')) }}</title>
	<link rel="shortcut icon" href="{{ url('assets/frontend/images/descotis_logo.png') }}">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/icons/icomoon/styles.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/icons/fontawesome/styles.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/components.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/colors.css') }}">
	<!-- /global stylesheets -->

	<!-- Custom stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/backend/css/custom.css') }}">
	<link rel="stylesheet" href="{{ url_css_frontend('style.css') }}" />
  	<link rel="stylesheet" href="{{ url_css_frontend('responsive.css') }}" />
	<!-- /custom stylesheets -->


	<!-- Core JS files -->
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/backend/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ url('assets/backend/js/core/app.js') }}"></script>
	<!-- /theme JS files -->

	

</head>

<body style="background:url('assets/frontend/images/slider/hammock_chandra 520_sage-green house_girl_cute_couple_rooftop.jpg'); background-position:center; background-size:cover; background-repeat: no-repeat;">

	<header>
		<div class="container">
			<div class="col-left">
				<div class="above-section">
					
				</div>
				<div class="below-section"></div><!-- END BELOW SECTION -->
			</div><!-- END COL LEFT -->

			<div class="col-middle">
				<!-- <div class="img"><a href="{{ url('') }}"><img style="width:86px;" src="{{ url_img_frontend('logo.png') }}" /></a></div> -->
				<div class="half-triangle" style="top:42px;">
					<!-- <img src="{{ url_img_frontend('half-triangle.png') }}" /> -->
				</div>
			</div><!-- END COL MIDDLE -->

			<div class="col-right">
				<div class="above-section">
				</div><!-- END ABOVE SECTION -->
				<div class="below-section">
				</div><!-- END BELOW SECTION -->
			</div><!-- END COL RIGHT -->
		</div>
	</header>


	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					{!! Form::open(['url' => url(env('BACKEND_ROUTE').'/auth/login'), 'method' => 'post']) !!}
						<div class="panel panel-body login-form">

							<div class="text-center">
								<i style="font-size:20px;" class="icon-user-tie"></i>
								<h5 class="content-group">{{ ucfirst(trans('backend/core.login_to_admin_panel')) }} <small class="display-block">{{ ucfirst(trans('backend/core.enter_credential')) }}</small></h5>
							</div>

							@if(Session::has('sys_error_code'))
								<div class="alert alert-{{ Session::get('sys_error_type') }}" style="padding:5px; text-align:center;">
									{{ Session::get('sys_error_message') }}
								</div>
							@endif

							<div class="form-group has-feedback has-feedback-left">
								<input type="email" class="form-control" name="email" placeholder="{{ ucfirst(trans('backend/core.email')) }}">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" name="password" placeholder="{{ ucfirst(trans('backend/core.password')) }}">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">{{ ucfirst(trans('backend/core.login')) }} <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<!--<a href="login_password_recover.html">{{ ucfirst(trans('backend/core.forgot_password')) }}</a>-->
							</div>
						</div>
					{!! Form::close() !!}
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted" style="color:#fff;">
						<!--<div class="spacer"></div>-->
						&copy; {{ date('Y') }} <a href="" style="color:#fff;">Web Content Management</a> {{ trans('backend/core.by') }} <a href="http://www.harmonydshine.com" target="_blank" style="color: #ececec;">Harmony Dshine Studio</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
