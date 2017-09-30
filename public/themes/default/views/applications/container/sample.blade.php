<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/style-new.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/jquery.formstyler.theme.css') !!}">
    <link rel="stylesheet" href="{!! Theme::asset()->url('css/theme-new.css') !!}">
    <style>
        html { overflow-y: scroll;
        overflow-x: hidden;}
        body { overflow-y: scroll; overflow-x: hidden;}
    </style>
    <script type="text/javascript">
        function SP_source() {
            return "{{ url('/') }}/";
        }
        var base_url = "{{ url('/') }}/";
        var theme_url = "{!! Theme::asset()->url('') !!}";
    </script>
    {!! Theme::asset()->scripts() !!}

    <script src="https://sand.esvoe.com/js/api_client.js?t={{time()}}"></script>
    <script>
        ESAPI.init(function(status, payload) {
            console.log("esapi init "+status+" >> "+payload.error_message);
        });
    </script>
</head>
<body style="background-color: rgba(93,133,174,0.34)">

<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default" id="appParams">
            <div class="panel-heading">
                Application
            </div>
            <div class="panel-content" style="padding: 1em">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    {!! Form::text('app_id', $application->id, array('class'=>'form-control', 'placeholder'=>'Application ID')) !!}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">API KEY</label>
                    {!! Form::text('app_secret_key', $application->api_key, array('class'=>'form-control', 'placeholder'=>'Application API Key')) !!}
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default" id="inputParams">
            <div class="panel-heading">
                Parameters
            </div>
            <div class="panel-content" style="padding: 1em">
                @foreach($params as $key=>$val)
                    <div class="form-group">
                        <label for="{{$key}}">{{$key}}</label>
                        {!! Form::text($key, $val, array('class'=>'form-control')) !!}
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                TEST /user/info
            </div>
            <div class="panel-content" style="padding: 1em">

                <div class="well" style="padding: 1em" id="user-info-response">

                </div>

            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" data-action="call_rest_user_info">Call REST using session</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function() {

        var rand1 = '{{ substr(str_shuffle("-abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890_-"), -5) }}';

        function getTimestamp() {
            return Math.round(new Date().getTime()/1000);
        }

        function sha1(str1){
            for (
                var blockstart = 0,
                    i = 0,
                    W = [],
                    A, B, C, D, F, G,
                    H = [A=0x67452301, B=0xEFCDAB89, ~A, ~B, 0xC3D2E1F0],
                    word_array = [],
                    temp2,
                    s = unescape(encodeURI(str1)),
                    str_len = s.length;

                i <= str_len;
            ){
                word_array[i >> 2] |= (s.charCodeAt(i)||128) << (8 * (3 - i++ % 4));
            }
            word_array[temp2 = ((str_len + 8) >> 2) | 15] = str_len << 3;

            for (; blockstart <= temp2; blockstart += 16) {
                A = H; i = 0;

                for (; i < 80;
                       A = [[
                           (G = ((s = A[0]) << 5 | s >>> 27) + A[4] + (W[i] = (i<16) ? ~~word_array[blockstart + i] : G << 1 | G >>> 31) + 1518500249) + ((B = A[1]) & (C = A[2]) | ~B & (D = A[3])),
                           F = G + (B ^ C ^ D) + 341275144,
                           G + (B & C | B & D | C & D) + 882459459,
                           F + 1535694389
                       ][0|((i++) / 20)] | 0, s, B << 30 | B >>> 2, C, D]
                ) {
                    G = W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16];
                }

                for(i = 5; i; ) H[--i] = H[i] + A[i] | 0;
            }

            for(str1 = ''; i < 40; )str1 += (H[i >> 3] >> (7 - i++ % 8) * 4 & 15).toString(16);
            return str1;
        }

        function encodeLine(a) {
            var b = "";
            for (var e = 0; e < a.length; e++) {
                var d = a.charCodeAt(e);
                if (d < 128) {
                    b += String.fromCharCode(d);
                } else {
                    if ((d > 127) && (d < 2048)) {
                        b += String.fromCharCode((d >> 6) | 192);
                        b += String.fromCharCode((d & 63) | 128);
                    } else {
                        b += String.fromCharCode((d >> 12) | 224);
                        b += String.fromCharCode(((d >> 6) & 63) | 128);
                        b += String.fromCharCode((d & 63) | 128);
                    }
                }
            }
            return b;
        }

        function calcSign(params, secret) {
            var i, line, key, keys = [];

            for (key in params) {
                if( params.hasOwnProperty(key)) {
                    keys.push(key.toString());
                }
            }
            keys.sort();
            line = "";
            for (i = 0; i < keys.length; i++) {
                key = keys[i];
                console.log(key, params[key]);
                if ((key !== "sign") && (key !== "access-token") && (key !== "session-key") && (key !== "session-secret-key")) {
                    line += keys[i] + "=" + String(params[key]);
                }
            }
            line += secret;
            line = encodeLine(line);
            return sha1(line);
        }

        //substr(str_shuffle("-abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890_-"), -5);


        var $app_id = $('#appParams input[name="app_id"]').val();
        var $app_key = $('#appParams input[name="app_key"]').val();
        var $api_server = $('#inputParams input[name="api_server"]').val();
        var $session_key = $('#inputParams input[name="api_session"]').val();
        var $session_secret_key = $('#inputParams input[name="api_session_secret"]').val();

        $('[data-action="call_rest_user_info"]').on('click', function(){

            var data = {
                'method':'user.info',
                'app-id': $app_id,
                'session-key': $session_key,
                'session-secret-key': $session_secret_key,
                'timestamp': getTimestamp()
            };

            data['sign'] = calcSign(data, $session_secret_key);

            console.log($api_server + '/api/v1/apps/user/info');

            $.ajax($api_server + '/api/v1/apps/user/info',{
                'method': 'get',
                'data': data
            })
                .done(function(response){
                    alert(response)
                })
                .error(function (error) {

                })
        });
    });
</script>


</body>
</html>