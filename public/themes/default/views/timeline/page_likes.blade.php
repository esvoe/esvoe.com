<!-- main-section -->
<div class="container">
	<div class="row">
		<div class="col-md-10">
			{!! Theme::partial('page-header',compact('timeline','page')) !!}

			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">

						{!! Theme::partial('page-leftbar',compact('timeline','page','page_members')) !!}
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
									<li class="list-group-item">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url($page_like->username) }}">													
												<img src="{{ $page_like->avatar }}" alt="{{ $page_like->name }}" class="img-icon img-30" title="{{ $page_like->name }}">
													{{ $page_like->name }}
												</a>
												@if($page_like->verified)
													<span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif
											</div>

											@if($page_like->pivot->user_id != Auth::user()->id)
											<div class="follow-links side-right">
												@if(!Auth::user()->following->contains($page_like->id))
												<div class="left-col">
													<a href="#" class="btn btn-to-follow btn-default follow-user follow" data-timeline-id="{{ $page_like->timeline_id }}">				
														<i class="fa fa-heart"></i> {{ trans('common.follow') }} 
													</a>
												</div>

												<div class="left-col hidden">
													<a href="#" class="btn follow-user btn-success unfollow " data-timeline-id="{{ $page_like->timeline_id }}">
														<i class="fa fa-check"></i>{{ trans('common.following') }}
													</a>
												</div>
												@else
												<div class="left-col hidden">
													<a href="#" class="btn btn-to-follow btn-default follow-user follow " data-timeline-id="{{ $page_like->timeline_id }}">
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
											@endif
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
				</div><!-- /main-content -->
			</div><!-- /row -->
		</div><!-- /col-md-10 -->

		<div class="col-md-2">
			{!! Theme::partial('timeline-rightbar') !!}
		</div>
	</div>
</div><!-- /container -->
