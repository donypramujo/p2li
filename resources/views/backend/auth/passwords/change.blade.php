@extends('layouts.backend') 
@section('nav',action('TeamController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.change_password')}}</li>
</ul>
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.change_password')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.change_password')}}</header>
	<div class="panel-body">
		<form action="{{action('BackendController@changePassword')}}" method="post" class="form-horizontal">
			{!! csrf_field() !!}
			<div class="form-group {{$errors->has('old_password') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label">{{trans('app.old_password')}}</label>
				<div class="col-sm-10">
					<input type="password" name="old_password" class="form-control">
					@foreach($errors->get('old_password') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('password') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label">{{trans('app.password')}}</label>
				<div class="col-sm-10">
					<input type="password" name="password" class="form-control">
					@foreach($errors->get('password') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label">{{trans('app.confirm_password')}}</label>
				<div class="col-sm-10">
					<input type="password" name="password_confirmation" class="form-control">
					@foreach($errors->get('password_confirmation') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('TeamController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> {{trans('app.submit')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection


