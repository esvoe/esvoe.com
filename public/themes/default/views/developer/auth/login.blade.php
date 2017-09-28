
{!! Form::open(array('route' => array('developer.oauth.login'), 'method' => 'post')) !!}

Username:<br>
{!! Form::text('login', null, array()) !!}
<br />
Password:<br>
{!! Form::password('password', null, array()) !!}
<br />

{!! app('captcha')->display(); !!}

<br>

{!! Form::submit('Login') !!}

{!! Form::close() !!}



