
@foreach($peopleList as $user)
<div class="wrap-own-invite">
    <a href="{{route('user.showTimeline', array('username'=>$user->esvoe_id))}}">
        <div class="photo-invite"
         @if( isset($user->avatar) && strlen($user->avatar) > 1) style="background-image: url('/user/avatar/{!! $user->avatar !!}')" @else style="background-image: url('{{ url('/user/avatar/default-other-avatar.png') }}');" @endif
    title="{{ $user->firstname }} {{$user->lastname}}"></div>
    </a>
    <h4><a href="{{route('user.showTimeline', array('username'=>$user->esvoe_id))}}"> {{$user->firstname}} {{$user->lastname}} </a></h4>
    <p>{{$user->city}} &nbsp; </p>
    <span><a href="#"></a>
        {{--та ще 12 спільних друзів--}}
        &nbsp;
    </span>
    <div class="action-invite-friend">
        @if(! isset($user->type_friend))
            <div class="js-follow-links">
                <div>
                    <a href="" class="hypothetically-friend follow" rel="{{$user->user_id}}" ><i class="icon-dodaty-druzi svoe-lg svoe-icon"></i> <span>{{ trans('friend.add_to_friends') }}</span></a>
                </div>
                <div class="hidden">
                    <a href="" style="background-color: #f59d1a !important;" class="hypothetically-friend unfollow" rel="{{$user->user_id}}" ><i class="icon-vidpysatys svoe-lg svoe-icon"></i> <span>{{ trans('friend.cancel_request') }}</span></a>
                </div>
            </div>
        @endif
    </div>
</div>
@endforeach