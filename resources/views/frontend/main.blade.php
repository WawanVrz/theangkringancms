<!DOCTYPE html>
@php
    $websitesLang = DB::table('sys_websites')->where('id',Session::get('sys_website_scope'))->get()->first();
@endphp
<html lang="{{ $websitesLang->locale }}">
@include('frontend.blocks.head')
<body>
	<input type="hidden" id="baseURI" value="{{ url('') }}">
	<input type="hidden" name="currentURL" value="<?php echo URL::current(); ?>">
	<input type="hidden" id="currentLocale" value="{{ $websitesLang->locale }}">

	@include('frontend.blocks.header')

		@yield('content')

	@include('frontend.blocks.footer')

</body>
	@include('frontend.blocks.foot')
	@yield('footer')
</html>
