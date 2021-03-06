<!doctype html>
<html @php(language_attributes()) class="front-end">
@include('partials.head')
<body @php(body_class())>
@php(do_action('get_header'))
@include('partials.header')
<div class="wrap" role="document">
	@include('partials.page-header')
	<div class="content">
		<main class="main" id="main">
			@yield('content')
		</main>
		@if (App\display_sidebar())
			<aside class="sidebar">
				@include('partials.sidebar')
			</aside>
		@endif
	</div>
</div>
@php(do_action('get_footer'))
@include('partials.footer')
@php(wp_footer())
</body>
</html>
