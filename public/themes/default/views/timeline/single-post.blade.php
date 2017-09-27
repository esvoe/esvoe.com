<!-- main-section -->
	<!-- <div class="main-content"> -->
		<div class="container container-grid">
			<div class="row">
				<div class="visible-lg col-lg-3 hide-1">
					{!! Theme::partial('advertising') !!}
				</div>
				<div class="col-md-5 col-md-push-7 col-lg-4 col-lg-push-5 col-grid-2">
					<div class="sm-desc-prof">
						{!! Theme::partial('home-rightbar',compact('suggested_users', 'suggested_groups', 'suggested_pages')) !!}
					</div>
				</div>
                <div class="col-md-7 col-md-pull-5 col-lg-5 col-lg-pull-4 col-grid-1">

					<div class="timeline-posts">
						@if($mode == 'posts')
							{!! Theme::partial('post',compact('post','timeline')) !!}
						@elseif($mode == 'notifications')
							{!! Theme::partial('allnotifications',compact('notifications')) !!}
						@endif							
					</div>
				</div><!-- /col-md-6 -->


			</div>
		</div>
	<!-- </div> -->
<!-- /main-section -->
<script>
	$(function () {
		$('.wrap-show-comment').show();
    })
</script>