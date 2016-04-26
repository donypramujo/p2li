@extends('layouts.backend') 
@section('nav',action('TitleController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.title.manage')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.title.manage')}}</h3>
</div>

@if(!empty($message))
<div class="alert alert-danger">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	<span class="font-bold">{{$message}}</span>
</div>
@endif

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.title.manage')}}</header>
	<div class="panel-body">
		<form id="form" action="{{action('TitleController@store')}}" class="form-horizontal" method="post" autocomplete="off" >
			{!! csrf_field() !!}
			<div class="form-group">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.contest')}}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{$contest->name}} - <span class="text-info">{{$contest->status->name}}</span></p>
				</div>
			</div>
			<div class="form-group {{$errors->has('contestant_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contestant.tank_number')}}</label>
				<div class="col-sm-10">
					<select name="contestant_id" class="select2-option"  style="width: 100%;">
						<option value="">&nbsp;</option>
						@foreach ($selectRank as $key_select => $select)
							<optgroup label="{{$key_select}}">
								@foreach ($select as $key => $value)
								<option value="{{$key}}" {{(old("contestant_id") == $key ? "selected":"")}}  >{{$value}}</option>
								@endforeach
							</optgroup>
						@endforeach
					</select>
					<span class="help-block m-b-none text-info">{{trans('app.title.1st_only')}}</span>
					@foreach($errors->get('contestant_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('title_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.title.title')}}</label>
				<div class="col-sm-10">
					<select name="title_id" class="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
						@foreach ($titles as $title)
							<option value="{{$title->id}}" {{(old("title_id") == $title->id ? "selected":"") }}>{{$title->name}}</option>
						@endforeach
					</select>
					@foreach($errors->get('title_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
					<div class="col-sm-4 col-sm-offset-2">
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.submit')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contestant.contestants')}}</header>

	@if (count($contestants) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.contestant.tank_number')}}</th>
					<th>{{trans('app.contestant.owner')}}</th>
					<th>{{trans('app.category.category')}}</th>
					<th>{{trans('app.team.team')}}</th>
					<th>{{trans('app.title.title')}}</th>
					<th>
						{{trans('app.action')}}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($contestants as $contestant)
					<tr>
						<td>{{$contestant->tank_number}}</td>
						<td>{{$contestant->owner}}</td>
						<td>{{$contestant->subcategory->name}}</td>
						<td>{{$contestant->team->name}}</td>
						<td>{{$contestant->title->name}}</td>
						<td>
							<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$contestant->tank_number])}}');" action="{{action('TitleController@destroy',$contestant->id)}}" method="POST" style="display: inline;" >
            					{{ csrf_field() }}
            					{{ method_field('DELETE') }}
           						<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> {{trans('app.delete')}}</button>
        					</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
</section>

@endsection

