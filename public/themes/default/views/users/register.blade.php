<div class="login-block" style="display: none">
    <div class="panel panel-default">
        <div class="panel-body nopadding">
            <div class="login-head">
                {{ trans('auth.welcome_to').' '.Setting::get('site_name') }}
                <div class="header-circle"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
            </div>
            <div class="login-bottom">
                
                <ul class="signup-errors text-danger list-unstyled"></ul>

                <form method="POST" class="signup-form" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group required {{ $errors->has('email') ? ' has-error' : '' }}">
                                {{ Form::label('email', trans('auth.email_address')) }} 
                                {{ Form::text('email', NULL, ['class' => 'form-control', 'id' => 'email', 'placeholder'=> trans('auth.welcome_to')]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
                                {{ Form::label('name', trans('auth.name')) }} 
                                {{ Form::text('name', NULL, ['class' => 'form-control', 'id' => 'name', 'placeholder'=> trans('auth.name')]) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </fieldset>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group required {{ $errors->has('username') ? ' has-error' : '' }}">
                                {{ Form::label('username', trans('common.username')) }} 
                                {{ Form::text('username', NULL, ['class' => 'form-control', 'id' => 'username', 'placeholder'=> trans('common.username')]) }}
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        {{ $errors->first('username') }}
                                    </span>
                                @endif
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group required {{ $errors->has('gender') ? ' has-error' : '' }}">
                                {{ Form::label('gender', trans('common.gender')) }} 
                                {{ Form::select('gender', array('female' => 'Female', 'male' => 'Male', 'other' => 'None'), null, ['placeholder' => trans('auth.select_gender'), 'class' => 'form-control']) }}
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        {{ $errors->first('gender') }}
                                    </span>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                                {{ Form::label('password', trans('auth.password')) }} 
                                {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder'=> trans('auth.password')]) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </fieldset>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <div class="row">
                        @if(Setting::get('birthday') == "on")
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    {{ Form::label('birthday', trans('common.birthday')) }}<i class="optional">(optional)</i>
                                    <div class="input-group date datepicker">
                                        <span class="input-group-addon addon-left calendar-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                        {{ Form::text('birthday', NULL, ['class' => 'form-control', 'id' => 'datepicker1']) }}
                                        <span class="input-group-addon addon-right angle-addon">
                                            <span class="fa fa-angle-down"></span>
                                        </span>
                                    </div>
                                </fieldset>
                            </div>
                        @endif
                            
                        @if(Setting::get('city') == "on")
                           <div class="col-md-6">
                                <fieldset class="form-group">
                                    {{ Form::label('city', trans('common.current_city')) }}<i class="optional">(optional)</i>
                                    {{ Form::text('city', NULL, ['class' => 'form-control', 'placeholder' => trans('common.current_city')]) }}
                                </fieldset>
                            </div>
                        @endif   
                    </div>

                    <div class="row">
                        @if(Setting::get('captcha') == "on")
                        <div class="col-md-12">
                            <fieldset class="form-group{{ $errors->has('captcha_error') ? ' has-error' : '' }}">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('captcha_error'))
                                    <span class="help-block">
                                        {{ $errors->first('captcha_error') }}
                                    </span>
                                @endif
                            </fieldset>
                        </div>    
                        @endif    
                    </div>
                    
                    {{ Form::button(trans('auth.signup_to_dashboard'), ['type' => 'submit','class' => 'btn btn-success btn-submit']) }}
                </form>
            </div>  
            @if((env('GOOGLE_CLIENT_ID') != NULL && env('GOOGLE_CLIENT_SECRET') != NULL) ||
                (env('TWITTER_CLIENT_ID') != NULL && env('TWITTER_CLIENT_SECRET') != NULL) ||
                (env('FACEBOOK_CLIENT_ID') != NULL && env('FACEBOOK_CLIENT_SECRET') != NULL) ||
                (env('LINKEDIN_CLIENT_ID') != NULL && env('LINKEDIN_CLIENT_SECRET') != NULL) )
                <div class="divider-login">
                    <div class="divider-text"> {{ trans('auth.login_via_social_networks') }}</div>
                </div>
            @endif
            <ul class="list-inline social-connect">
                @if(env('GOOGLE_CLIENT_ID') != NULL && env('GOOGLE_CLIENT_SECRET') != NULL)
                    <li><a href="{{ url('google') }}" class="btn btn-social google-plus"><span class="social-circle"><i class="fa fa-google-plus" aria-hidden="true"></i></span></a></li> 
                @endif

                @if(env('TWITTER_CLIENT_ID') != NULL && env('TWITTER_CLIENT_SECRET') != NULL)
                    <li><a href="{{ url('twitter') }}" class="btn btn-social tw"><span class="social-circle"><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
                @endif

                @if(env('FACEBOOK_CLIENT_ID') != NULL && env('FACEBOOK_CLIENT_SECRET') != NULL)
                    <li><a href="{{ url('facebook') }}" class="btn btn-social fb"><span class="social-circle"><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
                @endif

                @if(env('LINKEDIN_CLIENT_ID') != NULL && env('LINKEDIN_CLIENT_SECRET') != NULL) 
                    <li><a href="{{ url('linkedin') }}" class="btn btn-social linkedin"><span class="social-circle"><i class="fa fa-linkedin" aria-hidden="true"></i></span></a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="problem-login">
        <div class="pull-left">{{ trans('auth.already_have_an_account').'? ' }}<a href="{{ url('/login') }}">{{ trans('auth.sign_in') }}</a></div>
        <div class="pull-right"><a href="{{ url('/password/reset') }}"> {{ trans('auth.forgot_password').'?' }}</a></div>
    </div>
</div><!-- /login-block -->