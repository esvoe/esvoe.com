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

                <div class="panel panel-default">

                    <div class="modal-app-info">
                        <div class="wrap-modal-game">

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="wrap-own-modal-game">

                                        <div class="block-play-thumb">
                                            <img src="{{static_uploads($application->image_main)}}" />
                                        </div>

                                        <h3>{{$application->title}}</h3>
                                        <p>{{$application->category->title}}</p>
                                        <span>{{$application->count_users}} Учасників</span>

                                        <div class="block-play-rating-game">
                                            <div class="rating">
                                                <div >
                                                    <span class="rating-counter">
                                                        @if($application->rate != 0)
                                                            {{$application->rate}}
                                                        @else
                                                            {{0}}
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="stars stars-example-bootstrap">
                                                    <div class="br-wrapper br-theme-bootstrap-stars">
                                                        <select  name="rating" class="rating-block" autocomplete="off" style="display: none;">
                                                            <option value="1-20">1</option>
                                                            <option value="2-20">2</option>
                                                            <option value="3-20" selected>3</option>
                                                            <option value="4-20">4</option>
                                                            <option value="5-20" >5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {!! Form::open([
                                                'route' => array('applications.container.authorize', $application->id),
                                                'method' => 'post',
                                            ]) !!}
                                            {!! Form::hidden('check', $link_hash) !!}

                                            {!! Form::button('<i class="icon-igry svoe-lg svoe-icon"></i> Играть', ['type' => 'submit','class' => 'btn-play-game-modal']) !!}

                                            {!! Form::close() !!}

                                        </div>

                                    </div>                                    
                                </div>
                                <div class="col-xs-12">

                                    <div class="modal-game-desc">
                                        <div class="title-modal-game">
                                            Описание Игры
                                        </div>
                                        <p class="desc-modal-game">
                                            {{$application->description}}
                                        </p>
                                        <div class="line-modal-game"></div>
                                        <div class="title-modal-game">
                                            Правила доступа
                                        </div>
                                        @if (is_array($permissions))
                                            @foreach($permissions as $permission)
                                                <span class="rules-modal-game"><i style="left: 4px;" class="icon-informaciya  svoe-icon"></i>{{trans('application.permission.'.$permission)}}</span>
                                            @endforeach
                                        @endif

                                        <div>Приложение получит доступ к [!статика!]:</div>
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


                                        <div class="line-modal-game"></div>
                                        <span class="accept-rules-game">Запускаючи гру Ви пооджуєтеся з <a href="">правилами</a> гри</span>
                                        <div class="line-modal-game"></div>
                                        <div class="title-modal-game">
                                            Официальная страница
                                        </div>
                                        <div class="official-page-game">
                                            <div class="photo-official-game" style="background-image: url({!! Theme::asset()->url('images/set3/cS-1.jpg') !!})"></div>
                                            <h4><a href="">My summer car</a></h4>
                                            <span>Відео гра</span>
                                        </div>
                                    </div>                                   

                                    @if ($screenshots)
                                        <div class="gallery-modal-game">
                                            <ul id="image-gallery-view" class="gallery list-unstyled cS-hidden">
                                                @foreach($screenshots as $screenshot)
                                                    <li data-thumb="{{static_uploads($screenshot->path)}}">
                                                        <img src="{{static_uploads($screenshot->path)}}" alt="" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif                                            

                                </div>
                            </div>

                        </div>
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

<!-- <link rel="stylesheet" href="{{Theme::asset()->url('css/fontawesome-stars-o.css')}}"> -->

<script type="text/javascript">
    $(function() {

        $('.rating-block').barrating({
            /*theme: 'fontawesome-stars'*/
            initialRating: Number( @if($application->rate != 0){{$application->rate}}@else{{0}}@endif ).toFixed(1),
        });
        $('.rating-block').barrating('readonly', true);

        $('#image-gallery-view').lightSlider({
            gallery:true,
            item:1,
            thumbItem:5,
            slideMargin: 0,
            speed:500,
            auto:false,
            loop:true,
            adaptiveHeight: true,
            onSliderLoad: function() {
                $('#image-gallery-view').removeClass('cS-hidden');
            }
        });

    });
</script>