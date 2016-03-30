@extends('layouts.backend') 
@section('nav',action('UserController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('UserController@index')}}">{{trans('app.user.manage')}}</a></li>
	<li class="active">{{trans('app.user.edit')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.user.edit')}}</h3>
</div>
<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.user.user')}}</header>
	<div class="panel-body">
		<form action="{{action('UserController@update',$user->id)}}" method="post" class="form-horizontal">
			{!! csrf_field() !!}
			{{ method_field('PUT') }}
			<div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.name')}}</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{ $errors->has() ? old('name') : $user->name }}">
					@foreach($errors->get('name') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('email') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.email')}}</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control" value="{{ $errors->has() ? old('email') : $user->email }}">
					@foreach($errors->get('email') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('password') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.password')}}</label>
				<div class="col-sm-10">
					<input type="password" name="password" class="form-control" >
					@foreach($errors->get('password') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.confirm_password')}}</label>
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
					<a href="{{action('UserController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> {{trans('app.edit')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



