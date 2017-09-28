<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('user-header',compact('timeline','user','followRequests','following_count','followers_count',
			'follow_confirm','user_post','joined_groups_count','guest_events')) !!}

			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">

						{!! Theme::partial('user-leftbar',compact('timeline','user','own_pages','follow_user_status','own_groups','user_events')) !!}
					</div>
					<div class="col-md-8">						

						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">{{ trans('common.join_requests') }}</h3>						
							</div>
							<div class="panel-body group-suggested-users">

								{{-- @include('flash::message') --}}
								@if(count($followRequests))
									@foreach($followRequests as $followRequest)

										<div class="holder">
											<div class="follower pull-left">
												<a href="{{ url($followRequest->username) }}">
													<img src="{{ $followRequest->avatar }}" alt="{{ $followRequest->name }}" class="img-icon img-30" title="{{ $followRequest->name }}">
												</a>
												<a href="{{ url($followRequest->username) }}">
													<span>{{ $followRequest->username }}</span>
												</a>
												@if($followRequest->verified)
									              <span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif

											</div>

											<div class="follow-links pull-right">
												<div class="left-col">
													<a href="#" class="btn btn-to-follow accept-follow btn-success accept" data-user-id="{{ $followRequest->id }}">
														<i class="fa fa-thumbs-up"></i> {{ trans('common.accept') }} 
													</a>
													<a href="#" class="btn btn-to-follow reject-follow btn-danger reject" data-user-id="{{ $followRequest->id }}">
														<i class="fa fa-thumbs-down"></i> {{ trans('common.decline') }}
													</a>
												</div>
											</div>

										</div>
									@endforeach
								@else
									<div class="alert alert-warning">{{ trans('messages.no_requests') }}</div>
								@endif
							</div>
						</div><!-- /panel -->
					</div><!-- /col-md-8 -->
				</div><!-- /main-content -->
			</div><!-- /row -->
		</div><!-- /col-md-10 -->

		<div class="col-md-2">
			{!! Theme::partial('timeline-rightbar') !!}
		</div>

	</div>
</div><!-- /container -->
