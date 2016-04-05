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
			<li><a href="{{action('HomeController@index')}}">{{trans('app.live_score.s')}}</a></li>
			<li class="active">{{trans('app.score.detail')}}</li>
		</ul>
	</div>
</div>

<div class="container m-t-xl">
	<div class="row">
		<div class="col-sm-12">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">{{trans('app.contestant.contestant')}}</header>
				<div class="panel-body">
					<form action="" method="get" class="form-horizontal" autocomplete="off">
						<div class="form-group">
							<label class="col-sm-2 control-label font-bold">Contest</label>
							<div class="col-sm-10">
								<p class="form-control-static">{{$contestant->contest->name}}</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label font-bold">{{trans('app.category.category')}}</label>
							<div class="col-sm-10">
								<p class="form-control-static">{{$contestant->subcategory->name}}</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label font-bold">{{trans('app.contestant.tank_number')}}</label>
							<div class="col-sm-10">
								<p class="form-control-static">{{$contestant->tank_number}}</p>
							</div>
						</div>
						<div class="line line-dashed line-lg pull-in"></div>
					</form>
					
				</div>
			</section>
		</div>
		@if(!empty($scores))
		<div class="col-sm-12">
			<section class="panel panel-default">
				<header class="panel-heading">{{trans('app.score.detail')}}</header>
				@if (count($scores) > 0)
				<div class="table-responsive">
					<table class="table table-striped b-t b-light">
						<thead>
							<tr>
								<th>{{trans('app.category.overall_impression')}}</th>
								<th>{{trans('app.category.head')}}</th>
								<th>{{trans('app.category.face')}}</th>
								<th>{{trans('app.category.body_shape')}}</th>
								<th>{{trans('app.category.marking')}}</th>
								<th>{{trans('app.category.pearl')}}</th>
								<th>{{trans('app.category.color')}}</th>
								<th>{{trans('app.category.finnage')}}</th>
								<th>{{trans('app.score.penalty')}}</th>
								<th>{{trans('app.score.total')}}</th>
								<th>{{trans('app.score.comment')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($scores as $score)
							<tr>
								<td>{{number_format($score->score_overall_impression, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_head, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_face, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_body_shape, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_marking, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_pearl, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_color, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_finnage, 2, ',', '.')}}</td>
								<td>{{number_format($score->score_penalty, 2, ',', '.')}}</td>
								
								<td>{{number_format($score->score_final, 2, ',', '.')}}</td>
								<td>{{$score->comment}}</td>
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