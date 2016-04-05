@extends('layouts.backend') 
@section('nav',action('ContestController@index'))
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.contest.current')}}</li>
</ul>
	
<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.contest.current')}}</h3>
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
		<div class="form-horizontal">
			<form id="form" action="{{action('ContestController@update',$contest->id)}}" method="post" autocomplete="off" 
				onsubmit="return confirm('{{trans('app.contest.confirm_change_status',['value'=>$contest->name])}}');">
				{!! csrf_field() !!}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-2 control-label font-bold">{{trans('app.contest.name')}}</label>
					<div class="col-sm-10">
						<p class="form-control-static">{{$contest->name}}</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label font-bold">{{trans('app.contest.period')}}</label>
					<div class="col-sm-10">
						<p class="form-control-static">{{$contest->start_date->format('d M Y')}} <b>{{trans('app.to')}}</b> {{$contest->end_date->format('d M Y')}}</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label font-bold">{{trans('app.contest.status')}}</label>
					<div class="col-sm-10">
						<p class="form-control-static">{{$contest->status->name}} </p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label font-bold text-info">{{trans('app.status.next')}}</label>
					<div class="col-sm-10">
						<p class="form-control-static text-success font-bold">
							@if($contest->status->name == trans('app.status.preparation'))
								{{trans('app.status.nomination')}}
							@elseif($contest->status->name == trans('app.status.nomination'))
								{{trans('app.status.ongoing')}}
							@elseif($contest->status->name == trans('app.status.ongoing'))
								{{trans('app.status.completed')}}
							@endif
						</p>
					</div>
				</div>
			</form>
			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-2">
					<button class="btn btn-primary" onclick="$('#form').submit();"><i class="fa fa-recycle"></i> {{trans('app.status.change')}}</button>
					<form action="{{action('ContestController@destroy',$contest->id)}}" method="post" style="display: inline;"
						onsubmit="return confirm('{{trans('app.contest.confirm_cancel')}}');" >
            			{!! csrf_field() !!}
            			{{ method_field('DELETE') }}
						<button class="btn btn-danger" type="submit"><i class="fa fa-power-off"></i> {{trans('app.contest.cancel')}}</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
