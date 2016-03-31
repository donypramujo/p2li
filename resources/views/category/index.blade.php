@extends('layouts.backend') 
@section('nav',action('CategoryController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.category.manage')}}</li>
</ul>
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.category.manage')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.category.categories')}}</header>
	@permission('category.store')
		<div class="row wrapper">
			<div class="col-sm-12 m-b-xs">
				<a class="btn btn-success btn-sm" href="{{action('CategoryController@create')}}"><i class="fa fa-plus-square"></i> {{trans('app.category.create')}}</a>
			</div>
		</div>
	@endpermission
	@if (count($categories) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.category.id')}}</th>
					<th>{{trans('app.category.name')}}</th>
					<th>{{trans('app.category.overall_impression')}}</th>
					<th>{{trans('app.category.head')}}</th>
					<th>{{trans('app.category.face')}}</th>
					<th>{{trans('app.category.body_shape')}}</th>
					<th>{{trans('app.category.marking')}}</th>
					<th>{{trans('app.category.pearl')}}</th>
					<th>{{trans('app.category.color')}}</th>
					<th>{{trans('app.category.finnage')}}</th>
					<th>
						{{trans('app.action')}}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{$category->id}}</td>
						<td>{{$category->name}}</td>
						<td>{{$category->rate_overall_impression}} %</td>
						<td>{{$category->rate_head}} %</td>
						<td>{{$category->rate_face}} %</td>
						<td>{{$category->rate_body_shape}} %</td>
						<td>{{$category->rate_marking}} %</td>
						<td>{{$category->rate_pearl}} %</td>
						<td>{{$category->rate_color}} %</td>
						<td>{{$category->rate_finnage}} %</td>
						<td>
							@permission('category.update')
								<a class="btn btn-info btn-xs" href="{{action('CategoryController@edit',$category->id)}}"><i class="fa fa-edit"></i> {{trans('app.edit')}}</a>
							@endpermission
							@permission('category.destroy')
								<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$category->name])}}');" action="{{action('CategoryController@destroy',$category->id)}}" method="POST" style="display: inline;" >
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
	@include('pagination.default', ['paginator' => $categories])
</section>
@endsection


