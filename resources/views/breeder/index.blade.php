@extends('layouts.backend') 
@section('nav',action('BreederController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.breeder.manage')}}</li>
</ul>
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.breeder.manage')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.breeder.breeders')}}</header>
	@permission('team.store')
		<div class="row wrapper">
			<div class="col-sm-12 m-b-xs">
				<a class="btn btn-success btn-sm" href="{{action('BreederController@create')}}"><i class="fa fa-plus-square"></i> {{trans('app.breeder.create')}}</a>
			</div>
		</div>
	@endpermission
	@if (count($breeders) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.breeder.id')}}</th>
					@sortablelink ('name',trans('app.breeder.name'))
					<th>
						{{trans('app.action')}}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($breeders as $breeder)
					<tr>
						<td>{{$breeder->id}}</td>
						<td>{{$breeder->name}}</td>
						<td>
							@permission('team.update')
								<a class="btn btn-info btn-xs" href="{{action('BreederController@edit',$breeder->id)}}"><i class="fa fa-edit"></i> {{trans('app.edit')}}</a>
							@endpermission
							@permission('team.destroy')
								<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$breeder->name])}}');" action="{{action('BreederController@destroy',$breeder->id)}}" method="POST" style="display: inline;">
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
	@include('pagination.default', ['paginator' => $breeders])
</section>
@endsection


