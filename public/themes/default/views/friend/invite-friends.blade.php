<!-- main-section -->
<!-- <div class="main-content"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {!! Theme::partial('advertising') !!}
        </div>
        <div class="col-md-5 col-md-push-7 col-lg-4 col-lg-push-5 col-grid-2">
            <div class="sm-desc-prof">
                <div class="panel panel-default">
                    <div class="wrap-find-invite">
                        <div class="title-find-invite">
                            {{ trans('friend.find_friend')  }}
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
                                    {{--<select class="form-control styler-select2" name="city" id="city">
                                        <option value="">Виберіть місто</option>
                                        <option value="">Львів</option>
                                        <option value="">Київ</option>
                                    </select>--}}
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

                            {{--<div class="wrap-group-find two-field-group-find">
                                <span>—</span>
                                <label for="">Вік</label>
                                <div class="form-group">
                                    <select class="form-control styler-select" name="" id="">
                                        <option value="">Від</option>
                                        <option value="">15</option>
                                        <option value="">16</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control styler-select" name="" id="">
                                        <option value="">До</option>
                                        <option value="">23</option>
                                        <option value="">24</option>
                                    </select>
                                </div>
                            </div>

                            <div class="wrap-group-find two-field-group-find">
                                <div class="form-group">
                                    <select class="form-control styler-select" name="" id="">
                                        <option value="">Сімейний стан</option>
                                        <option value=""></option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control styler-select" name="" id="">
                                        <option value="">Стать</option>
                                        <option value="">Чоловіча</option>
                                        <option value="">Жіноча</option>
                                    </select>
                                </div>
                            </div>--}}

                            {{--<div class="wrap-group-find">
                                <label for="">Спільний друг</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Введіть ім'я">
                                </div>
                                <label for="">Роботодавець</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Введіть роботодавця">
                                </div>
                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-md-pull-5 col-lg-5 col-lg-pull-4 col-grid-1">
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

                {{--<div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile02.png') !!}')"></div>
                    <h4><a href="">Оксана Габалевич</a></h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend"><span></span></div>
                </div>--}}

                {{--<div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile03.png') !!}')"></div>
                    <h4><a href="">Оксана Габалевич</a></h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span>6 спільних друзів </span>
                    <div class="action-invite-friend"><span></span></div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile04.png') !!}')"></div>
                    <h4><a href="">Оксана Габалевич</a></h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend"><span></span></div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile07.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span>6 спільних друзів </span>
                    <div class="action-invite-friend"><span></span></div>
                </div>--}}
            </div>



            <div class="panel panel-default">
                <div class="title-invite">
                    {{ trans('friend.people_may_you_know')  }}
                    <ul class="list-inline no-margin">
                        {{--<li class="dropdown ">
                            <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="icon-menyu svoe-lg svoe-icon"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="main-link">
                                    <a href="#" class="notify-user unnotify">
                                        Відмовити всі
                                    </a>
                                </li>
                            </ul>
                        </li>--}}
                    </ul>
                </div>

                <div id="foundPeople">

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
                {{--<div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile01.png') !!}')"></div>
                    <h4><a href="">Оксана Габалевич</a></h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend">
                        <a href="#">{{ trans('friend.add_to_friends')  }}</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>--}}

                {{--<div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile02.png') !!}')"></div>
                    <h4><a href="">Оксана Габалевич</a></h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend"><span></span></div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile07.png') !!}')"></div>
                    <h4><a href="">Оксана Габалевич</a></h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span>6 спільних друзів </span>
                    <div class="action-invite-friend"><span></span></div>
                </div>--}}

            </div>
        </div><!-- /col-md-6 -->


    </div>
</div>
<!-- </div> -->
<!-- /main-section -->


<script>
    $(function(){
        $('.wrap-group-find select.styler-select2').select2();

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