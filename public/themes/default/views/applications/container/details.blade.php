<script type="text/javascript">
    $(function() {
        $('.balance>a').click(function() {
            $(document).fullscreen();
            return false;
        });
        $('.close').click(function() {
            $.fullscreen.exit();
            return false;
        });
    });
</script>
<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {!! Theme::partial('advertising') !!}
        </div>
        <div class="col-lg-9 col-wallet">

            <div class="single-game-container">
                <div class="game-head">
                    <div class="row" style="margin: 0 -5px">
                        <div class="col-xs-12 col-sm-8 col-md-6" style="padding:0 5px">
                            <span class="">{{$application->name}}</span>
                            <div class="rating">
                                <span>3,7</span>
                                <div class="stars stars-example-bootstrap">
                                    <div class="br-wrapper br-theme-bootstrap-stars">
                                        <select  name="rating" class="rating-block" autocomplete="off" style="display: none;">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="voted hidden-xs hidden-sm">(960)</span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-6 " style="padding:0 5px">
                            <div class="balance">
                                Баланс:
                                <span>
                            0.00
                        </span>
                                $
                                <a href="#">
                                    <img src="{!! Theme::asset()->url('images/modal-full-screen.png') !!}" alt="full-screen">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    Permissions
                @if (is_array($permissions))
                    @foreach($permissions as $permission)
                        <span class="rules-modal-game"><i style="left: 4px;" class="icon-informaciya  svoe-icon"></i>{{trans('application.permission.'.$permission)}}</span>
                    @endforeach
                @endif
            </div>

                <div class="gallery-modal-game">
                    @if ($screenshots)

                        <ul id="image-gallery-modal" class="gallery list-unstyled cS-hidden">
                            @foreach($screenshots as $screenshot)
                                <li style="background-image: url('{{static_uploads($screenshot->path)}}')" data-thumb="{{static_uploads($screenshot->path)}}"></li>
                            @endforeach
                        </ul>

                    @endif
                </div>

                <div class="game-body">
                    <h2>{{$application->title}}</h2>
                    <img src="{{static_uploads($application->image_main)}}" />

                    <div>
                        <pre>
                            {{$application->description}}
                        </pre>
                    </div>
                    <div>users: {{$application->count_users}}</div>
                    <div>rating: {{$application->rate}}</div>

                    <div>Приложение получит доступ к:</div>
                    <div>
                        <ul>
                            <li>Публичные данные профиля</li>
                            <li>Email адрес</li>
                            <li>Номер телефона</li>
                            <li>Список друзей</li>
                            <li>Чтение стены</li>
                            <li>Добавление записи на стену</li>
                            <li>Отправка уведомлений</li>
                        </ul>
                    </div>
                    <div>
                        {!! Form::open([
                            'route' => array('applications.container.authorize', $application->id),
                            'method' => 'post',
                        ]) !!}
                        {!! Form::hidden('check', $link_hash) !!}
                        {!! Form::submit('Grant and play >', array('class'=>'btn btn-primary')) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div>
                @if(Request::root() != Request::url())
                    <div class="wrap-footer-home other-page-footer panel panel-default">
                        <a @if(Config::get('app.locale')== 'en')class="active-lang-home" @endif href="{{url('setlocale/'.'en')}}">{{Config::get('app.locales')['en']}}</a>
                        <a @if(Config::get('app.locale')== 'ru')class="active-lang-home" @endif href="{{url('setlocale/'.'ru')}}">{{Config::get('app.locales')['ru']}}</a>
                        <a @if(Config::get('app.locale')== 'ua')class="active-lang-home" @endif href="{{url('setlocale/'.'ua')}}">{{Config::get('app.locales')['ua']}}</a>
                        <div class="more-lang-home">
                            <a data-toggle="modal" data-target=".modal-lang" href=""><i class="fa fa-globe fa-lg" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="link-home-footer other-page-footer">
                        @foreach(App\StaticPage::active() as $staticpage)
                            <a href="{{ url('page/'.$staticpage->slug) }}">{{ $staticpage->title }}</a>
                        @endforeach
                        <p>
                            <a class="copy" href="/">{{ Setting::get('site_name') }} </a>
                            <span>&copy; {{ date('Y') }}</span>
                        </p>
                    </div>

            @endif
            <!--
        <a href="#" onclick="$('#popup-topup-e').modal('show')">
            topup etoken
        </a>
        <a href="#" onclick="$('#popup-payment-e').modal('show')">
            buy etoken
        </a>
        <a href="#" onclick="$('#popup-payment-e').modal('show')">
            buy binacoin
        </a>
        -->
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $('.rating-block').barrating({
            theme: 'fontawesome-stars'
        });
    });
</script>