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
									{{ trans('common.groups_joined') }}
								</h3>
							</div>
							<div class="panel-body">

								@if(count($joined_groups) > 0)
								<ul class="list-group page-likes">
									@foreach($joined_groups as $join_group)
									<li class="list-group-item holder">
										<div class="connect-list">
											<div class="connect-link side-left">
												<a href="{{ url($join_group->username) }}">
													@if($join_group->avatar != NULL)
													<img src="{{ url('group/avatar/'.$join_group->avatar) }}" alt="{{ $join_group->name }}" title="{{ $join_group->name }}">
													@else
													<img src="{{ url('group/avatar/default-group-avatar.png') }}" alt="{{ $join_group->name }}" title="{{ $join_group->name }}">
													@endif
													{{ $join_group->name }}
												</a>
											</div>

											@if($timeline->id == Auth::user()->timeline_id)
												<div class="side-right page-links">
													@if(($join_group->users->contains(Auth::user()->id)) && $join_group->is_admin(Auth::user()->id) != true)
													<div class="left-col">
														<a href="#" class="btn btn-success group-join joined" data-timeline-id="{{ $join_group->timeline_id }}">
															<i class="fa fa-check"></i> {{ trans('common.joined') }}
														</a>
													</div>

													<div class="left-col hidden">
														<a href="#" class="btn btn-default group-join join" data-timeline-id="{{ $join_group->timeline_id }}"><i class="fa fa-plus"></i> {{ trans('common.join') }}
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
								<div class="alert alert-warning">{{ trans('messages.no-joined-goups') }}</div>
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

