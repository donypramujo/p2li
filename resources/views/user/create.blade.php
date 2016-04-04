@extends('layouts.backend') 
@section('nav',action('UserController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('UserController@index')}}">{{trans('app.user.manage')}}</a></li>
	<li class="active">{{trans('app.user.create')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.user.create')}}</h3>
</div>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.user.user')}}</header>
	<div class="panel-body">
		<form action="{{action('UserController@store')}}" method="post" class="form-horizontal" autocomplete="off">
			{!! csrf_field() !!}
			<div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.name')}}</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{old('name')}}" maxlength="255">
					@foreach($errors->get('name') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('email') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.email')}}</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control" value="{{old('email')}}" maxlength="255">
					@foreach($errors->get('email') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('role_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.role')}}</label>
				<div class="col-sm-10">
					<select name="role_id" id="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
						<option value="3" {{(old("role_id") == '3' ? "selected":"") }}>{{\App\Role::find(3)->display_name}}</option>
						<option value="2" {{(old("role_id") == '2' ? "selected":"") }}>{{\App\Role::find(2)->display_name}}</option>
					</select>
					@foreach($errors->get('role_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('password') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.password')}}</label>
				<div class="col-sm-10">
					<input type="password" name="password" class="form-control" value="{{old('password')}}">
					@foreach($errors->get('password') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.user.confirm_password')}}</label>
				<div class="col-sm-10">
					<input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
					@foreach($errors->get('password_confirmation') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('UserController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.create')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



