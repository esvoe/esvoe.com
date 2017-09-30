<style>
    .pictures {margin: 0px auto; width: 100%; padding: 0;}
    .user-blocks-photo,.last-photo-mosaic-1 {margin: 0px auto; width: 100%; padding: 0;}
</style>
<!-- Tab panes -->
<!-- <div class="container container-grid section-container"> -->
<div class="tab-content profheader-tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="tab-chronicle">
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
                                <span>Дата рождения</span>
                                <span>08.04.1988</span>
                            </div>
                            <div class="own-info-contact">
                                <span>Город</span>
                                <span>Львов</span>
                            </div>
                            <div class="own-info-contact">
                                <span>Номер телефона</span>
                                <span>0633833452</span>
                            </div>
                            <div class="own-info-contact">
                                <span>Skype</span>
                                <span>Viktoria_kazakova</span>
                            </div>
                            <div class="own-info-contact">
                                <span>Instagram</span>
                                <span>kazakova88</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-panel-prof">
                    <div class="title-link-album">
                        <a href="#">
                            <i class="icon-photoalbomy svoe-icon"></i>
                            Останні фотографії
                            <span>(26 фото)</span>
                        </a>
                    </div>
                    <div class="last-photo-prof">
                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="last-photo-mosaic-1">
                                    <li style="width: {{getimagesize('themes/default/assets/images/set3/1.jpg')[0].'px'}}; height: {{getimagesize('themes/default/assets/images/set3/1.jpg')[1].'px'}}; background-image: url('{!! Theme::asset()->url('images/set3/1.jpg') !!}');list-style: none;">
                                        <a href=""></a>
                                    </li>
                                    <li style="width: {{getimagesize('themes/default/assets/images/set3/2.jpg')[0].'px'}}; height: {{getimagesize('themes/default/assets/images/set3/2.jpg')[1].'px'}}; background-image: url('{!! Theme::asset()->url('images/set3/2.jpg') !!}'); list-style: none;">
                                        <a href=""></a>
                                    </li>
                                    <li style="width: {{getimagesize('themes/default/assets/images/set3/3.jpg')[0].'px'}}; height: {{getimagesize('themes/default/assets/images/set3/3.jpg')[1].'px'}}; background-image: url('{!! Theme::asset()->url('images/set3/3.jpg') !!}'); list-style: none;">
                                        <a href=""></a>
                                    </li>
                                    <li style="width: {{getimagesize('themes/default/assets/images/set3/4.jpg')[0].'px'}}; height: {{getimagesize('themes/default/assets/images/set3/4.jpg')[1].'px'}}; background-image: url('{!! Theme::asset()->url('images/set3/4.jpg') !!}'); list-style: none;">
                                        <a href=""></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-panel-prof">
                    <div class="title-link-album">
                        <a href="#">
                            <i class="icon-photoalbomy svoe-icon"></i>
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
                            <i class="icon-druzi svoe-lg svoe-icon" style="top: 5px;"></i>
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
                            <i class="icon-storinky  svoe-icon"></i>
                            Страницы
                            <span class="show-all-title">Все</span>
                        </a>
                    </div>
                    <div class="album-prof-block">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="wrap-pages-prof">
                                    <div class="own-photo-page-prof" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-11-04-20-09581705_335030449956947_1312109208_n.jpg')">
                                        <a href=""></a>
                                    </div>
                                    <a href="">InternetCash</a>
                                    <span>3 друзей</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="wrap-pages-prof">
                                    <div class="own-photo-page-prof" style="background-image: url({!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!})">
                                        <a href=""></a>
                                    </div>
                                    <a href="">Digital Art&world 3D</a>
                                    <span>10 895 учасиків</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="wrap-pages-prof">
                                    <div class="own-photo-page-prof" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
                                        <a href=""></a>
                                    </div>
                                    <a href="">Digital Art&world 3D</a>
                                    <span>10 895 учасиків</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="wrap-pages-prof">
                                    <div class="own-photo-page-prof" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-11-04-20-09581705_335030449956947_1312109208_n.jpg')">
                                        <a href=""></a>
                                    </div>
                                    <a href="">InternetCash</a>
                                    <span>3 друзей</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-panel-prof">
                    <div class="title-link-album">
                        <a href="#">
                            <i class="icon-grupy svoe-lg svoe-icon" style="top: 5px;"></i>
                            Групы
                            <span class="show-all-title">Все</span>
                        </a>
                    </div>
                    <div class="wrap-group-prof">
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
                        <a href="">InternetCash</a>
                        <div class="btn-joined-prof-group">
                            <i class="icon-prisoidenitsa svoe-icon"></i> {{ trans('common.join') }}
                        </div>
                        <span>3 друзей</span>
                    </div>
                    <div class="wrap-group-prof">
                        <div class="own-photo-group" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!}')">
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
                        <a href="">Digital Art&world 3D</a>
                        <div class="btn-joined-prof-group">
                            <i class="icon-prisoidenitsa svoe-icon"></i> {{ trans('common.join') }}
                        </div>
                        <span>3 246 людей</span>
                    </div>
                </div>
                <div class="wrap-panel-prof">
                    <div class="title-link-album">
                        <a href="#">
                            <i class="icon-podii  svoe-icon"></i>
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
                {{--{!! Theme::partial('create-post',compact('timeline','user_post')) !!}--}}
            </div>
            <div class="visible-lg col-lg-3 hide-1">
                {!! Theme::partial('advertising') !!}
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="tab-info">Tab Info ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-friends">Tab Friends ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-groups">Tab Groups ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-pages">Tab Pages ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-photos">Tab Photos ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-videos">Tab Videos ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-events">Tab Events ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-bookmarks">Tab Bookmarks ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-audio">Tab Audio ...</div>
    <div role="tabpanel" class="tab-pane fade" id="tab-apps">Tab Apps ...</div>
</div>
<!-- </div> -->