<!-- <div class="main-content"> -->
			<!-- List of user events-->
				<div class="post-filters pages-groups">
					
					<div class="panel panel-default">
					@include('flash::message')
						<div class="panel-heading no-bg panel-settings">						
							<div class="side-right">
								<a href="{{ url(Auth::user()->username.'/create-event') }}" class="btn btn-success">{{ trans('common.create_event') }}</a>
							</div>
							<h3 class="panel-title">
								{{ trans('messages.events-manage') }}
							</h3>
						</div>
						<div class="panel-body">
							@if(count($user_events))

							<ul class="list-group page-likes">
								@foreach($user_events as $user_event)
								<li class="list-group-item deleteevent">
									<div class="connect-list">
										<div class="connect-link side-left">
											
											<a href="{{ url($user_event->timeline->username) }}">
												<img src=" @if(Auth::user()->profile->avatar) {{ Auth::user()->avatar }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $user_event->timeline->name }}" title="{{ $user_event->timeline->name }}">{{ $user_event->timeline->name }}
											</a>
											<span class="label label-default">{{ $user_event->type }}</span>
										</div>
										<div class="side-right">
											<a href="" class="side-right delete-event delete_event" data-eventdelete-id="{{ $user_event->id }}"><i class="fa fa-close text-danger"></i></a>
										</div>
										<div class="clearfix"></div>
									</div><!-- /connect-list -->
								</li>
								@endforeach
							</ul>
							@else
							<div class="alert alert-warning">
								{{ trans('messages.no_events') }}
							</div>
							@endif
						</div>
					</div>

				</div><!-- /panel -->
<!-- </div> --><!-- /main-content -->