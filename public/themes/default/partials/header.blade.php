<header>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">
				<img src="{!! Theme::asset()->url('images/logo-svg.svg') !!}" alt="{{ Setting::get('site_name') }}" title="{{ Setting::get('site_name') }}">
                <img class="beta-img" src="{!! Theme::asset()->url('images/beta.svg') !!}" alt="beta-svg">
				<span class="logo-text">своє!</span>
                <span style="display: none;" data-logo-text="friend" class="logo-text other-logo">{{ trans('common.friends') }}!</span>
                <span style="display: none;" data-logo-text="photo" class="logo-text other-logo">{{ trans('common.photos') }}!</span>
                <span style="display: none;" data-logo-text="video" class="logo-text other-logo">{{ trans('common.videos') }}!</span>
                <span style="display: none;" data-logo-text="audio" class="logo-text other-logo">{{ trans('common.music') }}!</span>
                <span style="display: none;" data-logo-text="mess" class="logo-text other-logo">{{ trans('common.messages') }}!</span>
                <span style="display: none;" data-logo-text="group" class="logo-text other-logo">{{ trans('common.groups') }}!</span>
                <span style="display: none;" data-logo-text="news" class="logo-text other-logo">{{ trans('common.news') }}!</span>
                <span style="display: none;" data-logo-text="answer" class="logo-text other-logo">{{ trans('common.replies') }}!</span>
                <span style="display: none;" data-logo-text="note" class="logo-text other-logo">{{ trans('common.bookmarks') }}!</span>
                <span style="display: none;" data-logo-text="setting" class="logo-text other-logo">{{ trans('common.settings') }}!</span>
                <span style="display: none;" data-logo-text="app" class="logo-text other-logo">{{ trans('common.applications') }}!</span>
                <span style="display: none;" data-logo-text="doc" class="logo-text other-logo">{{ trans('common.documents') }}!</span>
                <span style="display: none;" data-logo-text="event" class="logo-text other-logo">{{ trans('common.events') }}!</span>
                <span style="display: none;" data-logo-text="gods" class="logo-text other-logo">{{ trans('common.goods') }}!</span>
                <span style="display: none;" data-logo-text="car" class="logo-text other-logo">{{ trans('common.car') }}!</span>
                <span style="display: none;" data-logo-text="wallet" class="logo-text other-logo">{{ trans('common.wallet') }}!</span>
			</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left form-left" role="search">
                <div class="input-group no-margin">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"><img src="{!! Theme::asset()->url('images/_new/loop-search.png') !!}" alt=""></button>
					</span>
                    <input type="text" id="navbar-search" data-url="{{ URL::to('api/v1/timelines') }}" class="form-control" placeholder="{{ trans('messages.search_placeholder') }}">
                </div><!-- /input-group -->
            </form>
			<!-- Collect the nav links, forms, and other content for toggling -->
			
			@if (Auth::guest())
			<ul class="nav navbar-nav navbar-right">
				<li class="logout">
					<a href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ trans('common.join') }}</a>
				</li>
			</ul>
			@else
{{--start new menu--}}
				<ul class="nav navbar-nav navbar-right notification-list" id="navbar-right" v-cloak>


                    <li class="widget-li" style="display: none;">
                        <div class="block-played-radio played-radio-widget">
                            <div class="active-radio-img active-radio-widget">
                                <div class="fon-pause-img">
                                    <i class="icon-paysa svoe-lg svoe-icon"></i>
                                </div>
                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-1.png') !!}" alt="">
                            </div>
                            <span>
                                <img src="{!! Theme::asset()->url('images/play-ekva.gif') !!}" alt="">
                                <img class="stop-ekva" src="{!! Theme::asset()->url('images/stop-ekva.png') !!}" alt="">
                            </span>
                            <h6>Хіт FM</h6>
                            <p>Anna Naklab, Alle Farben & You...</p>
                        </div>
                        <div class="jp-jplayer" id="radio-w"></div>
                        <div class="jp-audio jp_container_radio radio-widget" style="display: none"  role="application" aria-label="media player">
                            <div class="jp-type-single">
                                <div class="jp-gui jp-interface">
                                    <div class="jp-controls-holder">
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-current-time"  role="timer" aria-label="time">&nbsp;</div>
                                        <div class="jp-duration hidden"  role="timer" aria-label="duration">&nbsp;</div>
                                        <div class="jp-duration-radio"  role="timer" aria-label="duration">--:--</div>
                                        <div class="jp-controls">
                                            <button class="jp-previous" onclick="previousRadio()" role="button" tabindex="0"><i class="icon-nastypna svoe-lg svoe-icon"></i></button>
                                            <button class="jp-play" onclick="playPause()" role="button" tabindex="0">
                                                <i class="icon-paysa svoe-lg svoe-icon"></i>
                                                <i class="icon-igratu svoe-lg svoe-icon"></i>
                                            </button>
                                            <button class="jp-next" onclick="nextRadio()" role="button" tabindex="0"><i class="icon-nastypna svoe-lg svoe-icon"></i></button>
                                            <button class="jp-stop hidden" role="button" tabindex="0">stop</button>
                                        </div>
                                        <div class="jp-toggles">
                                            <button class="jp-repeat" role="button" tabindex="0"><i class="icon-povtorutu svoe-icon"></i></button>
                                            <button class="jp-shuffle hidden" role="button" tabindex="0"><img src="{!! Theme::asset()->url('images/suffle-audio.png') !!}" alt=""></button>
                                            <button class="jp-change-widget" role="button" tabindex="0">
                                                <i class="icon-rozshurutu svoe-icon"></i>
                                                <i class="icon-zhornytu svoe-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="jp-volume-controls">
                                        <button class="jp-mute" role="button" tabindex="0">
                                            <i class="icon-zvyk svoe-icon"></i>
                                            <i class="icon-zvyk-off svoe-icon"></i>
                                        </button>
                                        <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="jp-details">
                                    <div class="jp-title" aria-label="title">&nbsp;</div>
                                </div>
                                <div class="jp-no-solution">
                                    <span>Update Required</span>
                                    To play the media you will need to either update your browser to a recent version or update your <a href="https://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                </div>
                            </div>
                            <div class="jp-playlist" style="display: none;">
                                <ul>
                                    <li></li> <!-- Empty <li> so your HTML conforms with the W3C spec -->
                                </ul>
                            </div>
                        </div>
                    </li>








{{--					<li class="dropdown profile-header dropdown-link-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="{{ Auth::user()->name }}">
							<span style="background-image: url('{{ Auth::user()->avatar }}')" ></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="name-user-header" href="#"><img src="{!! Theme::asset()->url('images/_new/icon-profile-header.png') !!}" alt="">Андрій Винарчик</a></li>
							<li>
								<a class="email-user-header" href="#">
									<img src="{!! Theme::asset()->url('images/_new/icon-email-profile-header.png') !!}" alt="">
									<img class="valid-email-prof" src="{!! Theme::asset()->url('images/_new/check-email-valid.png') !!}" alt="">
									{{ Auth::user()->mail }}
								</a>
							</li>
							<li>
								<a class="e-token-prof-head" href="{{ url(Auth::user()->username.'/wallet') }}">
									<img src="{!! Theme::asset()->url('images/_new/icon-wallet-profile-header.png') !!}" alt="">
									<span>153</span> єТокенів
									<span><img src="{!! Theme::asset()->url('images/_new/balance-plus.png') !!}" alt=""></span>
								</a>
							</li>
							<li class="logout-prof-header"><a href="#"><span><img src="{!! Theme::asset()->url('images/_new/icon-logout-header.png') !!}" alt=""></span></a></li>
						</ul>
					</li>--}}

					<li class="dropdown profile-header dropdown-link-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span style="background-image: url('{{ Auth::user()->avatar }}')"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="name-user-header" href="{{ url(Auth::user()->username) }}"><img src="{!! Theme::asset()->url('images/_new/icon-profile-header.png') !!}" alt="">{{ Auth::user()->name }}</a></li>
							<li>
								<a class="email-user-header" href="#">
									<img src="{!! Theme::asset()->url('images/_new/icon-email-profile-header.png') !!}" alt="">
									<img class="valid-email-prof" src="{!! Theme::asset()->url('images/_new/check-email-valid.png') !!}" alt="">
									{{ Auth::user()->email }}
								</a>
							</li>
							<li>
								<a class="e-token-prof-head" href="{{ url(Auth::user()->username.'/wallet') }}">
									<img src="{!! Theme::asset()->url('images/_new/icon-wallet-profile-header.png') !!}" alt="">
									<span>{{ Auth::user()->wallet->token / 1000 }}</span> єТокенів
									<span><img src="{!! Theme::asset()->url('images/_new/balance-plus.png') !!}" alt=""></span>
								</a>
							</li>
							<li class="logout-prof-header">
								<form action="{{ url('/logout') }}" method="post" id="logoutForm">
								{{ csrf_field() }}
									{{--<button type="submit" class="btn-logout"><i class="fa fa-unlock" aria-hidden="true"></i>{{ trans('common.logout') }}</button>--}}
								</form>
                                <a href="#" onclick="document.getElementById('logoutForm').submit();return false;"><span><img src="{!! Theme::asset()->url('images/_new/icon-logout-header.png') !!}" alt=""></span></a>
							</li>
							<li>
{{--							<ul class="list-token">
									@if(Auth::user()->hasRole('admin'))
										<li class="{{ Request::segment(1) == 'admin' ? 'active' : '' }}"><a href="{{ url('admin') }}"><i class="fa fa-user-secret" aria-hidden="true"></i>{{ trans('common.admin') }}</a></li>
									@endif
									<li class="{{ (Request::segment(1) == Auth::user()->username && Request::segment(2) == '') ? 'active' : '' }}"><a style="padding-left: 10px" href="{{ url(Auth::user()->username) }}"><i class="fa fa-user" aria-hidden="true" style="margin-right: 20px"></i>{{ trans('common.my_profile') }}</a></li>
									<li class="{{ (Request::segment(1) == Auth::user()->username && Request::segment(2) == '') ? 'active' : '' }}">
										<a style="padding-left: 10px" href="{{ url(Auth::user()->username.'/wallet') }}">
											<i class="fa fa-money" aria-hidden="true" style="margin-right: 20px"></i>{{ trans('common.wallet_menu') }}
										</a>
									</li>
									<li class="{{ Request::segment(2) == 'albums' ? 'active' : '' }}"><a style="padding-left: 10px" href="{{ url(Auth::user()->username.'/albums') }}"><i class="fa fa-image" aria-hidden="true" style="margin-right: 20px"></i>{{ trans('common.my_albums') }}</a></li>
									<li class="{{ Request::segment(2) == 'pages' ? 'active' : '' }}"><a style="padding-left: 10px" href="{{ url(Auth::user()->username.'/pages') }}"><i class="fa fa-file-text" aria-hidden="true" style="margin-right: 20px"></i>{{ trans('common.my_pages') }}</a></li>
									<li class="{{ Request::segment(2) == 'groups' ? 'active' : '' }}"><a style="padding-left: 10px" href="{{ url(Auth::user()->username.'/groups') }}"><i class="fa fa-users" aria-hidden="true" style="margin-right: 20px"></i>{{ trans('common.my_groups') }}</a></li>
									<li class="{{ Request::segment(3) == 'events' ? 'active' : '' }}"><a style="padding-left: 10px" href="{{ url(Auth::user()->username.'/events') }}"><i class="fa fa-calendar" aria-hidden="true" style="margin-right: 20px"></i>{{ trans('common.my_events') }}</a></li>
									<li class="{{ Request::segment(3) == 'general' ? 'active' : '' }}"><a style="padding-left: 10px" href="{{ url('/'.Auth::user()->username.'/settings/general') }}"><i class="fa fa-cog" aria-hidden="true" style="margin-right: 20px"></i>{{ trans('common.settings') }}</a></li>
								</ul>--}}
                                <ul class="list-token">
                                    @if(Auth::user()->hasRole('admin'))
                                    <li>
                                        <a href="{{ url('admin') }}">
                                            <img src="{!! Theme::asset()->url('images/_new/icon-logout-header.png') !!}" alt="icon-wallet">
                                            {{ trans('common.admin') }}
                                        </a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{ url(Auth::user()->username.'/albums') }}">
                                            <img src="{!! Theme::asset()->url('images/_new/icon-photo.png') !!}" alt="icon-wallet" style="max-height: 15px">
                                            {{ trans('common.my_albums') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url(Auth::user()->username.'/pages') }}">
                                            <img src="{!! Theme::asset()->url('images/_new/icon-news.png') !!}" alt="icon-wallet" style="max-height: 15px">
                                            {{ trans('common.my_pages') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url(Auth::user()->username.'/groups') }}">
                                            {{--<img src="{!! Theme::asset()->url('images/_new/icon-other-friend.png') !!}" alt="icon-wallet">--}}
                                            <img src="{!! Theme::asset()->url('images/_new/icon-group.png') !!}" alt="icon-wallet" style="max-height: 15px">
                                            {{ trans('common.my_groups') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url(Auth::user()->username.'/events') }}">
                                            <img src="{!! Theme::asset()->url('images/_new/icon-event.png') !!}" alt="icon-wallet" style="max-height: 15px">
                                            {{ trans('common.my_events') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://sand.esvoe.com/application/auth?id=50&endpoint=d20537dc031e67cf5157">
                                            <img src="{!! Theme::asset()->url('images/_new/icon-video.png') !!}" alt="icon-wallet" style="max-height: 15px">
                                            {{ trans('common.my_advertising') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/'.Auth::user()->username.'/settings/general') }}">
                                            <img src="{!! Theme::asset()->url('images/_new/icon-setting.png') !!}" alt="icon-wallet" style="max-height: 15px">
                                            {{ trans('common.settings') }}
                                        </a>
                                    </li>
                                </ul>
							</li>
						</ul>
					</li>

                    <li class="music-player dropdown-link-menu">
                        <a href="#">
                            <i class="icon-myzuka svoe-icon"></i>
                        </a>
                        <div class="drop-music-player dropdown-open">
                            <div class="widget-music">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" ><a style="pointer-events: none" href="#my-music" aria-controls="home" role="tab" data-toggle="tab">{{ trans('common.my_music') }}</a></li>
                                    <li role="presentation"><a style="pointer-events: none" href="#friend-music" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('common.music_of_friends') }}</a></li>
                                    <li role="presentation" class="active"><a href="#online-radio" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('common.online_radio') }}</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane" id="my-music" >
                                        <div class="wrap-played-list">



                                            <div id="jquery_jplayer_2" class="jp-jplayer"></div>
                                            <div id="jp_container_2" class="jp-audio my-music-jp" role="application" aria-label="media player">
                                                <div class="jp-type-playlist">
                                                    <div class="jp-gui jp-interface">
                                                        <div class="jp-controls">
                                                            <button class="jp-previous" role="button" tabindex="0">previous</button>
                                                            <button class="jp-play" role="button" tabindex="0">play</button>
                                                            <button class="jp-next" role="button" tabindex="0">next</button>
                                                            <button class="jp-stop" role="button" tabindex="0">stop</button>
                                                        </div>
                                                        <div class="jp-progress">
                                                            <div class="jp-seek-bar">
                                                                <div class="jp-play-bar"></div>
                                                            </div>
                                                        </div>
                                                        <div class="jp-volume-controls">
                                                            <button class="jp-mute" role="button" tabindex="0">mute</button>
                                                            <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                                            <div class="jp-volume-bar">
                                                                <div class="jp-volume-bar-value"></div>
                                                            </div>
                                                        </div>
                                                        <div class="jp-time-holder">
                                                            <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                                            <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                                        </div>
                                                        <div class="jp-toggles">
                                                            <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                                            <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
                                                        </div>
                                                    </div>
                                                    <div class="jp-playlist">
                                                        <ul>
                                                            <li>&nbsp;</li>
                                                        </ul>
                                                    </div>
                                                    <div class="jp-no-solution">
                                                        <span>Update Required</span>
                                                        To play the media you will need to either update your browser to a recent version or update your <a href="https://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="friend-music" >...</div>
                                    <div role="tabpanel" class="tab-pane active fade in" id="online-radio">
                                        <div class="wrap-played-list">
                                            <div  class="jp-jplayer jquery_jplayer_radio" id="radio-j"></div>
                                            <div  class="jp-audio jp_container_radio" role="application" aria-label="media player">
                                                <div class="jp-type-single">
                                                    <div class="jp-gui jp-interface">

                                                        <div class="block-played-radio">
                                                            <div class="active-radio-img">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-1.png') !!}" alt="">
                                                            </div>
                                                            <h5>
                                                                Хіт FM <!-- <br>
								    				<p>Від 90-х до сьогодні</p> -->
                                                            </h5>
                                                        </div>

                                                        <div class="jp-controls-holder">
                                                            <div class="jp-controls">
                                                                <button class="jp-play tab-jp-play" onclick="playPause(this);" role="button" tabindex="0">play</button>
                                                                <button class="jp-stop" style="display: none;" role="button" tabindex="0">stop</button>
                                                            </div>
                                                            <div class="jp-progress" style="display: none;">
                                                                <div class="jp-seek-bar">
                                                                    <div class="jp-play-bar"></div>
                                                                </div>
                                                            </div>
                                                            <div class="jp-current-time" style="display: none;" role="timer" aria-label="time">&nbsp;</div>
                                                            <div class="jp-duration" style="display: none;" role="timer" aria-label="duration">&nbsp;</div>
                                                            <div class="jp-toggles" style="display: none;">
                                                                <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                                            </div>
                                                        </div>
                                                        <div class="jp-volume-controls">
                                                            <button class="jp-mute" role="button" tabindex="0">mute</button>
                                                            <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                                            <div class="jp-volume-bar">
                                                                <div class="jp-volume-bar-value"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="jp-details">
                                                        <div class="jp-title" aria-label="title">&nbsp;</div>
                                                    </div>
                                                    <div class="jp-no-solution">
                                                        <span>Update Required</span>
                                                        To play the media you will need to either update your browser to a recent version or update your <a href="https://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                                    </div>
                                                </div>
                                                <div class="jp-playlist" style="display: none;">
                                                    <ul>
                                                        <li></li> <!-- Empty <li> so your HTML conforms with the W3C spec -->
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="wrap-radio-list">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="block-own-radio active-radio" data-play="0">
                                                            <div class="wrap-own-radio-list">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-1.png') !!}" alt="">
                                                            </div>
                                                            <h5>Хіт FM</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="block-own-radio" data-play="1">
                                                            <div class="wrap-own-radio-list">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-2.png') !!}" alt="">
                                                            </div>
                                                            <h5>KISS FM</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="block-own-radio" data-play="2">
                                                            <div class="wrap-own-radio-list">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-3.gif') !!}" alt="">
                                                            </div>
                                                            <h5>Русское радио</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="block-own-radio" data-play="3">
                                                            <div class="wrap-own-radio-list">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-4.gif') !!}" alt="">
                                                            </div>
                                                            <h5>Люкс ФМ</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="block-own-radio" data-play="4">
                                                            <div class="wrap-own-radio-list">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-5.gif') !!}" alt="">
                                                            </div>
                                                            <h5>Radio ROKS</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="block-own-radio" data-play="5">
                                                            <div class="wrap-own-radio-list">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-6.gif') !!}" alt="">
                                                            </div>
                                                            <h5>Радіо Львівська хвиля</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="block-own-radio" data-play="6">
                                                            <div class="wrap-own-radio-list">
                                                                <img class="img-responsive" src="{!! Theme::asset()->url('images/_new/icon-radio-7.gif') !!}" alt="">
                                                            </div>
                                                            <h5>Радіо-Ера</h5>
                                                        </div>
                                                    </div>
                                                    {{--<div class="col-xs-6">--}}
                                                        {{--<div class="block-own-radio" data-play="6">--}}
                                                            {{--<iframe src="http://icecastlv.luxnet.ua/lux" style="height: 75px; width: 200px"></iframe>--}}
                                                            {{--http://icecastlv.luxnet.ua/lux--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="show-all-radio">
                                            {{ trans('common.see_all') }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>

{{--					<li class="music-player">
						<a href="#">
							<img src="{!! Theme::asset()->url('images/_new/active-music-header.png') !!}" alt="icon-logout" class="active-music-icon">
							<img src="{!! Theme::asset()->url('images/_new/music-header.png') !!}" alt="icon-logout">
						</a>
					</li>--}}

{{--					<li class="notification dropdown-link-menu">
						<a href="#">
							<img src="{!! Theme::asset()->url('images/_new/active-notification-header.png') !!}" alt="icon-logout" class="active-notification-icon">
							<img src="{!! Theme::asset()->url('images/_new/notification-header.png') !!}" alt="icon-logout">
						</a>
						<div class="drop-notification dropdown-open">
							<div class="header-notifi">
								Сповіщення
								<i class="fa fa-cog fa-lg" aria-hidden="true"></i>
							</div>
							<div class="wrap-own-notifi">
								<div class="notifi-user online-notifi">
									<span></span>
									<div class="photo-notifi-user" style="background-image: url('{!! Theme::asset()->url('images/_new/friend.png') !!}')"></div>
								</div>
								<p>
									<a href="">Оксана Габалевич</a> <br>
									<span>3 спільних друзів</span>
								</p>
								<div class="nav-notifi-friend">
									<div>Підтвердити</div>
									<div>Видалити</div>
								</div>
							</div>
							<div class="wrap-own-notifi">
								<div class="notifi-user online-notifi">
									<span></span>
									<div class="photo-notifi-user" style="background-image: url('{!! Theme::asset()->url('images/_new/friend.png') !!}')"></div>
								</div>
								<p>
									<a href="">Мандруючи Україною</a> запрошує вас вступити у спільноту
									<a href="">Фірмовий тур "КАРПАТСЬКІ КАНІКУЛИ!"</a>
									<br>
									<span>12 год тому</span>
								</p>
								<div class="nav-notifi-friend group-notifi">
									<div>Підтвердити</div>
									<div>Видалити</div>
								</div>
							</div>
							<div class="wrap-own-notifi">
								<div class="notifi-user online-notifi">
									<span></span>
									<div class="photo-notifi-user" style="background-image: url('{!! Theme::asset()->url('images/_new/friend.png') !!}')"></div>
								</div>
								<p>
									<a href="">Оксана Габалевич</a> <br>
									<span>3 спільних друзів</span>
								</p>
								<div class="nav-notifi-friend">
									<div>Підтвердити</div>
									<div>Видалити</div>
								</div>
							</div>
							<div class="wrap-own-notifi">
								<div class="notifi-user online-notifi">
									<span></span>
									<div class="photo-notifi-user" style="background-image: url('{!! Theme::asset()->url('images/_new/friend.png') !!}')"></div>
								</div>
								<p>
									<a href="">Мандруючи Україною</a> запрошує вас вступити у спільноту
									<a href="">Фірмовий тур "КАРПАТСЬКІ КАНІКУЛИ!"</a>
									<br>
									<span>12 год тому</span>
								</p>
								<div class="nav-notifi-friend group-notifi">
									<div>Підтвердити</div>
									<div>Видалити</div>
								</div>
							</div>
							<div class="show-all-notifi">
								Переглянути всі
							</div>
						</div>
					</li>--}}
					<li class="dropdown message notification dropdown-link-menu">
						<a href="#" data-toggle="dropdown" @click.prevent="showNotifications" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-spovischennya svoe-icon"></i>
							{{--<i class="fa fa-bell" aria-hidden="true" style="font-size: 18px">--}}
								@if(Auth::user()->notifications()->where('seen',0)->count() > 0)
									<span class="count hidden">{{ Auth::user()->notifications()->where('seen',0)->count() }}</span>
									<span class="count" v-if="unreadNotifications > 0" >@{{ unreadNotifications }}</span>
								@endif
							{{--</i>--}}
							{{--<span class="small-screen">{{ trans('common.notifications') }}</span>--}}
						</a>
						<div class="dropdown-menu dropdown-open">
							<div class="dropdown-menu-header">
								<span class="side-left">{{ trans('common.notifications') }}</span>
								<a v-if="unreadNotifications > 0" class="side-right" href="#" @click.prevent="markNotificationsRead" >{{ trans('messages.mark_all_read') }}</a>
								<div class="clearfix"></div>
							</div>
							@if(Auth::user()->notifications()->count() > 0)
								<ul class="list-unstyled dropdown-messages-list scrollable" data-type="notifications">
									<li class="inbox-message"  v-bind:class="[ !notification.seen ? 'active' : '' ]" v-for="notification in notifications.data">
										{{--<a href="{{ url(Auth::user()->username.'/notification/') }}/@{{ notification.id }}">--}}
											<div class="media">
												<div class="media-left" v-bind:style="{ backgroundImage: 'url(' + notification.notified_from.avatar + ')', cursor: 'pointer'} " onClick="window.location.href = '/@{{ notification.notified_from.username }}';">
													{{--<img class="media-object img-icon" v-bind:src="notification.notified_from.avatar" alt="images">--}}
												</div>
												<div class="media-body">
                                                    <a href="{{ url(Auth::user()->username.'/notification/') }}/@{{ notification.id }}">
													<h4 class="media-heading">
														<span class="notification-text">@{{ notification.description_owner }} <span>@{{ notification.description }}</span> </span>
														<span class="message-time">
																<span class="notification-type"><i class="fa fa-user" aria-hidden="true"></i></span>
																<time class="timeago" datetime="@{{ notification.created_at }}+03:00" title="@{{ notification.created_at }}+03:00">
																	@{{ notification.created_at }}+03:00
																</time>
															</span>
													</h4>
                                                    </a>
												</div>
											</div>
										{{--</a>--}}
									</li>
									<li v-if="notificationsLoading" class="dropdown-loading">
										<i class="fa fa-spin fa-spinner"></i>
									</li>
								</ul>
							@else
								<div class="no-messages">
									<i class="fa fa-bell-slash-o" aria-hidden="true"></i>
									<p>{{ trans('messages.no_notifications') }}</p>
								</div>
							@endif
							<div class="dropdown-menu-footer">
								<a href="{{ url('allnotifications') }}">{{ trans('common.see_all') }}</a>
							</div>
						</div>
					</li>



                    <li class="notifi-friend dropdown-link-menu">
                        <a href="#">
                            <i class="icon-druzi svoe-2x svoe-icon"></i>
                        </a>
                        <div class="dropdown-vidget dropdown-open notifi-friend">
                            <div class="scroll-notifi-friend" id="friendInviteList">
                            </div>

                            <a href="{{route('friend.list.of.invite')}}" class="show-all-notifi-friend">{{ trans('friend.see_all') }}</a>
                        </div>
                    </li>


					{{--<li class="wallet-widget dropdown-link-menu">--}}
						{{--<a href="#">--}}
							{{--<img src="{!! Theme::asset()->url('images/_new/walle-icon-header-active.png') !!}" alt="icon-logout" class="active-logout-icon">--}}
							{{--<img src="{!! Theme::asset()->url('images/_new/walle-icon-header.png') !!}" alt="icon-logout">--}}
						{{--</a>--}}
						{{--<div class="dropdown-vidget dropdown-open">--}}
							{{--<p class="balance-token">--}}
                                {{--{{ trans('common.balance') }}--}}
								{{--<a href="#">єТокенів:</a>--}}
								{{--<span>--}}
				        			{{--{{ Auth::user()->wallet->token / 1000 }}--}}
				        			{{--<span><img src="{!! Theme::asset()->url('images/_new/balance-plus.png') !!}" alt=""></span>--}}
				        		{{--</span>--}}
							{{--</p>--}}
							{{--<ul class="list-token">--}}
								{{--<li>--}}
									{{--<a href="">--}}
										{{--<img src="{!! Theme::asset()->url('images/_new/icon-pay-token.png') !!}" alt="icon-wallet">--}}
                                        {{--{{ trans('common.buy') }} <span>єТокени</span>--}}
									{{--</a>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<a href="">--}}
										{{--<img src="{!! Theme::asset()->url('images/_new/icon-sale-token.png') !!}" alt="icon-wallet">--}}
                                        {{--{{ trans('common.sell') }} <span>єТокени</span>--}}
									{{--</a>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<a href="">--}}
										{{--<img src="{!! Theme::asset()->url('images/_new/icon-transfer-token.png') !!}" alt="icon-wallet">--}}
                                        {{--{{ trans('common.translate_to_another_user') }}--}}
									{{--</a>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<a href="">--}}
										{{--<img src="{!! Theme::asset()->url('images/_new/icon-transfer-email-token.png') !!}" alt="icon-wallet">--}}
                                        {{--{{ trans('common.translate_to_email') }}--}}
									{{--</a>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<a href="">--}}
										{{--<img src="{!! Theme::asset()->url('images/_new/icon-pay-product-poslug.png') !!}" alt="icon-wallet">--}}
                                        {{--{{ trans('common.pay_for_goods_and_services') }}--}}
									{{--</a>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<a href="">--}}
										{{--<img src="{!! Theme::asset()->url('images/_new/icon-history-tranzaction.png') !!}" alt="icon-wallet">--}}
                                        {{--{{ trans('common.transaction_history') }}--}}
									{{--</a>--}}
								{{--</li>--}}
							{{--</ul>--}}
						{{--</div>--}}
					{{--</li>--}}

					{{--<li class="dropdown message largescreen-message">
						<a href="#" data-toggle="dropdown" @click="showConversations" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-comments" aria-hidden="true" style="font-size: 18px">
								<span class="count" v-if="unreadConversations" >@{{ unreadConversations }}</span>
							</i>
							--}}{{--<span class="small-screen">{{ trans('common.messages') }}</span>--}}{{--
						</a>
						<div class="dropdown-menu">
							<div class="dropdown-menu-header">
								<span class="side-left">{{ trans('common.messages') }}</span>
								<div class="clearfix"></div>
							</div>
							<div class="no-messages hidden">
								<i class="fa fa-commenting-o" aria-hidden="true"></i>
								<p>{{ trans('messages.no_messages') }}</p>
							</div>
							<ul class="list-unstyled dropdown-messages-list scrollable" data-type="messages">
								<li class="inbox-message" v-for="conversation in conversations.data">
									<a href="#" onclick="chatBoxes.sendMessage(@{{ conversation.user.id }})">
										<div class="media">
											<div class="media-left">
												<img class="media-object img-icon" v-bind:src="conversation.user.avatar" alt="images">
											</div>
											<div class="media-body">
												<h4 class="media-heading">
													<span class="message-heading">@{{ conversation.user.name }}</span>
													<span class="online-status hidden"></span>
													<time class="timeago message-time" datetime="@{{ conversation.lastMessage.created_at }}+00:00" title="@{{ conversation.lastMessage.created_at }}+00:00">
														@{{ conversation.lastMessage.created_at }}+00:00
												</h4>
												<p class="message-text">
													@{{ conversation.lastMessage.body }}
												</p>
											</div>
										</div>
									</a>
								</li>
								<li v-if="conversationsLoading" class="dropdown-loading">
									<i class="fa fa-spin fa-spinner"></i>
								</li>
							</ul>
							<div class="dropdown-menu-footer">
								<a href="{{ url('messages') }}">{{ trans('common.see_all') }}</a>
							</div>
						</div>
					</li>--}}

                    <li class="header-friends {{--chat-list-toggle--}}">
                        <a href="#">
                            <i class="icon-povidomlennia svoe-lg svoe-icon"></i>
                            <span v-if="unreadedDialogsCount">@{{ unreadedDialogsCount }}</span>
                        </a>
                    </li>

					{{--<li class="header-friends chat-list-toggle">
						<a href="#"><i class="fa fa-users" aria-hidden="true"></i><span class="small-screen">chat-list</span></a>
					</li>--}}

				</ul>
                <ul class="nav navbar-nav nav-center-link">
                    <li><a href="{{ url(Auth::user()->username.'/people') }}">{{ trans('header.people') }}</a></li>
                    <li><a href="{{ url(Auth::user()->username.'/groups') }}">{{ trans('header.groups') }}</a></li>
                    <li><a href="{{ url('apps') }}">{{ trans('header.games') }}</a></li>
                    <li><a href="{{ url(Auth::user()->username.'/audio-recordings') }}">{{ trans('header.music') }}</a></li>
                </ul>
{{--end new menu--}}
			@endif
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
</header>


	{!! Theme::asset()->container('footer')->usePath()->add('notifications', 'js/notifications.js') !!}
	{!! Theme::asset()->container('footer')->usePath()->add('friendInvite', 'js/friendInviteList.js') !!}
