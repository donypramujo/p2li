  <!-- header -->
  <header id="header" class="navbar navbar-fixed-top bg-white box-shadow b-b b-light"  data-spy="affix" data-offset-top="1">
    <div class="container">
      <div class="navbar-header">        
        <a href="#" class="navbar-brand"><img src="{{url('public/assets/favicon.ico')}}" class="m-r-sm"><span class="text-muted">{{trans('app.short_name')}}</span></a>
        <button class="btn btn-link visible-xs" type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="{{action('HomeController@index')}}">{{trans('app.live_score.s')}}</a>
          </li>
          <li>
            <a href="{{action('HomeController@showLiveTeamScores')}}">{{trans('app.live_score.team')}}</a>
          </li>
          <li>
            <a href="{{action('HomeController@showLiveBreederScores')}}">{{trans('app.live_score.breeder')}}</a>
          </li>
        </ul>
      </div>
    </div>
  </header>