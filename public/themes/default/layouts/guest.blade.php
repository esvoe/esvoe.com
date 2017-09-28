<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf_token" content="{!! csrf_token() !!}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
        <meta property="og:image" content="{{ url('setting/logo.jpg') }}" />
        <meta property="og:title" content="{{ Setting::get('site_title') }}" />
        <meta property="og:type" content="Social Network" />
        <meta name="keywords" content="{{ Setting::get('meta_keywords') }}">
        <meta name="description" content="{{ Setting::get('meta_description') }}">
        <link rel="icon" type="image/x-icon" href="{!! url('setting/'.Setting::get('favicon')) !!}">


        <title>{{ Theme::get('title') }}</title>

        {!! Theme::asset()->styles() !!}
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/style-new.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.theme.css') !!}">
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/style-intro.css') !!}">
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
        <script src="{!! Theme::asset()->url('js/script-intro.js') !!}"></script>
        <script src="{!! Theme::asset()->url('js/script.js') !!}"></script>

        @if(Setting::get('google_analytics') != NULL)
            {!! Setting::get('google_analytics') !!}
        @endif
    </head>
    <body style="background: #eff3f6;" @if(Setting::get('enable_rtl') == 'on') class="direction-rtl" @endif>

        
        {!! Theme::content() !!}
        
        {!! Theme::partial('footer') !!}

        {!! Theme::asset()->container('footer')->scripts() !!}


        


    </body>
</html>
