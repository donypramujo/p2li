@extends('layouts.backend') 
@section('nav',action('ImageController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.image.upload')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.image.upload')}}</h3>
	<h5 class="m-b-none">{{$contest->name}} - <span class="text-info">{{$contest->status->name}}</h5>
</div>


@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contestant.contestants')}}</header>
	<div class="row wrapper">
		<form method="get" action="{{action('NominationController@index')}}">
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
						<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-filter"></i> {{trans('app.filter')}}</button>
						<a href="{{action('NominationController@index')}}" class="btn btn-sm btn-danger"><i class="fa fa-refresh"></i> {{trans('app.clear_filter')}}</a>
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
					<th>{{trans('app.image.image')}}</th>
					@sortablelink ('tank_number',trans('app.contestant.tank_number'))
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
						@if(is_null($contestant->image))
							<td>-</td>
						@else
							<td><a data-remote="{{url($contestant->image->path.$contestant->image->file_name)}}" data-toggle="lightbox"><img src="{{url($contestant->image->path.'resize/'.$contestant->image->file_name)}}" alt="{{trans('app.image.no_image')}}" width="80"  height="60"></a></td>
						@endif
						<td>{{$contestant->tank_number}}</td>
						<td>{{$contestant->subcategory->name}}</td>
						<td>{{$contestant->team->name}}</td>
						<td>
							<a class="btn btn-info btn-xs" href="{{action('ImageController@show',$contestant->id)}}"><i class="fa fa-file-image-o"></i> {{trans('app.image.upload')}}</a>
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
@section('scripts')
<script type="text/javascript">
	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    	event.preventDefault();
   	 $(this).ekkoLightbox();
	});
	</script>
@endsection
