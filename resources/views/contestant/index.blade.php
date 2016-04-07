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
		<form id="form" action="{{action('ContestantController@store')}}" class="form-horizontal" method="post" autocomplete="off" >
			{!! csrf_field() !!}
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
										<option value="{{$subcategory->id}}" {{(old("subcategory_id") == $subcategory->id ? "selected":"") }}>{{$subcategory->name}}</option>
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
								<option value="{{$team->id}}" {{(old("team_id") == $team->id ? "selected":"") }}>{{$team->name}}</option>
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
					<input type="text" name="tank_number" class="form-control" value="{{old('tank_number')}}" maxlength="20">
					@foreach($errors->get('tank_number') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			
			<div class="form-group {{$errors->has('owner') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contestant.owner')}}</label>
				<div class="col-sm-10">
					<input type="text" name="owner" class="form-control" value="{{old('owner')}}" maxlength="20">
					@foreach($errors->get('owner') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
		
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
					<div class="col-sm-4 col-sm-offset-2">
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.contestant.register')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contestant.contestants')}}</header>
	<div class="row wrapper">
		<form method="get" action="{{action('ContestantController@index')}}">
			<div class="row wrapper">
				<div class="col-sm-6 m-b-xs">
					<select name="search_field" class="input-sm form-control input-s-sm inline v-middle">
						<option value="subcategory" {{( $search_field == 'subcategory' ? "selected":"")}} >{{trans('app.category.category')}}</option>
						<option value="team" {{( $search_field == 'team' ? "selected":"")}}>{{trans('app.team.team')}}</option>
						<option value="tank_number" {{( $search_field == 'tank_number' ? "selected":"")}}>{{trans('app.contestant.tank_number')}}</option>
					</select>
				</div>
				<div class="col-sm-6">
					<div class="input-group">
						<input name="search_value" type="text" value="{{$search_value}}" placeholder="Filter" class="input-sm form-control"> <span class="input-group-btn">
						<button type="submit" class="btn btn-sm btn-default">{{trans('app.filter')}}</button>
						<a href="{{action('ContestantController@index')}}" class="btn btn-sm btn-danger">{{trans('app.clear_filter')}}</a>
						</span>
					</div>
				</div>
			</div>
		</form>
	</div>

	@if (count($contestants) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					@sortablelink ('tank_number',trans('app.contestant.tank_number'))
					<th>{{trans('app.contestant.owner')}}</th>
					@sortablelink ('subcategory_id',trans('app.category.category'))
					@sortablelink ('team_id',trans('app.team.team'))
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
						<td>
							@permission('contestant.update')
								<a class="btn btn-info btn-xs" href="{{action('ContestantController@edit',$contestant->id)}}"><i class="fa fa-edit"></i> {{trans('app.edit')}}</a>
							@endpermission
							@permission('contestant.destroy')
								<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$contestant->tank_number])}}');" action="{{action('ContestantController@destroy',$contestant->id)}}" method="POST" style="display: inline;" >
            						{{ csrf_field() }}
            						{{ method_field('DELETE') }}
           							<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> {{trans('app.delete')}}</button>
        						</form>
        					@endpermission
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	@include('pagination.default', ['paginator' => $contestants])
	
</section>

@endsection

