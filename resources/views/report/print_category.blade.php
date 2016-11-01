@extends('layouts.blank') 
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">Report Contestant per Category</h3>
	<h5 class="m-b-none">{{$contest->name}}, {{$contest->start_date->format('d M Y')}} <b>{{trans('app.to')}}</b> {{$contest->end_date->format('d M Y')}}</h5>
</div>

<section class="panel panel-default">
	<header class="panel-heading">Report Contestant per Category</header>


	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>{{trans('app.category.category')}}</th>
					<th>Total</th>
					<th>Tank No.</th>
				</tr>
			</thead>
			<tbody>
			<?php $total=0;?>
			@foreach($categories as $category)
				<tr>
					<td>{{$category->subcategory->name}}</td>
					<td>{{$category->count_tank_number}}</td>
					<td>{{$category->list_tank_number}}</td>
				</tr>
				<?php $total+=$category->count_tank_number?>
			@endforeach
			
				<tr>
					<td><h4>Total</h4></td>
					<td colspan="2"><h4>{{$total}}</h4></td>
				</tr>
			</tbody>
		</table>
	</div>

</section>

@endsection