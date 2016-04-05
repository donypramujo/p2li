<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>{{trans('app.short_name')}}</title>
<meta name="description" content="{{trans('app.name')}}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href="{{url('public/css/all.css')}}" rel="stylesheet">
@yield('styles')
<!--[if lt IE 9]>
	<script src="{{url('js/ie-plugin.js')}}"></script>
  <![endif]-->
</head>
<body class="">
	<section class="vbox">
		<section>
			<section class="hbox stretch">
				<section id="content">
					<section class="vbox">
						<section class="scrollable padder">
							@yield('content')
						</section>
					</section>
				</section>
			</section>
		</section>
	</section>
	<script src="{{url('public/js/all.js')}}"></script>
	@yield('scripts')
</body>
</html>