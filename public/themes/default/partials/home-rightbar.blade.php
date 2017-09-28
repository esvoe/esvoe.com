<div class="right-side-section">

	<div class="panel panel-default">
		<div class="panel-body nopadding">
			<div class="mini-profile socialite">
				<div class="background">
					<div class="widget-bg">
						<img src=" @if(Auth::user()->cover) {{ url('user/cover/'.Auth::user()->cover) }} @else {{ url('user/cover/default-cover-user.png') }} @endif" alt="{{ Auth::user()->name }}" title="{{ Auth::user()->name }}">
					</div>
					<div class="avatar-img">
						<img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" title="{{ Auth::user()->name }}">
					</div>
				</div>
				<div class="avatar-profile">
					<div class="avatar-details">
						<h2 class="avatar-name">
							<a href="{{ url(Auth::user()->username) }}">
								{{ Auth::user()->name }}
							</a>
						</h2>
						<h4 class="avatar-mail">
							<a href="{{ url(Auth::user()->username) }}">
								{{ '@'.Auth::user()->username }}
							</a>
						</h4>
					</div>
				</div>
				<ul class="activity-list list-inline">
					{{--<li>--}}
					{{--<a href="{{ url(Auth::user()->username.'/posts') }}">--}}
					{{--<div class="activity-name">--}}
					{{--{{ trans('common.posts') }}--}}
					{{--</div>--}}
					{{--<div class="activity-count">--}}
					{{--{{ count(Auth::user()->posts()->where('active', 1)->get()) }}--}}
					{{--</div>--}}
					{{--</a>--}}
					{{--</li>--}}
					<li>
						<a href="{{ url(Auth::user()->username.'/following') }}">
							<div class="activity-name">
								{{ trans('common.following') }}
							</div>
							<div class="activity-count">
								{{ Auth::user()->following->count() }}
							</div>
						</a>
					</li>
					<li>
						<a href="{{ url(Auth::user()->username.'/followers') }}">
							<div class="activity-name">
								{{ trans('common.followers') }}
							</div>
							<div class="activity-count">
								{{ Auth::user()->followers->count() }}
							</div>
						</a>
					</li>

				</ul>
			</div><!-- /mini-profile -->
		</div>
	</div><!-- /panel -->

	<div class="panel panel-default new-panel-group one-block-home">
		<div class="panel-heading no-bg">
			<h3 class="panel-title">
				{{ trans('common.suggested_people') }}
			</h3>
		</div>
		<div class="panel-body">
			@if($suggested_users != "")
				@foreach($suggested_users as $suggested_user)
					<div class="own-mess-notifi-friend">
						<div class="photo-mess-notifi-friend badge-verification" style="background-image: url('{{ $suggested_user->avatar }}');" title="{{ $suggested_user->name }}">
							<a href="{{ url($suggested_user->username) }}"></a>
							{{--@if($suggested_user->verified)
								<span class="verified-badge bg-success verified-medium">
											<i class="icon-verifikaciya svoe-lg svoe-icon"></i>
										</span>
							@endif--}}
						</div>
						<p><a href="{{ url($suggested_user->username) }}">{{ $suggested_user->name }}</a></p>
						<span>{{$suggested_user->city}}</span>
						<div class="action-notifi-friend follow-links js-follow-links">
							<div class="btn-follow">
								<a href="" class="hypothetically-friend follow" rel="{{$suggested_user->id}}" ><i class="icon-dodaty-druzi svoe-lg svoe-icon"></i> <span>{{ trans('friend.add_to_friends') }}</span></a>
							</div>
							<div class="btn-follow hidden">
								<a href="" class="hypothetically-friend unfollow" rel="{{$suggested_user->id}}" ><i class="icon-dodaty-druzi svoe-lg svoe-icon"></i> <span>{{ trans('friend.cancel_request') }}</span></a>
							</div>
							{{--<span>
								<i class="icon-zakrutu svoe-icon"></i>
							</span>--}}
						</div>
					</div>
				@endforeach
			@else
				<div class="alert alert-warning">
					{{ trans('messages.no_suggested_users') }}
				</div>
			@endif
		</div>
	</div>

	<div class="panel panel-default new-panel-group one-block-home">
		<div class="panel-heading no-bg">
			<h3 class="panel-title">
				{{ trans('common.suggested_groups') }}
			</h3>
		</div>
		<div class="panel-body">
			@if($suggested_groups != "")
				@foreach($suggested_groups as $suggested_group)
					<div class="wrap-one-group-prof">
						<div class="photo-group-col" @if($suggested_group->avatar != NULL)style="background-image: url('{{ url('group/avatar/'.$suggested_group->avatar) }}');"title="{{ $suggested_group->name }}" @else style="background-image:url('{{ url('group/avatar/default-group-avatar.png') }}');"{{ $suggested_group->name }} @endif>
							<a href="{{ url($suggested_group->username) }}"></a>
							<div>
								<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
									<a href=""></a>
								</div>
								<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
									<a href=""></a>
								</div>
								<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
									<a href=""></a>
								</div>
							</div>
						</div>
						<div class="content-group-col join-links">
							<p><a href="{{ url($suggested_group->username) }}">{{ $suggested_group->name }}</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
							<div class="btn-group-col">
								@if(!$suggested_group->users->contains(Auth::user()->id))
									<div class="btn-follow">
										<a href="#" class="btn btn-options btn-block join-user btn-default join" data-timeline-id="{{ $suggested_group->timeline_id }}">
											<i class="icon-prisoidenitsa svoe-icon"></i> <span>{{ trans('common.join') }}</span>
										</a>
									</div>
									<div class="btn-follow hidden">
										<a href="#" class="btn btn-options btn-block btn-success join-user joined" data-timeline-id="{{ $suggested_group->timeline_id }}">
											<i class="icon-prinyat-kolo svoe-icon"></i>  <span>{{ trans('common.joined') }}</span>
										</a>
									</div>
								@else
									<div class="btn-follow hidden">
										<a href="#" class="btn btn-options btn-block join-user btn-default join " data-timeline-id="{{ $suggested_group->timeline_id }}">
											<i class="icon-prisoidenitsa svoe-icon"></i>  <span>{{ trans('common.join') }}</span>
										</a>
									</div>
									<div class="btn-follow">
										<a href="#" class="btn btn-options btn-block btn-success join-user joined @if(count($suggested_group->admins()) == 1 && $suggested_group->is_admin(Auth::user()->id)) disabled @endif ">
											<i class="icon-prinyat-kolo svoe-icon"></i>  <span>{{ trans('common.joined') }}</span>
										</a>
									</div>
								@endif
								<span> 3 141(3 друзей)</span>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<div class="alert alert-warning">
					{{ trans('messages.no_suggested_groups') }}
				</div>
			@endif
		</div>
	</div>

	<div class="panel panel-default new-panel-group">
		<div class="panel-heading no-bg">
			<h3 class="panel-title">
				{{ trans('sidebar.pages') }}
			</h3>
		</div>
		<div class="panel-body">
			<div class="wrap-pages-rightbar">
				@if($suggested_pages != "")
				<div class="row">
					@foreach($suggested_pages as $suggested_page)
					<div class="col-sm-6">
						<div class="own-page-rightbar">
							<div class="photo-page-rightbar" @if($suggested_page->avatar != NULL)style="background-image: url('{{ url('page/avatar/'.$suggested_page->avatar) }}');"title="{{ $suggested_page->name }}"@else style="background-image: url('{{ url('page/avatar/default-page-avatar.png') }}');" title="{{ $suggested_page->name }}" @endif>
								<a href="{{ url($suggested_page->username) }}"></a>
							</div>
							<div class="content-page-rightbar">
								<h4><a href="{{ url($suggested_page->username) }}">{{ $suggested_page->name }}</a></h4>
								<p>{{ $suggested_page->category->name }}</p>
								<span><i class="icon-like  svoe-icon"></i> 360</span>
								<div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
									@if(!$suggested_page->likes->contains(Auth::user()->id))
										<div class="btn-follow page"><a href="#" class="btn btn-options btn-block btn-default page-like like" data-timeline-id="{{ $suggested_page->timeline_id }}"><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
										<div class="btn-follow page hidden"><a href="#" class="btn btn-options btn-block btn-success page-like liked " data-timeline-id="{{ $suggested_page->timeline_id }}"><i class="fa fa-heart" aria-hidden="true"></i> <span>{{ trans('common.liked') }}</span></a></div>
									@else
										<div class="btn-follow page hidden"><a href="#" class="btn btn-options btn-block btn-default page-like like " data-timeline-id="{{ $suggested_page->timeline_id }}"><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
										<div class="btn-follow page"><a href="#" class="btn btn-options btn-block btn-success page-like liked " data-timeline-id="{{ $suggested_page->timeline_id }}"><i class="fa fa-heart" aria-hidden="true"></i> <span>{{ trans('common.liked') }}</span></a></div>
									@endif
									<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
										<i class="icon-pidpysatysya  svoe-icon"></i>
										Подписаться
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				@else
					<div class="alert alert-warning">
						{{ trans('messages.no_suggested_pages') }}
					</div>
				@endif
			</div>
		</div>
	</div>

	<div class="panel panel-default new-panel-group one-block-home">
		<div class="panel-heading no-bg">
			<h3 class="panel-title">
				{{ trans('sidebar.my_events') }}
			</h3>
		</div>
		<div class="panel-body">
			<div class="wrap-one-event-col">
				<div class="photo-event-col" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/set3/other-img-2.png')">
					<div class="shadow-event-prof">
						<div class="date-event-prof">
							<span class="number-date">26</span>
							<span>серпня</span>
						</div>
					</div>
					<div class="wrap-event-friend">
						<div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/profheader/profheader-ava.jpg')">
							<a href=""></a>
						</div>
						<div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/set3/orher-img-1.png')">
							<a href=""></a>
						</div>
						<div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/set3/8.jpg')">
							<a href=""></a>
						</div>
					</div>
				</div>
				<div class="content-event-col">
					<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
					<div class="btn-hover-wrap">
						<a href="" class="btn-action-hover">
							<i class="icon-pereytu  svoe-icon"></i>
							Посетить
						</a>
						<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
							<i class="icon-pidpysatysya  svoe-icon"></i>
							Подписаться
						</a>
					</div>
					<span>295 374 участников</span>
				</div>
			</div>
			<div class="wrap-one-event-col">
				<div class="photo-event-col" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/event-prof-1.png')">
					<div class="shadow-event-prof">
						<div class="date-event-prof">
							<span class="number-date">26</span>
							<span>серпня</span>
						</div>
					</div>
					<div class="wrap-event-friend">
						<div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/profheader/profheader-ava.jpg')">
							<a href=""></a>
						</div>
						<div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/set3/orher-img-1.png')">
							<a href=""></a>
						</div>
						<div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/themes/default/assets/images/set3/8.jpg')">
							<a href=""></a>
						</div>
					</div>
				</div>
				<div class="content-event-col">
					<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
					<div class="btn-hover-wrap">
						<a href="" class="btn-action-hover">
							<i class="icon-pereytu  svoe-icon"></i>
							Посетить
						</a>
						<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
							<i class="icon-pidpysatysya  svoe-icon"></i>
							Подписаться
						</a>
					</div>
					<span>295 374 участников</span>
				</div>
			</div>
		</div>
	</div>



	{{--@if(Setting::get('home_ad') != NULL)--}}
	{{--<div id="link_other" class="post-filters">--}}
	{{--{!! htmlspecialchars_decode(Setting::get('home_ad')) !!}--}}
	{{--</div>--}}
	{{--@endif--}}

	<div class="wrap-footer-home panel panel-default">
		<a @if(Config::get('app.locale')== 'en')class="active-lang-home" @endif href="{{url('setlocale/'.'en')}}">{{Config::get('app.locales')['en']}}</a>
		<a @if(Config::get('app.locale')== 'ru')class="active-lang-home" @endif href="{{url('setlocale/'.'ru')}}">{{Config::get('app.locales')['ru']}}</a>
		<a @if(Config::get('app.locale')== 'ua')class="active-lang-home" @endif href="{{url('setlocale/'.'ua')}}">{{Config::get('app.locales')['ua']}}</a>
		<div class="more-lang-home">
			<a data-toggle="modal" data-target=".modal-lang" href=""><i class="fa fa-globe fa-lg" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="link-home-footer">
		@foreach(App\StaticPage::active() as $staticpage)
			<a href="{{ url('page/'.$staticpage->slug) }}">{{ trans('common.'.$staticpage->title.'_footer') }}</a>
		@endforeach
		<p>
			<a class="copy" href="/">{{ Setting::get('site_name') }} </a>
			<span>&copy; {{ date('Y') }}</span>
		</p>
	</div>
</div>


