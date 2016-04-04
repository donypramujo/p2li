@extends('layouts.backend') 
@section('nav',action('JuryController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.jury.registration')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.jury.registration')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif


<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.jury.registration')}}</header>
	<div class="panel-body">
		<form id="form" class="form-horizontal" action="{{action('JuryController@store')}}" method="post" autocomplete="off" >
			{!! csrf_field() !!}
			<div class="form-group">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.contest')}}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{$contest->name}} - <span class="text-info">{{$contest->status->name}}</span></p>
				</div>
			</div>
			<div class="form-group {{$errors->has('user_id') ? 'has-error' : '' }}">
				<label class="col-sm-2 control-label font-bold">{{trans('app.jury.jury')}}</label>
				<div class="col-sm-10">
					<select name="user_id" id="select2-option" style="width: 100%;">
						<option value="">&nbsp;</option>
							@foreach ($users as $user)
								<option value="{{$user->id}}" {{(old("user_id") == $user->id ? "selected":"") }}>{{$user->name}}</option>
							@endforeach
					</select>
					@foreach($errors->get('user_id') as $error)
						<span class="help-block m-b-none text-danger">{{$error}}</span>
					@endforeach
				</div>
			</div>
			<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group">
				<div class="col-sm-4 col-sm-offset-2">
					<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{trans('app.jury.register')}}</button>
				</div>
			</div>
		</form>
	</div>
</section>
<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.jury.juries')}}</header>
		@if (count($juries) > 0)
			<div class="table-responsive">
				<table class="table table-striped b-t b-light">
					<thead>
						<tr>
							<th>{{trans('app.user.id')}}</th>
							<th>{{trans('app.user.name')}}</th>
							<th>{{trans('app.user.email')}}</th>
							<th>
								{{trans('app.action')}}
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($juries as $jury)
							<tr>
								<td>{{$jury->id}}</td>
								<td>{{$jury->user->name}}</td>
								<td>{{$jury->user->email}}</td>
								<td>
									@permission('subcategory.destroy')
										<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$jury->user->name])}}');" action="{{action('JuryController@destroy',$jury->id)}}" method="POST" style="display: inline;">
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
</section>

@endsection