<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>{{trans('app.short_name')}}</title>
<meta name="description" content="{{trans('app.name')}}" />
<link href="{{url('public/assets/favicon.ico')}}" rel="icon" type="image/png" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href="{{url('public/css/landing.css')}}" rel="stylesheet">
@yield('styles')
<!--[if lt IE 9]>
	<script src="{{url('js/ie-plugin.js')}}"></script>
  <![endif]-->
</head>
<body class="">
	@include('frontend.header')
	<section id="content">
		<section class="scrollable padder">@yield('content')</section>
	</section>
	<script src="{{url('public/js/landing.js')}}"></script>
	@yield('scripts')
</body>
</html>