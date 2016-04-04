@extends('layouts.backend') 
@section('nav',action('ScoreController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.score.create')}}</li>
</ul>
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.score.create')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.category.select')}}</header>
	<div class="panel-body">
		<form id="form" action="{{action('ScoreController@create')}}" class="form-horizontal" method="get" autocomplete="off" >
			<div class="form-group {{$errors->has('subcategory_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.category')}}</label>
				<div class="col-sm-10">
					<select name="subcategory_id" class="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($select_subcategories as $key_select => $select)
								<optgroup label="{{$key_select}}">
									@foreach ($select as $key => $value)
										<option value="{{$key}}" {{(old("subcategory_id") == $key ? "selected":"") }}>{{$value}}</option>
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
					<button class="btn btn-primary" type="submit"><i class="fa fa-location-arrow"></i> {{trans('app.submit')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
	

@endsection

