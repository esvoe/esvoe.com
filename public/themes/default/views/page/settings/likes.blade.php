<!-- <div class="main-content"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="post-filters">
					{!! Theme::partial('pagemenu-settings',compact('timeline')) !!}
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						<h3 class="panel-title">
							{{ trans('common.page_likes') }}
						</h3>
					</div>
					<div class="panel-body">
						@if(count($page_likes) > 0)
						<ul class="list-group page-likes">
							@foreach($page_likes as $page_like)
							<li class="list-group-item holder">
								<div class="connect-list">
									<div class="connect-link pull-left">
										<a href="{{ url($page_like->username) }}">
											<img src="{{ $page_like->avatar }}" alt="{{ $page_like->name }}" title="{{ $page_like->name }}">
											{{ $page_like->name }}
										</a>
									</div>
									<div class="follow-links pull-right">
										@if(!Auth::user()->following->contains($page_like->id))
											<div class="left-col">
												<a href="#" class="btn btn-to-follow btn-default follow-user follow" data-timeline-id="{{ $page_like->timeline_id }}">				
													<i class="fa fa-heart"></i> {{ trans('common.follow') }} 
												</a>
											</div>

											<div class="left-col hidden">
												<a href="#" class="btn follow-user btn-success unfollow" data-timeline-id=  "{{ $page_like->timeline_id }}">
													<i class="fa fa-check"></i> {{ trans('common.following') }}
												</a>
											</div>
										@else
											<div class="left-col hidden">
												<a href="#" class="btn btn-to-follow btn-default follow-user follow" data-timeline-id="{{ $page_like->timeline_id }}">
													<i class="fa fa-heart"></i> {{ trans('common.follow') }}
												</a>
											</div>

											<div class="left-col">
												<a href="#" class="btn follow-user btn-success unfollow" data-timeline-id="{{ $page_like->timeline_id }}">
													<i class="fa fa-check"></i> {{ trans('common.following') }}
												</a>
											</div>
										@endif
									</div>
									<div class="clearfix"></div>
								</div>
							</li>
							@endforeach
						</ul>
						@else
							<div class="alert alert-warning">{{ trans('messages.no_likes') }}</div>
						@endif
					</div><!-- /panel-body -->
				</div>
			</div><!-- /col-md-8 -->
		</div>
	</div><!-- /container -->
<!-- </div> -->