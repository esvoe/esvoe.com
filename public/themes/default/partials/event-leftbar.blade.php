<div class="user-profile-buttons">
	<div class="row join-links">	
		@if($event->type == 'public' && $event->isExpire($event->id))
			@if(!$event->users->contains(Auth::user()->id))
			<div class="col-md-12 col-xs-6 col-sm-6">
				<a href="#" class="btn btn-options btn-block join-guest btn-default join" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-heart"></i> {{ trans('common.want_to_go') }}
				</a>
			</div>

			<div class="col-md-12 col-xs-6 col-sm-6 hidden">
				<a href="#" class="btn btn-options btn-block btn-success join-guest joined" data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-check"></i>  {{ trans('common.iam_going') }}
				</a>
			</div>
			@else
			<div class="col-md-12 col-xs-6 col-sm-6 hidden">
				<a href="#" class="btn btn-options btn-block join-guest btn-default join " data-timeline-id="{{ $timeline->id }}">
					<i class="fa fa-heart"></i>  {{ trans('common.want_to_go') }}
				</a>
			</div>
				@if(!$event->is_eventadmin(Auth::user()->id, $event->id))  
					<div class="col-md-12 col-xs-6 col-sm-6">
						<a href="#" class="btn btn-options btn-block btn-success join-guest joined" data-timeline-id="{{ $timeline->id }}">
							<i class="fa fa-check"></i>  {{ trans('common.iam_going') }}
						</a>
					</div>
				@endif
			@endif
		@endif

		@if($event->is_eventadmin(Auth::user()->id, $event->id))
			<div class="col-md-12 col-sm-6 col-xs-6">
				<a href="{{ url('/'.$timeline->username.'/event-settings/general') }}" class="btn btn-options btn-block btn-default"><i class="fa fa-gear"></i> 
					{{ trans('common.settings') }}
				</a>
			</div>
		@endif
	</div>
</div>

	<div class="user-bio-block">

		<div class="bio-header">{{ trans('common.about') }}</div>
		<div class="bio-description">
			{{ ($timeline['about'] != NULL) ? $timeline['about'] : trans('messages.no_description') }}
		</div>
		<ul class="bio-list list-unstyled">			
			<li>
				@if($event->type == 'public')
					<i class="fa fa-unlock"></i>
				@else
					<i class="fa fa-lock"></i>
				@endif
				<span>{{ $event->type.' '.trans('common.event') }}</span>
			</li>
			<li>
				<i class="fa fa-user" aria-hidden="true"></i><span> {{ trans('common.hosted_by') }} <a href="{{ url('/'.$event->hostedByUsername($event->user_id)) }}">{{ $event->hostedByName($event->user_id) }}</a> </span>
			</li>

			@if($event->location != null)
				<li>
					<i class="fa fa-map-marker" aria-hidden="true"></i><span>{{ $event->location }}</span>
				</li>
			@endif

			@if($event->start_date != null)
				<li>
					<i class="fa fa-calendar"></i><span>{{ trans('common.starts_on') }}</span>: {{ date("Y:m:d H:i", strtotime($event->start_date)) }}
				</li>
			@endif

			@if($event->end_date != null)
				<li>
					<i class="fa fa-calendar"></i><span>{{ trans('common.ends_on') }}</span>: {{ date("Y:m:d H:i", strtotime($event->end_date)) }}
				</li>
			@endif
			@if($event->group_id != null)
				<li>
					<i class="fa fa-users" aria-hidden="true"></i><span>{{ trans('common.group') }}</span>:  <a href="{{ $event->group->name }}">{{ $event->group->name }}</a>
				</li>
			@endif
		</ul>
	</div>
{{--<iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q={!! $event->location !!}&key={{ env('GOOGLE_MAPS_API_KEY') }}"></iframe>--}}