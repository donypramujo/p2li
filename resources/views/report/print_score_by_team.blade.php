@extends('layouts.blank') 
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.report.score_by_team')}}</h3>
	<h5 class="m-b-none">{{$contest->name}}</h5>
</div>

<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.team.team')}} : {{$team->name}}</header>
	@if (count($liveRanks) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.contestant.tank_number')}}</th>
					<th>{{trans('app.category.category')}}</th>
					<th>{{trans('app.score.rank')}}</th>
					<th>{{trans('app.score.grand_total')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($liveRanks as $rank)
				<tr>
					<td>{{$rank->tank_number}}</td>
					<td>{{$rank->subcategory->name}}</td>
					<td>{{$rank->rank}}</td>
					<td>{{$rank->score}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
</section>


@endsection