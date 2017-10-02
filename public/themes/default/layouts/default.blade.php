<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf_token" content="{!! csrf_token() !!}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />

        <meta name="keywords" content="{{ Setting::get('meta_keywords') }}">
        <meta name="description" content="{{ Setting::get('meta_description') }}">
        <link rel="icon" type="image/x-icon" href="{!! url('setting/'.Setting::get('favicon')) !!}">

        <meta content="{{ url('/') }}" property="og:url" />
        <meta content="{{ Setting::get('meta_description') }}" property="og:description" />
        <meta content="{{ Setting::get('site_name') }}" property="og:title" />
        <meta content="{{ Setting::get('site_name') }}" property="og:site_name" />
        
        <meta content="{!! url('setting/'.Setting::get('logo')) !!}" property="og:image" />             
        <meta property="og:image:width" content="400">
        <meta property="og:image:height" content="400">
        <meta content="website" property="og:type" />

        <title>{{ Theme::get('title') }}</title>

        {!! Theme::asset()->styles() !!}
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/jplayer.blue.monday.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.theme.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/bootstrap-stars.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/swiper.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/lightslider.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.jMosaic.css') !!}">

{{--        <link rel="stylesheet" href="{!! Theme::asset()->url('css/__bootstrap.css') !!}">--}}
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/style-new.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/theme-new.css') !!}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
        function SP_source() {
          return "{{ url('/') }}/";
        }
        var base_url = "{{ url('/') }}/";
        var theme_url = "{!! Theme::asset()->url('') !!}";
        var current_username = "{{ Auth::user()->username }}";
        var current_user_id = "{{ Auth::user()->id }}";
        </script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8128663849778602",
            enable_page_level_ads: true
          });
        </script>
        {!! Theme::asset()->scripts() !!}

        {!! Theme::asset()->container('footer')->usePath()->add('lodash.min', 'js/lodash.min.js') !!}

        <script src="{!! Theme::asset()->url('js/jquery.jplayer.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/jplayer.playlist.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/jquery.formstyler.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/jquery.barrating.min.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/swiper.jquery.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/lightslider.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/jquery.jMosaic.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/jquery-tjgallery.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/jquery.fullscreen.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/embed.videos.js') !!}"></script>


        <script src="{!! Theme::asset()->url('js/script.js') !!}"></script>
        @if(Setting::get('google_analytics') != NULL)
            {!! Setting::get('google_analytics') !!}
        @endif
        <script src="{!! Theme::asset()->url('js/lightgallery.js') !!}"></script>
    </head>
    <body class="@if(Setting::get('enable_rtl') == 'on') direction-rtl @endif @if( Request::is('messages') == 1 ) page-messages @endif">
    {{--<div class="wrapper active-right-side">--}}
        {!! Theme::partial('header') !!}

        {!! Theme::partial('sidebar') !!}
        {!! Theme::partial('modal-photo') !!}

            <div class="main-content">
                {!! Theme::content() !!}
            </div>

        @if ( Request::is('messages') != 1 )
        {!! Theme::partial('friend-sidebar') !!}
        @endif

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

    {!! Theme::asset()->container('footer')->usePath()->add('app', 'js/app.js') !!}
    {!! Theme::asset()->container('footer')->usePath()->add('timeago', 'js/timeago/locales/timeago-'.App::getLocale().'.js') !!}
    {{--</div>--}}
        <script>
          @if(Config::get('app.debug'))
            // Pusher.logToConsole = true;
          @endif
            var pusherConfig = {
                token: "{{ csrf_token() }}",
                PUSHER_KEY: "{{ config('broadcasting.connections.pusher.key') }}"
            };
       </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.5.0/socket.io.min.js"></script>

        {!! Theme::asset()->container('footer')->scripts() !!}

    {!! Theme::partial('modal-windows') !!}
    {!! Theme::partial('javascript') !!}
    </body>
</html>
