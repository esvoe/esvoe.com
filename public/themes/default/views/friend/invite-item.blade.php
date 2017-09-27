

    <div class="title-notifi-friend">
        <span>{{ trans('friend.ask_invite_friend') }}</span>
    </div>
    @foreach($inviteList as $invite)
        <div class="own-mess-notifi-friend unread-notifi-friend" id="inviteElementOnForm{{$invite['userId']}}">
            <a href="{{route('user.showTimeline', array('username'=>$invite['login']))}}">
                <div class="photo-mess-notifi-friend" @if( isset($invite['avatar']) && strlen($invite['avatar']) > 1) style="background-image: url('{!! $invite['avatar'] !!}')" @else style="background-image: url('{{ url('page/avatar/default-page-avatar.png') }}');" @endif title="{{ $invite['name'] }}"  >
                </div>
            </a>
            <p><a href="{{route('user.showTimeline', array('username'=>$invite['login']))}}"> {{$invite['name']}} </a></p>
            <span> {{$invite['city']}} &nbsp; </span>
            <div class="action-notifi-friend">
                <a href="javascript:" onclick="acceptFriend({{$invite['userId']}});">{{ trans('friend.accept_friend') }}</a>
                <span onclick="rejectFriend({{$invite['userId']}})"><i class="icon-zakrutu svoe-icon"></i></span>
            </div>
        </div>
    @endforeach

    <div class="title-notifi-friend" style="border-top:1px solid #dfe7ee">
        <span>{{ trans('friend.people_may_you_know') }}</span>
    </div>
    {{--<div class="own-mess-notifi-friend">
        <div class="photo-mess-notifi-friend" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')"></div>
        <p><a href="">Оксана Габалевич</a></p>
        <span>3 спільних друзів </span>
        <div class="action-notifi-friend">
            <a href="">{{ trans('friend.add_to_friends') }}</a>
            <span><i class="icon-zakrutu svoe-icon"></i></span>
        </div>
    </div>
    <div class="own-mess-notifi-friend">
        <div class="photo-mess-notifi-friend" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')"></div>
        <p><a href="">Миколай Габалевич</a></p>
        <span>8 спільних друзів </span>
        <div class="action-notifi-friend">
            <a href="">{{ trans('friend.add_to_friends') }}</a>
            <span><i class="icon-zakrutu svoe-icon"></i></span>
        </div>
    </div>
    <div class="own-mess-notifi-friend">
        <div class="photo-mess-notifi-friend" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')"></div>
        <p><a href="">Хроска Гарбузова</a></p>
        <span>2 спільних друзів </span>
        <div class="action-notifi-friend">
            <a href="">{{ trans('friend.add_to_friends') }}</a>
            <span><i class="icon-zakrutu svoe-icon"></i></span>
        </div>
    </div>--}}
