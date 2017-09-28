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
									{{ trans('common.pages_liked') }}
								</h3>
							</div>
							<div class="panel-body">

								@if(count($liked_pages) > 0)
								<ul class="list-group page-likes">
									@foreach($liked_pages as $page)
									<li class="list-group-item holder">
										<div class="connect-list ">
											<div class="connect-link side-left">
												<a href="{{ url($page->username) }}">
													@if($page->avatar != NULL)
													<img src="{{ url('page/avatar/'.$page->avatar) }}" alt="{{ $page->name }}" title="{{ $page->name }}">
													@else
													<img src="{{ url('page/avatar/default-page-avatar.png') }}" alt="{{ $page->name }}" title="{{ $page->name }}">
													@endif
													{{ $page->name }}
												</a>
												@if($page->verified)
									              <span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            @endif
											</div>

											@if($timeline->id == Auth::user()->timeline_id)
												<div class="page-links side-right">
													@if($page->likes->contains(Auth::user()->id))
													<div class="left-col">
														<a href="#" class="btn btn-success page-liked pageliked " data-timeline-id="{{ $page->timeline_id }}">
															<i class="fa fa-check"></i> {{ trans('common.liked') }}
														</a>
													</div>

													<div class="left-col hidden">
														<a href="#" class="btn btn-default page-liked pagelike" data-timeline-id="{{ $page->timeline_id }}">	<i class="fa fa-thumbs-up"></i> {{ trans('common.like') }}
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
								<div class="alert alert-warning">{{ trans('messages.no-liked-pages') }}</div>
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

