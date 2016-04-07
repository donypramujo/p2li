@extends('layouts.blank') 
@section('nav',action('NominationController@index'))
@section('content')

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.nomination.nomination')}}</h3>
</div>


@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contest.contest')}}</header>
	<div class="panel-body">
		<form class="form-horizontal" >
			{!! csrf_field() !!}
			<div class="form-group">
				<label class="col-sm-2 control-label font-bold">{{trans('app.contest.contest')}}</label>
				<div class="col-sm-10">
					<p class="form-control-static">{{$contest->name}}</p>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="panel panel-default">
	<header class="panel-heading font-bold">{{trans('app.contestant.contestants')}}</header>
	@if (count($contestants) > 0)
	<div class="table-responsive">
		<table class="table table-striped b-t b-light">
			<thead>
				<tr>
					@sortablelink ('tank_number',trans('app.contestant.tank_number'))
					@sortablelink ('subcategory_id',trans('app.category.category'))
					@sortablelink ('team_id',trans('app.team.team'))
					<th>
						{{trans('app.action')}}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($contestants as $contestant)
					<tr>
						<td>{{$contestant->tank_number}}</td>
						<td>{{$contestant->subcategory->name}}</td>
						<td>{{$contestant->team->name}}</td>
						<td>
							@permission('nomination.destroy')
								<form onsubmit="return confirm('{{trans('app.confirm_delete',['value'=>$contestant->id])}}');" action="{{action('NominationController@destroy',$contestant->id)}}" method="POST" style="display: inline;" >
            						{{ csrf_field() }}
            						{{ method_field('DELETE') }}
           							<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> {{trans('app.delete')}}</button>
        						</form>
        					@endpermission
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	
</section>

@endsection

