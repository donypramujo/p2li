@extends('layouts.backend') 


@section('styles')
	 <link href="{{url('public/bootstrap3-editable/css/bootstrap-editable.css')}}" rel="stylesheet">
	 <meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')
	<script src="{{url('public/bootstrap3-editable/js/bootstrap-editable.js')}}"></script>
	<script type="text/javascript">
	
    $(document).ready(function() {
    	$.ajaxSetup({
    		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    	});
    	$.fn.editable.defaults.mode = 'inline';
        $('.score').editable({
            url: "{{action('ScoreController@store')}}",
            error: function(response, newValue) {
            	$('#errors').html('');
            	var errors = response.responseJSON;
				var html = '';
            	$.each(errors,function(index,value){
            		html+='<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>' + value+ "</div>";
                });

            	$('#errors').html(html);
                return false;
            },
            success: function(response, newValue) {
            	$('#errors').html('');
            },
            source: [
                	{value: '', text: ''},
                 {value: 'minor', text: 'Minor'},
                 {value: 'major', text: 'Major'},
            ]
        });
    });
	</script>
@endsection
@section('content')


<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
	<li><a href="{{action('BackendController@index')}}"></i>{{trans('app.home')}}</a></li>
	<li class="active">{{trans('app.score.create')}}</li>
</ul>

<div class="m-b-md">
	<h3 class="m-b-none">{{trans('app.score.create')}} {{trans('app.for')}} {{$subcategory->name}}</h3>
</div>

<div id="errors">
</div>

@if(!empty(old('content')))
<div class="alert alert-{{old('type')}}">
	<button data-dismiss="alert" class="close" type="button"><i class="fa fa-remove"></i></button>
	{{old('content')}}
</div>
@endif

<section class="panel panel-default">
	<header class="panel-heading">{{$subcategory->name}} {{trans('app.score.scores')}} </header>
	<div class="row wrapper">
		<div class="col-sm-3 col-sm-offset-9">
			<div class="input-group">
					<a href="{{action('ScoreController@show',$subcategory->id)}}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i> {{trans('app.print')}} {{trans('app.score.result')}}</a>
					<form method="post" onsubmit="return confirm('{{trans('app.score.confirm_validate',['name'=>$subcategory->name])}}');" action="{{action('ScoreController@update',$subcategory->id)}}" style="display: inline;">
						{!! csrf_field() !!}
						{{ method_field('PUT') }}
						<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-check"></i> {{trans('app.score.validate')}}</button>
					</form>
			</div>
		</div>
	</div>
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
							<th>{{trans('app.score.penalty_type')}}</th>
							<th>{{trans('app.score.penalty')}}</th>
							<th>{{trans('app.score.comment')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($scores as $score)
							<tr>
								@if($score->valid)
								<td>{{$score->contestant->tank_number}}</td>
								<td>{{$score->rate_overall_impression}} %</td>
								<td>{{$score->rate_head}} %</td>
								<td>{{$score->rate_face}} %</td>
								<td>{{$score->rate_body_shape}} %</td>
								<td>{{$score->rate_marking}} %</a></td>
								<td>{{$score->rate_pearl}} %</a></td>
								<td>{{$score->rate_color}} %</a></td>
								<td>{{$score->rate_finnage}} %</a></td>
								<td>{{$score->penalty_type}}</td>
								<td>{{$score->rate_penalty}} %</td>
								<td>{{$score->comment}}</td>
								@else
								<td>{{$score->contestant->tank_number}}</td>
								<td><a href="#" data-type="text" data-name="overall_impression" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_overall_impression}}</a></td>
								<td><a href="#" data-type="text" data-name="head" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_head}}</a></td>
								<td><a href="#" data-type="text" data-name="face" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_face}}</a></td>
								<td><a href="#" data-type="text" data-name="body_shape" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_body_shape}}</a></td>
								<td><a href="#" data-type="text" data-name="marking" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_marking}}</a></td>
								<td><a href="#" data-type="text" data-name="pearl" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_pearl}}</a></td>
								<td><a href="#" data-type="text" data-name="color" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_color}}</a></td>
								<td><a href="#" data-type="text" data-name="finnage" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_finnage}}</a></td>
								<td><a href="#" data-type="select" data-name="penalty_type" data-pk="{{$score->contestant->id}}" class="score" data-value="{{$score->penalty_type}}"></a></td>
								<td><a href="#" data-type="text" data-name="penalty" data-pk="{{$score->contestant->id}}" class="score">{{$score->rate_penalty}}</a></td>
								<td><a href="#" data-type="text" data-name="comment" data-pk="{{$score->contestant->id}}" class="score">{{$score->comment}}</a></td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
</section>




@endsection

