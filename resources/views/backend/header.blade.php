<header class="bg-dark dk header navbar navbar-fixed-top-xs">
	<div class="navbar-header aside-md">
		<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html"> <i class="fa fa-bars"></i>
		</a> <a href="#" class="navbar-brand" data-toggle="fullscreen"> <i class="fa fa-clone"></i> {{trans('app.short_name')}}</a> <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user"> <i class="fa fa-cog"></i>
		</a>
	</div>
	<ul class="nav navbar-nav hidden-xs">
	</ul>
	<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
		<li class="hidden-xs"></li>
		<li class="dropdown hidden-xs"></li>
		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i>
		  {{ Auth::user()->name }} <b class="caret"></b>
		</a>
			<ul class="dropdown-menu animated fadeInRight">
				<span class="arrow top"></span>
				<li><a href="#">{{trans('app.change_password')}}</a></li>
				<li class="divider"></li>
				<li><a href="{{url('backend/logout')}}">{{trans('app.logout')}}</a></li>
			</ul></li>
	</ul>
</header>