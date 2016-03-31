@extends('layouts.backend') 
@section('nav',action('CategoryController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('CategoryController@index')}}">{{trans('app.category.manage')}}</a></li>
	<li class="active">{{trans('app.category.edit')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.category.edit')}}</h3>
</div>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.category.category')}}</header>
	<div class="panel-body">
		<form action="{{action('CategoryController@update',$category->id)}}" method="post" class="form-horizontal" autocomplete="off">
			{!! csrf_field() !!}
			{{ method_field('PUT') }}
			<div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.name')}}</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{ $errors->has() ? old('name') : $category->name }}" maxlength="20">
					@foreach($errors->get('name') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('rate_overall_impression') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.overall_impression')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_overall_impression" class="form-control" value="{{$errors->has() ? old('rate_overall_impression') : $category->rate_overall_impression}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_overall_impression') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('rate_head') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.head')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_head" class="form-control" value="{{$errors->has() ? old('rate_head') : $category->rate_head}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_head') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('rate_face') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.face')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_face" class="form-control" value="{{$errors->has() ? old('rate_face') : $category->rate_face}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_face') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('rate_body_shape') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.body_shape')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_body_shape" class="form-control" value="{{$errors->has() ? old('rate_body_shape') : $category->rate_body_shape}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_body_shape') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			
			<div class="form-group {{$errors->has('rate_marking') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.marking')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_marking" class="form-control" value="{{$errors->has() ? old('rate_marking') : $category->rate_marking}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_marking') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('rate_pearl') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.pearl')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_pearl" class="form-control" value="{{$errors->has() ? old('rate_pearl') : $category->rate_pearl}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_pearl') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('rate_color') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.color')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_color" class="form-control" value="{{$errors->has() ? old('rate_color') : $category->rate_color}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_color') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('rate_finnage') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.finnage')}}</label>
				<div class="col-sm-10">
					<div class="input-group m-b-none">
						<input type="text" name="rate_finnage" class="form-control" value="{{$errors->has() ? old('rate_finnage') : $category->rate_finnage}}" maxlength="5"> <span class="input-group-addon">%</span>
					</div>
					@foreach($errors->get('rate_finnage') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('CategoryController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.create')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



