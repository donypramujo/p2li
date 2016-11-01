@extends('layouts.frontend') 
@section('content')

<div class="bg-dark lt">
	<div class="container">
		<div class="m-b-lg m-t-lg">
			<h3 class="m-b-none">{{trans('app.live_score.breeder')}}</h3>
			<small class="text-muted">{{trans('app.name')}}</small>
		</div>
	</div>
</div>
<div class="bg-white b-b b-light">
	<div class="container">
		<ul class="breadcrumb no-border bg-empty m-b-none m-l-n-sm">
			<li><a href="{{action('HomeController@index')}}">{{trans('app.home')}}</a></li>
			<li class="active">{{trans('app.live_score.breeder')}}</li>
		</ul>
	</div>
</div>

<div class="container m-t-xl">
	<div class="row">
		<div class="col-sm-12">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">{{trans('app.contest.contest')}}</header>
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
					</form>
				</div>
			</section>
		</div>
		@if(!empty($scores))
		<div class="col-sm-12">
			<section class="panel panel-default">
				<header class="panel-heading">{{trans('app.live_score.breeder')}}</header>
				@if (count($scores) > 0)
				<div class="table-responsive">
					<table class="table table-striped b-t b-light">
						<thead>
							<tr>
								<th>{{trans('app.score.rank')}}</th>
								<th>{{trans('app.breeder.breeder_name')}}</th>
								<th>{{trans('app.score.score')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($scores as $index => $score)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$score->breeder->name}}</td>
								<td>{{number_format($score->score, 2, ',', '.')}}</td>
								
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


@endsection