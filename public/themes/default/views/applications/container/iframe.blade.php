<script type="text/javascript">
    $(function() {
        $('.balance>a').click(function() {
            $(document).fullscreen();
            return false;
        });
        $('.close').click(function() {
            $.fullscreen.exit();
            return false;
        });
    });
</script>
<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {!! Theme::partial('advertising') !!}
        </div>
<div class="col-lg-9 col-wallet">


    <div class="single-game-container">
        <div class="game-head">
            <div class="row" style="margin: 0 -5px">
                <div class="col-xs-12 col-sm-8 col-md-6" style="padding:0 5px">
                    <span class="">{{$application->name}}</span>

                    <div class="rating ratingblock haspopover" data-rating-data="{{$application->rating_packed}}" data-rating-uri="{{route('application.ajax.rate')}}">
                        <div class="ratingblock-content">
                            <span class="ratingblock-value"></span>
                            <div class="stars stars-example-fontawesome-o">
                                <select class="rating-block" name="rating" autocomplete="off">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <span class="ratingblock-total hidden-xs hidden-sm"></span>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-4 col-md-6 " style="padding:0 5px">
                    <div class="balance">
                        Баланс:
                        <span>
                            0.00
                        </span>
                        $
                        <a href="#">
                            <img src="{!! Theme::asset()->url('images/modal-full-screen.png') !!}" alt="full-screen">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="game-body">
            <iframe
                    id="appMainFrame"
                    name="{{$web_channel}}"
                    webkitallowfullscreen="true"
                    mozallowfullscreen="true"
                    allowfullscreen="true"
                    src="{{$iframe_url}}"
                    scrolling="no"
                    height="100%"
                    frameborder="0"
                    width="100%"
            ></iframe>
        </div>
        <div class="row" style="margin: 0 -5px;">
            <div class="col-xs-12 col-md-7" style="padding:0 5px">
                <div class="user-comments" style="height: 361px">

                </div>
            </div>
            <div class="col-xs-12 col-md-5" style="padding: 0 5px">
                <div class="user-activity">
                    <div class="user-activity-header">
                        <a href="">Активность друзей</a>
                    </div>
                    <div class="user-activity-body">
                        <ul>
                            <li>
                                <div class="avatar" >
                                    <a href="" style="background-image: url('{!! Theme::asset()->url('images/sambuka.png') !!}')"></a>
                                </div>
                                <div class="activity-item">
                                    <a href="#">
                                        Ольга
                                        <span>
                                            набрала 53 очки у
                                        </span>
                                    </a>
                                    <div class="time">
                                        8 хв тому
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="avatar" >
                                    <a href="" style="background-image: url('{!! Theme::asset()->url('images/sambuka.png') !!}')"></a>
                                </div>
                                <div class="activity-item">
                                    <a href="#">
                                        Ольга
                                        <span>
                                            набрала 53 очки у
                                        </span>
                                    </a>
                                    <div class="time">
                                        8 хв тому
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="avatar" >
                                    <a href="" style="background-image: url('{!! Theme::asset()->url('images/sambuka.png') !!}')"></a>
                                </div>
                                <div class="activity-item">
                                    <a href="#">
                                        Ольга
                                        <span>
                                            набрала 53 очки у
                                        </span>
                                    </a>
                                    <div class="time">
                                        8 хв тому
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="avatar" >
                                    <a href="" style="background-image: url('{!! Theme::asset()->url('images/sambuka.png') !!}')"></a>
                                </div>
                                <div class="activity-item">
                                    <a href="#">
                                        Ольга
                                        <span>
                                            набрала 53 очки у
                                        </span>
                                    </a>
                                    <div class="time">
                                        8 хв тому
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @if(Request::root() != Request::url())
            <div class="wrap-footer-home other-page-footer panel panel-default">
                <a @if(Config::get('app.locale')== 'en')class="active-lang-home" @endif href="{{url('setlocale/'.'en')}}">{{Config::get('app.locales')['en']}}</a>
                <a @if(Config::get('app.locale')== 'ru')class="active-lang-home" @endif href="{{url('setlocale/'.'ru')}}">{{Config::get('app.locales')['ru']}}</a>
                <a @if(Config::get('app.locale')== 'ua')class="active-lang-home" @endif href="{{url('setlocale/'.'ua')}}">{{Config::get('app.locales')['ua']}}</a>
                <div class="more-lang-home">
                    <a data-toggle="modal" data-target=".modal-lang" href=""><i class="fa fa-globe fa-lg" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="link-home-footer other-page-footer">
                @foreach(App\StaticPage::active() as $staticpage)
                    <a href="{{ url('page/'.$staticpage->slug) }}">{{ $staticpage->title }}</a>
                @endforeach
                <p>
                    <a class="copy" href="/">{{ Setting::get('site_name') }} </a>
                    <span>&copy; {{ date('Y') }}</span>
                </p>
            </div>
            @endif
        <!--
        <a href="#" onclick="$('#popup-topup-e').modal('show')">
            topup etoken
        </a>
        <a href="#" onclick="$('#popup-payment-e').modal('show')">
            buy etoken
        </a>
        <a href="#" onclick="$('#popup-payment-e').modal('show')">
            buy binacoin
        </a>
        -->
    </div>
</div>
</div>
</div>

{!! Theme::partial('popups.payment-main', compact('gameName', 'application')) !!}

<link rel="stylesheet" href="{{Theme::asset()->url('css/fontawesome-stars-o.css')}}">
