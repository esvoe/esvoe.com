<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">

			{!! Theme::partial('event-header',compact('timeline','event')) !!}
			
			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">
						
						{!! Theme::partial('event-leftbar',compact('timeline','event','event_guests')) !!}
					</div>

					<div class="col-md-8">
					<div class="panel panel-default">
						@include('flash::message')
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									{{ trans('common.guests') }}
								</h3>
							</div>
							<div class="panel-body">								
								@if(count($event_guests) > 0)
								<ul class="list-group page-likes">
									@foreach($event_guests as $event_guest)									
									<li class="list-group-item holder">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url($event_guest->username) }}">													
													<img src="{{ $event_guest->avatar }}" alt="{{ $event_guest->name }}" class="img-icon img-30" title="{{ 
														$event_guest->name }}">
													{{ $event_guest->name }}
												</a>
												@if($event_guest->verified)
									              <span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif
											</div>

											@if($event->users->contains($event_guest->id) && Auth::user()->id != $event_guest->id)
												<div class="side-right follow-links">
													@if(!Auth::user()->following->contains($event_guest->id))
													<div class="left-col"><a href="#" class="btn btn-to-follow btn-default follow-user follow" data-timeline-id="{{ $event_guest->timeline_id }}"><i class="fa fa-heart"></i> {{ trans('common.follow') }} </a></div>

													<div class="left-col hidden"><a href="#" class="btn follow-user btn-success unfollow " data-timeline-id="{{ $event_guest->timeline_id }}"><i class="fa fa-check"></i>{{ trans('common.following') }}</a></div>
													@else
													<div class="left-col hidden"><a href="#" class="btn btn-to-follow btn-default follow-user follow " data-timeline-id="{{ $event_guest->timeline_id }}"><i class="fa fa-heart"></i> {{ trans('common.follow') }}</a></div>
													<div class="left-col"><a href="#" class="btn follow-user btn-success unfollow" data-timeline-id="{{ $event_guest->timeline_id }}"><i class="fa fa-check"></i> {{ trans('common.following') }}</a></div>
													@endif
												</div>
											@endif

											<!-- form starts here -->
											<div class="clearfix"></div>
										</div>
									</li>
									@endforeach
								</ul>

								@else
								<div class="alert alert-warning">{{ trans('messages.no_guests') }}</div>
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
