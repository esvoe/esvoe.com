
Hello 'username'
<br />
<br>


<br>

<img src="{{static_uploads($application->image_main)}}" /><br>



Application <h3>{{$application->title}}</h3> ask for your permissions

<br>

Permission name<br>
    @foreach($requirePerms as $perm)
    <div>! {{$perm}}</div>

    @endforeach
<br>
{!! Form::open(array('route' => array('developer.oauth.connect'), 'method' => 'post')) !!}
{!! Form::hidden('session_id', $sessionID) !!}
    {!! Form::submit('Grant') !!}
{!! Form::close() !!}

{!! Form::open(array('route' => array('developer.oauth.abort'), 'method' => 'post')) !!}
{!! Form::hidden('session_id', $sessionID) !!}
{!! Form::submit('Cancel') !!}
{!! Form::close() !!}
<br />

