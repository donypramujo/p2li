@extends('layouts.blank') 
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.report.score')}}</h3>
	<h5 class="m-b-none">{{$contest->name}}</h5>
</div>

<section class="panel panel-default">
				<header class="panel-heading">{{trans('app.score.team')}}</header>
				@if (count($scores) > 0)
				<div class="table-responsive">
					<table class="table table-striped b-t b-light">
						<thead>
							<tr>
								<th>{{trans('app.score.rank')}}</th>
								<th>{{trans('app.team.team_name')}}</th>
								<th>{{trans('app.score.score')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($scores as $index => $score)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$score->team->name}}</td>
								<td>{{number_format($score->score, 2, ',', '.')}}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</section>


@endsection