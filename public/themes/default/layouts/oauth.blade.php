<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf_token" content="{!! csrf_token() !!}"/>
    
    <title>{{ Theme::get('title') }}</title>

    {!! Theme::asset()->styles() !!}
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/style-new.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.theme.css') !!}">
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
    </script>

    {!! Theme::asset()->scripts() !!}

    <script src="{!! Theme::asset()->url('js/jquery.jplayer.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jplayer.playlist.js') !!}"></script>
    <script src="{!! Theme::asset()->url('js/jquery.formstyler.js') !!}"></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    <script src="{!! Theme::asset()->url('js/script.js') !!}"></script>

    @if(Setting::get('google_analytics') != NULL)
        {!! Setting::get('google_analytics') !!}
    @endif


</head>
<body class="body-login-svoe app-auth-page">

    <div class="header-svoe">
        <img class="template-logo-svoe" src="{!! Theme::asset()->url('images/logo-svg.svg') !!}" alt="{{ Setting::get('site_name') }}" title="{{ Setting::get('site_name') }}">
        <span class="template-logo-text">своє!</span>
        @if (Auth::user())
        <!-- <div class="logout-prof-header">
            <form action="{{ url('/logout') }}" method="post" id="logoutForm">
            {{ csrf_field() }}
                {{--<button type="submit" class="btn-logout"><i class="fa fa-unlock" aria-hidden="true"></i>{{ trans('common.logout') }}</button>--}}
            </form>
            <a href="#" onclick="document.getElementById('logoutForm').submit();return false;"><span><img src="{!! Theme::asset()->url('images/_new/icon-logout-header.png') !!}" alt=""></span></a>
        </div> -->
        <div class="profile-login-svoe">
            <div class="photo-user-login-svoe" style="background-image: url('{{url('user/avatar/default-male-avatar.png')}}');"></div>
        </div>
        @endif
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                {!! Theme::content() !!} 
            </div>
        </div>
    </div>      

    {!! Theme::asset()->container('footer')->scripts() !!}

</body>
</html>