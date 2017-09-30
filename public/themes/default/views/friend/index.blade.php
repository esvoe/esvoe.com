<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-4 hide-1">
            <div class="panel panel-default find-page-friend">
                <div class="wrap-find-invite">
                    <div class="title-find-invite">
                        <i class="icon-shukaty  svoe-icon"></i> {{ trans('friend.find_friend')  }}<i class="icon-strilka  svoe-icon"></i>
                    </div>
                    <form id="findFriendForm">
                        <input type="hidden" name="_token" id="formToken">
                        <div class="wrap-group-find">
                            <div class="form-group">
                                <input type="text" class="form-control findField" name="firstname" placeholder="{{ trans('friend.find_by_firstname')  }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control findField" name="lastname" placeholder="{{ trans('friend.find_by_lastname')  }}">
                            </div>
                        </div>

                        <div class="wrap-group-find">
                            <div class="form-group">
                                <input type="text" class="form-control findField" name="country" placeholder="{{ trans('friend.find_by_county')  }}">
                                {{--<select class="form-control styler-select2" name="country" id="country">
                                    <option value="">Виберіть Країну</option>
                                    <option value="">Україна</option>
                                    <option value="">Польща</option>
                                </select>--}}
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control findField" name="city" placeholder="{{ trans('friend.find_by_city')  }}">
                            </div>

                            <div class="form-group">
                                <select class="form-control styler-select2 findFieldSelect" name="sex" id="sex">
                                    <option value="">{{ trans('friend.find_by_sex')  }}</option>
                                    <option value="male">{{ trans('common.male')  }}</option>
                                    <option value="female">{{ trans('common.female')  }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="wrap-group-find">
                            <div class="form-group">
                                <input type="text" class="form-control findField school" name="school" placeholder="{{ trans('friend.find_by_school')  }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control findField" name="university" placeholder="{{ trans('friend.find_by_university')  }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="title-invite">
                    {{ trans('friend.ask_invite_friend')  }}
                    <ul class="list-inline no-margin">
                        {{--<li class="dropdown ">
                            <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="icon-menyu svoe-lg svoe-icon"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="main-link">
                                    <a href="#" class="notify-user unnotify">
                                    </a>
                                </li>
                            </ul>
                        </li>--}}
                    </ul>
                </div>

                @if(isset($inviteList) AND ! empty($inviteList))
                    @foreach($inviteList as $invite)
                        <div class="wrap-own-invite" id="inviteElement{{$invite['userId']}}">
                            <a href="{{route('user.showTimeline', array('username'=>$invite['login']))}}">
                                <div class="photo-invite" @if( isset($invite['avatar']) && strlen($invite['avatar']) > 1) style="background-image: url('{!! $invite['avatar'] !!}')" @else style="background-image: url('{{ url('/user/avatar/default-other-avatar.png') }}');" @endif title="{{ $invite['name'] }}"></div>
                            </a>
                            <h4>
                                <a href="{{route('user.showTimeline', array('username'=>$invite['login']))}}"> {{$invite['name']}} </a>
                            </h4>
                            <p>{{$invite['city']}} &nbsp; </p>
                            <span>&nbsp;
                                {{--8 спільних друзів--}}
                    </span>
                            <div class="action-invite-friend">
                                <a href="javascript:" onclick="acceptFriend({{$invite['userId']}});">{{ trans('friend.accept_friend')  }}</a>
                                <span onclick="rejectFriend({{$invite['userId']}})"><i class="icon-zakrutu svoe-icon"></i></span>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="wrap-own-invite">
                        <h4>{{trans('friend.no_any_invite')}}</h4>
                    </div>
                @endif
            </div>

            <div class="panel panel-default">
                <div class="title-invite">
                    {{ trans('friend.people_may_you_know')  }}
                    <ul class="list-inline no-margin">
                    </ul>
                </div>

                <div id="foundPeople" class="page-friend-find">

                    @if($suggested_users != "")
                        @foreach($suggested_users as $suggested_user)
                            <div class="wrap-own-invite">
                                <a href="{{ url($suggested_user->username) }}">
                                    <div class="photo-invite" style="background-image: url('{{ $suggested_user->avatar }}');" title="{{ $suggested_user->name }}">
                                        {{--@if($suggested_user->verified)
                                            <span class="verified-badge bg-success verified-medium">
                                                        <i class="icon-verifikaciya svoe-lg svoe-icon"></i>
                                                    </span>
                                        @endif--}}
                                    </div>
                                </a>
                                <h4><a href="{{ url($suggested_user->username) }}">{{ $suggested_user->name }}</a></h4>
                                <p>{{$suggested_user->city}} &nbsp;</p>
                                <span><a href="#"></a>&nbsp;</span>
                                <div class="action-invite-friend js-follow-links">
                                    <div class="">
                                        <a href="" class="hypothetically-friend follow" rel="{{$suggested_user->id}}" ><i class="icon-dodaty-druzi svoe-lg svoe-icon"></i> <span>{{ trans('friend.add_to_friends') }}</span></a>
                                    </div>
                                    <div class="hidden">
                                        <a href="" style="background-color: #f59d1a !important;" class="hypothetically-friend unfollow" rel="{{$suggested_user->id}}" ><i class="icon-vidpysatys svoe-lg svoe-icon"></i> <span>{{ trans('friend.cancel_request') }}</span></a>
                                    </div>
                                    {{--<span>
                                        <i class="icon-zakrutu svoe-icon"></i>
                                    </span>--}}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            {{ trans('messages.no_suggested_users') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>








        <div class="col-lg-8 col-wallet">
            <div class="wrap-content-tab tab-page-friend">
                <div class="wrap-photo-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($relations as $relation => $users)
                            <li role="presentation" @if($loop->iteration == 1) class="active" @endif><a href="#tab-friend-{{ $loop->iteration }}" aria-controls="tab-friend-{{ $loop->iteration }}" role="tab" data-toggle="tab">{{ trans('timeline.'.$relation) }}</a></li>
                        @endforeach
                        {{--<li role="presentation" class="active"><a href="#tab-friend-1" aria-controls="tab-friend-1" role="tab" data-toggle="tab">Друзі</a></li>
                        <li role="presentation"><a href="#tab-friend-2" aria-controls="tab-friend-2" role="tab" data-toggle="tab">Підписники</a></li>
                        <li role="presentation" ><a href="#tab-friend-3" aria-controls="tab-friend-3" role="tab" data-toggle="tab">Спільні друзі</a></li>
                        <li role="presentation" ><a href="#tab-friend-4" aria-controls="tab-friend-4" role="tab" data-toggle="tab">Родина</a></li>--}}
                        <li class="grid-col-friend">
                            <div class="search-friend-tab">
                                <input type="text" class="form-control">
                                <i class="icon-shukaty svoe-lg svoe-icon"></i>
                            </div>
                        <span class="sort-small">
                            <i class="icon-sort-c svoe-sort svoe-icon"></i>
                        </span>
                        <span class="active-col-friend sort-big">
                            <i class="icon-sort-d svoe-sort svoe-icon"></i>
                        </span>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @foreach($relations as $users)
                            <div role="tabpanel" class="tab-pane fade @if($loop->iteration == 1) in active @endif" id="tab-friend-{{ $loop->iteration }}">
                                <div class="wrap-friend-tab-prof">
                                    <div class="row small-tab-friend row-big-tab-friend">
                                        @foreach($users as $key => $friend)
                                            <div class="col-sm-6">
                                                <div class="own-friend-tab-prof">
                                                    <div class="bg-wall-friend-tab" style="background-image: url('{{ url('user/cover/'.$friend->cover) }}')" ></div>
                                                    <a href="{{ url($friend->username) }}"><div class="photo-friend-tab" style="z-index: 99; background-image: url('{{ $friend->avatar }}')"></div></a>
                                                    <div class="content-friend-tab">
                                                        <ul class="list-inline no-margin">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="#">
                                                                            {{ trans('common.report') }}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                        <div class="info-action-friend-tab">
                                                            <p><a href="{{ url($friend->username) }}">{{ $friend->name }}</a></p>
                                                            <span>{{ $friend->city }}</span>
                                                            <div class="count-friend-photo-block">
                                                                <div class="row">
                                                                    <div class="col-xs-3">
                                                                        <span>{{ $friend->profile->count_friend }}</span>
                                                                        <p>{{ trans('timeline.of_friends_ucf') }}</p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <span>{{ $friend->profile->count_follower }}</span>
                                                                        <p>{{ trans('timeline.of_followers') }} </p>
                                                                    </div>
                                                                    <div class="col-xs-5">
                                                                        <span>{{ $friend->photos_count }}</span>
                                                                        <p>{{ trans('timeline.of_photos') }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
{{--                                                            @if($friend->id != Auth::id())--}}
                                                            @if(false)
                                                                <div class="profheader-ctrl">
                                                                    <!-- case 0 : confirm request for friendship -->
                                                                    <div class="profheader-ctrl-item" data-role="friend-request" @if($friend->type_friend != 4) style="display: none;" @endif>
                                                                        <div class="dropdown">
                                                                            <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                                <i class="icon-druzhyty svoe-lg svoe-icon"></i>
                                                                                <span class="profheader-ctrl-text">{{ trans('friend.want_friend') }}</span>
                                                                            </a>
                                                                            <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                                <li>
                                                                                    <a data-action="friend-accept" href="#" class="ctrlFriend" data-user="{{$friend->id}}">
                                                                                        <i class="icon-prinyat svoe-icon"></i>{{ trans('common.accept') }}
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a data-action="friend-cancel" href="#" class="ctrlFriend" data-user="{{$friend->id}}">
                                                                                        <i class="icon-vidpysatys svoe-icon"></i>{{ trans('common.decline') }}
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!-- case 1 : add to friend -->
                                                                    <div class="profheader-ctrl-item" data-role="add-to-friend" @if($friend->type_friend != 0) style="display: none;" @endif>
                                                                        <a data-action="add" data-user="{{$friend->id}}" href="#" class="ctrlFriend profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
                                                                            <i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">{{ trans('friend.add_to_friends') }}</span>
                                                                        </a>
                                                                    </div>
                                                                    <!-- case 2 : not allowed, cancel adding -->
                                                                    <div class="profheader-ctrl-item" data-role="not-allowed" @if($friend->type_friend != 1) style="display: none;" @endif>
                                                                        <div class="dropdown">
                                                                            <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                                <i class="icon-chekaty svoe-lg svoe-icon"></i>
                                                                                <span class="profheader-ctrl-text">{{ trans('friend.not_confirmed') }}</span>
                                                                            </a>
                                                                            <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                                <li>
                                                                                    <a data-action="cancel" data-user="{{$friend->id}}" href="#" class="ctrlFriend">
                                                                                        <i class="icon-vidpysatys svoe-icon"></i>{{ trans('friend.cancel_request') }}
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!-- case 3 : your friend -->
                                                                    <div class="profheader-ctrl-item" data-role="your-friend" @if($friend->type_friend != 3) style="display: none;" @endif>
                                                                        <div class="dropdown">
                                                                            <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                                <i class="icon-prinyat svoe-lg svoe-icon"></i>
                                                                                <span class="profheader-ctrl-text">{{ trans('friend.in_your_friends') }}</span>
                                                                            </a>
                                                                            <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                                <li>
                                                                                    <a data-action="delete" data-user="{{$friend->id}}" href="#" class="ctrlFriend dropdown-unclosed">
                                                                                        <i class="icon-vidpysatys svoe-icon"></i>{{ trans('friend.delete_from_friends') }}
                                                                                    </a>
                                                                                </li>
                                                                                <li class="divider"></li>
                                                                                <li>
                                                                                    <form name="user-status-form">
                                                                                        <a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
                                                                                            <i class="icon-strilka svoe-icon"></i>{{ trans('friend.friendship_status') }}
                                                                                        </a>
                                                                                        <ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">
                                                                                            @foreach(config('friend.status') as $status)
                                                                                                <li class="profheader-ctrl-submenu-item">
                                                                                                    <label for="{{$status}}">
																											<span class="wrap-checker-sett">
																												<div class="jq-checkbox" id="{{$status}}-styler">
																													<input data-action="status" data-user="{{$friend->id}}" type="checkbox" class="ctrlFriend" name="status" id="{{$status}}" value="{{$status}}" @if(isset($friend->curStatuses) AND strpos($friend->curStatuses, $status)!==false) checked="checked" @endif /><div class="jq-checkbox__div"></div>
																												</div>
																											</span>
                                                                                                        {{ trans('friend.status_'.$status) }}
                                                                                                    </label>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </form>
                                                                                </li>
                                                                                <li>
                                                                                    <form name="user-relative-form">
                                                                                        <a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
                                                                                            <i class="icon-strilka svoe-icon"></i>{{ trans('friend.relatives') }}
                                                                                        </a>
                                                                                        <ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
                                                                                            @if (isset($available_relative))
                                                                                                @foreach($available_relative as $rl => $rlValue)
                                                                                                    <li class="profheader-ctrl-submenu-item">
                                                                                                        <label for="{{$rl}}">
		                            																			<span class="wrap-checker-sett">
																													<div class="jq-radio" id="{{$rl}}-styler">
		                            																					<input data-action="relative" class="ctrlFriend" data-user="{{$friend->id}}" type="radio" name="relative" id="{{$rl}}" value="{{$rl}}" @if($rlValue == $friend->curRelative) checked="checked" @endif /><div class="jq-radio__div"></div>
																													</div>
		                            																			</span>
                                                                                                            {{ trans('friend.rl_'.$rl) }}
                                                                                                        </label>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            @else
                                                                                                <small>  ---</small>
                                                                                            @endif
                                                                                        </ul>
                                                                                    </form>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="profheader-ctrl-item profheader-ctrl-item___message">
                                                                        <a data-action="subscribe" data-user="{{$friend->id}}" href="#" class="ctrlFriend profheader-ctrl-btn profheader-ctrl-message" @if($friend->is_follower) style="display: none;" @endif>
                                                                            <i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">{{ trans('friend.subscribe') }}</span>
                                                                        </a>
                                                                        <a data-action="unsubscribe" data-user="{{$friend->id}}" href="#" class="ctrlFriend profheader-ctrl-btn profheader-ctrl-message" @if(!$friend->is_follower) style="display: none;" @endif>
                                                                            <i class="icon-vidpysatys svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">{{ trans('friend.unsubscribe') }}</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="profheader-ctrl-item">
                                                                        <div class="dropdown">
                                                                            <a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                                <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                                <li>
                                                                                    <a href="#" class="">
                                                                                        <i class="icon-povidomlennia svoe-icon"></i>{{ trans('friend.write_message') }}
                                                                                    </a>
                                                                                </li>
                                                                                <li class="divider"></li>
                                                                                <li>
                                                                                    <a data-action="claim" data-user="{{$friend->id}}" href="#" class="ctrlFriend sub">
                                                                                        <i class="icon-poskarzhytysya svoe-icon"></i>{{ trans('common.report') }}
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a data-action="block" data-user="{{$friend->id}}" href="#" class="ctrlFriend sub">
                                                                                        <i class="icon-zablokuvaty svoe-icon"></i>{{ trans('friend.block') }}
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    $(function () {
        var userid = $('#profheader').data('userid');
        token = $('meta[name="csrf_token"]').attr('content');

        var $btnAddToFriend = $('.profheader-ctrl-item[data-role="add-to-friend"]'),
                $btnNotAllowed = $('.profheader-ctrl-item[data-role="not-allowed"]'),
                $btnYourFriend = $('.profheader-ctrl-item[data-role="your-friend"]'),
                $btnFriendRequest = $('.profheader-ctrl-item[data-role="friend-request"]'),
                $btnSubscribe = $('.profheader-ctrl-item a[data-action="subscribe"]'),
                $btnUnsubscribe = $('.profheader-ctrl-item a[data-action="unsubscribe"]'),
                $btnClaim = $('.profheader-ctrl-item a[data-action="claim"]'),
                $btnBlock = $('.profheader-ctrl-item a[data-action="block"]'),
                $btnDelete = $('.profheader-ctrl-item a[data-action="delete"]'),
                $btnFriendAccept = $('.profheader-ctrl-item a[data-action="friend-accept"]'),
                $btnFriendCancel = $('.profheader-ctrl-item a[data-action="friend-cancel"]');

        var userRequest;

        var reqUrlUserAdd = '{{route('friend.add')}}', 				// ### DEBUG set real url's
                reqUrlUserDelete = '{{route('friend.delete')}}',
                reqUrlUserCancel = '{{route('friend.cancel')}}',	//cancel invite
                reqUrlUserFriendAccept = '{{route('friend.accept')}}',
                reqUrlUserFriendCancel = '{{route('friend.reject')}}',
                reqUrlUserSubscribe = '{{route('friend.follower.add')}}',
                reqUrlUserUnsubscribe = '{{route('friend.follower.remove')}}',
                reqUrlUserClaim = '{{route('friend.complain')}}',		    //complain
                reqUrlUserBlock = '{{route('friend.block')}}',				//block
                reqUrlUserStatus = '{{route('friend.setStatus')}}',       //set status
                reqUrlUserRelative = '{{route('friend.setRelative')}}';
        var userRelativeCache;

        // click n close dropdown
        var $fr = $('.ctrlFriend');
//        $('.profheader-ctrl').on('click', 'a[data-action]', function (e) {
        $fr.on('click', 'a[data-action]', function (e) {
            makeUserAction($(this).data('action'), $(this).data('user'));
            e.preventDefault();
        });

        // input
//        $('.profheader-ctrl input[data-action]').on('change', function (e) {//'input[data-action]',
        $fr.on('change', function (event) {//'input[data-action]',
            event.stopPropagation();
            makeUserAction($(this).data('action'), $(this).data('user'));
        });

        // click but not close dropdown (.dropdown-unclosed)
        $('.profheader-ctrl .dropdown-menu').click(function (e) {
            if ($(e.target).is('.dropdown-unclosed') || $(e.target).is('.dropdown-unclosed *')) {
                if ($(e.target).is('a[data-action]')) makeUserAction($(e.target).data('action'), $(this).data('user'));
                e.stopPropagation();
            }
        });

        function makeUserAction(event, userid) {
            console.log('user-action: ' + event);
            switch (event) {
                case 'add':
                    user.add(userid);
                    break;
                case 'cancel':
                    user.cancel(userid);
                    break;
                case 'subscribe':
                    user.subscribe(userid);
                    break;
                case 'unsubscribe':
                    user.unsubscribe(userid);
                    break;
                case 'claim':
                    user.claim(userid);
                    break;
                case 'block':
                    user.block(userid);
                    break;
                case 'delete':
                    user.delete(userid);
                    break;
                case 'relative':
                    user.relative(userid);
                    break;
                case 'status':
                    user.status(userid);
                    break;
                case 'friend-accept':
                    user.friendAccept(userid);
                    break;
                case 'friend-cancel':
                    user.friendCancel(userid);
                    break;
                default:
                    //console.log('unknown user-action...');
            }
        }

        var user = {
            add: function (userid) {
                console.log('Request url: reqUrlUserAdd');
                $btnAddToFriend.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserAdd,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnAddToFriend.hide().removeClass('wait');
                        $btnNotAllowed.show();
                        $btnSubscribe.hide(); // if add to friend auto subscribe
                        $btnUnsubscribe.show();
                    } else {
                        $btnAddToFriend.removeClass('wait');
                    }
                });
            }, // user.add()

            cancel: function (userid) {
                console.log('Request url: reqUrlUserCancel');
                $btnNotAllowed.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserCancel,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnNotAllowed.hide().removeClass('wait');
                        $btnAddToFriend.show();
                    } else {
                        $btnNotAllowed.removeClass('wait');
                    }
                });
            }, // user.cancel()

            subscribe: function (userid) {
                console.log('Request url: reqUrlUserSubscribe');
                $btnSubscribe.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserSubscribe,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnSubscribe.hide().removeClass('wait');
                        $btnUnsubscribe.show();
                    } else {
                        $btnSubscribe.removeClass('wait');
                    }
                });
            }, // user.subscribe()

            unsubscribe: function (userid) {
                console.log('Request url: reqUrlUserUnsubscribe');
                $btnUnsubscribe.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserUnsubscribe,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnUnsubscribe.hide().removeClass('wait');
                        $btnSubscribe.show();
                    } else {
                        $btnUnsubscribe.removeClass('wait');
                    }
                });
            }, // user.unsubscribe()

            claim: function (userid) {
                console.log('Request url: reqUrlUserClaim');
                $btnClaim.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserClaim,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnClaim.removeClass('wait');
                        $('body').click(); //close dropdown
                    } else {
                        $btnClaim.removeClass('wait');
                    }
                });
            }, // user.claim()

            block: function (userid) {
                console.log('Request url: reqUrlUserBlock');
                $btnBlock.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserBlock,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnBlock.removeClass('wait');
                        $('body').click(); //close dropdown
                    } else {
                        $btnBlock.removeClass('wait');
                    }
                });

            }, // user.block()

            delete: function (userid) {
                console.log('Request url: reqUrlUserDelete');
                $btnDelete.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserDelete,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);

                    if (response.result === "true") {
                        $btnDelete.removeClass('wait');
                        $btnYourFriend.hide();
                        $btnAddToFriend.show();
                    } else {
                        $btnDelete.removeClass('wait');
                    }
                });
            }, // user.delete()

            status: function (userid) {
                console.log('Request url: reqUrlUserStatus');
                var $form = $('form[name="user-status-form"]');
                $form.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserStatus,
                    data: $form.serialize() + '&user_id=' + userid + '&_token=' + token,
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $form.removeClass('wait');
                    } else {
                        $form.removeClass('wait');
                    }
                });
            }, // user.status()

            relative: function (userid) {
                console.log('Request url: reqUrlUserRelative');
                var $form = $('form[name="user-relative-form"]');
                if (userRelativeCache != $form.serialize()) {
                    userRelativeCache = $form.serialize();
                    $form.addClass('wait');
                    userRequest = $.ajax({
                        method: 'POST',
                        url: reqUrlUserRelative,
                        data: userRelativeCache + '&user_id=' + userid + '&_token=' + token,
                    }).done(function (response) {
                        console.log("ajax request done:", response);
                        if (response.result === "true") {
                            $form.removeClass('wait');
                        } else {
                            $form.removeClass('wait');
                        }
                    });
                }

            }, // user.relative()

            friendAccept: function (userid) {
                console.log('Request url: reqUrlUserFriendAccept');
                $btnFriendAccept.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserFriendAccept,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnFriendAccept.removeClass('wait');
                        $btnFriendRequest.hide();
                        $btnYourFriend.show();
                    } else {
                        $btnFriendAccept.removeClass('wait');
                    }
                });

            }, // user.friendAccept()

            friendCancel: function (userid) {
                console.log('Request url: reqUrlUserFriendCancel');
                $btnFriendCancel.addClass('wait');
                userRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlUserFriendCancel,
                    data: {
                        user_id: userid,
                        _token: token
                    }
                }).done(function (response) {
                    console.log("ajax request done:", response);
                    if (response.result === "true") {
                        $btnFriendCancel.removeClass('wait');
                        $btnFriendRequest.hide();
                        $btnAddToFriend.show();
                    } else {
                        $btnFriendCancel.removeClass('wait');
                    }
                });
            } // user.friendCancel()
        }; // user


        $(".findField").on('input',function() {
            console.log( "Handler for - " + $("#findFriendForm").serialize() + " val " + $(this).val() + " len=" + this.value.length);
            if ($(this).hasClass("school")) return findPeople();
            if (this.value.length > 3) findPeople();
        });
        $('.findFieldSelect').on('change', function() {
            console.log( "Handler for - " + $("#findFriendForm").serialize() + " val " + this.value );
            findPeople();
        });

        var tokenPage = $('meta[name="csrf_token"]').attr('content');
        $("#formToken").val(tokenPage);
        function findPeople() {
            var request = $("#findFriendForm").serialize();
            console.log( "Handler for - " + request );
            $.ajax({
                method: 'POST',
                url: '/friend/ajax/find/people',
                data: request
            }).done(function(response) {
                console.log("ajax request done:", response);
                $("#foundPeople").html(response);
                /*if (response.status == 200) {
                 } else {
                 console.log( " res with some error " + response.status);
                 }*/
            });
        }
    });
</script>