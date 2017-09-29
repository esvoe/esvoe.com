<div class="container">
    <div class="wrap-login-page">
        <div class="row">
            <div class=" col-sm-7 col-md-8 col-lg-8">
                <a href="{{ url('/') }}" class="logo-login">
                    <img src="{!! Theme::asset()->url('images/beta_logo.svg') !!}" alt="{{ Setting::get('site_name') }}" title="{{ Setting::get('site_name') }}">
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
                                    {{trans('auth.quick_reg')}} <span>{{trans('common.beta_test')}}</span>
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

                    <div class="terms-text @if(Config::get('app.locale')== 'en')active-lang-modal @endif">
                        <h4><b>1) Privacy policy</b></h4><p class="MsoNormal"><br></p><p class="MsoNormal">Rules relevant for all visitors of the portal, both for registered and unregistered persons are listed below.</p><p class="MsoNormal">1. This portal is supported and operated by ESVOE LLP, with the registration number OC418712.</p><p class="MsoNormal">2. The portal is provided for wide user audience and available on the website Esvoe.com and also as a mobile addition.</p><p class="MsoNormal">3. Before work the user is obliged to study rules. If the user takes any actions on the portal - it means that he is informed of rules and undertakes to follow them. Esvoe.com reserves the right to introduce amendments in the set of rules. Changes come into force after they are published on the portal.</p><p class="MsoNormal">4. Users of the portal are recommended&nbsp; to regularly re-read rules to be aware of innovations. In case the user doesn't agree with rules - access to the portal is blocked.</p><p class="MsoNormal">5. The portal gives to the registered users the chance to use different services including paid services. They are regulated by conditions of the remote contract. Also It should be noted that Esvoe.com in the right to change the cost of services and to enter new paid services.</p><p class="MsoNormal">6. To be registered on the portal it is necessary to adhere the designated order of registration.</p><p class="MsoNormal">7. For registration it is obligatory to use reliable data and photos. On one person registered in it only one profile is provided. On the portal creation of fake profiles with animals, objects or nonexistent persons is forbidden.</p><p class="MsoNormal">8. For the purpose of safety it is recommended not to disclose any infromation which is intended for the user. Any actions and purchases which are carried out at the indication of the correct login and the password are considered executed by the user.</p><p class="MsoNormal">9. Activity of commercial character on the portal is forbidden. For this purpose there is a special section, with the corresponding set of rules and the written agreement of Esvoe.com.</p><p class="MsoNormal">10. The administration of the portal reserves full authority to delete the registered profiles or information from a profile. At the same time, data can go without the previous prevention and without explanation.</p><p class="MsoNormal">11. All users of the portal bear full responsibility for the data placed in a profile or are sent to other users. The user undertakes to dispose only of those data on which he has the implicit rights.</p><p class="MsoNormal">12. Users are forbidden to place and send information in that case:</p><p class="MsoNormal">- if it violates the rights for the intellectual property of the third parties;</p><p class="MsoNormal">- if she calls for discrimination and violence;</p><p class="MsoNormal">- if it immoral, sensitive or pornographic character;</p><p class="MsoNormal">- if it contains the computer viruses or programs capable to do much harm to data transmission;</p><p class="MsoNormal">- if it contains spam or uncoordinated advertizing;</p><p class="MsoNormal">- if it contains advertizing of financial pyramids or the forbidden competitions;</p><p class="MsoNormal">- if it violates regulations of Ukraine;</p><p class="MsoNormal">- if it can will do much harm safety of the portal.</p><p class="MsoNormal">13. The user of Esvoe.com provides to the portal and to its users the world license and the right to dispose are published by data and also refuses to put forward claims concerning copyright.</p><p class="MsoNormal">14. The portal pose is forbidden to use the "recommend" function for information if she does not answer rules of the portal.</p><p class="MsoNormal">15. The portal does not bear responsibility for information which is placed on it and also for access and mutual communication between users. Also the portal does not bear responsibility for possible losses which arose when using Esvoe.com and additional services.</p><p class="MsoNormal">16. In access for users there are paid and free games. They are provided by the portal and also the third persons. The third parties have the right to interrupt the offer of games, but undertake to warn about it in two weeks. The money which was spent for a game are not compensated to the user.</p><p class="MsoNormal">17. To the user damages for paid services are not paid if his access to the portal was blocked, or information was removed from its profile.</p><p class="MsoNormal">18. All rights for intellectual property concerning the portal belong to Esvoe.com. One of the users duties -&nbsp; actions directed to protect the legal interests of Esvoe.com belong. In case of copyright infringement, the guilty person is called for responsibility.</p><p class="MsoNormal">19. Any dispute between users of the portal and Esvoe.com decide via negotiations, or through court of Ukraine.</p><p class="MsoNormal">20. The user agrees to obtain information which is connected with current events on the portal from Esvoe.com.</p><p class="MsoNormal"><br></p><h4><b>2) Rules of confidentiality</b></h4><p class="MsoNormal"><br></p><p class="MsoNormal">1. Being registered on the portal, the user agrees to processing of Esvoe.com of personal data and identification codes, according to the law on protection of personal data and natural persons.</p><p class="MsoNormal">2. Processing of personal data is carried out for the purpose of ensuring communication between users of the portal, publication of data and rendering of services.</p><p class="MsoNormal">3. The user agrees that data are placed in a profile are in public access for other registered users and also in limited access for the third parties.</p><p class="MsoNormal">4. Degree of a detail of a profile is chosen directly the user and also can be corrected in appropriate section of a profile (personal installations). After removal of information or the profile, it becomes invisible to other users. But this information is stored in the database of the portal within 90 days.</p><p class="MsoNormal">5. The portal offers an opportunity of search of the registered users, the enterprises and actions, information on which contains on the portal. The registered users have an opportunity to see statistics of revisions of the profile and also to mark out other registered users. Revision of profiles of users can be carried out via the personal computer or through mobile addition.</p><p class="MsoNormal">6. Esvoe.com offers an opportunity to authorization through other websites and mobile appliques. At the same time, these authorizations are not told to the third parties that keeps confidentiality of the user.</p><p class="MsoNormal">7. If the user does publications on websites of the third parties, using possibilities of authorization of Esvoe.com, data of its profile will be visible to not registered users of the portal.</p><p class="MsoNormal">8. Publications and data of a profile of the registered user can be looked through which are not registered by users.</p><p class="MsoNormal">9. If the registered user revises information of the third parties on the portal (the page of actions, the enterprises or self-government), then websites of these most third parties and also to other registered users, can be sent message about revision and also personal information from the user's profile.</p><p class="MsoNormal">10. On the portal information of advertizing character can be placed. Advertisers have no access to personal information of users, but have the right to determine the audience by gender and century sign.</p><p class="MsoNormal">11. Esvoe.com obtains and stores information of the user from programs of the accelerated revision. For these purposes the portal uses information concerning the IP address, cookie and also parameters of the device from which the executed entrance.</p><p class="MsoNormal">12. The portal has the right to publish summarized information on users, without identification and concrete data.</p><p class="MsoNormal">13. Users of the portal (registered and unregistered) agree that Esvoe.com is in right to transfer personal data of the user in the following cases:</p><p class="MsoNormal">- to other persons at the consent of the user;</p><p class="MsoNormal">- to other persons, for implementation of the services ordered by the user;</p><p class="MsoNormal">- to law enforcement agencies, in the presence of inquiry, within the legislation of Ukraine;</p><p class="MsoNormal">- law enforcement agencies in case Esvoe.com states violation by the user of rules or regulations of Ukraine.</p>
                    </div>

                    <div class="terms-text @if(Config::get('app.locale')== 'ru')active-lang-modal @endif">
                        <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><b>1) Политика конфиденциальности </b></span></p><p><b style="font-weight:normal;" id="docs-internal-guid-70f55fbf-ce75-dd3b-9726-61a34d6c42d8"><br></b></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">Ниже перечисленные правила актуальны для всех посетителей портала, как для зарегистрированных лиц, так и для не зарегистрированных пользователей. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">1. &nbsp;&nbsp;Данный портал поддерживается и управляется ESVOE LLP </span><span style="font-size: 9.5pt; font-family: Arial; color: rgb(0, 0, 0); font-weight: 400; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">ООО </span><span style="font-size: 9.5pt; font-family: Arial; color: rgb(34, 34, 34); font-weight: 400; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Esvoe</span><span style="font-size: 9.5pt; font-family: Arial; color: rgb(0, 0, 0); font-weight: 400; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">,</span><span style="font-size: 9.5pt; font-family: Arial; color: rgb(34, 34, 34); font-weight: 400; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> с регистрационным номером. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">2. Портал предусмотрен для широкой пользовательской аудитории и доступен на сайте Esvoe.com, а также в формате мобильного приложения. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">3. Перед началом работы пользователь обязан ознакомится с правилами. Если пользователь совершает на портале какие-либо действия – это значит, что он ознакомлен с правилами и обязуется их соблюдать. Esvoe.com оставляет за собой право вносить коррективы в свод правил. Изменения вступают в силу после того, как будут опубликованы на портале. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">4. Пользователям портала рекомендуется регулярно перечитывать правила, чтобы быть в курсе нововведений. В случае, когда пользователь не согласен с правилами – доступ к порталу блокируется. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">5. Зарегистрированным пользователям портал даёт возможность использовать разные услуги, в том числе и платные. Они регламентируются условиями дистанционного договора. Также стоит отметить, что Esvoe.com в праве изменять стоимость услуг и вводить новые платные услуги. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">6. Для того, чтобы зарегистрироваться на портале следует соблюдать обозначенный порядок регистрации. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">7. Для регистрации обязательно использовать достоверные данные и фотографии. На одно зарегистрированное лицо предусмотрен только один профиль. На портале запрещается создание фэйковых профилей с животными, предметами или несуществующими личностями. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">8. &nbsp;В целях безопасности рекомендуется не разглашать пользовательские данные. Любые действия и покупки, совершенные при указании правильного логина и пароля, считаются выполненными самим пользователем.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">9. Деятельность коммерческого характера на портале запрещена. Для этого существует специальный раздел, с соответствующим сводом правил и письменным соглашением Esvoe.com. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">10. Администрация портала оставляет за собой полное право удалять зарегистрированные профили или информацию из профиля. При этом, данные могут удалиться без предварительного предупреждения и без объяснения причин. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">11. Все пользователи портала несут полную ответственность за данные, размещенные в профиле или отправленные другим пользователям. Пользователь обязуется распоряжаться только теми данными, на которые имеет безоговорочные права. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">12. Пользователям запрещается размещать и пересылать информацию в том случае:</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она нарушает права на интеллектуальную собственность третьих лиц; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она призывает к дискриминации и насилию; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она аморального, оскорбительного или порнографического характера; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она содержит компьютерные вирусы или программы, способные навредить передаче данных; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она содержит спам или несогласованную рекламу; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она содержит рекламу финансовых пирамид или запрещённых соревнований; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она нарушает нормативные акты Украины;</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• если она может навредит безопасности портала. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">13. Пользователь Esvoe.com предоставляет порталу и его пользователям всемирную лицензию и право распоряжаться публикуемыми данными, а также отказывается выдвигать претензии касательно авторских прав.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">14. Запрещается пользоваться функцией «рекомендовать» для информации вне портала, если она не соответствует правилам портала.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">15. Портал не несёт ответственность за информацию, которая размещена на нем, а также за доступ и взаимную коммуникацию между пользователями. Также портал не несёт ответственность за возможные убытки, которые возникли при использовании Esvoe.com и дополнительных услуг.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">16. В доступе пользователей находятся платные и бесплатные игры. Их предоставляет портал, а также третий лица. Третьи лица имеют право прервать предложение игр, но обязуются предупредить об этом за две недели.Пользователю не возмещаются деньги, которые были потрачены на игру.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">17. Пользователю не возмещаются убытки за платные услуги, если ему заблокирован доступ на портал, или информация из его профиля была удалена.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">18. Все права на интеллектуальную собственность касательно портала принадлежат Esvoe.com В обязанности пользователя входят действия, направленные на защиту правовых интересов Esvoe.com. В случае нарушения авторских прав, виновное лицо призывается к ответственности. &nbsp;</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">19. Любой спор между пользователями портала и Esvoe.com решаются либо переговорами, либо через суд Украины. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">20. Пользователь соглашается получать от Esvoe.com информацию, которая связана с актуальными событиями на портале.</span></p><p><b style="font-weight:normal;"><br></b></p><h6 style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><b>2)</b><b style="color: inherit; font-family: inherit; letter-spacing: -0.015em;">Правила конфиденциальности</b></h6><p><b style="font-weight:normal;"><br></b></p><h6 style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">1. Регестрируясь на портале, пользователь даёт согласие на обработку Esvoe.com персональных данных и идентификационных кодов, соответственно с законом о защите личных данных и физических лиц.</span></h6><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">2. Обработкой данных занимается непосредственно ООО Esvoe, </span><span style="font-size: 9.5pt; font-family: Arial; color: rgb(34, 34, 34); font-weight: 400; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">с регистрационным номером OC418712 , по юридическому адресу:.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">3. Обработка персональных данных совершается с целью обеспечения коммуникации между пользователями портала, публикации данных и предоставления услуг.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">4. Пользователь соглашается с тем, что данные размещённые в профиле находятся в публичном доступе для других зарегистрированных пользователей, а также в ограниченом доступе для третьих лиц. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">5. Степень приватности профиля выбирается непосредственно пользователем, а также может корректироваться в соответствующем разделе профиля (персональные установки). После удаления информации или самого профиля, он становится невидимым для других пользователей. Но эта информация хранится в базе данных портала в течении 90 дней.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">6. Портал предлагает возможность поиска зарегистрированных пользователей, предприятий и мероприятий, информация о которых содержится на портале. Зарегистрированные пользователи имеют возможность видеть статистику просмотров своего профиля, а также отмечать других зарегистрированных пользователей. Просмотр профилей пользователей можно совершать через ПК или через мобильное приложение. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">7. Esvoe.com предлагает возможность авторизации через другие веб-сайты и мобильные аппликации. При этом, данные авторизации третьим лицам не передаются, что сохраняет конфиденциальность пользователя.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">8. Если пользователь делает публикации на веб-сайтах третьих лиц, используя возможности авторизации Esvoe.com, данные его профиля будут видны не зарегистрированным пользователям портала.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">9. Публикации и данные профиля зарегистрированного пользователя могут просматриваться не зарегистрированными пользователями. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">10. Если зарегистрированный пользователь просматривает информацию третьих лиц на портале (страницы мероприятий, предприятий или самоуправлений), то веб-сайтам этих самых третьих лиц, а также другим зарегистрированным пользователям, может отправится сообщение о просмотре а также личная информация из профиля пользователя. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">11. На портале может размещаться информация рекламного характера. Рекламодатели не имеют доступа к личной информации пользователей, но имеют право определять свою аудиторию по гендерному и возрастному признаку.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">12. Esvoe.com получает и сохраняет информацию пользователя из программ ускоренного просмотра. Для этих целей портал использует информацию касательно IP адреса, cookie, а также параметры устройства, с которого выполнен вход. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">13. Портал имеет право опубликовать обобщенную информацию о пользователях, без идентификации и конкретных данных. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">14. Пользователи портала (зарегистрированные и не зарегистрированные) соглашаются с тем, что Esvoe.com в праве передавать личные данные пользователя в следующих случаях: </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• другим лицам при согласии пользователя; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• другим лицам, для осуществления заказанных пользователем услуг; </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• правоохранительным органам, при наличии запроса, в рамках законодательства Украины; </span></p><p></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;">• правоохранительных органам, в случае если Esvoe.com констатирует нарушения пользователем правил или нормативных актов Украины. </span></p><div><span style="font-size:9.5pt;font-family:Arial;color:#222222;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;"><br></span></div>
                    </div>

                    <div class="terms-text @if(Config::get('app.locale')== 'ua')active-lang-modal @endif">
                        <p class="MsoNormal"><b><o:p>&nbsp;</o:p><span style="font-size: 14pt;">1) Політика конфіденційності</span></b></p><p class="MsoNormal"><o:p>&nbsp;</o:p></p><p class="MsoNormal">Нижче перераховані
                            правила актуальні для всіх відвідувачів порталу, як для зареєстрованих осіб,
                            так і для незареєстрованих користувачів.<o:p></o:p></p><p class="MsoNormal">1. Цей портал
                            підтримується і управляється ESVOE LLP , з реєстраційним номером&nbsp; OC418712.<o:p></o:p></p><p class="MsoNormal">2. Портал передбачений
                            для широкої користувальницької аудиторії і доступний на сайті Esvoe.com, а
                            також в форматі мобільного додатка.<o:p></o:p></p><p class="MsoNormal">3. Перед початком роботи
                            користувач зобов'язаний ознайомитися з правилами. Якщо користувач робить на
                            порталі будь-які дії - це значить, що він ознайомлений з правилами та
                            зобов'язується їх дотримуватися. Esvoe.com залишає за собою право вносити
                            корективи в звід правил. Зміни вступають в силу після того, як будуть
                            опубліковані на порталі.<o:p></o:p></p><p class="MsoNormal">4. Користувачам порталу
                            рекомендується регулярно перечитувати правила, щоб бути в курсі нововведень. У
                            разі, коли користувач не згоден з правилами - доступ до порталу блокується.<o:p></o:p></p><p class="MsoNormal">5. Зареєстрованим
                            користувачам портал дає можливість використовувати різні послуги, в тому числі
                            і платні. Вони регламентуються умовами дистанційного договору. Також варто
                            відзначити, що Esvoe.com в праві змінювати вартість послуг і вводити нові
                            платні послуги.<o:p></o:p></p><p class="MsoNormal">6. Для того, щоб
                            зареєструватися на порталі слід дотримуватися позначений порядок реєстрації.<o:p></o:p></p><p class="MsoNormal">7. Для реєстрації
                            обов'язково використовувати достовірні дані і фотографії. На одне зареєстровану
                            в ньому особу передбачений тільки один профіль. На порталі забороняється
                            створення фейкових профілів з тваринами, предметами або неіснуючими
                            особистостями.<o:p></o:p></p><p class="MsoNormal">8. З метою безпеки
                            рекомендується не розголошувати призначені для користувача дані. Будь-які дії і
                            покупки, здійснені при вказівці правильного логіна і пароля, вважаються
                            виконаними самим користувачем.<o:p></o:p></p><p class="MsoNormal">9. Діяльність комерційного
                            характеру на порталі заборонена. Для цього існує спеціальний розділ, з
                            відповідним зводом правил та письмовою угодою Esvoe.com.<o:p></o:p></p><p class="MsoNormal">10. Адміністрація порталу
                            залишає за собою повне право видаляти зареєстровані профілі або інформацію з
                            профілю. При цьому, дані можуть піти без попереднього попередження і без
                            пояснення причин.<o:p></o:p></p><p class="MsoNormal">11. Всі користувачі
                            порталу несуть повну відповідальність за дані, розміщені в профілі або
                            відправлені іншим користувачам. Користувач зобов'язується розпоряджатися тільки
                            тими даними, на які має беззаперечні права.<o:p></o:p></p><p class="MsoNormal">12. Користувачам
                            забороняється розміщувати та пересилати інформацію в тому випадку:<o:p></o:p></p><p class="MsoNormal">• якщо вона порушує права
                            на інтелектуальну власність третіх осіб;<o:p></o:p></p><p class="MsoNormal">• якщо вона закликає до
                            дискримінації та насильства;<o:p></o:p></p><p class="MsoNormal">• якщо вона аморального,
                            образливого чи порнографічного характеру;<o:p></o:p></p><p class="MsoNormal">• якщо вона містить
                            комп'ютерні віруси або програми, здатні нашкодити передачі даних;<o:p></o:p></p><p class="MsoNormal">• якщо вона містить спам
                            або неузгоджену рекламу;<o:p></o:p></p><p class="MsoNormal">• якщо вона містить
                            рекламу фінансових пірамід або заборонених змагань;<o:p></o:p></p><p class="MsoNormal">• якщо вона порушує
                            нормативні акти України;<o:p></o:p></p><p class="MsoNormal">• якщо вона може
                            зашкодить безпеки порталу.<o:p></o:p></p><p class="MsoNormal">13. Користувач Esvoe.com
                            надає порталу і його користувачам всесвітню ліцензію і право розпоряджатися
                            публікуються даними, а також відмовляється висувати претензії щодо авторських
                            прав.<o:p></o:p></p><p class="MsoNormal">14. Забороняється
                            користуватися функцією «рекомендувати» для інформації поза порталу, якщо вона
                            не відповідає правилам порталу.<o:p></o:p></p><p class="MsoNormal">15. Портал не несе
                            відповідальність за інформацію, яка розміщена на ньому, а також за доступ і
                            взаємну комунікацію між користувачами. Також портал не несе відповідальність за
                            можливі збитки, які виникли при використанні Esvoe.com і додаткових послуг.<o:p></o:p></p><p class="MsoNormal">16. У доступі
                            користувачів знаходяться платні і безкоштовні ігри. Їх надає портал, а також
                            третій особи. Треті особи мають право перервати пропозицію ігор, але
                            зобов'язуються попередити про це за два тижні. Користувачеві не відшкодовуються
                            гроші, які були витрачені на гру.<o:p></o:p></p><p class="MsoNormal">17. Користувачеві не
                            відшкодовуються збитки за платні послуги, якщо йому заблокований доступ на портал,
                            або інформація з його профілю була видалена.<o:p></o:p></p><p class="MsoNormal">18. Всі права на
                            інтелектуальну власність щодо порталу належать Esvoe.com В обов'язки
                            користувача входять дії, спрямовані на захист правових інтересів Esvoe.com. У
                            разі порушення авторських прав, винну особу закликається до відповідальності.<o:p></o:p></p><p class="MsoNormal">19. Будь-яка суперечка
                            між користувачами порталу і Esvoe.com вирішуються або переговорами, або через
                            суд України.<o:p></o:p></p><p class="MsoNormal">20. Користувач
                            погоджується отримувати від Esvoe.com інформацію, яка пов'язана з актуальними
                            подіями на порталі.</p><p class="MsoNormal"><br></p><p class="MsoNormal"><span style="font-size:14.0pt;line-height:107%;mso-ansi-language:
UK"><b>2) Правила конфіденційності</b><o:p></o:p></span></p><p class="MsoNormal"><o:p>&nbsp;</o:p></p><p class="MsoNormal">1. Реєструючись на
                            порталі, користувач дає згоду на обробку Esvoe.com персональних даних та
                            ідентифікаційних кодів, відповідно до закону про захист особистих даних та
                            фізичних осіб.<o:p></o:p></p><p class="MsoNormal">2. Обробка персональних
                            даних здійснюється з метою забезпечення комунікації між користувачами порталу,
                            публікації даних і надання послуг.<o:p></o:p></p><p class="MsoNormal">3. Користувач
                            погоджується з тим, що дані розміщені в профілі знаходяться в публічному
                            доступі для інших зареєстрованих користувачів, а також в обмеженому доступі для
                            третіх осіб.<o:p></o:p></p><p class="MsoNormal">4. Ступінь приватності
                            профілю вибирається безпосередньо користувачем, а також може коригуватися в
                            відповідному розділі профілю (персональні установки). Після видалення
                            інформації або самого профілю, він стає невидимим для інших користувачів. Але
                            ця інформація зберігається в базі даних порталу протягом 90 днів.<o:p></o:p></p><p class="MsoNormal">5. Портал пропонує
                            можливість пошуку зареєстрованих користувачів, підприємств та заходів,
                            інформація про яких міститься на порталі. Зареєстровані користувачі мають можливість
                            бачити статистику переглядів свого профілю, а також відзначати інших
                            зареєстрованих користувачів. Перегляд профілів користувачів можна здійснювати
                            через ПК або через мобільний додаток.<o:p></o:p></p><p class="MsoNormal">6. Esvoe.com пропонує
                            можливість авторизації через інші веб-сайти і мобільні аплікації. При цьому,
                            дані авторизації третім особам не передаються, що зберігає конфіденційність
                            користувача.<o:p></o:p></p><p class="MsoNormal">7. Якщо користувач робить
                            публікації на веб-сайтах третіх осіб, використовуючи можливості авторизації
                            Esvoe.com, дані його профілю будуть видні не зареєстрованим користувачам
                            порталу.<o:p></o:p></p><p class="MsoNormal">8. Публікації та дані
                            профілю зареєстрованого користувача можуть проглядатися які не зареєстровані
                            користувачами.<o:p></o:p></p><p class="MsoNormal">9. Якщо зареєстрований
                            користувач переглядає інформацію третіх осіб на порталі (сторінки заходів,
                            підприємств або самоврядувань), то веб-сайтів цих самих третіх осіб, а також
                            іншим зареєстрованим користувачам, може відправиться повідомлення про перегляд
                            а також особиста інформація з профілю користувача.<o:p></o:p></p><p class="MsoNormal">10. На порталі може
                            розміщуватися інформація рекламного характеру. Рекламодавці не мають доступу до
                            особистої інформації користувачів, але мають право визначати свою аудиторію за
                            гендерною та віковою ознакою.<o:p></o:p></p><p class="MsoNormal">11. Esvoe.com отримує і
                            зберігає інформацію користувача з програм прискореного перегляду. Для цих цілей
                            портал використовує інформацію щодо IP адреси, cookie, а також параметри
                            пристрою, з якого виконаний вхід.<o:p></o:p></p><p class="MsoNormal">12. Портал має право
                            опублікувати узагальнену інформацію про користувачів, без ідентифікації і
                            конкретних даних.<o:p></o:p></p><p class="MsoNormal">13. Користувачі порталу
                            (зареєстровані та незареєстровані) погоджуються з тим, що Esvoe.com в праві
                            передавати особисті дані користувача в наступних випадках:<o:p></o:p></p><p class="MsoNormal">• іншим особам за згодою
                            користувача;<o:p></o:p></p><p class="MsoNormal">• іншим особам, для
                            здійснення замовлених користувачем послуг;<o:p></o:p></p><p class="MsoNormal">• правоохоронним органам,
                            при наявності запиту, в рамках законодавства України;<o:p></o:p></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">
                        </p><p class="MsoNormal">• правоохоронних органів,
                            у разі якщо Esvoe.com констатує порушення користувачем правил або нормативних
                            актів України.<o:p></o:p></p>
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