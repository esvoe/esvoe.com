<div class="login-block">
    <div class="panel panel-default">
        <div class="panel-body nopadding">
            <div class="login-head">
                {{ trans('auth.reset_welcome_heading') }}
                <div class="header-circle"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
                <div class="header-circle login-progress hidden"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
            </div>
            <div class="login-bottom">
                 @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                    <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email',trans('auth.email_address')) }}
                        {{ Form::text('email', NULL, ['class' => 'form-control', 'id' => 'email', 'placeholder'=> trans('auth.email_address')]) }}
                    </fieldset>
                    {{ Form::button( 'Send Password Reset Link' , ['type' => 'submit','class' => 'btn btn-success btn-submit']) }}
                </form>
            </div>  
           
        </div>
    </div>
    <div class="problem-login">
        <div class="pull-left">{{ trans('auth.dont_have_an_account_yet') }}<a href="{{ url('/register') }}"> {{ trans('auth.get_started') }}</a></div>
        <div class="pull-right"><a href="{{ url('/login') }}">{{ trans('auth.login') }}</a></div>
        <div class="clearfix"></div>
    </div>
</div><!-- /login-block -->
