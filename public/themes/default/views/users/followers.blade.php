<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('user-header',compact('timeline','user','followRequests','following_count',
			'followers_count','follow_confirm','user_post','joined_groups_count','guest_events')) !!}

			<div class="row">
				<div class=" timeline">

					<div class="col-md-4">
						{!! Theme::partial('user-leftbar',compact('timeline','user','follow_user_status','own_pages','own_groups','user_events')) !!}
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.followers') }}
								</h3>
							</div>
							<div class="panel-body">

								@if(count($followers) > 0)
								<ul class="list-group page-likes">
									@foreach($followers as $follower)
									<li class="list-group-item">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url($follower->username) }}">													
													<img src="{{ $follower->avatar }}" alt="{{ $follower->name }}" class="img-icon img-30" title="{{ $follower->name }}">
													{{ $follower->name }}
												</a>
												@if($follower->verified)
									              <span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif
											</div>

											@if($timeline->id == Auth::user()->timeline_id)
												<div class="side-right follow-links">
													@if(!$user->following->contains($follower->id))
													<div class="left-col"><a href="#" class="btn btn-to-follow btn-default follow-user follow" data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-heart"></i> {{ trans('common.follow') }} </a></div>

													<div class="left-col hidden"><a href="#" class="btn follow-user btn-success unfollow " data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-check"></i> {{ trans('common.following') }}</a></div>
													@else
													<div class="left-col hidden"><a href="#" class="btn btn-to-follow btn-default follow-user follow " data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-heart"></i> {{ trans('common.follow') }}</a></div>
													<div class="left-col"><a href="#" class="btn follow-user btn-success unfollow" data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-check"></i> {{ trans('common.following') }}</a></div>
													@endif

												</div>
											@endif
											<div class="clearfix"></div>
										</div>
									</li>
									@endforeach
								</ul>

								@else
								<div class="alert alert-warning">{{ trans('messages.no_followers') }}</div>
								@endif
							</div><!-- /panel-body -->
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

