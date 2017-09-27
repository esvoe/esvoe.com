<!-- main-section -->
<div class="container">
	<div class="row">
		<div class="col-md-10">

			{!! Theme::partial('group-header',compact('timeline','group')) !!}

			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">

						{!! Theme::partial('group-leftbar',compact('timeline','group','group_members','group_events','ongoing_events','upcoming_events')) !!}
					</div>

					<div class="col-md-8">
						@if($timeline->type == "group")						
							@if($group->post_privacy == "only_admins" && $group->is_admin(Auth::user()->id))
								{!! Theme::partial('create-post',compact('timeline','user_post','username')) !!}	
							@elseif($group->post_privacy == "members" && (Auth::user()->get_group($group->id) == 'approved') || $group->is_admin(Auth::user()->id))
								{!! Theme::partial('create-post',compact('timeline','user_post','username')) !!}	
							@elseif($group->post_privacy == "everyone")		
								{!! Theme::partial('create-post',compact('timeline','user_post','username')) !!}	
							@endif
						@endif	

						<div class="timeline-posts">
							
							@if($posts->count() > 0)
								@foreach($posts as $post)
									{!! Theme::partial('post',compact('post','timeline','next_page_url')) !!}
								@endforeach
							@else
								<div class="panel panel-default">
									<div class="panel-heading no-bg panel-settings">
										<h3 class="panel-title">
											{{ trans('common.posts') }}
										</h3>
									</div>
									<div class="panel-body">
										<div class="alert alert-warning">{{ trans('messages.no_posts') }}</div>
									</div>
								</div><!-- /panel -->
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

