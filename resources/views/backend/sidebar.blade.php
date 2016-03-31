<!-- .aside -->
<aside class="bg-dark lter aside-md hidden-print hidden-xs" id="nav">
	<section class="vbox">
		<section class="w-f scrollable">
			<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<!-- nav -->
				<nav class="nav-primary hidden-xs">
					<ul class="nav">
						<li><a href="#"> <i class="fa fa-database icon"> <b class="bg-danger"></b>
							</i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i>
							</span> <span>{{trans('app.master_data')}}</span>
						</a>
							<ul class="nav lt">
								@permission('user.index')
									<li>
										<a href="{{action('UserController@index')}}"><i class="fa fa-user"></i> <span>{{trans('app.user.manage')}}</span></a>
									</li>
								@endpermission
								@permission('category.index')
									<li>
										<a href="{{action('CategoryController@index')}}"><i class="fa fa-object-group"></i> <span>{{trans('app.category.manage')}}</span></a>
									</li>
								@endpermission
								@permission('team.index')
									<li>
										<a href="{{action('TeamController@index')}}"><i class="fa fa-users"></i> <span>{{trans('app.team.manage')}}</span></a>
									</li>
								@endpermission
							</ul>
						</li>
					</ul>
				</nav>
				<!-- / nav -->
			</div>
		</section>
	</section>
</aside>
<!-- /.aside -->