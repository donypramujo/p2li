<footer class="panel-footer">
	<div class="row">
		<div class="col-sm-4 hidden-xs">
		</div>
		<div class="col-sm-4 text-center">
			<small class="text-muted inline m-t-sm m-b-sm">
			
			@if($paginator->total() == 1)
				{{trans('pagination.one_item_found')}}
			@elseif( $paginator->total() <=  $paginator->perPage())
			 	{{	trans('pagination.all_items_found',[
						'total'=>$paginator->total()
					])
				}}
			@elseif($paginator->count() > 0)
				{{	trans('pagination.some_items_found',[
						'total'=>$paginator->total(),
						'start'=>(($paginator->currentPage()-1) * $paginator->perPage()) +1,
						'end'=>((($paginator->currentPage()-1) * $paginator->perPage()) ) + $paginator->count()
					])
				}}
			@else
				{{trans('pagination.no_items_found')}}
			@endif
			</small>
		</div>
		<div class="col-sm-4 text-right text-center-xs">
			@if ($paginator->lastPage() > 1)
				<ul class="pagination pagination-sm m-t-none m-b-none">
	    			<li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
	    				@if($paginator->currentPage() == 1)
	    		 			<a href="#"><i class="icon-chevron-left"></i></a>
	    				@else
	        				<a href="{{ $paginator->url($paginator->currentPage()-1) }}"><i class="icon-chevron-left"></i></a>
	        			@endif
	    			</li>
	    		@for ($i = 1; $i <= $paginator->lastPage(); $i++)
	        		<li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
	            		<a href="{{ $paginator->url($i) }}">{{ $i }}</a>
	        		</li>
	    		@endfor
	    			<li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}">
	    				@if($paginator->currentPage() == $paginator->lastPage())
	    		 			<a href="#" ><i class="icon-chevron-right"></i></a>
	    				@else
	    					<a href="{{ $paginator->url($paginator->currentPage()+1) }}" ><i class="icon-chevron-right"></i></a>
	    				@endif
	    			</li>
				</ul>
			@endif
		</div>
	</div>
</footer>

