
<div class="right-side-section">
	<div class="user-profile-buttons">
		<div class="row join-links pagelike-links">
			<!-- Start Open Group -->
			@if($group->is_admin(Auth::user()->id) && $group->type == "open")
				@if(!$group->users->contains(Auth::user()->id))
				<div class="col-md-6 col-xs-6 col-sm-6 left-col">
					<a href="#" class="btn btn-options btn-block join-user btn-default join" data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-plus"></i> {{ trans('common.join') }}
					</a>
				</div>

				<div class="col-md-6 col-xs-6 col-sm-6 left-col hidden">
					<a href="#" class="btn btn-options btn-block btn-success join-user joined" data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-check"></i>  {{ trans('common.joined') }}
					</a>
				</div>
				@else
				<div class="col-md-6 col-xs-6 col-sm-6 left-col hidden">
					<a href="#" class="btn btn-options btn-block join-user btn-default join " data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-plus"></i>  {{ trans('common.join') }}
					</a>
				</div>
				
				<div class="col-md-6 col-xs-6 col-sm-6 left-col">
					<a href="#" class="btn btn-options btn-block btn-success join-user joined @if(count($group->admins()) == 1 && $group->is_admin(Auth::user()->id)) disabled @endif ">
						<i class="fa fa-check"></i>  {{ trans('common.joined') }}
					</a>
				</div>
				@endif	
				<div class="col-md-6 col-xs-6 col-sm-6 right-col">

					<a href="{{ url('/'.$timeline->username.'/group-settings/general') }}" class="btn btn-options btn-block btn-default">

						<i class="fa fa-gear"></i>  {{ trans('common.settings') }}
					</a>
				</div>
			@else
			@if(!$group->is_admin(Auth::user()->id) && $group->type == "open")
			@if(!$group->users->contains(Auth::user()->id))
				<div class="col-md-12 page">
					<a href="#" class="btn btn-options btn-block join-user btn-default join" data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-plus"></i> {{ trans('common.join') }}
					</a>
				</div>
				<div class="col-md-12 col-xs-12 col-sm-12 page  hidden">
					<a href="#" class="btn btn-options btn-block btn-success join-user joined" data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-check"></i> {{ trans('common.joined') }}
					</a>
				</div>
			@else
				<div class="col-md-12 col-xs-12 col-sm-12 page hidden">
					<a href="#" class="btn btn-options btn-block join-user btn-default join" data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-plus"></i> {{ trans('common.join') }}
					</a>
				</div>
				<div class="col-md-12 col-xs-12 col-sm-12 page">
					<a href="#" class="btn btn-options btn-block btn-success join-user joined @if(count($group->admins()) == 1 && $group->is_admin(Auth::user()->id)) disabled @endif " data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-check"></i> {{ trans('common.joined') }}
					</a>
				</div>
			@endif			
			@endif					
			@endif
			<!-- End open group -->

			<!-- Start closed group -->
			@if($group->is_admin(Auth::user()->id) && $group->type == "closed")
			@if(!$group->users->contains(Auth::user()->id))


			<div class="col-md-12 col-xs-12 col-sm-12 ">
				<a href="#" class="btn btn-options btn-block join-close-group btn-default join" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-plus"></i> {{ trans('common.join') }}
				</a>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12 hidden">
				<a href="#" class="btn btn-options btn-block btn-warning join-close-group joinrequest" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-check"></i> {{ trans('common.join_requested') }}
				</a>
			</div>

			@else
			<div class="col-md-12 col-xs-12 col-sm-12 hidden">
				<a href="#" class="btn btn-options btn-block join-close-group btn-default join" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-plus"></i> {{ trans('common.join') }}
				</a>
			</div>

			@if(Auth::user()->get_group($group->id) == "pending")
			<div class="col-md-12 col-xs-12 col-sm-12">
				<a href="#" class="btn btn-options btn-block btn-warning join-close-group joinrequest" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-check"></i> {{ trans('common.join_requested') }}
				</a>
			</div>							
			@endif
			
			@if(Auth::user()->get_group($group->id) == "approved")
			<div class="col-md-6 col-xs-6 col-sm-6 left-col">
				<a href="#" class="btn btn-options btn-block btn-success join-close-group joined @if(count($group->admins()) == 1 && $group->is_admin(Auth::user()->id)) disabled @endif " data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-check"></i> {{ trans('common.joined') }}
				</a>
			</div>
			@endif

			@endif

			<div class="col-md-6 col-xs-6 col-sm-6 right-col">

				<a href="{{ url('/'.$timeline->username.'/group-settings/closegroup') }}" class="btn btn-options btn-block btn-default">

					<i class="fa fa-gear"></i> {{ trans('common.settings') }}
				</a>
			</div>

			@else
			@if(!$group->is_admin(Auth::user()->id) && $group->type == "closed")

			@if(!$group->users->contains(Auth::user()->id))
			<div class="col-md-12 col-xs-12 col-sm-12 page">
				<a href="#" class="btn btn-options btn-block join-close-group btn-default join" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-plus"></i>   {{ trans('common.join') }}
				</a>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12 page hidden">
				<a href="#" class="btn btn-options btn-block btn-success join-close-group joinrequest" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-check"></i>   {{ trans('common.join_requested') }}
				</a>
			</div>

			@else
			<div class="col-md-12 col-xs-12 col-sm-12 page hidden">
				<a href="#" class="btn btn-options btn-block join-close-group btn-default join" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-plus"></i>  {{ trans('common.join') }}
				</a>
			</div>
			@if(Auth::user()->get_group($group->id) == "pending")
			<div class="col-md-12 col-xs-12 col-sm-12 page">
				<a href="#" class="btn btn-options btn-block btn-success join-close-group joinrequest" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-check"></i> {{ trans('common.join_requested') }}
				</a>
			</div>
			@endif

			@if(Auth::user()->get_group($group->id) == "approved")								
				<div class="col-md-12 col-xs-12 col-sm-12 page">
					<a href="#" class="btn btn-options btn-block btn-success join-close-group joined @if(count($group->admins()) == 1 && $group->is_admin(Auth::user()->id)) disabled @endif " data-timeline-id="{{ $timeline->id }}">
						<i class="fa fa-check"></i> {{ trans('common.joined') }}
					</a>
				</div>
			@endif
		@endif			
	@endif	
@endif
			<!-- End closed group -->

	<!-- Start secret Group -->
	@if($group->is_admin(Auth::user()->id) && $group->type == "secret")			
		<div class="col-md-12 col-xs-12 col-sm-12">

			<a href="{{ url('/'.$timeline->username.'/group-settings/general') }}" class="btn btn-options btn-block btn-default">

				<i class="fa fa-gear"></i>  {{ trans('common.settings') }}
			</a>
		</div>					
	@endif
	<!-- End secret group -->
		

		</div>
	</div>

	<div class="user-bio-block">
		<div class="bio-header">{{ trans('common.about') }}</div>
		<div class="bio-description">
			{{ ($timeline['about'] != NULL) ? $timeline['about'] : trans('messages.no_description') }}
		</div>
		<ul class="bio-list list-unstyled">
			<li>
				@if($group->type == 'open')
				<i class="fa fa-unlock" aria-hidden="true"></i>
				@else
				<i class="fa fa-lock" aria-hidden="true"></i>
				@endif

				@if($group->type == 'open')
					<span>{{ trans('common.group_open').' '.trans('common.group') }}</span>
				@elseif($group->type == 'secret')
					<span>{{ trans('common.group_secret').' '.trans('common.group') }}</span>
					@endif
				{{--<span>{{ $group->type.' '.trans('common.group') }}</span>--}}
			</li>
		</ul>
	</div>
	<div class="widget-pictures widget-best-pictures"><!-- /pages-liked -->
	<div class="picture side-left">
		{{ trans('common.members') }}
	</div>
	@if(count($group_members) > 0)
		<div class="side-right show-all">
			<a href="{{ url($timeline->username.'/members/'.$group->id) }}">{{ trans('common.show_all') }}</a>
		</div>
	@endif
	<div class="clearfix"></div>
	<div class="best-pictures my-best-pictures">
		<div class="row">
			@if(count($group_members) > 0)
				@foreach($group_members->take(12) as $group_member)
				<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
					<a href="{{ url($group_member->username) }}" class="image-hover" data-toggle="tooltip" data-placement="top" title="{{ $group_member->name }}" >
						<img src="{{ $group_member->avatar }}" alt="{{ $group_member->name }}" title="{{ $group_member->name }}">
					</a>
				</div>
				@endforeach
			@else
				<div class="alert alert-warning">{{ trans('messages.no_members') }}</div>
			@endif
		</div>
	</div>
</div> <!-- /pages-liked -->

<div class="widget-pictures widget-best-pictures"><!-- /group-events -->
	<div class="picture pull-left">
		{{ trans('common.events') }}
	</div>
	@if(count($group_events) > 0)
		<div class="pull-right show-all">
			<a href="{{ url($timeline->username.'/events') }}">{{ trans('common.show_all') }}</a>
		</div>
	@endif
	<div class="clearfix"></div>
	<ul class="nav nav-tabs events" role="tablist">
        <li role="presentation" class="active"><a href="#all-events" aria-controls="allevents" role="tab" data-toggle="tab">{{ trans('common.all') }}</a></li>
        <li role="presentation"><a href="#ongoing-events" aria-controls="ongoingevents" role="tab" data-toggle="tab">{{ trans('common.ongoing') }}</a></li>
        <li role="presentation"><a href="#upcoming-events" aria-controls="upcomingevents" role="tab" data-toggle="tab">{{ trans('common.upcoming') }}</a></li>
    </ul>

  <!-- Tab panes -->
    <div class="tab-content events">
        <div role="tabpanel" class="tab-pane active" id="all-events">
          	<div class="best-pictures my-best-pictures">
				<ul class="list-group new-events">
				@if(count($group_events) > 0)
					@foreach($group_events->take(12) as $group_event)
						<li class="list-group-item">
							<a href="{{ url($group_event->timeline->username) }}" class="image-hover" data-toggle="tooltip" data-placement="top" title="{{ $group_event->timeline->name }}" >							
								<img src=" @if($group_event->user->timeline->avatar) {{ url('user/avatar/'.$group_event->user->timeline->avatar->source) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $group_event->timeline->name }}" title="{{ $group_event->timeline->name }}">
								{{ str_limit($group_event->timeline->name, 18, '...') }}

							</a>
							<span class="date pull-right">{{ date("d M Y", strtotime($group_event->start_date)) }}</span>
							<div class="clearfix"></div>
						</li>
					@endforeach
				@else	
					<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
				@endif	
				</ul>
			</div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ongoing-events">
          	<div class="best-pictures my-best-pictures">
				<ul class="list-group new-events">
				@if(count($ongoing_events) > 0 && $ongoing_events != NULL)
					@foreach($ongoing_events as $ongoing_event)
						<li class="list-group-item">
							<a href="{{ url($ongoing_event->timeline->username) }}" class="image-hover" data-toggle="tooltip" data-placement="top" title="{{ $ongoing_event->timeline->name }}" >
								
								<img src=" @if($ongoing_event->user->timeline->avatar) {{ url('user/avatar/'.$ongoing_event->user->timeline->avatar->source) }}  @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $ongoing_event->timeline->name }}" title="{{ $ongoing_event->timeline->name }}">
							{{ str_limit($ongoing_event->timeline->name, 18, '...') }}
							</a>
							<span class="date pull-right">{{ date("d M Y", strtotime($ongoing_event->start_date)) }}</span>
							<div class="clearfix"></div>
						</li>
					@endforeach
				@else	
					<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
				@endif	
				</ul>
			</div>
        </div>
        <div role="tabpanel" class="tab-pane" id="upcoming-events">
			<div class="best-pictures my-best-pictures">
				<ul class="list-group new-events">
				@if(count($upcoming_events) > 0 && $upcoming_events != NULL)
					@foreach($upcoming_events as $upcoming_event)
					<li class="list-group-item">
						<a href="{{ url($upcoming_event->timeline->username) }}" class="image-hover" data-toggle="tooltip" data-placement="top" title="{{ $upcoming_event->timeline->name }}" >

							<img src=" @if($upcoming_event->user->timeline->avatar) {{ url('user/avatar/'.$upcoming_event->user->timeline->avatar->source) }}  @else {{ url('group/avatar/default-group-avatar.png') }} @endif" alt="{{ $upcoming_event->timeline->name }}" title="{{ $upcoming_event->timeline->name }}">
							{{ str_limit($upcoming_event->timeline->name, 18, '...') }}
						</a>
						<span class="date pull-right">{{ date("d M Y", strtotime($upcoming_event->start_date)) }}</span>
							<div class="clearfix"></div>
					</li>
					@endforeach
				@else	
					<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
				@endif	
				</ul>
			</div>
        </div>
    </div>
	
</div> <!-- /group-events -->
</div>

