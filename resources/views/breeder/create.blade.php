@extends('layouts.backend') 
@section('nav',action('BreederController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('BreederController@index')}}">{{trans('app.breeder.manage')}}</a></li>
	<li class="active">{{trans('app.breeder.create')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.breeder.create')}}</h3>
</div>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.breeder.breeder')}}</header>
	<div class="panel-body">
		<form action="{{action('BreederController@store')}}" method="post" class="form-horizontal" autocomplete="off">
			{!! csrf_field() !!}
			<div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.breeder.name')}}</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{old('name')}}" maxlength="50">
					@foreach($errors->get('name') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('BreederController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.create')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



