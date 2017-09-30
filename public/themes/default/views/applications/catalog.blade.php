<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {!! Theme::partial('advertising') !!}
        </div>
        <div class="col-lg-9 col-wallet">

                <div class="game-container">

                    <div class="row" style="margin: 0 -5px;" >

                        <div class="col-md-7 game game-content" style="padding: 0 5px;">
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                            {{ trans('common.home') }}{{--Главная--}}

                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                            {{ trans('common.my_games') }}{{--Мои игры--}}

                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
                                            {{ trans('common.notifications') }}{{--Оповещения--}}
                                            <span class="notification-counter hidden-xs">3</span>

                                        </a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="home">

                                        <div class="slider-box">
                                            <div id="carousel-example-generic" class="carousel fade" data-ride="carousel">
                                                <!-- Indicators -->
                                                <!--<ol class="carousel-indicators">-->
                                                <!--<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>-->
                                                <!--<li data-target="#carousel-example-generic" data-slide-to="1"></li>-->
                                                <!--<li data-target="#carousel-example-generic" data-slide-to="2"></li>-->
                                                <!--</ol>-->

                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">

                                                    @foreach ($annexes_promo as $annex)
                                                    <div class="item
                                                    @if ($loop->first)
                                                    active
                                                    @endif
                                                    ">
                                                        <div style="background-image:url('{{static_uploads($annex->image_promo)}}'); cursor: pointer;" onclick="window.location.href = $(this).find('a').attr('href');">
                                                            <div class="carousel-caption hidden-xs">
                                                                <a href="{{route('applications.container',array('gamename'=>$annex->name))}}">
                                                                    <h5>{{$annex->title}}</h5>
                                                                    <span>{{$annex->desc}}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <!-- Controls -->
                                                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">

                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="messages">

                                    </div>


                                </div>
                            </div>


                        </div>
                        <div class="col-md-5 game game-sub" style="padding: 0 5px;">
                            <div class="col-xs-12 game-list-head">
                                {{ trans('common.novelties') }}{{--Новинки--}}
                                    <span class="pull-right">
                                        <a href="#">
                                            {{ trans('common.show_more') }}{{--Показать  еще--}}
                                        </a>
                                    </span>
                            </div>
                            <div class="col-xs-12 game-list-body">
                                <ul class="games-list">
                                    {{--limit 7 news--}}
                                    @foreach($annexes_recent as $annex)
                                    <li>
                                        <a href="{{route('applications.container',array('gamename'=>$annex->name))}}">
                                            <div class="avatar-game-list" style="background-image:url('{{static_uploads($annex->image_icon)}}')"></div>
                                            <span class="name-game-list">{{$annex->title}}</span>
                                            <span class="games-list-category hidden-xs">
                                                @if($annex->category)
                                                {{$annex->category->title}}
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                        <div class="col-xs-12 games-search-box" style="padding: 0 5px;">
                            <div class="games-search-box">
                                <form action="">
                                    <div class="form-group">
                                        <img src="{!! Theme::asset()->url('images/icon-game-search.png') !!}" alt="">
                                        <input type="text" class="form-control" id="" placeholder="Поиск по играм">
                                    </div>
                                </form>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#popular" aria-controls="home" role="tab" data-toggle="tab">
                                            {{ trans('common.populars') }}{{--Популярные--}}

                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#table" aria-controls="profile" role="tab" data-toggle="tab">
                                            Настольные
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#simulator" aria-controls="messages" role="tab" data-toggle="tab">
                                            Симуляторы

                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#shooter" aria-controls="settings" role="tab" data-toggle="tab">
                                            Шутеры

                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#sport" aria-controls="settings" role="tab" data-toggle="tab">
                                            Спортивные

                                        </a>
                                    </li>
                                    <span class="pull-right">
                                        <a href="">
                                            <img src="img/dots.png" alt="">
                                        </a>
                                    </span>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">


                                    <div role="tabpanel" class="tab-pane active" id="popular">
                                        <div class="row" style="margin: 0 -5px;">

                                            <ul class="games-list hidden">
                                                {{--limit 7 news--}}
                                                @foreach($annexes_recent as $annex)
                                                    <li>
                                                        <a href="{{route('applications.container.preview',array('id'=>$annex->id))}}" data-toggle="modal" data-target="#modal-app-info" data-remote="false">
                                                            <div class="avatar-game-list" style="background-image:url('{{static_uploads($annex->image_icon)}}')"></div>
                                                            <span class="name-game-list">{{$annex->title}}</span>
                                            <span class="games-list-category hidden-xs">
                                                @if($annex->category)
                                                    {{$annex->category->title}}
                                                @endif
                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            @foreach($annexes_recent as $annex)
                                                <div class="games-grid">
                                                    {{--{{route('applications.container',array('gamename'=>$annex->name))}}--}}
                                                    <a href="#" data-toggle="modal" data-target=".view-game">
                                                        <div class="game-image" style="background-image:url('{{static_uploads($annex->image_promo)}}')"></div>
                                                        <h5>{{$annex->title}}</h5>
                                                        <span>
                                                            @if($annex->category)
                                                                {{$annex->category->title}}
                                                            @endif
                                                        </span>
                                                        <div class="rating">
                                                            <div >
                                                            <span class="rating-counter">
                                                                3,7
                                                            </span>
                                                            </div>
                                                            <div class="stars stars-example-bootstrap">
                                                                <div class="br-wrapper br-theme-bootstrap-stars">
                                                                    <select  name="rating" class="rating-block" autocomplete="off" style="display: none;">
                                                                        <option value="1-{{$annex->id}}">1</option>
                                                                        <option value="2-{{$annex->id}}">2</option>
                                                                        <option value="3-{{$annex->id}}">3</option>
                                                                        <option value="4-{{$annex->id}}">4</option>
                                                                        <option value="5-{{$annex->id}}">5</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="game-members">{{$annex->count_users}} участников</p>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="table">

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="simulator">

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="shooter">

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="sport">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade view-game"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap-modal-game">
                    <span class="close-modal-game" data-dismiss="modal" aria-label="Close">
                        <i class="icon-zakrutu svoe-icon"></i>
                    </span>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="wrap-own-modal-game">
                                <h3>My summer car</h3>
                                <p>Спортивные</p>
                                <span>7 600 000 Учасників</span>
                                <div class="block-play-rating-game">
                                    <div class="rating">
                                        <div >
                                            <span class="rating-counter">
                                                3,7
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
                                    <div class="btn-play-game-modal">
                                        <i class="icon-igry svoe-lg svoe-icon"></i> Играть
                                    </div>
                                </div>

                                <div class="gallery-modal-game">
                                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                        <li style="background-image: url({!! Theme::asset()->url('images/set3/cS-1.jpg') !!})" data-thumb="{!! Theme::asset()->url('images/set3/cS-1.jpg') !!}"></li>
                                        <li style="background-image: url({!! Theme::asset()->url('images/set3/cS-2.jpg') !!})" data-thumb="{!! Theme::asset()->url('images/set3/cS-2.jpg') !!}"></li>
                                        <li style="background-image: url({!! Theme::asset()->url('images/set3/cS-3.jpg') !!})" data-thumb="{!! Theme::asset()->url('images/set3/cS-3.jpg') !!}"></li>
                                        <li style="background-image: url({!! Theme::asset()->url('images/set3/cS-4.jpg') !!})" data-thumb="{!! Theme::asset()->url('images/set3/cS-4.jpg') !!}"></li>
                                        <li style="background-image: url({!! Theme::asset()->url('images/set3/cS-5.jpg') !!})" data-thumb="{!! Theme::asset()->url('images/set3/cS-5.jpg') !!}"></li>
                                        <li style="background-image: url({!! Theme::asset()->url('images/set3/cS-6.jpg') !!})" data-thumb="{!! Theme::asset()->url('images/set3/cS-6.jpg') !!}"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="modal-game-desc">
                                <div class="title-modal-game">
                                    Описание Игры
                                </div>
                                <p class="desc-modal-game">Онлайн гонки - дрифт, драг (дрэг), тюнинг авто
                                    Тюнингуй авто, сражайся в районах,
                                    побеждай боссов и становись
                                    самым крутым гонщиком!
                                </p>
                                <div class="line-modal-game"></div>
                                <div class="title-modal-game">
                                    Правила доступа
                                </div>
                                <span class="rules-modal-game"><i style="left: 4px;" class="icon-informaciya  svoe-icon"></i>Грі будуть доступні Ваші дані</span>
                                <span class="rules-modal-game"><i class="icon-druzi svoe-lg svoe-icon"></i>Грі буде доступний список Ваших друзів</span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.rating-block').barrating({
            theme: 'fontawesome-stars',
            onSelect:function(value, text, event){
                var arr = value.split('-');
                var app_id = arr[1];
                value = arr[0];
                console.log(app_id,value);
            }
        });
        $('.rating-block').barrating('readonly', true);
        $('.rating-block').barrating('set', 4);
    });
</script>


