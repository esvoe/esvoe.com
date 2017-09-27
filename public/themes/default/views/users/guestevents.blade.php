<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('user-header',compact('timeline','user','followRequests','following_count',
			'followers_count','follow_confirm','user_post','joined_groups_count','user_events','guest_events')) !!}				
			
			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">
						
						{!! Theme::partial('user-leftbar',compact('timeline','user','follow_user_status','own_pages','own_groups','user_events')) !!}
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.guest-event') }}
								</h3>
							</div>
							<div class="panel-body">

								@if(count($guest_events) > 0)
								<ul class="list-group page-likes">
									@foreach($guest_events as $guest_event)									
									<li class="list-group-item">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url('/'.$guest_event->timeline->username) }}">								
													<img src="{{ $guest_event->user->picture }}" alt="{{ $guest_event->timeline->name }}" title="{{ $guest_event->timeline->name }}" >{{ $guest_event->timeline->name }}</a>
											</div>											
											<div class="clearfix"></div>
										</div>
									</li>									
									@endforeach
								</ul>
								@else
								<div class="alert alert-warning">{{ trans('messages.no_guest_events') }}</div>
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

