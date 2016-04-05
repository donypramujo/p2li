@extends('layouts.blank') 
@section('content')
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.score.create')}}</h3>
</div>

<section class="panel panel-default">
	<header class="panel-heading">{{$subcategory->name}} {{trans('app.score.scores')}} </header>
	@if (count($scores) > 0)
			<div class="table-responsive">
				<table class="table table-striped b-t b-light">
					<thead>
						<tr>
							<th>{{trans('app.contestant.tank_number')}}</th>
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
								<th>{{trans('app.score.valid')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($scores as $score)
							<tr>
								<td>{{$score->contestant->tank_number}}</td>
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
								<th>{{$score->valid?'TRUE':"FALSE"}}</th>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
</section>

@endsection

