@extends('layouts.backend') 
@section('nav',action('TeamController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.team.manage')}}</li>
</ul>
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.team.manage')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

{{old('message')}}
<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.team.teams')}}</header>
	@can('team.store')
		<div class="row wrapper">
			<div class="col-sm-12 m-b-xs">
				<a class="btn btn-success btn-sm" href="{{action('TeamController@create')}}"><i class="fa fa-plus-square"></i> {{trans('app.team.create')}}</a>
			</div>
		</div>
	@endcan
	@if (count($teams) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.team.id')}}</th>
					@sortablelink ('name',trans('app.team.name'))
					<th>
						{{trans('app.action')}}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($teams as $team)
					<tr>
						<td>{{$team->id}}</td>
						<td>{{$team->name}}</td>
						<td>
							@can('team.update')
								<a class="btn btn-info btn-xs" href="{{action('TeamController@edit',$team->id)}}"><i class="fa fa-edit"></i> {{trans('app.edit')}}</a>
							@endcan
							@can('team.destroy')
								<form action="{{action('TeamController@destroy',$team->id)}}" method="POST" style="display: inline;">
            						{{ csrf_field() }}
            						{{ method_field('DELETE') }}
           							<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> {{trans('app.delete')}}</button>
        						</form>
        					@endcan
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	@include('pagination.default', ['paginator' => $teams])
</section>
@endsection


