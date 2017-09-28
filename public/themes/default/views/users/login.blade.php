<div class="container">
    <div class="wrap-login-page">
        <div class="row">
            <div class=" col-sm-7 col-md-8 col-lg-8">
                <a href="{{ url('/') }}" class="logo-login">
                    <img src="{!! Theme::asset()->url('images/elogo.svg') !!}" alt="{{ Setting::get('site_name') }}" title="{{ Setting::get('site_name') }}">
                </a>
                {!! Theme::partial('intro-circle') !!}
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
                <div class="login-block">
                    <div class="panel panel-default">
                        <div class="panel-body nopadding">
                            <div class="login-bottom">
                                <div class="login-errors text-danger"></div>
                                @if (Config::get('app.env') == 'demo')
                                    <div class="alert alert-success">
                                        username : <code>bootstrapguru</code> &nbsp;&nbsp;&nbsp;   password : <code>socialite</code>
                                    </div>
                                @endif

                                @if(Request::get('echk') == "on")
                                    <div class="alert alert-info fade in" id="emailalert">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Note!</strong> {{ trans('auth.email_verify') }}
                                    </div>
                                @endif

                                @if(session()->has('login_notice'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{ session()->get('login_notice') }}
                                    </div>
                                @endif

                                <form method="POST" class="login-form" action="{{ url('/login') }}">
                                    {{ csrf_field() }}
                                    <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {{ Form::text('email', NULL, ['class' => 'form-control', 'id' => 'email', 'placeholder'=> trans('auth.enter_email_or_username')]) }}
                                    </fieldset>
                                    <fieldset class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder'=> trans('auth.password')]) }}

                                        <div class="form-sign form-sign_showpass">
                                            <i class="icon-bachymo svoe-icon"></i>
                                        </div>

                                    </fieldset>
                                    {{ Form::button( trans('auth.signin_to_dashboard') , ['type' => 'submit','class' => 'btn btn-success btn-submit']) }}
                                    <div class="small-soc-wrap" style="display: none">
                                        <ul class="list-inline social-connect">
                                            @if(env('GOOGLE_CLIENT_ID') != NULL && env('GOOGLE_CLIENT_SECRET') != NULL)
                                                <li><a href="{{ url('google') }}" class="btn btn-social google-plus"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a></li>
                                            @endif

                                            @if(env('TWITTER_CLIENT_ID') != NULL && env('TWITTER_CLIENT_SECRET') != NULL)
                                                <li><a href="{{ url('twitter') }}" class="btn btn-social tw"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></li>
                                            @endif

                                            @if(env('FACEBOOK_CLIENT_ID') != NULL && env('FACEBOOK_CLIENT_SECRET') != NULL)
                                                <li><a href="{{ url('facebook') }}" class="btn btn-social fb"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></li>
                                            @endif

                                            @if(env('LINKEDIN_CLIENT_ID') != NULL && env('LINKEDIN_CLIENT_SECRET') != NULL)
                                                <li><a href="{{ url('linkedin') }}" class="btn btn-social linkedin"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <a class="forgot-login" href="{{ url('/password/reset') }}">{{ trans('auth.forgot_password').'?' }}</a>
                                </form>
                            </div>

                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-body nopadding">
                            <div class="login-bottom">
                                <div class="quick-reg">
                                    {{trans('auth.quick_reg')}}
                                </div>
                                <ul class="signup-errors text-danger list-unstyled"></ul>

                                <form method="POST" class="signup-form" id="signup-form" action="{{ url('/register') }}" autocomplete="off">
                                    @php $esvoeId = 'eid'.implode(explode('.', microtime(TRUE))); @endphp
                                    {{ csrf_field() }}
                                    {{ Form::hidden('esvoe_id', $esvoeId) }}
                                    <fieldset class="form-group form-control-check {{ $errors->has('name') ? ' has-error' : '' }}">
                                        {{ Form::text('name', NULL, ['class' => 'form-control', 'id' => 'name', 'placeholder'=> trans('auth.name') ]) }}
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif                                        
                                        
                                        <div class="form-sign form-sign_info top-left">
                                            <i class="icon-informaciya-kolo svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                Введите Имя
                                            </div>
                                        </div>
                                        
                                        <div class="form-sign form-sign_accept">
                                            <i class="icon-prinyat-kolo svoe-icon"></i>
                                        </div>
                                        
                                        <div class="form-sign form-sign_error top-left">
                                            <i class="icon-poskarzhytysya svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                {{ trans('auth.reg_req_name') }}
                                            </div>
                                        </div>

                                    </fieldset>
                                    <fieldset class="form-group form-control-check {{ $errors->has('sename') ? ' has-error' : '' }}">
                                        {{ Form::text('sename', NULL, ['class' => 'form-control', 'id' => 'sename', 'placeholder'=> trans('auth.sename')]) }}
                                        @if ($errors->has('sename'))
                                            <span class="help-block">
                                                {{ $errors->first('sename') }}
                                            </span>
                                        @endif

                                        <div class="form-sign form-sign_info top-left">
                                            <i class="icon-informaciya-kolo svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                Введите Фамилию
                                            </div>
                                        </div>

                                        <div class="form-sign form-sign_accept">
                                            <i class="icon-prinyat-kolo svoe-icon"></i>
                                        </div>
                                        
                                        <div class="form-sign form-sign_error top-left">
                                            <i class="icon-poskarzhytysya svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                {{ trans('auth.temp') }}
                                            </div>
                                        </div>

                                    </fieldset>
                                    <div class="row">

                                        <div class="col-xs-7 hidden">
                                            <fieldset class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                                {{ Form::text('username', $esvoeId, ['class' => '', 'id' => 'username', 'placeholder'=> trans('common.username')]) }}
                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        {{ $errors->first('username') }}
                                                    </span>
                                                @endif
                                            </fieldset>
                                        </div>

                                        <div class="col-xs-7">

                                            <fieldset class="form-group form-control-check {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                                {{ Form::text('birthday', NULL, ['class' => 'form-control', 'id' => 'date-field', 'placeholder'=> trans('common.birthday')]) }}
                                                @if ($errors->has('birthday'))
                                                    <span class="help-block">
                                                        {{ $errors->first('birthday') }}
                                                    </span>
                                                @endif
                                            </fieldset>



                                                {{--<div class="form-sign form-sign_info top-center">
                                                    <i class="icon-informaciya-kolo svoe-icon"></i>
                                                    <div class="form-sign-tooltip">
                                                        Если вы укажете дату рождения, мы сможем показывать вам материалы, актуальные человеку вашего возраста.
                                                    </div>
                                                </div>--}}

                                        </div>

                                        <div class="col-xs-5">
                                            <fieldset class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                                {{ Form::select('gender', array('female' => trans('common.female'), 'male' => trans('common.male')), null, ['placeholder' => trans('auth.sex'), 'class' => 'form-control']) }}
                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                {{ $errors->first('gender') }}
                                            </span>
                                                @endif
                                            </fieldset>
                                        </div>
                                    </div>
                                    <fieldset class="form-group form-control-check {{ $errors->has('email') ? ' has-error' : '' }}">
                                        {{ Form::text('email', NULL, ['class' => 'form-control', 'id' => 'email', 'placeholder'=> 'Email', 'autocomplete'=> 'off']) }}
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif

                                        <div class="form-sign form-sign_info top-left">
                                            <i class="icon-informaciya-kolo svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                Введите email
                                            </div>
                                        </div>
                                        
                                        <div class="form-sign form-sign_accept">
                                            <i class="icon-prinyat-kolo svoe-icon"></i>
                                        </div>
                                        
                                        <div class="form-sign form-sign_error top-left">
                                            <i class="icon-poskarzhytysya svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                {{ trans('auth.reg_req_email') }}
                                            </div>
                                        </div> 

                                    </fieldset>
                                    <fieldset class="form-group form-control-check {{ $errors->has('password') ? ' has-error' : '' }}">
                                        {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder'=> trans('auth.password'), 'autocomplete'=> 'off']) }}
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @endif

                                        <div class="form-sign form-sign_info top-left">
                                            <i class="icon-informaciya-kolo svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                Пароль должен быть не менее 6-ти цифр, букв, знаков припинания
                                            </div>
                                        </div>
                                        
                                        <div class="form-sign form-sign_accept">
                                            <i class="icon-prinyat-kolo svoe-icon"></i>
                                        </div>
                                        
                                        <div class="form-sign form-sign_error top-left">
                                            <i class="icon-poskarzhytysya svoe-icon"></i>
                                            <div class="form-sign-tooltip">
                                                {{ trans('auth.reg_req_password') }}
                                            </div>
                                        </div>

                                        <div class="form-sign form-sign_showpass">
                                            <i class="icon-bachymo svoe-icon"></i>
                                        </div>                                       

                                    </fieldset>

                                    <fieldset class="form-group-terms">    
                                        <span class="wrap-checker-sett">
                                            <input type="checkbox" id="terms-accept" name="terms-accept" class="" />
                                        </span>
                                        <a class="terms-link" href="#terms-modal" data-toggle="modal">{{ trans('auth.terms') }}</a>
                                    </fieldset>
                                    {!! app('captcha')->display($attributes = [], $lang = App::getLocale()) !!}
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            {{ Form::button(trans('auth.create_account'), ['type' => 'submit','class' => 'btn btn-success btn-submit']) }}
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>                  

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal terms-modal fade" id="terms-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="title-setting-side">
                {{ trans('auth.terms_modal_title') }}
                <span class="close" data-dismiss="modal" aria-label="Close">
                <img src="{!! Theme::asset()->url('images/_new/icon-close-modal-sett.png') !!}" alt=""></span>
            </div>
            <div class="modal-body">

                <div class="terms-wrapper">

                    <div class="terms-text">
                        <!-- ###TEMP -->
                        <p>«Он не вернулся из боя» — песня Владимира Высоцкого о Великой Отечественной войне. Написана летом 1969 года для кинофильма «Сыновья уходят в бой» режиссёра Виктора Турова, была использована в фильме 1980 года «„Мерседес“ уходит от погони» режиссёра Юрия Ляшенко. Варианты названия: «Песня о погибшем друге», «Песня о друге», «Почему всё не так».</p>

                        <p>Первое исполнение перед широкой аудиторией состоялось в 1971 году. Песня рассматривает одну из ключевых тем в творчестве Высоцкого — тему фронтового братства и поисков родственной души. Первое музыкальное издание — мини-альбом «Песни Владимира Высоцкого из кинофильмов» (фирма звукозаписи «Мелодия», 1972 год). При жизни автора произведение было переведено и опубликовано в Польше и Болгарии.</p>

                        <p>«Он не вернулся из боя» — песня Владимира Высоцкого о Великой Отечественной войне. Написана летом 1969 года для кинофильма «Сыновья уходят в бой» режиссёра Виктора Турова, была использована в фильме 1980 года «„Мерседес“ уходит от погони» режиссёра Юрия Ляшенко. Варианты названия: «Песня о погибшем друге», «Песня о друге», «Почему всё не так».</p>

                        <p>Первое исполнение перед широкой аудиторией состоялось в 1971 году. Песня рассматривает одну из ключевых тем в творчестве Высоцкого — тему фронтового братства и поисков родственной души. Первое музыкальное издание — мини-альбом «Песни Владимира Высоцкого из кинофильмов» (фирма звукозаписи «Мелодия», 1972 год). При жизни автора произведение было переведено и опубликовано в Польше и Болгарии.</p>

                        <p>«Он не вернулся из боя» — песня Владимира Высоцкого о Великой Отечественной войне. Написана летом 1969 года для кинофильма «Сыновья уходят в бой» режиссёра Виктора Турова, была использована в фильме 1980 года «„Мерседес“ уходит от погони» режиссёра Юрия Ляшенко. Варианты названия: «Песня о погибшем друге», «Песня о друге», «Почему всё не так».</p>

                        <p>Первое исполнение перед широкой аудиторией состоялось в 1971 году. Песня рассматривает одну из ключевых тем в творчестве Высоцкого — тему фронтового братства и поисков родственной души. Первое музыкальное издание — мини-альбом «Песни Владимира Высоцкого из кинофильмов» (фирма звукозаписи «Мелодия», 1972 год). При жизни автора произведение было переведено и опубликовано в Польше и Болгарии.</p>
                    </div>

                    <div class="login-bottom text-center">
                        <div class="btn btn-success" data-dismiss="modal" aria-label="Close">{{ trans('common.close') }}</div>
                    </div>

                </div>                   

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{Theme::asset()->url('css/anytime.5.2.0.css')}}" />
<script src="{{Theme::asset()->url('js/anytime.5.2.0.min.js')}}"></script>
<!--<script src="{{Theme::asset()->url('js/anytimetz.5.2.0.js')}}"></script>-->

<script src="{{Theme::asset()->url('js/moment/moment-with-locales.js')}}"></script>

<script type="text/javascript">

$(function () {

    var $form = $('form.signup-form');
    var $btn = $form.find('.btn-submit');

    // other form field
    $form.find('.form-group:not(.form-control-check) .form-control, #terms-accept').on('change', function(){
        enableSubmitBtn();
    });

    // enable btn ?
    function enableSubmitBtn() {
        var enable = true;

        // ajax field
        if ( $form.find('.form-control-check').length !== $form.find('.form-control-check.valid').length ) {
            enable = false;
        }

        // gender
        if ( $.trim($form.find('select[name="gender"]').val()) == '' ) {
            enable = false;
        }

        // terms
        if ( !$form.find('#terms-accept').prop('checked') ) {
            enable = false;
        }       

        if (enable) {
            $btn.prop('disabled', false);
        } else {
            $btn.prop('disabled', true);
        }

    }

    // Show/hide ico show pass
    $('.form-control[name="password"]').on('keyup', function(){
        var $pass = $(this);
        if ( $pass.val().length > 0 ) {
            $pass.addClass('showpass');
        } else {
            $pass.removeClass('showpass');
        }
    });

    // Show/hide pass
    $('.form-sign_showpass').on('click', function(){
        var $pass = $(this).parent('.form-group').find('.form-control[name="password"]');

        if ($pass.attr('type') == "password") {
            $(this).addClass('active');
            $pass.attr('type', 'text');
        } else {
            $(this).removeClass('active');
            $pass.attr('type', 'password');
        }            

    });

    moment.locale( "{{App::getLocale()}}" );
    $('#date-field').AnyTime_picker({
        format: '%d %M %Y',
        firstDOW: 1,
        labelDismiss: '<i class="icon-zakrutu svoe-icon"></i>',
        labelTitle: ' ',
        labelYear: "{{ trans('common.year') }}",
        labelMonth: "{{ trans('common.month') }}",
        labelDayOfMonth: "{{ trans('common.day_month') }}",
        monthNames: moment.months(),
        monthAbbreviations: moment.monthsShort(),
        dayNames: moment.weekdays(),
        dayAbbreviations: moment.weekdaysShort()
    });

    // clear reg form email, pass field
    setTimeout(function(){

        $('form.signup-form .form-control').val('').trigger('keyup');

        // Validate form field
        $('.form-control-check .form-control').on('blur', function(){

            var $field = $(this).parent('.form-group'),
                name = $(this).prop('name'),
                value = $(this).val(),
                token  = $('meta[name="csrf_token"]').attr('content');

            /*$btn.prop('disabled', true);*/
            $field.addClass('wait');
            console.log('VALIDATE field: ' + name);
            var data ={_token: token};
            data[name]=value;
            $.ajax({
                method: 'POST',
                url: SP_source() + 'register-ajaxValidate',
                data: {
                    name: name,
                    value: value,
                    _token: token
                }
            }).done(function(response) {

                if(response.msg=='success' && response.status==200){
                    // Valid
                    $field.addClass('valid').removeClass('has-error');
                    enableSubmitBtn();
                }
                else {
                    var err=response.err_result[name],
                        errMes='';
                    err.forEach(function(item, i, arr) {
                        errMes+=item;
                    });
                    $field.removeClass('valid').addClass('has-error').find('.form-sign_error .form-sign-tooltip').text(errMes);
                }

                $field.removeClass('wait');

            });

        });

    }, 500);


});

</script>