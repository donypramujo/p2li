@extends('layouts.backend') 
@section('nav',action('ContestantController@showCategoryForm'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.contestant.registration')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.contestant.registration')}}</h3>
</div>


@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contestant.registration')}}</header>
	<div class="panel-body">
		<form id="form" action="{{action('ContestantController@create')}}" class="form-horizontal" method="get" autocomplete="off" >
			<div class="form-group {{$errors->has('subcategory_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.select')}}</label>
				<div class="col-sm-10">
					<select name="subcategory_id" id="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($categories as $category)
								<optgroup label="{{$category->name}}">
									@foreach($category->subcategories as $subcategory)
										<option value="{{$subcategory->id}}" {{(old("subcategory") == $subcategory->id ? "selected":"") }}>{{$subcategory->name}}</option>
									@endforeach
								</optgroup>
							@endforeach
					</select>
					@foreach($errors->get('subcategory_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<button class="btn btn-primary" type="submit"><i class="fa fa-caret-right"></i> {{trans('app.category.select')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>

@endsection

