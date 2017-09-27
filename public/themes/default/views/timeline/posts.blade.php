<!-- main-section -->
<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('user-header',compact('timeline','liked_pages','user','joined_groups','followRequests','following_count',
			'followers_count','follow_confirm','user_post','joined_groups_count','guest_events')) !!}
			
			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">
						
						
						{!! Theme::partial('user-leftbar',compact('timeline','user','follow_user_status','own_groups','own_pages','user_events')) !!}
					</div>
					<div class="col-md-8">
						@if($timeline->type == "user" && $timeline_post == true)
							{!! Theme::partial('create-post',compact('timeline','user_post')) !!}						
						@endif
						
						<div class="timeline-posts">
							@if($posts->count() > 0)
								@foreach($posts as $post)
									{!! Theme::partial('post',compact('post','timeline','next_page_url')) !!}
								@endforeach
							@else
								<p class="no-posts">{{ trans('messages.no_posts') }}</p>
							@endif
						</div>
					</div><!-- /col-md-8 -->
				</div><!-- /main-content -->
			</div><!-- /row -->
		</div><!-- /col-md-10 -->

		<div class="col-md-2">
			{!! Theme::partial('timeline-rightbar') !!}
		</div>

	</div>
</div><!-- /container -->
