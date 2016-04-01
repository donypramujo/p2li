@extends('layouts.backend') 
@section('nav',action('SubcategoryController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.subcategory.manage')}}</li>
</ul>
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.subcategory.manage')}}</h3>
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.subcategory.subcategories')}}</header>
	@permission('subcategory.store')
		<div class="row wrapper">
			<div class="col-sm-12 m-b-xs">
				<a class="btn btn-success btn-sm" href="{{action('SubcategoryController@create')}}"><i class="fa fa-plus-square"></i> {{trans('app.subcategory.create')}}</a>
			</div>
		</div>
	@endpermission
	@if (count($subcategories) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.subcategory.id')}}</th>
					<th>{{trans('app.subcategory.name')}}</th>
					<th>{{trans('app.category.category')}}</th>
					<th>
						{{trans('app.action')}}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subcategories as $subcategory)
					<tr>
						<td>{{$subcategory->id}}</td>
						<td>{{$subcategory->name}}</td>
						<td>{{$subcategory->category->name}}</td>
						<td>
							@permission('subcategory.update')
								<a class="btn btn-info btn-xs" href="{{action('SubcategoryController@edit',$subcategory->id)}}"><i class="fa fa-edit"></i> {{trans('app.edit')}}</a>
							@endpermission
							@permission('subcategory.destroy')
								<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$subcategory->name])}}');" action="{{action('SubcategoryController@destroy',$subcategory->id)}}" method="POST" style="display: inline;">
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
	@include('pagination.default', ['paginator' => $subcategories])
</section>
@endsection


