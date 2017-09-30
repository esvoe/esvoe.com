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
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8128663849778602",
        enable_page_level_ads: true
      });
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
    </div>

    <script type="text/javascript">
        if(window.parent) {
            window.parent.postMessage('status={{$status}}')
        }
    </script>

    @if($status == 'authorize') 

        <div class="template-reg-svoe">
            <div class="photo-reg-site photo-reg-site-error">
                <i class="icon-poskarzhytysya  svoe-icon" style="color: green;"></i>
            </div>
            <p>успешно</p>
        </div>

    @else

        <div class="template-reg-svoe">
            <div class="photo-reg-site photo-reg-site-error">
                <i class="icon-poskarzhytysya  svoe-icon"></i>
            </div>
            <p>
                You have errors in request:
                @if (session('status'))
                    status:{{ session('status') }}
                @endif
                @if (session('error_code'))
                    error_code:{{ session('error_code') }}
                @endif        
            </p>
        </div>

    @endif



</body>
</html>