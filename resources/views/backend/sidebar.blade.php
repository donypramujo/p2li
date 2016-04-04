<!-- .aside -->
<aside class="bg-dark lter aside-md hidden-print hidden-xs" id="nav">
	<section class="vbox">
		<section class="w-f scrollable">
			<div class="slim-scroll" data-height="100%" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<!-- nav -->
				<nav class="nav-primary hidden-xs">
					<ul class="nav">
						@permission(['user.index','category.index','subcategory.index','configuration.index','team.index'])
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
								@permission('subcategory.index')
									<li>
										<a href="{{action('SubcategoryController@index')}}"><i class="fa fa-object-group"></i> <span>{{trans('app.subcategory.manage')}}</span></a>
									</li>
								@endpermission
								@permission('configuration.index')
									<li>
										<a href="{{action('ConfigurationController@index')}}"><i class="fa fa-object-group"></i> <span>{{trans('app.subcategory.manage')}}</span></a>
									</li>
								@endpermission
								@permission('team.index')
									<li>
										<a href="{{action('TeamController@index')}}"><i class="fa fa-users"></i> <span>{{trans('app.team.manage')}}</span></a>
									</li>
								@endpermission
							</ul>
						</li>
						@endpermission
						@permission(['contest.index','jury.index','contestant.index','nomination.index','image.index'])
						<li><a href="#"> <i class="fa fa-flag icon"> <b class="bg-danger"></b>
							</i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i>
							</span> <span>{{trans('app.contest.manage')}}</span>
						</a>
							<ul class="nav lt">
								@permission('contest.index')
									<li>
										<a href="{{action('ContestController@index')}}"><i class="fa fa-tasks"></i> <span>{{trans('app.contest.current')}}</span></a>
									</li>
								@endpermission
								@permission('jury.index')
									<li>
										<a href="{{action('JuryController@index')}}"><i class="fa fa-user"></i> <span>{{trans('app.jury.registration')}}</span></a>
									</li>
								@endpermission
								@permission('contestant.index')
									<li>
										<a href="{{action('ContestantController@index')}}"><i class="fa fa-users"></i> <span>{{trans('app.contestant.registration')}}</span></a>
									</li>
								@endpermission
								@permission('nomination.index')
									<li>
										<a href="{{action('NominationController@index')}}"><i class="fa fa-flag"></i> <span>{{trans('app.contestant.nomination')}}</span></a>
									</li>
								@endpermission
							</ul>
						</li>
						@endpermission
						<li><a href="#"> <i class="fa fa-bars icon"> <b class="bg-danger"></b>
							</i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i>
							</span> <span>{{trans('app.score.manage')}}</span>
						</a>
							<ul class="nav lt">
								@permission('score.index')
									<li>
										<a href="{{action('ScoreController@index')}}"><i class="fa fa-industry"></i> <span>{{trans('app.score.create')}}</span></a>
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