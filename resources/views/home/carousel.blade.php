<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="5000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
<div class="item active">
			<img alt="" class="img-responsive center-block img-thumbnail" src="{{url('public/banner/BrosurLiga.jpg')}}">
			<div class="carousel-caption">
				
			</div>
		</div>
		<?php $flag = TRUE;?>
		@foreach($contestants as $contestant)
		<div class="item {{$flag ? '': ''}}">
			<img alt="" class="img-responsive center-block img-thumbnail" src="{{url($contestant->image->full_path)}}">
			<div class="carousel-caption">
				<h3>{{$contestant->title->name}}</h3>
				<h4>{{$contestant->team->name}}</h4>
				<h6>{{$contestant->contest->name}}</h6>
			</div>
		</div>
		<?php $flag = FALSE;?>
		@endforeach
	</div>

	<!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>