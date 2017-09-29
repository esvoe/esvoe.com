
<style>
    .pictures {margin: 0px auto; width: 100%; padding: 0;}
    .user-blocks-photo,.last-photo-mosaic-1 {margin: 0px auto; width: 100%; padding: 0;}
</style>
<div class="container container-grid section-container">


    <div class="wrap-new-prof-header" style="background-image: url('{!! Theme::asset()->url('images/set3/wallpaper-1.jpg') !!}');">
        <div class="shadow-new-prof"></div>
        <div class="ava-new-prof" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');"></div>
        <div class="profheader-content new-content-prof">
            <div class="profheader-text">
                <div class="profheader-name">Катерина Казакова</div>
                <div class="profheader-note">Ищу интересные типажи для tfp сьемок</div>
                <div class="profheader-status online">В мережі 20:32</div>
            </div>
            <div class="profheader-nav">
                <div class="profheader-ctrl ctrl-new-prof">
                    <div class="profheader-ctrl-item profheader-ctrl-item___toggle-width">
                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-add" style="width: 171px">
                            <i class="icon-druzi svoe-lg svoe-icon">
                            </i>
                            <span class="profheader-ctrl-text">Додати в друзі</span>
                        </a>
                    </div>
                    <div class="profheader-ctrl-item profheader-ctrl-item___toggle-width">
                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-message">
                            <span class="profheader-ctrl-text"></span>
                            <i class="icon-povidomlennia svoe-lg svoe-icon"></i>
                        </a>
                    </div>
                    <div class="profheader-ctrl-item">
                        <div class="dropdown">
                            <a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="{!! Theme::asset()->url('images/post-event-more.png') !!}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profheader-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse" id="profheader-navbar-collapse" aria-expanded="false">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a class="life-line" href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
                                <span class="count-cat-new-prof"><i class="fa fa-home" aria-hidden="true"></i></span>
                                {{--<span class="count-cat-new-prof">240 <span>/ 354</span></span>--}}
                                <span class="text-category-new-prof">Главная</span>
                            </a>
                        </li>
                        <li role="presentation" >
                            <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">
                                <span class="count-cat-new-prof">240 <span>/ 354</span></span>
                               <span class="text-category-new-prof">Друзі <span>/ підписників</span></span>
                            </a>
                        </li>
                        <li role="presentation" >
                            <a class="photo-shown-tab" href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab">
                                <span class="count-cat-new-prof">15 <span>/ 245</span></span>
                                <span class="text-category-new-prof">Альбоми <span>/ Світлини</span></span>
                            </a>
                        </li>
                        <li role="presentation" >
                            <a href="#tab-5" aria-controls="tab-5" role="tab" data-toggle="tab">
                                <span class="count-cat-new-prof">15</span>
                                <span class="text-category-new-prof">Відео</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab-6" aria-controls="tab-6" role="tab" data-toggle="tab">
                                <span class="count-cat-new-prof">152</span>
                                <span class="text-category-new-prof">Спільноти</span>
                            </a>
                        </li>
                        <li role="presentation" >
                            <a href="#tab-events" aria-controls="tab-events" role="tab" data-toggle="tab" aria-expanded="true">
                                <span class="count-cat-new-prof">152</span>
                                <span class="text-category-new-prof">События</span>
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab-apps" aria-controls="tab-apps" role="tab" data-toggle="tab">
                                <span class="count-cat-new-prof">19</span>
                                <span class="text-category-new-prof">Приложения</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="count-cat-new-prof"><i class="icon-menyu svoe-icon"></i></span>
                                <span class="text-category-new-prof">другое</span>
                            </a>
                            <ul class="dropdown-menu profheader-dropdown">
                                <!-- Закладки -->
                                <li role="presentation" class=""><a href="#tab-bookmarks" aria-controls="tab-bookmarks" role="tab" data-toggle="tab">Закладки</a></li>
                                <!-- Музика -->
                                <li role="presentation" class=""><a href="#tab-audio" aria-controls="tab-audio" role="tab" data-toggle="tab">Музыка</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <div class="profheader hidden">
        <div class="profheader-ava">
            <img src="{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}" alt="Ivan Ivanov" />

            <div class="chang-user-avatar">
                <a href="#" class="btn btn-camera change-avatar"><i class="fa fa-camera" aria-hidden="true"></i><span class="avatar-text">обновить аватару</span></a>
            </div>
            <div class="user-avatar-progress hidden"></div>

            <div class="profheader-ctrl">

                <div class="profheader-ctrl-item profheader-ctrl-item___toggle-width">
                    <a href="#" class="profheader-ctrl-btn profheader-ctrl-add">
                        <i class="icon-druzi svoe-lg svoe-icon">
                            <span class="add">+</span>
                        </i>
                        <span class="profheader-ctrl-text">Додати в друзі</span>
                    </a>
                </div>

                <div class="profheader-ctrl-item profheader-ctrl-item___toggle-width">
                    <a href="#" class="profheader-ctrl-btn profheader-ctrl-message">
                        <span class="profheader-ctrl-text">Написать сообщение</span>
                        <i class="icon-povidomlennia svoe-lg svoe-icon"></i>
                    </a>
                </div>

                <div class="profheader-ctrl-item">
                    <div class="dropdown">
                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="{!! Theme::asset()->url('images/post-event-more.png') !!}" alt="">
                        </a>
                        <ul class="dropdown-menu profheader-ctrl-dropdown">
                            <li class="">
                                <a href="#" class="">
                                    Menu item 1
                                </a>
                            </li>
                            <li class="">
                                <a href="#" class="">
                                    Menu item 2
                                </a>
                            </li>
                            <li class="">
                                <a href="#" class="">
                                    Menu item 3
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="profheader-bg" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!})">
            <a href="#" class="btn btn-camera-cover change-cover">
                <i class="fa fa-camera" aria-hidden="true"></i>
                <span class="change-cover-text">Изменить обложку</span>
            </a>
            <div class="user-cover-progress hidden"></div>
        </div>
        <div class="profheader-content">
            <div class="profheader-text">
                <div class="profheader-name">Катерина Казакова</div>
                <div class="profheader-note">Ищу интересные типажи для tfp сьемок</div>
                <div class="profheader-status online">В мережі 20:32</div>
            </div>
            <div class="profheader-nav">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profheader-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse" id="profheader-navbar-collapse" aria-expanded="false">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li role="presentation" class="active"><a class="life-line" href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Життєпис</a></li>
                        <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Інформація</a></li>
                        <li role="presentation" ><a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">Друзі <i>(14 спільних)</i></a></li>
                        <li role="presentation" ><a class="photo-shown-tab" href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab">Світлини</a></li>
                        <li role="presentation" ><a href="#tab-5" aria-controls="tab-5" role="tab" data-toggle="tab">Відео</a></li>
                        <li role="presentation"><a href="#tab-6" aria-controls="tab-6" role="tab" data-toggle="tab">Спільноти</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Еще</a>
                            <ul class="dropdown-menu profheader-dropdown">
                                <!-- События -->
                                <li role="presentation" ><a href="#tab-events" aria-controls="tab-events" role="tab" data-toggle="tab" aria-expanded="true">События</a></li>
                                <!-- Закладки -->
                                <li role="presentation" class=""><a href="#tab-bookmarks" aria-controls="tab-bookmarks" role="tab" data-toggle="tab">Закладки</a></li>
                                <!-- Музика -->
                                <li role="presentation" class=""><a href="#tab-audio" aria-controls="tab-audio" role="tab" data-toggle="tab">Музыка</a></li>
                                <!-- Приложения -->
                                <li role="presentation" class=""><a href="#tab-apps" aria-controls="tab-apps" role="tab" data-toggle="tab">Приложения</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Tab panes -->
<div class="container container-grid section-container">
    <div class="tab-content profheader-tab-content">
        <div role="tabpanel" class="tab-pane fade" id="tab-apps">
            <div class="wrap-content-tab">
                <div class="wrap-photo-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#all-apps" aria-controls="tab-friend-1" role="tab" data-toggle="tab">Все</a></li>
                        <li role="presentation"><a href="#tab-friend-2" aria-controls="tab-friend-2" role="tab" data-toggle="tab">Игры</a></li>
                        <li role="presentation" ><a href="#tab-friend-3" aria-controls="tab-friend-3" role="tab" data-toggle="tab">Финансы</a></li>
                        <li role="presentation" ><a href="#tab-friend-4" aria-controls="tab-friend-4" role="tab" data-toggle="tab">Магазины</a></li>
                        <li role="presentation" ><a href="#tab-friend-4" aria-controls="tab-friend-4" role="tab" data-toggle="tab">Медиа</a></li>
                        <li role="presentation" ><a href="#tab-friend-4" aria-controls="tab-friend-4" role="tab" data-toggle="tab">Сайты</a></li>
                        <li role="presentation" ><a href="#tab-friend-4" aria-controls="tab-friend-4" role="tab" data-toggle="tab">Другое</a></li>
                        {{--<li class="grid-col-friend">--}}
                            {{--<div class="search-friend-tab">--}}
                                {{--<input type="text" class="form-control">--}}
                                {{--<i class="icon-shukaty svoe-lg svoe-icon"></i>--}}
                            {{--</div>--}}
                                    {{--<span class="sort-small">--}}
                                        {{--<i class="icon-sort-c svoe-sort svoe-icon"></i>--}}
                                    {{--</span>--}}
                                    {{--<span class="active-col-friend sort-big">--}}
                                        {{--<i class="icon-sort-d svoe-sort svoe-icon"></i>--}}
                                    {{--</span>--}}
                        {{--</li>--}}
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="all-apps">
                            <div class="wrap-app-tab">
                                <div class="row">
                                    <div class="games-grid">
                                        <a href="#">
                                            <div class="game-image" style="background-image:url('https://static.esvoe.com/apps/promo_18@540x376.jpg')"></div>
                                            <div class="content-app-tab">
                                                <h5>поэтический портал</h5>
                                                <span>Спорт</span>
                                                <div class="rating">
                                                    <div>
                                                    <span class="rating-counter">
                                                        3,7
                                                    </span>
                                                    </div>
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
                                                </div>
                                                <p class="game-members">2 участников</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="games-grid">
                                        <a href="#">
                                            <div class="game-image" style="background-image:url('https://static.esvoe.com/apps/promo_18@540x376.jpg')"></div>
                                            <div class="content-app-tab">
                                                <h5>поэтический портал</h5>
                                                <span>Спорт</span>
                                                <div class="rating">
                                                    <div>
                                                    <span class="rating-counter">
                                                        3,7
                                                    </span>
                                                    </div>
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
                                                </div>
                                                <p class="game-members">2 участников</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="games-grid">
                                        <a href="#">
                                            <div class="game-image" style="background-image:url('https://static.esvoe.com/apps/promo_18@540x376.jpg')"></div>
                                            <div class="content-app-tab">
                                                <h5>поэтический портал</h5>
                                                <span>Спорт</span>
                                                <div class="rating">
                                                    <div>
                                                    <span class="rating-counter">
                                                        3,7
                                                    </span>
                                                    </div>
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
                                                </div>
                                                <p class="game-members">2 участников</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="games-grid">
                                        <a href="#">
                                            <div class="game-image" style="background-image:url('https://static.esvoe.com/apps/promo_18@540x376.jpg')"></div>
                                            <div class="content-app-tab">
                                                <h5>поэтический портал</h5>
                                                <span>Спорт</span>
                                                <div class="rating">
                                                    <div>
                                                    <span class="rating-counter">
                                                        3,7
                                                    </span>
                                                    </div>
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
                                                </div>
                                                <p class="game-members">2 участников</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="games-grid">
                                        <a href="#">
                                            <div class="game-image" style="background-image:url('https://static.esvoe.com/apps/promo_18@540x376.jpg')"></div>
                                            <div class="content-app-tab">
                                                <h5>поэтический портал</h5>
                                                <span>Спорт</span>
                                                <div class="rating">
                                                    <div>
                                                    <span class="rating-counter">
                                                        3,7
                                                    </span>
                                                    </div>
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
                                                </div>
                                                <p class="game-members">2 участников</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="games-grid">
                                        <a href="#">
                                            <div class="game-image" style="background-image:url('https://static.esvoe.com/apps/promo_18@540x376.jpg')"></div>
                                            <div class="content-app-tab">
                                                <h5>поэтический портал</h5>
                                                <span>Спорт</span>
                                                <div class="rating">
                                                    <div>
                                                    <span class="rating-counter">
                                                        3,7
                                                    </span>
                                                    </div>
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
                                                </div>
                                                <p class="game-members">2 участников</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="games-grid">
                                        <a href="#">
                                            <div class="game-image" style="background-image:url('https://static.esvoe.com/apps/promo_18@540x376.jpg')"></div>
                                            <div class="content-app-tab">
                                                <h5>поэтический портал</h5>
                                                <span>Спорт</span>
                                                <div class="rating">
                                                    <div>
                                                    <span class="rating-counter">
                                                        3,7
                                                    </span>
                                                    </div>
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
                                                </div>
                                                <p class="game-members">2 участников</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade active in" id="tab-1">
            <div class="row">
                <div class="col-md-5  col-lg-4  col-grid-2">
                    <div class="wrap-panel-prof">
                        <div class="info-block-prof">
                            <div class="title-info-prof">
                                <i class="icon-informaciya svoe-icon" style="top: 2px;"></i>
                                Інформація
                            </div>
                            <div class="count-friend-photo-block">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span>320</span>
                                        <p>Друзів</p>
                                    </div>
                                    <div class="col-xs-4">
                                        <span>229</span>
                                        <p>Підписників </p>
                                    </div>
                                    <div class="col-xs-4">
                                        <span>356</span>
                                        <p>Фотографий</p>
                                    </div>
                                </div>
                            </div>
                            <div class="info-contact-prof">
                                <div class="own-info-contact">
                                    <span><i class="fa fa-birthday-cake fa-lg" style="top: 0;" aria-hidden="true"></i> Дата рождения:</span>
                                    <span>08.04.1988</span>
                                </div>
                                <div class="own-info-contact">
                                    <span><i class="fa fa-globe fa-lg" aria-hidden="true"></i>Город:</span>
                                    <span>Львов</span>
                                </div>
                                <div class="own-info-contact">
                                    <span><i class="fa fa-mobile fa-lg" style="left: 4px;" aria-hidden="true"></i>Номер телефона:</span>
                                    <span>0633833452</span>
                                </div>
                                <div class="own-info-contact">
                                    <span><i class="fa fa-skype fa-lg" aria-hidden="true"></i>Skype:</span>
                                    <span>Viktoria_kazakova</span>
                                </div>
                                <div class="own-info-contact">
                                    <span><i class="fa fa-instagram fa-lg" aria-hidden="true"></i>Instagram:</span>
                                    <span>kazakova88</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-panel-prof">
                        <div class="title-link-album">
                            <a href="#">
                                <i class="icon-photoalbomy svoe-icon" style="top: 23px;"></i>
                                Останні фотографії
                                <span>(26 фото)</span>
                            </a>
                        </div>
                        <div class="last-photo-prof">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="chronicle" style="background-image: url('{!! Theme::asset()->url('images/set3/5.jpg') !!}');"></div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="chronicle" style="background-image: url('{!! Theme::asset()->url('images/set3/1.jpg') !!}');"></div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="chronicle" style="background-image: url('{!! Theme::asset()->url('images/set3/2.jpg') !!}');"></div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="chronicle" style="background-image: url('{!! Theme::asset()->url('images/set3/7.jpg') !!}');"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-panel-prof">
                        <div class="title-link-album">
                            <a href="#">
                                <i class="icon-photoalbomy svoe-icon" style="top: 22px;"></i>
                                Фотоальбоми
                                <span>(26 фотоальбомів)</span>
                            </a>
                        </div>
                        <div class="album-prof-block album-last">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="wrap-album-prof-last">
                                        <div class="album-prof" href="#">
                                            <a href="" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!})"></a>
                                        </div>
                                        <a href="">Фотосесія на кухні</a>
                                        <span>(18 фото)</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="wrap-album-prof-last">
                                        <div class="album-prof" href="#">
                                            <a href="" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')"></a>
                                        </div>
                                        <a href="">Вінтажне</a>
                                        <span>(18 фото)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-panel-prof">
                        <div class="title-link-album">
                            <a href="#">
                                <i class="icon-druzi svoe-lg svoe-icon" style="top: 20px;left: 15px;"></i>
                                Друзі
                                <span>(26 друзів)</span>
                            </a>
                        </div>
                        <div class="friend-prof-block">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="own-friend-prof" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!})">
                                        <a href="">
                                            <span>Hrystia<br>Koliasa</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="own-friend-prof" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!})">
                                        <a href="">
                                            <span>Юлія<br>Артемська</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="own-friend-prof" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!})">
                                        <a href="">
                                            <span>Оленка<br>Онишко</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="own-friend-prof" style="background-image: url({!! Theme::asset()->url('https://sand.esvoe.com/user/avatar/2017-07-18-13-21-54AGp7eZ4Z.png') !!})">
                                        <a href="">
                                            <span>Andriy<br>Vynarchyk</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="own-friend-prof" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-11-04-20-09581705_335030449956947_1312109208_n.jpg')">
                                        <a href="">
                                            <span>Hrystia<br>Koliasa</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="own-friend-prof" style="background-image: url('https://sand.esvoe.com/user/avatar/2017-06-08-19-43-0612208272_784130515042917_6144586870815355082_n.jpg')">
                                        <a href="">
                                            <span>Vitalii<br>Oleniichuk</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-panel-prof">
                        <div class="title-link-album">
                            <a href="#">
                                <i class="icon-storinky  svoe-icon" style="top: 22px;"></i>
                                Страницы
                                <span class="show-all-title">Все</span>
                            </a>
                        </div>
                        <div class="album-prof-block">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="own-page-rightbar">
                                        <div class="photo-page-rightbar" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!})">
                                            <a href="#"></a>
                                        </div>
                                        <div class="content-page-rightbar">
                                            <h4><a href="#">Digital Art&world 3D</a></h4>
                                            <p>Игры</p>
                                            <span><i class="icon-like  svoe-icon"></i> 360</span>
                                            <div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
                                                    <div class="btn-follow page"><a href="#" class="btn btn-options btn-block btn-default page-like like" ><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
                                                    <div class="btn-follow page hidden"><a href="#" class="btn btn-options btn-block btn-success page-like liked " ><i class="fa fa-heart" aria-hidden="true"></i> <span>{{ trans('common.liked') }}</span></a></div>

                                                <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                                    <i class="icon-pidpysatysya  svoe-icon"></i>
                                                    Подписаться
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="own-page-rightbar">
                                        <div class="photo-page-rightbar" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!})">
                                            <a href="#"></a>
                                        </div>
                                        <div class="content-page-rightbar">
                                            <h4><a href="#">Digital Art&world 3D</a></h4>
                                            <p>Игры</p>
                                            <span><i class="icon-like  svoe-icon"></i> 360</span>
                                            <div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
                                                <div class="btn-follow page"><a href="#" class="btn btn-options btn-block btn-default page-like like" ><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
                                                <div class="btn-follow page hidden"><a href="#" class="btn btn-options btn-block btn-success page-like liked " ><i class="fa fa-heart" aria-hidden="true"></i> <span>{{ trans('common.liked') }}</span></a></div>

                                                <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                                    <i class="icon-pidpysatysya  svoe-icon"></i>
                                                    Подписаться
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-panel-prof">
                        <div class="title-link-album">
                            <a href="#">
                                <i class="icon-grupy svoe-lg svoe-icon" style="top: 21px;"></i>
                                Групы
                                <span class="show-all-title">Все</span>
                            </a>
                        </div>
                        <div class="wrap-group-prof">
                            <div class="wrap-padding-group">
                                <div class="own-photo-group" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-11-04-20-09581705_335030449956947_1312109208_n.jpg')">
                                    <a href=""></a>
                                    <div>
                                        <div class="your-group-friend" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!})">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/user/avatar/2017-06-08-19-43-0612208272_784130515042917_6144586870815355082_n.jpg')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-profile">
                                    <a href=""><i class="icon-zakryto svoe-icon"></i> InternetCash</a>
                                    <div class="btn-joined-prof-group">
                                        <i class="icon-prisoidenitsa svoe-icon"></i> Присоединится
                                    </div>
                                    <span>3 друзей</span>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-group-prof">
                            <div class="wrap-padding-group">
                                <div class="own-photo-group" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-11-04-20-09581705_335030449956947_1312109208_n.jpg')">
                                    <a href=""></a>
                                    <div>
                                        <div class="your-group-friend" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!})">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('https://sand.esvoe.com/user/avatar/2017-06-08-19-43-0612208272_784130515042917_6144586870815355082_n.jpg')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-profile">
                                    <a href=""><i class="icon-vidkryto svoe-icon"></i> InternetCash</a>
                                    <div class="btn-joined-prof-group">
                                        <i class="icon-prisoidenitsa svoe-icon"></i> Присоединится
                                    </div>
                                    <span>3 друзей</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-panel-prof">
                        <div class="title-link-album">
                            <a href="#">
                                <i class="icon-podii  svoe-icon" style="top: 23px;left: 19px;"></i>
                                События
                                <span class="show-all-title">Все</span>
                            </a>
                        </div>
                        <div class="wrap-event-prof">
                            <div class="photo-event-prof" style="background-image: url({!! Theme::asset()->url('images/event-prof-1.png') !!})">
                                <div class="shadow-event-prof">
                                    <div class="date-event-prof">
                                        <span class="number-date">26</span>
                                        <span>серпня</span>
                                    </div>
                                </div>
                            </div>
                            <a href="">LET SWIFT - iOS Developers Meet-up</a>
                            <span>3 246 учасників</span>
                        </div>
                        <div class="wrap-event-prof">
                            <div class="photo-event-prof" style="background-image: url({!! Theme::asset()->url('images/event-prof-1.png') !!})">
                                <div class="shadow-event-prof">
                                    <div class="date-event-prof">
                                        <span class="number-date">26</span>
                                        <span>серпня</span>
                                    </div>
                                </div>
                            </div>
                            <a href="">LET SWIFT - iOS Developers Meet-up</a>
                            <span>3 246 учасників</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-7  col-lg-5  col-grid-1">
                    <div style="height: 600px;background-color: #ccc;"></div>
                </div>
                <div class="visible-lg col-lg-3 hide-1">
                    {!! Theme::partial('advertising') !!}
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab-2">Tab 2 ...</div>
        <div role="tabpanel" class="tab-pane fade " id="tab-3">

            <div class="row">
                <div class="visible-lg col-lg-3 hide-1">
                    {!! Theme::partial('advertising') !!}
                </div>
                <div class="col-lg-9 col-wallet">
                    <div class="wrap-content-tab">
                        <div class="wrap-photo-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab-friend-1" aria-controls="tab-friend-1" role="tab" data-toggle="tab">Друзі</a></li>
                                <li role="presentation"><a href="#tab-friend-2" aria-controls="tab-friend-2" role="tab" data-toggle="tab">Підписники</a></li>
                                <li role="presentation" ><a href="#tab-friend-3" aria-controls="tab-friend-3" role="tab" data-toggle="tab">Спільні друзі</a></li>
                                <li role="presentation" ><a href="#tab-friend-4" aria-controls="tab-friend-4" role="tab" data-toggle="tab">Родина</a></li>
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
                                <div role="tabpanel" class="tab-pane fade in active" id="tab-friend-1">
                                    <div class="wrap-friend-tab-prof">
                                        <div class="row small-tab-friend row-big-tab-friend">
                                            <div class="col-sm-6">
                                                <div class="own-friend-tab-prof">
                                                    <div class="bg-wall-friend-tab" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')" ></div>
                                                    <div class="photo-friend-tab" style="background-image: url('https://sand.esvoe.com/user/avatar/2017-06-08-19-43-0612208272_784130515042917_6144586870815355082_n.jpg')"></div>
                                                    <div class="content-friend-tab">
                                                        <ul class="list-inline no-margin">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="#">
                                                                            Поскаржитись
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                        <div class="info-action-friend-tab">
                                                            <p><a href="">Vitalii Oleniichuk</a></p>
                                                            <span>Львів</span>
                                                            <div class="count-friend-photo-block">
                                                                <div class="row">
                                                                    <div class="col-xs-3">
                                                                        <span>320</span>
                                                                        <p>Друзів</p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <span>229</span>
                                                                        <p>Підписників </p>
                                                                    </div>
                                                                    <div class="col-xs-5">
                                                                        <span>356</span>
                                                                        <p>Фотографий</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="profheader-ctrl">
                                                                <!-- case 0 : confirm request for friendship -->
                                                                <div class="profheader-ctrl-item" data-role="friend-request" style="display: ---none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-druzhyty svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">Хочет дружить</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                            <li>
                                                                                <a data-action="friend-accept" href="#" class="">
                                                                                    <i class="icon-prinyat svoe-icon"></i>Принять
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="friend-cancel" href="#" class="">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Отказать
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- case 1 : add to friend -->
                                                                <div class="profheader-ctrl-item" data-role="add-to-friend" style="display: none;">
                                                                    <a data-action="add" href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
                                                                        <i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
                                                                        <span class="profheader-ctrl-text">Добавить в друзья</span>
                                                                    </a>
                                                                </div>
                                                                <!-- case 2 : not allowed, cancel adding -->
                                                                <div class="profheader-ctrl-item" data-role="not-allowed" style="display: none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-chekaty svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">Не подтверждено</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                            <li>
                                                                                <a data-action="cancel" href="#" class="">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Отменить заявку
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- case 3 : your friend -->
                                                                <div class="profheader-ctrl-item" data-role="your-friend" style="display: none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-prinyat svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">У Вас в друзьях</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                            <li>
                                                                                <a data-action="delete" href="#" class="dropdown-unclosed">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Удалить из друзей
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <form name="user-status-form">
                                                                                    <a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
                                                                                        <i class="icon-strilka svoe-icon"></i>Статус дружбы
                                                                                    </a>
                                                                                    <ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="bestfriends">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="bestfriends-styler"><input data-action="status" type="checkbox" name="status" id="bestfriends" value="bestfriends"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Лучшие друзья
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="colleagues">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="colleagues-styler"><input data-action="status" type="checkbox" name="status" id="colleagues" value="colleagues"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Коллеги
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="employees">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="employees-styler"><input data-action="status" type="checkbox" name="status" id="employees" value="employees"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Сотрудники
                                                                                            </label>
                                                                                        </li>
                                                                                    </ul>
                                                                                </form>
                                                                            </li>
                                                                            <li>
                                                                                <form name="user-relative-form">
                                                                                    <a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
                                                                                        <i class="icon-strilka svoe-icon"></i>Родственники
                                                                                    </a>
                                                                                    <ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="mother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="mother-styler"><input data-action="relative" type="radio" name="relative" id="mother" value="mother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Мать
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="doughter">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="doughter-styler"><input data-action="relative" type="radio" name="relative" id="doughter" value="doughter"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Дочь
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="grandmother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="grandmother-styler"><input data-action="relative" type="radio" name="relative" id="grandmother" value="grandmother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Бабушка
                                                                                            </label>
                                                                                        </li>
                                                                                    </ul>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="profheader-ctrl-item profheader-ctrl-item___message">
                                                                    <a href="#" class="profheader-ctrl-btn profheader-ctrl-message" style="">
                                                                        <i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
                                                                        <span class="profheader-ctrl-text">Подписаться</span>
                                                                    </a>
                                                                </div>
                                                                <div class="profheader-ctrl-item">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                            <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                            <li>
                                                                                <a data-action="subscribe" href="#" class="">
                                                                                    <i class="icon-povidomlennia svoe-icon"></i>Написать сообщение
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="unsubscribe" href="#" class="" style="display:none;">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Подписаться
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a data-action="claim" href="#" class="sub">
                                                                                    <i class="icon-poskarzhytysya svoe-icon"></i>Пожаловаться
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="block" href="#" class="sub">
                                                                                    <i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="own-friend-tab-prof">
                                                    <div class="bg-wall-friend-tab" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')" ></div>
                                                    <div class="photo-friend-tab" style="background-image: url({!! Theme::asset()->url('https://sand.esvoe.com/user/avatar/2017-07-18-13-21-54AGp7eZ4Z.png') !!})"></div>
                                                    <div class="content-friend-tab">
                                                        <ul class="list-inline no-margin">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="#">
                                                                            Поскаржитись
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                        <div class="info-action-friend-tab">
                                                            <p><a href="">Andriy Vynarchyk</a></p>
                                                            <span>Львів</span>
                                                            <div class="count-friend-photo-block">
                                                                <div class="row">
                                                                    <div class="col-xs-3">
                                                                        <span>320</span>
                                                                        <p>Друзів</p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <span>229</span>
                                                                        <p>Підписників </p>
                                                                    </div>
                                                                    <div class="col-xs-5">
                                                                        <span>356</span>
                                                                        <p>Фотографий</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="profheader-ctrl">
                                                                <!-- case 0 : confirm request for friendship -->
                                                                <div class="profheader-ctrl-item" data-role="friend-request" style="display: ---none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-druzhyty svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">Хочет дружить</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                            <li>
                                                                                <a data-action="friend-accept" href="#" class="">
                                                                                    <i class="icon-prinyat svoe-icon"></i>Принять
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="friend-cancel" href="#" class="">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Отказать
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- case 1 : add to friend -->
                                                                <div class="profheader-ctrl-item" data-role="add-to-friend" style="display: none;">
                                                                    <a data-action="add" href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
                                                                        <i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
                                                                        <span class="profheader-ctrl-text">Добавить в друзья</span>
                                                                    </a>
                                                                </div>
                                                                <!-- case 2 : not allowed, cancel adding -->
                                                                <div class="profheader-ctrl-item" data-role="not-allowed" style="display: none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-chekaty svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">Не подтверждено</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                            <li>
                                                                                <a data-action="cancel" href="#" class="">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Отменить заявку
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- case 3 : your friend -->
                                                                <div class="profheader-ctrl-item" data-role="your-friend" style="display: none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-prinyat svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">У Вас в друзьях</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                            <li>
                                                                                <a data-action="delete" href="#" class="dropdown-unclosed">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Удалить из друзей
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <form name="user-status-form">
                                                                                    <a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
                                                                                        <i class="icon-strilka svoe-icon"></i>Статус дружбы
                                                                                    </a>
                                                                                    <ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="bestfriends">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="bestfriends-styler"><input data-action="status" type="checkbox" name="status" id="bestfriends" value="bestfriends"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Лучшие друзья
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="colleagues">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="colleagues-styler"><input data-action="status" type="checkbox" name="status" id="colleagues" value="colleagues"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Коллеги
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="employees">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="employees-styler"><input data-action="status" type="checkbox" name="status" id="employees" value="employees"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Сотрудники
                                                                                            </label>
                                                                                        </li>
                                                                                    </ul>
                                                                                </form>
                                                                            </li>
                                                                            <li>
                                                                                <form name="user-relative-form">
                                                                                    <a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
                                                                                        <i class="icon-strilka svoe-icon"></i>Родственники
                                                                                    </a>
                                                                                    <ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="mother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="mother-styler"><input data-action="relative" type="radio" name="relative" id="mother" value="mother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Мать
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="doughter">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="doughter-styler"><input data-action="relative" type="radio" name="relative" id="doughter" value="doughter"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Дочь
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="grandmother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="grandmother-styler"><input data-action="relative" type="radio" name="relative" id="grandmother" value="grandmother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Бабушка
                                                                                            </label>
                                                                                        </li>
                                                                                    </ul>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="profheader-ctrl-item profheader-ctrl-item___message">
                                                                    <a href="#" class="profheader-ctrl-btn profheader-ctrl-message" style="">
                                                                        <i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
                                                                        <span class="profheader-ctrl-text">Подписаться</span>
                                                                    </a>
                                                                </div>
                                                                <div class="profheader-ctrl-item">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                            <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                            <li>
                                                                                <a data-action="subscribe" href="#" class="">
                                                                                    <i class="icon-povidomlennia svoe-icon"></i>Написать сообщение
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="unsubscribe" href="#" class="" style="display:none;">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Подписаться
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a data-action="claim" href="#" class="sub">
                                                                                    <i class="icon-poskarzhytysya svoe-icon"></i>Пожаловаться
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="block" href="#" class="sub">
                                                                                    <i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="own-friend-tab-prof">
                                                    <div class="bg-wall-friend-tab" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')" ></div>
                                                    <div class="photo-friend-tab" style="background-image: url('https://sand.esvoe.com/user/avatar/2017-06-08-19-43-0612208272_784130515042917_6144586870815355082_n.jpg')"></div>
                                                    <div class="content-friend-tab">
                                                        <ul class="list-inline no-margin">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="#">
                                                                            Поскаржитись
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                        <div class="info-action-friend-tab">
                                                            <p><a href="">Vitalii Oleniichuk</a></p>
                                                            <span>Львів</span>
                                                            <div class="count-friend-photo-block">
                                                                <div class="row">
                                                                    <div class="col-xs-3">
                                                                        <span>320</span>
                                                                        <p>Друзів</p>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <span>229</span>
                                                                        <p>Підписників </p>
                                                                    </div>
                                                                    <div class="col-xs-5">
                                                                        <span>356</span>
                                                                        <p>Фотографий</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="profheader-ctrl">
                                                                <!-- case 0 : confirm request for friendship -->
                                                                <div class="profheader-ctrl-item" data-role="friend-request" style="display: ---none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-druzhyty svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">Хочет дружить</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                            <li>
                                                                                <a data-action="friend-accept" href="#" class="">
                                                                                    <i class="icon-prinyat svoe-icon"></i>Принять
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="friend-cancel" href="#" class="">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Отказать
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- case 1 : add to friend -->
                                                                <div class="profheader-ctrl-item" data-role="add-to-friend" style="display: none;">
                                                                    <a data-action="add" href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
                                                                        <i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
                                                                        <span class="profheader-ctrl-text">Добавить в друзья</span>
                                                                    </a>
                                                                </div>
                                                                <!-- case 2 : not allowed, cancel adding -->
                                                                <div class="profheader-ctrl-item" data-role="not-allowed" style="display: none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-chekaty svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">Не подтверждено</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                            <li>
                                                                                <a data-action="cancel" href="#" class="">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Отменить заявку
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!-- case 3 : your friend -->
                                                                <div class="profheader-ctrl-item" data-role="your-friend" style="display: none;">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
                                                                            <i class="icon-prinyat svoe-lg svoe-icon"></i>
                                                                            <span class="profheader-ctrl-text">У Вас в друзьях</span>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown">
                                                                            <li>
                                                                                <a data-action="delete" href="#" class="dropdown-unclosed">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Удалить из друзей
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <form name="user-status-form">
                                                                                    <a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
                                                                                        <i class="icon-strilka svoe-icon"></i>Статус дружбы
                                                                                    </a>
                                                                                    <ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="bestfriends">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="bestfriends-styler"><input data-action="status" type="checkbox" name="status" id="bestfriends" value="bestfriends"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Лучшие друзья
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="colleagues">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="colleagues-styler"><input data-action="status" type="checkbox" name="status" id="colleagues" value="colleagues"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Коллеги
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="employees">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="employees-styler"><input data-action="status" type="checkbox" name="status" id="employees" value="employees"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
                                                                                                Сотрудники
                                                                                            </label>
                                                                                        </li>
                                                                                    </ul>
                                                                                </form>
                                                                            </li>
                                                                            <li>
                                                                                <form name="user-relative-form">
                                                                                    <a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
                                                                                        <i class="icon-strilka svoe-icon"></i>Родственники
                                                                                    </a>
                                                                                    <ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="mother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="mother-styler"><input data-action="relative" type="radio" name="relative" id="mother" value="mother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Мать
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="doughter">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="doughter-styler"><input data-action="relative" type="radio" name="relative" id="doughter" value="doughter"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Дочь
                                                                                            </label>
                                                                                        </li>
                                                                                        <li class="profheader-ctrl-submenu-item">
                                                                                            <label for="grandmother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="grandmother-styler"><input data-action="relative" type="radio" name="relative" id="grandmother" value="grandmother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
                                                                                                Бабушка
                                                                                            </label>
                                                                                        </li>
                                                                                    </ul>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="profheader-ctrl-item profheader-ctrl-item___message">
                                                                    <a href="#" class="profheader-ctrl-btn profheader-ctrl-message" style="">
                                                                        <i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
                                                                        <span class="profheader-ctrl-text">Подписаться</span>
                                                                    </a>
                                                                </div>
                                                                <div class="profheader-ctrl-item">
                                                                    <div class="dropdown">
                                                                        <a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                                            <i class="icon-menyu svoe-lg svoe-icon"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
                                                                            <li>
                                                                                <a data-action="subscribe" href="#" class="">
                                                                                    <i class="icon-povidomlennia svoe-icon"></i>Написать сообщение
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="unsubscribe" href="#" class="" style="display:none;">
                                                                                    <i class="icon-vidpysatys svoe-icon"></i>Подписаться
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a data-action="claim" href="#" class="sub">
                                                                                    <i class="icon-poskarzhytysya svoe-icon"></i>Пожаловаться
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a data-action="block" href="#" class="sub">
                                                                                    <i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab-friend-2">

                                </div>
                                <div role="tabpanel" class="tab-pane fade " id="tab-friend-3">

                                </div>
                                <div role="tabpanel" class="tab-pane fade " id="tab-friend-4">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab-4">
            <div class="wrap-content-tab">
                <div class="wrap-photo-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-photo-1" aria-controls="tab-photo-1" role="tab" data-toggle="tab">Альбоми <span>(8)</span></a></li>
                        <li role="presentation"><a href="#tab-photo-2" aria-controls="tab-photo-2" role="tab" data-toggle="tab">Світлини з Катерина <span>(13)</span></a></li>
                        <li role="presentation" ><a class="switch-grid" href="#tab-photo-3" aria-controls="tab-photo-3" role="tab" data-toggle="tab">Світлини Катерины <span>(458)</span></a></li>
                        <li class="grid-col">
                        <span class="own-grid-bootstrap">
                            <i class="icon-sort-b svoe-sort svoe-icon"></i>
                        </span>
                        <span class="own-grid-mosaic active-grid">
                            <i class="icon-sort-a svoe-sort svoe-icon"></i>
                        </span>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-photo-1">
                            <div class="wrap-album-tab">
                                <div class="row">
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Всяке прирізне</a>
                                                <span>(458 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Шопінг у Львові</a>
                                                <span>(8 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/reklama-1.jpg') !!}')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Фотосесія на кухні</a>
                                                <span>(36 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-20-12-29-22Ie0V3.jpg')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Шопінг у Львові</a>
                                                <span>(8 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Всяке прирізне</a>
                                                <span>(458 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Шопінг у Львові</a>
                                                <span>(8 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-20-12-29-22Ie0V3.jpg')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Фотосесія на кухні</a>
                                                <span>(36 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-album">
                                        <div class="own-album-tab">
                                            <div class="photo-album-tab-border">
                                                <div class="one-photo-album" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-20-12-29-22Ie0V3.jpg')">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                            <div class="title-album-count">
                                                <a href="">Шопінг у Львові</a>
                                                <span>(8 фото)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-photo-2">Tab 6 ...</div>
                        <div role="tabpanel" class="tab-pane fade " id="tab-photo-3">
                            <div class="one-date-photo">
                                <span>2017 год</span>
                                <div class="tjpictures">
                                    <img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/8.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/9.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/10.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/11.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
                                </div>
                            </div>
                            <div class="one-date-photo">
                                <span>2016 год</span>
                                <div class="tjpictures">
                                    <img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/8.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/9.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/10.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/11.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
                                    <img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab-5">
            <div class="wrap-content-tab">

                <div class="wrap-photo-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-video-1" aria-controls="tab-video-1" role="tab" data-toggle="tab">Альбоми з відео</a></li>
                        <li role="presentation" ><a class="switch-grid" href="#tab-video-2" aria-controls="tab-video-2" role="tab" data-toggle="tab">Всі відео</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab-video-1">
                            <div class="wrap-video-tab">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="wrap-video-album-tab">
                                            <div class="own-album-video">
                                                <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/KyyvXziUGCQ"></div>
                                            </div>
                                        </div>
                                        <div class="title-video-tab">
                                            <p><a href="">PSG vs Toulouse 6-2 - All Goals & Highlights</a></p>
                                            <span>(28 видео)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="wrap-video-album-tab">
                                            <div class="own-album-video">
                                                <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/MXGORPXI6QQ"></div>
                                            </div>
                                        </div>
                                        <div class="title-video-tab">
                                            <p><a href="">Chalissery program 2015</a></p>
                                            <span>(28 видео)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="wrap-video-album-tab">
                                            <div class="own-album-video">
                                                <div class="embed-video" data-source="youtube" data-video-url="https://www.youtube.com/watch?v=C-Q7GeQG6iE"></div>
                                            </div>
                                        </div>
                                        <div class="title-video-tab">
                                            <p><a href="">TRADA's National Student Design</a></p>
                                            <span>(28 видео)</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="wrap-video-album-tab">
                                            <div class="own-album-video">
                                                <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/adFIMREcfog"></div>
                                            </div>
                                        </div>
                                        <div class="title-video-tab">
                                            <p><a href="">Вечерний Квартал 2016</a></p>
                                            <span>(28 видео)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-video-2">
                            <div class="wrap-video-tab">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/KyyvXziUGCQ"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">PSG vs Toulouse 6-2 - All Goals & Highlights</a></p>
                                            <a href="">Vine Video</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/MXGORPXI6QQ"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">Chalissery program 2015</a></p>
                                            <a href="">Vine Video</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://www.youtube.com/watch?v=C-Q7GeQG6iE"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">TRADA's National Student Design</a></p>
                                            <a href="">Vine Video</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/adFIMREcfog"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">Вечерний Квартал 2016</a></p>
                                            <a href="">Студия Квартал 95</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/uhmcyFSJYXg"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">Топ 5 противостояний Конора Макгрегора</a></p>
                                            <a href="">TOP TIP TOP MMA</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/L3wKzyIN1yk"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">Rag'n'Bone Man - Human</a></p>
                                            <a href="">RagnBoneManVEVO</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/kJQP7kiw5Fk"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">Ed Sheeran - Shape of You</a></p>
                                            <a href="">Ed Sheeran</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">три года назад</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/th63_uyJsWI"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">ТОП-10 трансферов, которые потрясли мир</a></p>
                                            <a href="">oSporte TV</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/KyyvXziUGCQ"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">PSG vs Toulouse 6-2 - All Goals & Highlights</a></p>
                                            <a href="">Vine Video</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/MXGORPXI6QQ"></div>
                                        <div class="title-video-tab">
                                            <p><a href="">Chalissery program 2015</a></p>
                                            <a href="">Vine Video</a>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
                                            <span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab-6">
            <div class="wrap-content-tab">
                <div class="title-tab-prof">
                    <i class="icon-grupy svoe-lg svoe-icon"></i>
                    {{ trans('sidebar.my_groups') }}
                    <div class="search-friend-tab search-other">
                        <input type="text" class="form-control" style="display: none;">
                        <i class="icon-shukaty svoe-icon"></i>
                    </div>
                </div>
                <div class="wrap-group-col">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-group-prof">
                                <div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!}');">
                                    <div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-col">
                                    <p><a href="">Cтудія меблів «Файно»</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
                                    <div class="btn-group-col">
                                        <a href="">
                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                            {{ trans('common.join') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-group-prof">
                                <div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}');">
                                    <div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-col">
                                    <p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
                                    <div class="btn-group-col">

                                        <a href="">
                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                            {{ trans('common.join') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-group-prof">
                                <div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}');">
                                    <div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-col">
                                    <p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
                                    <div class="btn-group-col">
                                        <a href="">
                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                            {{ trans('common.join') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-group-prof">
                                <div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!}');">
                                    <div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-col">
                                    <p><a href="">Cтудія меблів «Файно»</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
                                    <div class="btn-group-col">
                                        <a href="">
                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                            {{ trans('common.join') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-group-prof">
                                <div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}');">
                                    <div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-col">
                                    <p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
                                    <div class="btn-group-col">
                                        <a href="">
                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                            {{ trans('common.join') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-group-prof">
                                <div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}');">
                                    <div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-group-col">
                                    <p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
                                    <div class="btn-group-col">
                                        <a href="">
                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                            {{ trans('common.join') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab-events">
            <div class="wrap-content-tab">
                <div class="title-tab-prof">
                    <i class="icon-podii svoe-lg svoe-icon"></i>
                    {{ trans('sidebar.my_events') }}
                    <div class="search-friend-tab search-other">
                        <input type="text" class="form-control" style="display: none;">
                        <i class="icon-shukaty svoe-icon"></i>
                    </div>
                </div>
                <div class="wrap-event-col">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-event-col">
                                <div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-2.png') !!}')">
                                    <div class="shadow-event-prof">
                                        <div class="date-event-prof">
                                            <span class="number-date">26</span>
                                            <span>серпня</span>
                                        </div>
                                    </div>
                                    <div class="wrap-event-friend">
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-event-col">
                                    <p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
                                    <div class="btn-hover-wrap">
                                        <a href="" class="btn-action-hover">
                                            <i class="icon-pereytu  svoe-icon"></i>
                                            Посетить
                                        </a>
                                        <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                            <i class="icon-pidpysatysya  svoe-icon"></i>
                                            Подписаться
                                        </a>
                                    </div>
                                    <span>295 374 участников</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-event-col">
                                <div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-3.png') !!}')">
                                    <div class="shadow-event-prof">
                                        <div class="date-event-prof">
                                            <span class="number-date">26</span>
                                            <span>серпня</span>
                                        </div>
                                    </div>
                                    <div class="wrap-event-friend">
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-event-col">
                                    <p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
                                    <div class="btn-hover-wrap">
                                        <a href="" class="btn-action-hover">
                                            <i class="icon-pereytu  svoe-icon"></i>
                                            Посетить
                                        </a>
                                        <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                            <i class="icon-pidpysatysya  svoe-icon"></i>
                                            Подписаться
                                        </a>
                                    </div>
                                    <span>295 374 участников</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-event-col">
                                <div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}')">
                                    <div class="shadow-event-prof">
                                        <div class="date-event-prof">
                                            <span class="number-date">26</span>
                                            <span>серпня</span>
                                        </div>
                                    </div>
                                    <div class="wrap-event-friend">
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-event-col">
                                    <p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
                                    <div class="btn-hover-wrap">
                                        <a href="" class="btn-action-hover">
                                            <i class="icon-pereytu  svoe-icon"></i>
                                            Посетить
                                        </a>
                                        <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                            <i class="icon-pidpysatysya  svoe-icon"></i>
                                            Подписаться
                                        </a>
                                    </div>
                                    <span>295 374 участников</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-event-col">
                                <div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-2.png') !!}')">
                                    <div class="shadow-event-prof">
                                        <div class="date-event-prof">
                                            <span class="number-date">26</span>
                                            <span>серпня</span>
                                        </div>
                                    </div>
                                    <div class="wrap-event-friend">
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-event-col">
                                    <p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
                                    <div class="btn-hover-wrap">
                                        <a href="" class="btn-action-hover">
                                            <i class="icon-pereytu  svoe-icon"></i>
                                            Посетить
                                        </a>
                                        <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                            <i class="icon-pidpysatysya  svoe-icon"></i>
                                            Подписаться
                                        </a>
                                    </div>
                                    <span>295 374 участников</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-event-col">
                                <div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-3.png') !!}')">
                                    <div class="shadow-event-prof">
                                        <div class="date-event-prof">
                                            <span class="number-date">26</span>
                                            <span>серпня</span>
                                        </div>
                                    </div>
                                    <div class="wrap-event-friend">
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-event-col">
                                    <p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
                                    <div class="btn-hover-wrap">
                                        <a href="" class="btn-action-hover">
                                            <i class="icon-pereytu  svoe-icon"></i>
                                            Посетить
                                        </a>
                                        <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                            <i class="icon-pidpysatysya  svoe-icon"></i>
                                            Подписаться
                                        </a>
                                    </div>
                                    <span>295 374 участников</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="wrap-one-event-col">
                                <div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}')">
                                    <div class="shadow-event-prof">
                                        <div class="date-event-prof">
                                            <span class="number-date">26</span>
                                            <span>серпня</span>
                                        </div>
                                    </div>
                                    <div class="wrap-event-friend">
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-event-col">
                                    <p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
                                    <div class="btn-hover-wrap">
                                        <a href="" class="btn-action-hover">
                                            <i class="icon-pereytu  svoe-icon"></i>
                                            Посетить
                                        </a>
                                        <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                            <i class="icon-pidpysatysya  svoe-icon"></i>
                                            Подписаться
                                        </a>
                                    </div>
                                    <span>295 374 участников</span>
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
    //For blocks or images of size, you can use $(document).ready
    $(document).ready(function() {
        $('.embed-video').embedVideo();
        $('.rating-block').barrating({
            theme: 'fontawesome-stars'
        });

        // Fixed position Profile Header when scroll
        function profHeaderFix() {
            console.log($(this).scrollTop());
            var $box = $('.new-content-prof .profheader-nav');
            var $boxWrapper = $('.wrap-new-prof-header');
            var topScroll = $('.wrap-new-prof-header').innerHeight() - 80;
            var topOffset = 60;

            if ($(window).scrollTop() > topScroll) {
                $('body').addClass('profheader-fixed');
                $box.css({
                    'position': 'fixed',
                    'top': topOffset + 'px',
                    'left': $boxWrapper.offset().left,
                    'width': $boxWrapper.width(),
                    'zIndex':2
                });
            } else {
                $('body').removeClass('profheader-fixed');
                $box.css({
                    'position': 'relative',
                    'top': 'auto',
                    'left': 'auto',
                    'width': '',
                    'zIndex':''
                });
            }
        }
        $(window).scroll(profHeaderFix);
        $(window).resize(profHeaderFix);

        profHeaderFix();

    });

</script>