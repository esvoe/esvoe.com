<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('group-header',compact('timeline','liked_pages')) !!}
			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">
						{!! Theme::partial('group-leftbar',compact('timeline','user','timeline_type')) !!}
					</div>
					<div class="col-md-8">

						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">{{ trans('common.followers') }}</h3>
							</div>
							<div class="panel-body">

								@if(count($followers) > 0)
								@foreach($followers as $follower)

								<div class="holder">
									<div class="follower">
										<a href="{{ url($follower->username) }}">											
										<img src="{{ $follower->avatar }}" alt="{{ $follower->name }}" class="img-icon img-30" title="{{ $follower->name }}">
										</a>
										<a href="{{ url($follower->username) }}">
											<span>{{ $follower->username }}</span>
										</a>
									</div>
									@if($timeline->username == Auth::user()->username)
									<div class="follow-links pull-right">
										@if(!$user->following->contains($follower->id))
                                            <div class="left-col"><a href="#" class="btn btn-to-follow follow-user follow" data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-heart"></i> {{ trans('common.follow') }} </a></div>
                                            <div class="left-col hidden"><a href="#" class="btn follow-user btn-primary unfollow " data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-heart"></i>{{ trans('common.following') }}</a></div>
										@else
                                            <div class="left-col hidden"><a href="#" class="btn btn-to-follow follow-user follow " data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-heart"></i> {{ trans('common.follow') }}</a></div>
                                            <div class="left-col"><a href="#" class="btn follow-user btn-primary unfollow" data-timeline-id="{{ $follower->timeline_id }}"><i class="fa fa-heart"></i> {{ trans('common.following') }}</a></div>
										@endif
									</div>
									@endif
								</div>
								@endforeach
								@else
								<div class="alert alert-warning">{{ trans('messages.no_followers') }}</div>
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

