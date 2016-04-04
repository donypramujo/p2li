@extends('layouts.backend') 
@section('nav',action('ContestantController@index'))
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
		<form id="form" action="{{action('ContestantController@update',$contestant->id)}}" class="form-horizontal" method="post" autocomplete="off" >
			{!! csrf_field() !!}
			{{ method_field('PUT') }}
			<div class="form-group">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.contest')}}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{$contest->name}} - <span class="text-info">{{$contest->status->name}}</span></p>
				</div>
			</div>
			<div class="form-group {{$errors->has('subcategory_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.category.category')}}</label>
				<div class="col-sm-10">
					<select name="subcategory_id" class="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($categories as $category)
								<optgroup label="{{$category->name}}">
									@foreach($category->subcategories as $subcategory)
										<option value="{{$subcategory->id}}"  {{( ($errors->has() ? old('subcategory_id') : $contestant->subcategory_id) == $subcategory->id ? "selected":"") }}>{{$subcategory->name}}</option>
									@endforeach
								</optgroup>
							@endforeach
					</select>
					@foreach($errors->get('subcategory_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('team_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.team.team')}}</label>
				<div class="col-sm-10">
					<select name="team_id" class="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($teams as $team)
								<option value="{{$team->id}}" {{( ($errors->has() ? old('team_id') : $contestant->team_id) == $team->id ? "selected":"") }}>{{$team->name}}</option>
							@endforeach
					</select>
					@foreach($errors->get('team_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('tank_number') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contestant.tank_number')}}</label>
				<div class="col-sm-10">
					<input type="text" name="tank_number" class="form-control" value="{{ $errors->has() ? old('tank_number') : $contestant->tank_number }}" maxlength="20">
					@foreach($errors->get('tank_number') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
		
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<a href="{{action('ContestantController@index')}}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('app.cancel')}}</a>
					<button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> {{trans('app.edit')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>

@endsection