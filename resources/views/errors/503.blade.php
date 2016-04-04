<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>{{trans('app.short_name')}}</title>
<meta name="description" content="{{trans('app.name')}}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href="{{url('css/all.css')}}" rel="stylesheet">
<!--[if lt IE 9]>
	<script src="{{url('js/ie-plugin.js')}}"></script>
  <![endif]-->
</head>
<body class="">
	<section id="content">
		<div class="row m-n">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="text-center m-b-lg">
					<h1 class="h text-white animated fadeInDownBig">503</h1>
				</div>
				<div class="list-group m-b-sm bg-white m-b-lg">
					<a href="{{action('BackendController@index')}}" class="list-group-item"> <i class="fa fa-chevron-right icon-muted"></i> <i class="fa fa-fw fa-home icon-muted"></i> Goto homepage
					</a> <a href="#" class="list-group-item"> <i class="fa fa-chevron-right icon-muted"></i> <i class="fa fa-fw fa-question icon-muted"></i> Send us a tip
					</a> <a href="#" class="list-group-item"> <i class="fa fa-chevron-right icon-muted"></i> <span class="badge">{{trans('app.call_us')}}</span> <i class="fa fa-fw fa-phone icon-muted"></i> Call us
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- footer -->
	<footer id="footer">
		<div class="text-center padder clearfix">
			<p>
				<small>{{trans('app.name')}}<br>&copy; 2016
				</small>
			</p>
		</div>
	</footer>
<script src="{{url('js/all.js')}}"></script>
</body>
</html>