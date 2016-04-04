@extends('layouts.backend') 
@section('nav',action('UserController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.user.manage')}}</li>
</ul>
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.user.manage')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.user.users')}}</header>
	@permission('user.store')
		<div class="row wrapper">
			<div class="col-sm-12 m-b-xs">
				<a class="btn btn-success btn-sm" href="{{action('UserController@create')}}"><i class="fa fa-plus-square"></i> {{trans('app.user.create')}}</a>
			</div>
		</div>
	@endpermission
	@if (count($users) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.user.id')}}</th>
					<th>{{trans('app.user.name')}}</th>
					<th>{{trans('app.user.email')}}</th>
					<th>{{trans('app.user.role')}}</th>
					<th>
						{{trans('app.action')}}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{collect($user->roles)->first()->display_name}}</td>
						<td>
							@permission('user.update')
								<a class="btn btn-info btn-xs" href="{{action('UserController@edit',$user->id)}}"><i class="fa fa-edit"></i> {{trans('app.edit')}}</a>
							@endpermission
							@permission('user.destroy')
								<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$user->name])}}');" action="{{action('UserController@destroy',$user->id)}}" method="POST" style="display: inline;">
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
	@include('pagination.default', ['paginator' => $users])
</section>

@endsection


