@extends('layouts.backend') 
@section('nav',action('ContestController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('ContestController@index')}}">{{trans('app.contest.current')}}</a></li>
	<li class="active">{{trans('app.contest.create')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.contest.create')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contest.contest')}}</header>
	<div class="panel-body">
		<form action="{{action('ContestController@store')}}" method="post" class="form-horizontal" autocomplete="off">
			{!! csrf_field() !!}
			<div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.name')}}</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{old('name')}}" maxlength="50">
					@foreach($errors->get('name') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('start_date') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.start_date')}}</label>
				<div class="col-sm-10">
					<input type="text" name="start_date" value="{{old('start_date')}}" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" size="16" class="input-sm input-s datepicker-input form-control">
					@foreach($errors->get('start_date') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('end_date') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.end_date')}}</label>
				<div class="col-sm-10">
					<input type="text" name="end_date" value="{{old('end_date')}}" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" size="16" class="input-sm input-s datepicker-input form-control">
					@foreach($errors->get('end_date') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('BackendController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.create')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



