@extends('layouts.frontend') 
@section('content')

<div class="bg-dark lt">
	<div class="container">
		<div class="m-b-lg m-t-lg">
			<h3 class="m-b-none">{{trans('app.live_score.s')}}</h3>
			<small class="text-muted">{{trans('app.name')}}</small>
		</div>
	</div>
</div>
<div class="bg-white b-b b-light">
	<div class="container">
		<ul class="breadcrumb no-border bg-empty m-b-none m-l-n-sm">
			<li><a href="{{action('HomeController@index')}}">{{trans('app.home')}}</a></li>
			<li class="active">{{trans('app.live_score.s')}}</li>
		</ul>
	</div>
</div>

<div>
	<div class="container m-t-xl">
		<div class="row">
	@include('home.carousel')
	</div>
	</div>
</div>


<div>
<div class="container m-t-xl">
	<div class="row">
		<div class="col-sm-12">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">{{trans('app.filter')}}</header>
				<div class="panel-body">
					<form action="" method="get" class="form-horizontal" autocomplete="off">
						<div class="form-group">
							<label class="col-sm-2 control-label font-bold">Contest</label>
							<div class="col-sm-10">
								<p class="form-control-static">{{$contest->name}}</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label font-bold">{{trans('app.contest.period')}}</label>
							<div class="col-sm-10">
								<p class="form-control-static">{{$contest->start_date->format('d M Y')}} <b>{{trans('app.to')}}</b> {{$contest->end_date->format('d M Y')}}</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label font-bold">{{trans('app.category.category')}}</label>
							<div class="col-sm-10">
								<select name="subcategory_id" class="select2-option" style="width: 100%;">
									<option value="">&nbsp;</option> 
									@foreach ($select_subcategories as $key_select => $select)
										<optgroup label="{{$key_select}}">
											@foreach ($select as $key => $value)
											<option value="{{$key}}" {{ isset($subcategory) && $subcategory->id ==$key? 'selected':''}}  >{{$value}}</option>
											@endforeach
										</optgroup>
									@endforeach
								</select>
							</div>
						</div>
						<div class="line line-dashed line-lg pull-in"></div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								<button class="btn btn-default" type="submit">
									<i class="fa fa-search"></i> {{trans('app.search')}}
								</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
		@if(!empty($liveScores))
		<div class="col-sm-12">
			<section class="panel panel-default">
				<header class="panel-heading">{{$subcategory->name}} {{trans('app.score.scores')}}</header>
				@if (count($liveScores) > 0)
				<div class="table-responsive">
					<table class="table table-striped b-t b-light">
						<thead>
							<tr>
								<th>{{trans('app.score.rank')}}</th>
								<th>{{trans('app.contestant.tank_number')}}</th>
								@if( $contest->status->name == 'Completed')
								<th>{{trans('app.team.team')}}</th>
								@endif
									<th>{{trans('app.image.image')}}</th>
								<th>{{trans('app.score.grand_total')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($liveScores as $index => $liveScore)
							<tr>
								
								<td>{{$index+1}}</td>
								<td>{{$liveScore->tank_number}}</td>
									@if( $contest->status->name == 'Completed')
								<td>{{$liveScore->team->name}}</td>
								@endif
									@if(is_null($liveScore->contestant->image))
							<td>-</td>
						@else
							<td><a href="#" data-remote="{{url($liveScore->contestant->image->full_path)}}" data-toggle="lightbox"><img class="img-responsive" src="{{url($liveScore->contestant->small_image->full_path)}}" alt="{{trans('app.image.no_image')}}" width="80"  height="60"></a></td>
						@endif
								<td><a href="{{action('HomeController@show',$liveScore->id)}}" class="text-info">{{$liveScore->score}}</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</section>
		</div>
		@endif
	</div>
</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    	event.preventDefault();
   	 $(this).ekkoLightbox();
	});
	</script>
@endsection