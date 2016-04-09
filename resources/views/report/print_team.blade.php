@extends('layouts.blank') 
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.report.team')}}</h3>
	<h5 class="m-b-none">{{$contest->name}}</h5>
</div>

<section class="panel panel-default">
	<header class="panel-heading">{{trans('app.report.team')}}</header>
	@if (count($contestants) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					<th>{{trans('app.team.team')}}</th>
					<th>{{trans('app.category.category')}}</th>
					<th>No.</th>
					<th>{{trans('app.contestant.tank_number')}}</th>
					<th>{{trans('app.contestant.owner')}}</th>
				</tr>
			</thead>
			<tbody>
			<?php $team_id = NULL;?>
			<?php $team_name = NULL;?>
			<?php $subcategory_id = NULL;?>
			<?php $subcategory_name = NULL;?>
				<?php $index=1;?>
				@foreach($contestants as  $contestant)
					@if($team_id == $contestant->team->id)
						<?php $team_name=' ';?>
						@if($subcategory_id == $contestant->subcategory->id)
							<?php $subcategory_name = ' ';?>
							<?php $index++;?>
						@else
							<?php $subcategory_id = $contestant->subcategory->id;?>
							<?php $subcategory_name = $contestant->subcategory->name;?>
							<?php $index=1;?>
						@endif
					@else
						<?php $team_id=$contestant->team->id;?>
						<?php $team_name=$contestant->team->name;?>
						<?php $subcategory_id = $contestant->subcategory->id;?>
						<?php $subcategory_name = $contestant->subcategory->name;?>
						<?php $index=1;?>
					@endif
				<tr>
					<td class="font-bold">{{$team_name}}</td>
					<td class="font-bold">{{$subcategory_name}}</td>
					<td>{{$index}}</td>	
					<td>{{$contestant->tank_number}}</td>
					<td>{{$contestant->owner}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
</section>


@endsection