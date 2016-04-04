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
                 {value: 'minor', text: 'Minor'},
                 {value: 'major', text: 'Major'},
            ]
        });
    });
	</script>
@endsection
@section('content')
<div id="errors">
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
							<th>{{trans('app.score.penalty_type')}}</th>
							<th>{{trans('app.score.penalty')}}</th>
							<th>{{trans('app.score.comment')}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($scores as $score)
							<tr>
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
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
</section>




@endsection

