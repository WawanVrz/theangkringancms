<!DOCTYPE html>
<html lang="en">
@include('backend.layouts.head')
<body class="navbar-top">

	@include('backend.layouts.header-navigation')

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			@include('backend.layouts.sidebar')

			<!-- Main content -->
			<div class="content-wrapper">

				@include('backend.layouts.content-header')

				<!-- Content area -->
				<div class="content">
					@yield('content')
					<!-- Footer -->
					@include('backend.layouts.footer-copyright')
					<!-- /footer -->
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	@stack('scripts_footer')

</body>
</html>
