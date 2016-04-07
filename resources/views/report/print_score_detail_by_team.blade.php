@extends('layouts.blank') 
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.report.score_detail_by_team')}}</h3>
	<h5 class="m-b-none">{{$contest->name}}</h5>
</div>

<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.team.team')}} : {{$team->name}}</header>
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
						</tr>
					</thead>
					<tbody>
						<?php $tank_number=-1; ?>
						<?php $total=0; ?>
						<?php $print_tank_number=''; ?>
						@foreach($scores as $score)
							@if($tank_number == $score->contestant->tank_number)
								<?php $print_tank_number='&nbsp;';?>
							@else
							    <?php $tank_number=$score->contestant->tank_number; ?>
							    <?php $print_tank_number=$score->contestant->tank_number?>
							    @if($total != 0 )
							    	<tr>
							    		<td colspan="10" class="font-bold">&nbsp;</td>
							    		<td colspan="2" class="font-bold">{{number_format($total, 2, ',', '.')}}</td>
							    	</tr>
							    	<?php $total=0;?>
							    @endif
							@endif
							<tr>
								<td>{{$print_tank_number}}</td>
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
							<?php $total+=$score->score_final; ?>
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
</section>


@endsection