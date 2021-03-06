@extends('layouts.blank') 
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.report.team')}}</h3>
	<h5 class="m-b-none">{{$contest->name}}, {{$contest->start_date->format('d M Y')}} <b>{{trans('app.to')}}</b> {{$contest->end_date->format('d M Y')}}</h5>
</div>
@foreach($rows as  $key => $value)
<section class="panel panel-default">
	<header class="panel-heading">	<h2>{{$key}}</h2><h5>Total {{count($value)}}</h5></header>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>{{trans('app.category.category')}}</th>
					<th>{{trans('app.contestant.tank_number')}}</th>
					<th>{{trans('app.contestant.owner')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($value as $index => $contestant)
				<tr>
					<td>{{$index+1}}</td>
					<td>{{$contestant->subcategory->name}}</td>
					<td>{{$contestant->tank_number}}</td>
					<td>{{$contestant->owner}}</td>						
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</section>
@endforeach

@endsection