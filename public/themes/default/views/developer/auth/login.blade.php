{!! Form::open(array('route' => array('developer.oauth.login'), 'method' => 'post')) !!}
<div class="template-login-svoe ">
    <div class="text-login-svoe">
        Войдите в <a href="" class="svoe-link-login">Єsvoe</a>, чтобы использовать свой
        аккаунт в приложении <a href="">E-Ticket</a>
    </div>
    <div class="field-sign-login">
        <div class="form-group">
            {{ Form::text('email', NULL, ['class' => 'form-control', 'name' => 'login', 'placeholder'=> trans('auth.enter_email_or_username')]) }}
        </div>
        <div class="form-group">
            {{ Form::password('password', ['class' => 'form-control', 'name' => 'password', 'placeholder'=> trans('auth.password')]) }}
        </div>

        <div class="custom-captcha">
            {!! app('captcha')->display($attributes = [], $lang = App::getLocale()) !!}
        </div>

        {!! Form::button(trans('auth.sign_in'), ['type' => 'submit','class' => 'btn btn-success btn-submit' ]) !!}
    </div>
</div>
{!! Form::close() !!}
