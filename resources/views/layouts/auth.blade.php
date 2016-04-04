<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
<meta charset="utf-8" />
<title>{{trans('app.short_name')}}</title>
<meta name="description" content="{{trans('app.name')}}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href="{{url('public/css/all.css')}}" rel="stylesheet">
<!--[if lt IE 9]>
	<script src="{{url('js/ie-plugin.js')}}"></script>
  <![endif]-->
</head>
<body class="">
	<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
		<div class="container aside-xxl">
			@yield('content')
		</div>
	</section>
	<!-- footer -->
	<footer id="footer">
		<div class="text-center padder">
			<p>
				<small>{{trans('app.name')}}<br>&copy; 2016
				</small>
			</p>
		</div>
	</footer>
	<script src="{{url('public/js/all.js')}}"></script>
</body>
</html>