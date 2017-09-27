<!-- <div class="main-content"> -->
	<div class="container container-grid">
		<div class="row">

			<!-- List of user pages-->

			<div class="col-md-6">
				<div class="post-filters pages-groups">
					
					<div class="panel panel-default">
						<div class="panel-heading no-bg panel-settings">
							<div class="side-right create-btn">
								<a href="{{ url(Auth::user()->username.'/create-group') }}" class="btn btn-success">{{ trans('common.create_group') }}</a>
							</div>
							<h3 class="panel-title small-heading">
								{{ trans('messages.groups-manage') }}
							</h3>
							
						</div>
						<div class="panel-body">
							@if(Auth::user()->own_groups()->count())
								
							<ul class="list-group page-likes">
								@foreach(Auth::user()->own_groups() as $usergroup)
								<li class="list-group-item deletegroup">
									<div class="connect-list">
										<div class="connect-link side-left">
											<a href="{{ url($usergroup->username) }}">
												<img src=" @if($usergroup->timeline_id && $usergroup->avatar) {{ url('group/avatar/'.$usergroup->avatar) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $usergroup->name }}" title="{{ $usergroup->name }}">{{ $usergroup->name }}
											</a>
										</div>
										<div class="side-right">
											<a href="#" class="side-right delete-group delete_group" data-groupdelete-id="{{ $usergroup->id }}"><span class="trash-icon bg-danger"><i class="fa fa-trash text-danger"></i></span></a>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
								@endforeach
							</ul>
							@else
								<div class="alert alert-warning">
									{{ trans('messages.no_groups') }}
								</div>
							@endif
						</div>
					</div><!-- /panel -->
				</div>
			</div><!-- /col-md-6 -->
			
			<!-- List of user groups-->
			
			<div class="col-md-6">
				<div class="post-filters pages-groups">
					
					<div class="panel panel-default">
						<div class="panel-heading no-bg panel-settings">
							<h3 class="panel-title small-heading">
								{{ trans('common.joined_groups') }}
							</h3>
						</div>
						<div class="panel-body">
							@if(Auth::user()->joinedGroups()->count())
								
							<ul class="list-group page-likes">
								@foreach(Auth::user()->joinedGroups() as $joingroup)
								<li class="list-group-item holder">
									<div class="connect-list">
										<div class="connect-link side-left">
											<a href="{{ url($joingroup->username) }}">
												<img src=" @if($joingroup->timeline_id && $joingroup->avatar) {{ url('group/avatar/'.$joingroup->avatar) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $joingroup->name }}" title="{{ $joingroup->name }}">{{ $joingroup->name }}
											</a>
										</div>
										<div class="side-right page-links">
											<div class="left-col">
												<div class="left-col">
													<a href="#" class="btn btn-success group-join joined" data-timeline-id="{{ $joingroup->timeline_id }}">
														<i class="fa fa-check"></i> {{ trans('common.joined') }}
													</a>
												</div>

												<div class="left-col hidden">
													<a href="#" class="btn btn-default group-join join" data-timeline-id="{{ $joingroup->timeline_id }}"><i class="fa fa-plus"></i> {{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
								@endforeach
							</ul>
							@else
								<div class="alert alert-warning">{{ trans('messages.no-joined-goups') }}</div>
								
							@endif
						</div>
					</div>

				</div><!-- /panel -->
			</div>
		</div><!-- /row -->
	</div>
<!-- </div> --><!-- /main-content -->