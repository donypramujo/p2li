@extends('layouts.backend') @section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('TeamController@index')}}">{{trans('app.team.manage')}}</a></li>
	<li class="active">{{trans('app.team.create')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.team.create')}}</h3>
</div>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.team.team')}}</header>
	<div class="panel-body">
		<form action="{{action('TeamController@store')}}" method="post" class="form-horizontal">
			{!! csrf_field() !!}
			<div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label">{{trans('app.team.name')}}</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{old('name')}}">
					@foreach($errors->get('name') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('TeamController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.create')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



