@extends('layouts.backend') 
@section('nav',action('ConfigController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.config.edit')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.config.edit')}}</h3>
</div>
@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.config.edit')}}</header>
	<div class="panel-body">
		<form action="{{action('ConfigController@store')}}" method="post" class="form-horizontal" autocomplete="off">
			{!! csrf_field() !!}
			<div class="form-group {{$errors->has('max_score') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.config.max_score')}}</label>
				<div class="col-sm-10">
					<input type="text" name="max_score" class="form-control" value="{{$configs['max_score']}}" maxlength="50">
					@foreach($errors->get('max_score') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('rate_penalty_minor') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.config.penalty_minor')}}</label>
				<div class="col-sm-10">
					<input type="text" name="rate_penalty_minor" class="form-control" value="{{$configs['rate_penalty_minor'] or ''}}" maxlength="50">
					@foreach($errors->get('rate_penalty_minor') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('rate_penalty_major') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.config.penalty_major')}}</label>
				<div class="col-sm-10">
					<input type="text" name="rate_penalty_major" class="form-control" value="{{$configs['rate_penalty_major'] or ''}}" maxlength="50">
					@foreach($errors->get('rate_penalty_major') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('contest') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.selected')}}</label>
				<div class="col-sm-10">
					<select name="contest" id="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($contests as $contest)
								<option value="{{$contest->id}}" {{($configs['contest'] == $contest->id ? "selected":"") }}>{{$contest->name}}</option>
							@endforeach
					</select>
					@foreach($errors->get('contest') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('TeamController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> {{trans('app.edit')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



