<div class="login-block">
    <div class="panel panel-default">
        <div class="panel-body nopadding">
            <div class="login-head">
                {{ trans('auth.reset_password') }}
                <div class="header-circle"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
            </div>
            <div class="login-bottom">
                
                <form method="POST" class="login-form" action="{{ url('/password/email') }}" method="POST">
                    
                    {{ csrf_field() }}

                    <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email', trans('auth.email_address')) }}
                        {{ Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder'=> trans('auth.email_address')]) }}
                    </fieldset>

                    {{ Form::button(trans('auth.send_password_reset_link'), ['type' => 'submit','class' => 'btn btn-success']) }}
                </form>
            </div>  
        </div>
    </div><!-- /panel -->
</div><!-- /login-block -->