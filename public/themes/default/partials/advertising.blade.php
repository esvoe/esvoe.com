<div class="other-block-rekl">
    <div class="right-side-section">
        {{--<div class="panel panel-default">
            <div class="panel-heading no-bg">
                <h3 class="panel-title">
                    {{ trans('common.stars_esvoe') }} eSvoe:
                </h3>
            </div>
            <div class="panel-body">
                <!-- widget holder starts here -->
                <div class="user-follow socialite">
                    <!-- Each user is represented with media block -->

                    @foreach(App\User::stars() as $user)
                        <div class="media">
                            <div class="media-left badge-verification">
                                <a href="{{ url($user['username']) }}" style="background-image: url('{{ $user['avatar'] }}')"></a>
                            </div>
                            <div class="media-body socialte-timeline follow-links">

                                <h4 class="media-heading"><a href="{{ url($user['username']) }}">{{ $user['name'] }}</a>
                                    <span class="text-muted">{{ '@' . $user['username'] }}</span>
                                </h4>
                                @if ($user['following'])
                                    <div class="btn-follow hidden">
                                        <a href="#" class="btn btn-default follow-user follow" data-timeline-id="{{ $user['timeline_id'] }}"><i class="fa fa-heart"></i> <span>{{ trans('common.follow') }}</span></a>
                                    </div>
                                    <div class="btn-follow">
                                        <a href="#" class="btn btn-success follow-user unfollow" data-timeline-id="{{ $user['timeline_id'] }}"><i class="fa fa-check"></i> <span>{{ trans('common.following') }}</span></a>
                                    </div>
                                @else
                                    <div class="btn-follow">
                                        <a href="#" class="btn btn-default follow-user follow" data-timeline-id="{{ $user['timeline_id'] }}"><i class="fa fa-heart"></i> <span>{{ trans('common.follow') }}</span></a>
                                    </div>
                                    <div class="btn-follow hidden">
                                        <a href="#" class="btn btn-success follow-user unfollow" data-timeline-id="{{ $user['timeline_id'] }}"><i class="fa fa-check"></i> <span>{{ trans('common.following') }}</span></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- widget holder ends here -->
            </div>
        </div>--}}

        <div class="wrap-commertion">
            <h4>{{ trans('common.advertising') }}<a href="">{{ trans('common.create_advertising') }}</a></h4>
            <img class="img-responsive" src="{!! Theme::asset()->url('images/reklama-1.jpg') !!}" alt="">
            <a href="http://zaxidfest.com/">Західфест 2017</a>
            <p>Восхождение на Килиманджаро (5895 м), Сафари и Занзибар</p>
            <img class="img-responsive" src="{!! Theme::asset()->url('images/laptop.jpg') !!}" alt="">
            <a href="http://rozetka.com.ua/ua/hp_z2z61es/p17966112/">HP 250 G5 (Z2Z61ES) Black</a>
            <p>Ноутбук HP 250 G5 дає змогу завжди залишатися на зв'язку</p>
        </div>


    </div>
</div>