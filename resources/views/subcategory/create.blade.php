@extends('layouts.backend') 
@section('nav',action('SubcategoryController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li><a href="{{action('SubcategoryController@index')}}">{{trans('app.subcategory.manage')}}</a></li>
	<li class="active">{{trans('app.subcategory.create')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.subcategory.create')}}</h3>
</div>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.subcategory.subcategory')}}</header>
	<div class="panel-body">
		<form action="{{action('SubcategoryController@store')}}" method="post" class="form-horizontal" autocomplete="off">
			{!! csrf_field() !!}
			<div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.subcategory.name')}}</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{old('name')}}" maxlength="50">
					@foreach($errors->get('name') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
				
			</div>
			<div class="form-group {{$errors->has('category_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.category')}}</label>
				<div class="col-sm-10">
					<select name="category_id" id="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($categories as $category)
								<option value="{{$category->id}}" {{(old("category_id") == $category->id ? "selected":"") }}>{{$category->name}}</option>
							@endforeach
					</select>
					@foreach($errors->get('category_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('SubcategoryController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.create')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection



