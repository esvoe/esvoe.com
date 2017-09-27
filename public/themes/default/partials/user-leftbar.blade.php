

@if (        
        ($timeline->type == 'user' && $timeline->id == Auth::user()->timeline_id) ||
        ($timeline->type == 'page' && $timeline->page->is_admin(Auth::user()->id) == true) ||
        ($timeline->type == 'group' && $timeline->groups->is_admin(Auth::user()->id) == true)
        )

<div class="user-profile-buttons">
	<div class="row">
		<div class="col-md-12"><a href="{{ url('/'.Auth::user()->username.'/settings/wallpaper') }}" class="btn btn-profile"><i class="fa fa-image"></i>{{ trans('common.set_wallpaper') }}</a></div>
	</div>
</div>
@endif

<div class="user-bio-block">
	<div class="bio-header">{{ trans('common.bio') }}</div>
	<div class="bio-description">
		{{ ($user->about != NULL) ? $user->about : trans('messages.no_description') }}
		<ul class="list-unstyled list-details">
			@if($user->hobbies != NULL)
				<li>{!! '<b>'.trans('common.hobbies').': </b>'!!} {{ $user->hobbies }}</li>
			@endif
			@if($user->interests != NULL)
				<li>{!! '<b>'.trans('common.interests').': </b>'!!} {{ $user->interests }}</li>
			@endif
			@if($user->custom_option1 != NULL && Setting::get('custom_option1') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option1').': </b>'!!} {{ $user->custom_option1 }}</li>
			@endif
			@if($user->custom_option2 != NULL && Setting::get('custom_option2') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option2').': </b>'!!} {{ $user->custom_option2 }}</li>
			@endif
			@if($user->custom_option3 != NULL && Setting::get('custom_option3') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option3').': </b>'!!} {{ $user->custom_option3 }}</li>
			@endif
			@if($user->custom_option4 != NULL && Setting::get('custom_option4') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option4').': </b>'!!} {{ $user->custom_option4 }}</li>
			@endif
		</ul>
	</div>
	
	<ul class="bio-list list-unstyled">
		@if($user->designation != NULL)
			<li><i class="fa fa-thumb-tack"></i> <span>{{ $user->designation }}</span></li>
		@endif
		@if($user->country != NULL)
		<li>
			<i class="fa fa-map-marker" aria-hidden="true"></i><span>{{ trans('common.lives_in').' '.$user->country }}</span>
		</li>
		@endif

		@if($user->city != NULL)
		<li><i class="fa fa-building-o"></i><span>{{ trans('common.from').' '.$user->city }}</span></li>
		@endif

		@if($user->birthday != '1970-01-01')
		<li><i class="fa fa-calendar"></i><span>

			{{ trans('common.born_on').' '.date('F d', strtotime($user->birthday)) }}

		</span></li>
		@endif
	</ul>
	<ul class="list-inline list-unstyled social-links-list">
		@if($user->facebook_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->facebook_link }}" class="btn btn-facebook"><i class="fa fa-facebook"></i></a>
			</li>
		@endif
		@if($user->twitter_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->twitter_link }}" class="btn btn-twitter"><i class="fa fa-twitter"></i></a>
			</li>
		@endif
		@if($user->dribbble_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->dribbble_link }}" class="btn btn-dribbble"><i class="fa fa-dribbble"></i></a>
			</li>
		@endif
		@if($user->youtube_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->youtube_link }}" class="btn btn-youtube"><i class="fa fa-youtube"></i></a>
			</li>
		@endif
		@if($user->instagram_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->instagram_link }}" class="btn btn-instagram"><i class="fa fa-instagram"></i></a>
			</li>
		@endif
		@if($user->linkedin_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->linkedin_link }}" class="btn btn-linkedin"><i class="fa fa-linkedin"></i></a>
			</li>
		@endif
	</ul>
</div>

<!-- Albums Widget -->
@if((Auth::user()->username == $timeline->username) ||
	(Auth::user()->username != $timeline->username) && count($timeline->albums()->get()) > 0)
		
		<div class="widget-pictures widget-best-pictures all-groups">
			<div class="picture side-left">
				<span class="font-15"><i class="fa fa-film"></i> &nbsp;{{ ' '.trans('common.albums') }}</span>
			</div>

			<div class="clearfix"></div>

			<div class="best-pictures my-best-pictures">
				@if(count($timeline->albums()->get()) != NULL)
					<div class="row">
						@foreach($timeline->albums()->take(4)->get() as $album)
							<div class="col-md-6 col-sm-6 col-xs-6 best-pics">
								<a href="{{ url($timeline->username.'/album/show/'.$album->id) }}" class="image-hover" title="{{ $album->name }}" data-toggle="tooltip" data-placement="top">
									@if($album->previewImage()->first() != null) 
									<span class="image-holder">
										<img src="{!! url('/album/'.$album->previewImage()->first()['source']) !!}" alt="{{ $album->name }}" title="{{ $album->name }}">
										<span class="search"></span>
										<i class="fa fa-search-plus"></i>
									</span>
									@else
									<span class="image-holder">
										<img src="{{ url('/album/'.$album->photos()->first()['source']) }}" alt="{{ $album->name }}" title="{{ $album->name }}">
										<span class="search"></span>
										<i class="fa fa-search-plus"></i>
									</span>
									@endif
								</a>
							</div>
						@endforeach
					</div>
					<div>
						<div class="pull-right">
							<a href="{{ url($timeline->username.'/albums') }}" class="">{{ trans('common.show_all') }}</a>&nbsp;&nbsp;&nbsp;
						</div>
						<div class="clearfix"></div>
					</div>
				@else
					<div class="alert alert-warning">{{ trans('messages.no_albums') }}</div>
				@endif
			</div><!-- /best-pictures -->
		</div>
	@endif

		

<!-- /Albums Widget -->

	<!-- my-pages -->
	<div class="widget-pictures widget-best-pictures all-groups">
		<div class="picture side-left">
			{{ trans('common.pages') }}
		</div>
		<div class="clearfix"></div>
		<div class="best-pictures my-best-pictures scrollable">
			<div class="row">
				@if(count($own_pages) > 0)
				@foreach($own_pages as $own_page)
				<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
					<a href="{{ url($own_page->username) }}" class="image-hover" title="{{ $own_page->name }}" data-toggle="tooltip" data-placement="top">
						<img src="@if($own_page->avatar != NULL) {{ url('page/avatar/'.$own_page->avatar) }} @else {{ url('page/avatar/default-page-avatar.png')}} @endif" alt="{{ $own_page->name }}" title="{{ $own_page->name }}">
					</a>
				</div>
				@endforeach
				@else
				<div class="alert alert-warning">{{ trans('messages.no_pages') }}</div>
				@endif
			</div><!-- /row -->
		</div>
		<div class="show-more-options text-center">
			@if(count($own_pages) > 12)
				<a href="#" class="show-all-pages"><i class="fa fa-plus-square-o"></i> {{ trans('common.show_more') }}</a>
				<a href="#" class="less-all-pages"><i class="fa fa-minus-square-o"></i> {{ trans('common.show_less') }}</a>
			@endif
		</div>
	</div>
	<!-- /my pages -->

	<!-- my-groups -->
	<div class="widget-pictures widget-best-pictures all-groups">
		<div class="picture side-left">
			{{ trans('common.groups') }}
		</div>
		<div class="clearfix"></div>
		<div class="best-pictures my-best-pictures scrollable">
			<div class="row">
				@if(count($own_groups) > 0)					
					@foreach($own_groups as $own_group)
					<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
						<a href="{{ url($own_group->username) }}" class="image-hover" title="{{ $own_group->name }}" data-toggle="tooltip" data-placement="top">
							<img src=" @if($own_group->avatar != NULL) {{ url('group/avatar/'.$own_group->avatar) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif " alt="{{ $own_group->name }}" title="{{ $own_group->name }}" >
						</a>
					</div>
					@endforeach					
				@else
					<div class="alert alert-warning">{{ trans('messages.no_groups') }}</div>
				@endif
			</div><!-- /row -->
		</div>
		<div class="see-more-options text-center">
			@if(count($own_groups) > 12)
				<a href="#" class="show-all-groups"><i class="fa fa-plus-square-o"></i> {{ trans('common.show_more') }}</a>
				<a href="#" class="less-all-groups"><i class="fa fa-minus-square-o"></i> {{ trans('common.show_less') }}</a>
			@endif
		</div>
	</div>
	<!-- /my pages -->

	<!-- my-events -->
	<div class="widget-pictures widget-best-pictures all-groups">

		<div class="picture pull-left">
			{{ trans('common.events') }}
		</div>
		<div class="clearfix"></div>
		<div class="best-pictures my-best-pictures scrollable">
			<div class="row">
				@if(count($user_events) > 0)
					@foreach($user_events as $user_event)
					<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
						<a href="{{ url($user_event->timeline->username) }}" class="image-hover" title="{{ $user_event->timeline->name }}" data-toggle="tooltip" data-placement="top">
							<img src="{{ $user_event->user->picture }}" alt="{{ $user_event->timeline->name }}" title="{{ $user_event->timeline->name }}" >						
						</a>
					</div>
					@endforeach
				@else
					<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
				@endif
			</div><!-- /row -->
		</div>
		<div class="see-more-options text-center">
			@if(count($user_events) > 12)
				<a href="#" class="show-all-events"><i class="fa fa-plus-square-o"></i> {{ trans('common.show_more') }}</a>
				<a href="#" class="less-all-events"><i class="fa fa-minus-square-o"></i> {{ trans('common.show_less') }}</a>
			@endif
		</div>
	</div>
	<!-- /my events -->

	@if(Setting::get('timeline_ad') != NULL)
	<div id="link_other" class="post-filters">
		{!! htmlspecialchars_decode(Setting::get('timeline_ad')) !!} 
	</div>	
	@endif
















