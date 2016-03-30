@extends('layouts.auth') 

<!-- Main Content -->
@section('content')
<a class="navbar-brand block" href="{{action('BackendController@index')}}">{{trans('app.short_name')}}</a>
<section class="panel panel-default bg-white m-t-lg">
	<header class="panel-heading text-center">
		<strong>{{trans('app.reset_password')}}</strong>
	</header>
	 @if (session('status'))
     	<div class="alert alert-success">
        	{{ session('status') }}
        </div>
    @endif
	<form role="form" method="POST" action="{{ action('Auth\PasswordController@sendResetLinkEmail') }}" class="panel-body wrapper-lg" >
		{!! csrf_field() !!}
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<label class="control-label">{{trans('app.email_address')}}</label> 
			<input type="email" name="email" value="{{ old('email') }}" placeholder="{{trans('app.email_address')}}" class="form-control input-lg">
			@if ($errors->has('email')) 
				<span class="help-block m-b-none text-danger"><strong>{{ $errors->first('email') }}</strong></span> 
			@endif
		</div>
		<div class="line line-dashed"></div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						 <i class="fa fa-envelope"></i> Send Password Reset Link
					</button>
				</div>
		</div>
		<div class="line line-dashed"></div>
	</form>
</section>
@endsection
