@extends('layouts.backend') 
@section('nav',action('ReportController@filterScoreByTeam'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.report.score_by_team')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.report.score_by_team')}}</h3>
</div>


@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif


<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.report.score_by_team')}}</header>
	<div class="panel-body">
		<form action="{{action('ReportController@printScoreByTeam')}}" class="form-horizontal" method="get" autocomplete="off" target="_blank" >
				<div class="form-group {{$errors->has('contest_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.contest')}}</label>
				<div class="col-sm-10">
					<select name="contest_id" id="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($contests as $contest)
								<option value="{{$contest->id}}" {{(old('contest_id') == $contest->id ? "selected":"") }}>{{$contest->name}}</option>
							@endforeach
					</select>
					@foreach($errors->get('contest_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('team_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.team.team')}}</label>
				<div class="col-sm-10">
					<select name="team_id" class="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($teams as $team)
								<option value="{{$team->id}}" {{(old("team_id") == $team->id ? "selected":"") }}>{{$team->name}}</option>
							@endforeach
					</select>
					@foreach($errors->get('team_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<button class="btn btn-default" type="submit"><i class="fa fa-print"></i> {{trans('app.print')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>


@endsection