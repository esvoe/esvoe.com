<!-- Modal starts here-->
<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel">
    <div class="modal-dialog modal-likes" role="document">
        <div class="modal-content">
        	<i class="fa fa-spinner fa-spin"></i>
        </div>
    </div>
</div>
<div class="container container-footer" style="padding: 0 15px;">
	<footer>
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
				<a class="copy" href="/">{{ Setting::get('site_name') }} </a>
				<span>&copy; {{ date('Y') }}</span>
				{{--<a class="copy" href="/">eSvoe.com <span>&copy; 2017</span></a>--}}
				<div class="social-footer">
					<a href="https://www.facebook.com/esvoe.official" target="_blank"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a>
					<a href="https://twitter.com/EsvoeCom" target="_blank"><i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i></a>
					<a href="https://www.youtube.com/channel/UCEX7ZliHe8oqiB_qKcTM1Ew?view_as=subscriber" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
					<a href="https://www.instagram.com/esvoe_official" target="_blank"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-4 col-lg-5">
				<ul class="link-service">


					<li>
						<a href="#terms-modal" data-toggle="modal">{{ trans('common.terms_footer') }}</a>
					</li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="lang-footer">
					<span>{{ trans('common.available_languages') }}:</span>

					<a @if(Config::get('app.locale')== 'en')class="active-lang-home" @endif href="{{url('setlocale/'.'en')}}">{{Config::get('app.locales')['en']}}</a>
					<a @if(Config::get('app.locale')== 'ru')class="active-lang-home" @endif href="{{url('setlocale/'.'ru')}}">{{Config::get('app.locales')['ru']}}</a>
					<a @if(Config::get('app.locale')== 'ua')class="active-lang-home" @endif href="{{url('setlocale/'.'ua')}}">{{Config::get('app.locales')['ua']}}</a>
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target=".modal-lang"  aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-globe fa-lg" aria-hidden="true"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>






<div class="modal modal-lang fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="title-home-lang">
				{{ trans('common.choose_lang')  }}
				<span data-dismiss="modal" aria-label="Close"><img src="{!! Theme::asset()->url('images/_new/icon-close-modal-lang.png') !!}" alt=""></span>
			</div>
			<div class="wrap-row-lang">
				<div class="row-lang-ua">
					<ul>
						<li @if(Config::get('app.locale')== 'ua') class="active" @endif><a href="{{url('setlocale/'.'ua')}}">Українськa державна</a></li>
						<li class="disabled"><a href="">Суржик</a></li>
						<li class="disabled"><a href="">Галицька</a></li>
						<li class="disabled"><a href="">Закарпатська</a></li>
						<li class="disabled"><a href="">Лемківська</a></li>
						<li class="disabled"><a href="">Бойківська</a></li>
						<li class="disabled"><a href="">Гуцульська</a></li>
					</ul>
				</div>
				<div class="row-lang-other">
					<div class="row">
						<div class="col-xs-4">
							<ul>
								<li class="disabled"><a href="#" >Bahasa Indonesia</a></li>
								<li class="disabled"><a href="#" >Bosanski</a></li>
								<li class="disabled"><a href="#" >Dansk</a></li>
								<li @if(Config::get('app.locale')== 'de') class="active" @endif><a href="{{url('setlocale/'.'de')}}" >Deutsch</a></li>
								<li class="disabled"><a href="#" >Eesti</a></li>
								<li @if(Config::get('app.locale')== 'en') class="active" @endif><a href="{{url('setlocale/'.'en')}}" >English</a></li>
								<li @if(Config::get('app.locale')== 'es') class="active" @endif><a href="{{url('setlocale/'.'es')}}" >Español</a></li>
								<li class="disabled"><a href="#" >Esperanto</a></li>
								<li @if(Config::get('app.locale')== 'fr') class="active" @endif><a href="{{url('setlocale/'.'fr')}}" >Français</a></li>
								<li @if(Config::get('app.locale')== 'it') class="active" @endif><a href="{{url('setlocale/'.'it')}}" >Italiano</a></li>

							</ul>
						</div>
						<div class="col-xs-4">
							<ul>
								<li @if(Config::get('app.locale')== 'nl') class="active" @endif><a href="{{url('setlocale/'.'nl')}}" >Nederland</a></li>
								<li @if(Config::get('app.locale')== 'pt') class="active" @endif><a href="{{url('setlocale/'.'pt')}}" >Português</a></li>
								<li class="disabled"><a href="#" >Română</a></li>
								<li class="disabled"><a href="#" >Shqip</a></li>
								<li class="disabled"><a href="#" >Slovenščina</a></li>
								<li class="disabled"><a href="#" >Suomi</a></li>
								<li class="disabled" ><a href="#" >Svenska</a></li>
								<li class="disabled"><a href="#" >Tagalog</a></li>
								<li class="disabled"><a href="#" >Tiếng Việt</a></li>
								<li @if(Config::get('app.locale')== 'tr') class="active" @endif><a href="{{url('setlocale/'.'tr')}}" >Türkmen</a></li>
							</ul>
						</div>
						<div class="col-xs-4">
							<ul>
								<li class="disabled"><a href="#">ГIалгIай мотт</a></li>
								<li class="disabled"><a href="#" >Дореволюцiонный</a></li>
								<li class="disabled"><a href="#" >Ирон</a></li>
								<li class="disabled"><a href="#" >Кыргыз тили</a></li>
								<li class="disabled"><a href="#" >Къарачай-малкъар тил</a></li>
								<li class="disabled"><a href="#" >Лезги чІал</a></li>
								<li class="disabled"><a href="#" >Марий йылме</a></li>
								<li class="disabled"><a href="#" >Монгол</a></li>
								<li class="disabled"><a href="#" >Русинськый</a></li>
								<li @if(Config::get('app.locale')== 'ru') class="active" @endif><a href="{{url('setlocale/'.'ru')}}">Русский</a></li>
							</ul>
						</div>
					</div>
					<div class="dismiss-lang-modal" data-dismiss="modal" aria-label="Close">{{ trans('common.close')  }}</div>
				</div>
			</div>
		</div>
	</div>
</div>