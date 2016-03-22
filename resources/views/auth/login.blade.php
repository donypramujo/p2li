@extends('layouts.auth') 
@section('content')
<a class="navbar-brand block" href="{{action('BackendController@index')}}">{{trans('app.short_name')}}</a>
<section class="panel panel-default bg-white m-t-lg">
	<header class="panel-heading text-center">
		<strong>{{trans('app.login')}}</strong>
	</header>
	<form action="{{ url('/backend/login') }}" role="form" method="POST" class="panel-body wrapper-lg" >
		{!! csrf_field() !!}
		<div class="form-group">
			<label class="control-label">{{trans('app.email_address')}}</label> 
			<input type="email" name="email" value="{{ old('email') }}" placeholder="{{trans('app.email_address')}}" class="form-control input-lg">
			@if ($errors->has('email')) 
				<span class="help-block m-b-none text-danger"><strong>{{ $errors->first('email') }}</strong></span> 
			@endif
		</div>
		<div class="form-group">
			<label class="control-label">{{trans('app.password')}}</label> 
			<input type="password" name="password" placeholder="{{trans('app.password')}}" class="form-control input-lg">
			@if ($errors->has('password')) 
				<span class="help-block m-b-none text-danger"><strong>{{ $errors->first('password') }}</strong></span> 
			@endif
		</div>
		<div class="checkbox">
			<label> <input type="checkbox" name="remember">{{trans('app.remember_me')}}
			</label>
		</div>
		<a href="{{ url('backend/password/reset') }}" class="pull-right m-t-xs"><small>{{trans('app.forgot_password')}}</small></a>
		<button type="submit" class="btn btn-primary">{{trans('app.login')}}</button>
		<div class="line line-dashed"></div>
	</form>
</section>
@endsection
