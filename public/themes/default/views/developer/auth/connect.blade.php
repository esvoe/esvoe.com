<div class="template-reg-svoe">

    <div class="photo-reg-site">
        <img src="{{static_uploads($application->image_main)}}" />
    </div>

    <h3>{{$application->title}}</h3> ask for your permissions

    <div class="description"> 
        <div class="perms">
            <p>
    @foreach($requirePerms as $perm)
                <span>- {{$perm}}</span>
                @endforeach
            </p>
        </div>     
        <div class="btn-reg-template">

{!! Form::open(array('route' => array('developer.oauth.connect'), 'method' => 'post')) !!}
{!! Form::hidden('session_id', $sessionID) !!}
                {!! Form::button('Grant', ['type' => 'submit','class' => 'btn-continue-reg']) !!}
{!! Form::close() !!}

{!! Form::open(array('route' => array('developer.oauth.abort'), 'method' => 'post')) !!}
{!! Form::hidden('session_id', $sessionID) !!}
                {!! Form::button('<i class="icon-zakrutu svoe-icon"></i>', ['type' => 'submit','class' => 'btn-cancel-reg', 'title' => trans('common.cancel')]) !!}
{!! Form::close() !!}

        </div>
    </div>    

</div>

<div class="footer-reg-svoe">
    <a href="#">Условия приложений</a>
    <a href="#">Политика конфіденциальности</a>
</div>