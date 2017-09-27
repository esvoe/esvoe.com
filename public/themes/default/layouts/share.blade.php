<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="{!! Theme::asset()->url('css/share.css') !!}">
        
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
        
    </head>
    <body>
        <div style="width: 500px;">
            {!! Theme::content() !!}
        </div>
    </body>
</html>
