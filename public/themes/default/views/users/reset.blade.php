<div class="login-block">
    <div class="panel panel-default">
        <div class="panel-body nopadding">
            <div class="login-head">
                {{ trans('auth.reset_your_password') }}
                <div class="header-circle"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
            </div>
            <div class="login-bottom">
                <form method="POST" class="form" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="email" value="{{ Request::get('email') }}">
                    <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email', trans('auth.email_address')) }}
                        {{ Form::text('email', Request::get('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder'=> trans('auth.email_address'), 'disabled' => 'disabled']) }}
                    </fieldset>

                    <fieldset class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::label('password', trans('auth.password')) }}
                        {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder'=> trans('auth.password')]) }}

                        @if ($errors->has('password'))
                            <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                        @endif

                    </fieldset>

                    <fieldset class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {{ Form::label('password_confirmation', trans('auth.confirm_password')) }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder'=> trans('auth.confirm_password')]) }}

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                {{ $errors->first('password_confirmation') }}
                            </span>
                        @endif
                                
                    </fieldset>
                    {{ Form::button(trans('auth.reset_password'), ['type' => 'submit','class' => 'btn btn-success']) }}
                </form>
            </div>  
        </div>
    </div>
</div><!-- /login-block -->