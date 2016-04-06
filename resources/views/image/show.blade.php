@extends('layouts.backend') 
@section('nav',action('ImageController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('ImageController@index')}}"></i>{{trans('app.image.upload')}}</a></li>
	<li class="active">{{trans('app.image.upload')}} {{trans('app.for').' '.trans('app.contestant.tank_number')}} {{$contestant->tank_number}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.image.upload')}}</h3>
	<h5 class="m-b-none">{{$contestant->contest->name}} - <span class="text-info">{{$contestant->contest->status->name}}</h5>
</div>


<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contestant.contestant')}}</header>
	<div class="panel-body">
		<form action="{{action('ImageController@store')}}" method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<input type="hidden" name="id" value="{{$contestant->id}}">
			<div class="form-group">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.category')}}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{$contestant->subcategory->name}}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contestant.tank_number')}}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{$contestant->tank_number}}</p>
				</div>
			</div>
			<div class="form-group {{$errors->has('image') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.image.image')}}</label>
				<div class="col-sm-10">
					 <input type="file" name="image" class="filestyle" value="{{old('image')}}" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s">
					@foreach($errors->get('image') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('ImageController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.create')}}</button>
				</div>
			</div>
		</form>

	</div>
</section>


@endsection

