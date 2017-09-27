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
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jplayer.blue.monday.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.theme.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/bootstrap-stars.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/swiper.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/lightslider.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.jMosaic.css') !!}">


    <link rel="stylesheet" href="{!! Theme::asset()->url('css/style-new.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/theme-new.css') !!}">

    <script src="{!! Theme::asset()->url('js/jquery/jquery.min.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/bootstrap.min.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jquery.jplayer.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jplayer.playlist.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jquery.formstyler.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jquery.barrating.min.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/swiper.jquery.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/lightslider.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jquery.jMosaic.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jquery.fullscreen.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/embed.videos.js') !!}"></script>

    <script src="{!! Theme::asset()->url('js/script.js') !!}"></script>
</head>
<body class="body-login-svoe">

<div class="header-svoe">
    <img class="template-logo-svoe" src="{!! Theme::asset()->url('images/logo-svg.svg') !!}" alt="{{ Setting::get('site_name') }}" title="{{ Setting::get('site_name') }}">
    <span class="template-logo-text">своє!</span>
    <div class="profile-login-svoe">
        <div class="photo-user-login-svoe" style="background-image: url('{{url('user/avatar/default-male-avatar.png')}}');"></div>
        <ul class="template-dots nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="icon-menyu svoe-lg svoe-icon"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="main-link">
                        <a href="#" data-post-id="329" class="notify-user unnotify">
                            {{ trans('common.logout') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>


<div class="template-login-svoe ">
    <div class="text-login-svoe">
        Войдите в <a href="" class="svoe-link-login">Єsvoe</a>, чтобы использовать свой
        аккаунт в приложении <a href="">E-Ticket</a>
    </div>
    <div class="field-sign-login">
        <form action="">
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="password">
            </div>
            <a href="#" class="forgot-pass-login">Забыли пароль?</a>
            <button type="submit" class="btn btn-success btn-submit">Войти</button>
        </form>
    </div>
</div>



<div class="template-reg-svoe">
    <div class="photo-reg-site"></div>
    <p>
        Приложение E-Tickets получит:
        <span>- публичный профиль</span>
        <span>- эл. адрес</span>
    </p>
    <div class="btn-reg-template">
        <div class="btn-continue-reg">Продолжить как Alex</div>
        <div class="btn-cancel-reg">
            <i class="icon-zakrutu  svoe-icon"></i>
        </div>
    </div>
</div>
<div class="footer-reg-svoe">
    <a href="#">Условия приложений</a>
    <a href="#">Политика конфіденциальности</a>
</div>



<div class="template-reg-svoe">
    <div class="photo-reg-site photo-reg-site-error">
        <i class="icon-poskarzhytysya  svoe-icon"></i>
    </div>
    <p>
        Вам не вдалось зареєструватись через єСвоє.
    </p>
</div>


</body>
</html>