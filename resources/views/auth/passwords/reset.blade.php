@extends('layouts.auth') 
@section('content')

<a class="navbar-brand block" href="{{action('BackendController@index')}}">{{trans('app.short_name')}}</a>
<section class="panel panel-default bg-white m-t-lg">
	<header class="panel-heading text-center">
		<strong>{{trans('app.reset_password')}}</strong>
	</header>
	<form role="form" method="POST" action="{{ action('Auth\PasswordController@reset') }}" class="panel-body wrapper-lg" >
		{!! csrf_field() !!}
		<input type="hidden" name="token" value="{{ $token }}">
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<label class="control-label">{{trans('app.email_address')}}</label> 
			<input type="email" name="email" value="{{ $email or old('email') }}" placeholder="{{trans('app.email_address')}}" class="form-control input-lg">
			@if ($errors->has('email')) 
				<span class="help-block m-b-none text-danger"><strong>{{ $errors->first('email') }}</strong></span> 
			@endif
		</div>
		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        	<label class="control-label">{{trans('app.password')}}</label>
			<input type="password" name="password" placeholder="{{trans('app.password')}}" class="form-control input-lg">
				 @if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
		</div>
		<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        	<label class="control-label">{{trans('app.confirm_password')}}</label>
			<input type="password" name="password_confirmation" placeholder="{{trans('app.confirm_password')}}" class="form-control input-lg">
				 @if ($errors->has('password_confirmation'))
					<span class="help-block">
						<strong>{{ $errors->first('password_confirmation') }}</strong>
					</span>
				@endif
		</div>
		<div class="line line-dashed"></div>
		    <div class="form-group">
				<div class="col-md-6 col-md-offset-6">
					<button type="submit" class="btn btn-primary">
					<i class="fa fa-refresh"></i> {{trans('app.reset_password')}}
					</button>
				</div>
		</div>
		<div class="line line-dashed"></div>
	</form>
</section>
@endsection
