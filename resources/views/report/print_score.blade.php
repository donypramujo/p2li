@extends('layouts.blank') 
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.report.score')}}</h3>
	<h5 class="m-b-none">{{$contest->name}}</h5>
</div>

<section class="panel panel-default">
	<header class="panel-heading">{{$subcategory->name}} {{trans('app.score.scores')}}</header>
	@if (count($liveScores) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.score.rank')}}</th>
					<th>{{trans('app.contestant.tank_number')}}</th>
					<th>{{trans('app.team.team')}}</th>
					<th>{{trans('app.score.grand_total')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($liveScores as $index => $liveScore)
				<tr>
					<td>{{$index+1}}</td>
					<td>{{$liveScore->tank_number}}</td>
					<td>{{$liveScore->team->name}}</td>
					<td><a href="{{action('HomeController@show',$liveScore->id)}}" class="text-info">{{$liveScore->score}}</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
</section>


@endsection