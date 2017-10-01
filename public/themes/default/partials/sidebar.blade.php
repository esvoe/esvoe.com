<div id="leftSidebar" class="sidebar">
	<ul>
		<li class="{!! (Request::segment(2)=='friends' ? 'active' : '') !!}">
			<a data-change-logo="friend" href="{{ url(Auth::user()->username.'/friends') }}" {{--style="color: #d7dfe7;pointer-events: none;"--}}>
				<i style="top: 5px; left: 18px;" class="icon-druzi svoe-2x svoe-icon"></i>
				@if(Auth::user()->profile->count_invite > 0)<span class="count-block-side">+{{Auth::user()->profile->count_invite}}</span>@endif
				<span>{{ trans('sidebar.my_friends') }}</span></a>
		</li>
		<li class="{!! (Request::segment(1)=='messages' ? 'active' : '') !!}"><a data-change-logo="mess" href="{{ url('messages') }}">
				<i class="icon-povidomlennia svoe-lg svoe-icon"></i>
				<span class="count-block-side hidden" v-bind:class="[unreadedThreadsCount ? '' : 'hidden']">@{{ unreadedThreadsCount }}</span>
				<span>{{ trans('sidebar.my_messages') }}</span></a>
		</li>
		<li class="{!! (Request::segment(2)=='pages' ? 'active' : '') !!}">
			<a data-change-logo="pages" href="{{ url(Auth::user()->username.'/pages') }}">
				<i class="icon-storinky svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.pages') }}</span></a>
		</li>
		<li class="{!! (Request::segment(2)=='groups' ? 'active' : '') !!}">
			<a data-change-logo="group" href="{{ url(Auth::user()->username.'/groups') }}">
				<i class="icon-grupy svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_groups') }}</span></a>
		</li>
		<li data-li-setting="app" class="{!! (Request::segment(2)=='apps' ? 'active' : '') !!}">
			<a data-change-logo="app" href="{{ route('applications.catalog.index')}}">
				<i class="icon-dodatky svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.attachments') }}</span></a>
		</li>
		<li data-li-setting="event">
			<a data-change-logo="event" href="{{ url(Auth::user()->username.'/events') }}" >
				<i class="icon-podii svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_events') }}</span></a>
		</li>
		<li data-li-setting="wallet">
			<a data-change-logo="wallet" href="{{ url(Auth::user()->username.'/wallet') }}" >
				<i class="icon-wallet svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_wallet') }}</span></a>
		</li>
		<li data-li-setting="photos" class="{!! (Request::segment(2)=='photos' ? 'active' : '') !!}">
			<a data-change-logo="photo" href="{{ url('/'.Auth::user()->username.'#tab-photos') }}" >
				<i class="icon-photo svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_photos') }}</span></a>
		</li>
		{{--<li data-li-setting="videos" class="{!! (Request::segment(2)=='videos' ? 'active' : '') !!}">--}}
			{{--<a data-change-logo="video" href="{{ url(Auth::user()->username.'/videos') }}">--}}
				{{--<i class="icon-video svoe-lg svoe-icon"></i>--}}
				{{--<span>{{ trans('sidebar.my_videos') }}</span></a>--}}
		{{--</li>--}}
		<li data-li-setting="audio-recordings" class="{!! (Request::segment(2)=='audio-recordings' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="audio" href="{{ url(Auth::user()->username.'/audio-recordings') }}">
				<i class="icon-audio svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_audio_records') }}</span></a>
		</li>
		<li data-li-setting="radio" class="{!! (Request::segment(2)=='radio' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="radio" href="{{ url(Auth::user()->username.'/audio-recordings') }}" >
				<i class="icon-novyny svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.radio') }}</span></a>
		</li>
		<li data-li-setting="product" class="{!! (Request::segment(2)=='products' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="gods" href="{{ url(Auth::user()->username.'/products') }}">
				<i class="icon-tovary svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_goods') }}</span></a>
		</li>
		<li data-li-setting="board" class="{!! (Request::segment(2)=='board' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="board" href="@">
				<i class="icon-novyny svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.board') }}</span></a>
		</li>
		<li data-li-setting="car" class="{!! (Request::segment(2)=='cars' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="car" href="{{ url(Auth::user()->username.'/cars') }}">
				<i class="icon-avto svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_cars') }}</span></a>
		</li>
		<li data-li-setting="business-card" class="{!! (Request::segment(2)=='business-card' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="business-card" href="@">
				<i class="icon-novyny svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.business_card') }}</span></a>
		</li>
		<li data-li-setting="document" class="{!! (Request::segment(2)=='docs' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="doc" href="{{ url(Auth::user()->username.'/docs') }}">
				<i class="icon-dokumenty svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.documents') }}</span></a>
		</li>
		<li data-li-setting="kinsfolk" class="{!! (Request::segment(2)=='kinsfolk' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="kinsfolk" href="@">
				<i class="icon-novyny svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.kinsfolk') }}</span></a>
		</li>
		<li data-li-setting="news" class="{!! (Request::segment(2)=='news' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="news" href="{{ url(Auth::user()->username.'/news') }}" >
				<i class="icon-novyny svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_news') }}</span></a>
		</li>
		<li data-li-setting="note" class="{!! (Request::segment(2)=='note' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="note" href="#">
				<i class="icon-zakladky svoe-lg svoe-icon"></i>
				<span>{{ trans('sidebar.my_bookmarks') }}</span></a>
		</li>
		<li data-li-setting="answer" class="{!! (Request::segment(2)=='answer' ? 'active' : '') !!}" style="display: none">
			<a data-change-logo="answer" href="#">
				<i class="icon-moi_vidpovidi  svoe-icon"></i>
				<span>{{ trans('sidebar.my_answers') }}</span></a>
		</li>

		<li class="setting-side-left">
			<a href="#" onclick="$('.setting-menu-side').modal('show')" {{--data-toggle="modal" data-target=".setting-menu-side"--}}>
				<img src="{!! Theme::asset()->url('images/_new/icon-setting-menu-side.png') !!}" alt="">
			</a>
		</li>
		@if(in_array(Auth::user()->id,[17,36,54,25,9]))
		<li class="img-gal">
			<img data-gal="alone" data-post="1" style="width: 40px;height: 40px;" src="https://sand.esvoe.com/user/gallery/2017-08-18-04-56-214.jpg" alt="">


			<img data-gal="pp_gallery" data-post="1" style="width: 40px;height: 40px;" src="{!! Theme::asset()->url('images/test-img-modal.png') !!}" alt="">
			<img data-gal="pp_gallery" data-post="1" style="width: 40px;height: 40px;" src="{!! Theme::asset()->url('images/reklama-1.jpg') !!}" alt="">
			<img data-gal="pp_gallery" data-post="1" style="width: 40px;height: 40px;" src="https://sand.esvoe.com/user/gallery/2017-08-20-12-29-22Ie0V3.jpg" alt="">
			<img data-gal="pp_gallery" data-post="1" style="width: 40px;height: 40px;" src="https://sand.esvoe.com/user/gallery/2017-08-20-12-07-4933c0268119c6.original.jpeg" alt="">
			<img data-gal="pp_gallery" data-post="1" style="width: 40px;height: 40px;" src="https://sand.esvoe.com/user/gallery/2017-08-18-05-05-0120708109_1466302720124183_2990924151762121268_n.png" alt="">
			<img data-gal="pp_gallery" data-post="1" style="width: 40px;height: 40px;" src="https://sand.esvoe.com/user/gallery/2017-08-18-04-56-212.jpg" alt="">
		</li>
		@endif
	</ul>
</div>

<div class="modal fade setting-menu-side" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="title-setting-side">
				{{ trans('sidebar.setting_menu_items') }}
				<span class="close" data-dismiss="modal" aria-label="Close">
                <img src="{!! Theme::asset()->url('images/_new/icon-close-modal-sett.png') !!}" alt=""></span>
			</div>
			<div class="wrap-sett-menu">
@php/*
				<div class="own-setting-modal">
					<i class="icon-dodatky svoe-1x svoe-icon"></i>
					{{ trans('sidebar.attachments') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="app">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-podii svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_events') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="event">
					</div>
				</div>
				<div class="own-setting-modal disabled-sett">
					<i class="icon-druzi svoe-lg svoe-icon"></i>
					{{ trans('sidebar.my_friends') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="friend">
					</div>
				</div>
				<div class="own-setting-modal disabled-sett">
					<i class="icon-photo svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_photos') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="photo">
					</div>
				</div>
				<div class="own-setting-modal disabled-sett">
					<i class="icon-video svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_videos') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="video">
					</div>
				</div>
*/@endphp
				<div class="own-setting-modal">
					<i class="icon-audio svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_audio_records') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="audio-recordings">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-novyny svoe-1x svoe-icon"></i>
					{{ trans('sidebar.radio') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="radio">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-tovary svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_goods') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="product">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-novyny svoe-1x svoe-icon"></i>
					{{ trans('sidebar.board') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="board">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-avto svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_cars') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="car">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-novyny svoe-1x svoe-icon"></i>
					{{ trans('sidebar.business_card') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="business-card">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-dokumenty svoe-1x svoe-icon"></i>
					{{ trans('sidebar.documents') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="document">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-novyny svoe-1x svoe-icon"></i>
					{{ trans('sidebar.kinsfolk') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="kinsfolk">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-novyny svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_news') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="news">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-zakladky svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_bookmarks') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="note">
					</div>
				</div>
				<div class="own-setting-modal">
					<i class="icon-moi_vidpovidi svoe-1x svoe-icon"></i>
					{{ trans('sidebar.my_answers') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="answer">
					</div>
				</div>
{{--				<div class="own-setting-modal disabled-sett">
					<i class="icon-povidomlennia svoe-lg svoe-icon"></i>
					{{ trans('sidebar.my_messages') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="mess">
					</div>
				</div>--}}
{{--				<div class="own-setting-modal disabled-sett">
					<i class="icon-grupy svoe-lg svoe-icon"></i>
					{{ trans('sidebar.my_groups') }}
					<div class="wrap-checker-sett">
						<input type="checkbox" data-sett-side="group">
					</div>
				</div>--}}

			</div>
			<div class="wrap-btn-set-modal">
				<div class="btn-set-modal save-sett-modal save-set-left-sidebar" data-dismiss="modal" aria-label="Close">
					{{ trans('sidebar.save') }}
				</div>
				{{--<div class="btn-set-modal dismiss-set-modal" data-dismiss="modal" aria-label="Close">--}}
					{{--{{ trans('sidebar.cansel') }}--}}
				{{--</div>--}}
			</div>
		</div>
	</div>
</div>

{!! Theme::asset()->container('footer')->usePath()->add('left-sidebar', 'js/left-sidebar.js') !!}