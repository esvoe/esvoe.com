<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('group-header',compact('timeline','group')) !!}

			<div class="row">
				<div class="timeline">
					<div class="col-md-4">

						{!! Theme::partial('group-leftbar',compact('timeline','group','group_members','group_events','ongoing_events','upcoming_events')) !!}
					</div>
					<div class="col-md-8">						
						<div class="panel panel-default">
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.join_requests') }}
								</h3>
							</div>
							<div class="panel-body">

								@if(count($requestedUsers) > 0)
								<ul class="list-group page-likes">
									@foreach($requestedUsers as $requestedUser)
									<li class="list-group-item holder">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ $requestedUser->username }}">													
													<img src="{{ $requestedUser->avatar }}" alt="{{ $requestedUser->name }}" class="img-icon img-30" title="{{ 
														$requestedUser->name }}">
													{{ $requestedUser->name }}
												</a>
											</div>

											<div class="follow-links side-right">
												<div class="left-col">
													<a href="#" class="btn btn-to-follow btn-success accept-user accept" data-user-id="{{ $requestedUser->id }} - {{ $group_id }}"><i class="fa fa-thumbs-up"></i> {{ trans('common.accept') }} 
													</a>
													<a href="#" class="btn btn-to-follow reject-user btn-danger reject" data-user-id="{{ $requestedUser->id }} - {{ $group_id }}"><i class="fa fa-thumbs-down"></i> {{ trans('common.decline') }}
													</a>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</li>
									@endforeach
								</ul>

								@else
								<div class="alert alert-warning">{{ trans('messages.no_requests') }}</div>
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
