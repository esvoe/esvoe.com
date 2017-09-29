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

                <div class="wrap-own-invite friend-page-invite">
                    <a href="#">
                        <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');"></div>
                    </a>
                    <h4>
                        <a href="#">Катя Самбука</a>
                    </h4>
                    <p>Львів</p>
                    <div class="action-invite-friend">
                        <a href="#">{{ trans('friend.accept_friend')  }}</a>
                        <span><i class="icon-zakrutu svoe-icon"></i></span>
                    </div>
                </div>
                <div class="wrap-own-invite friend-page-invite">
                    <a href="#">
                        <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');"></div>
                    </a>
                    <h4>
                        <a href="#">Катя Самбука</a>
                    </h4>
                    <p>Львів</p>
                    <div class="action-invite-friend">
                        <a href="#">{{ trans('friend.accept_friend')  }}</a>
                        <span><i class="icon-zakrutu svoe-icon"></i></span>
                    </div>
                </div>

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

                <div id="foundPeople" class="page-friend-find">

                    <div class="wrap-own-invite">
                        <a href="#">
                            <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');" title="">
                            </div>
                        </a>
                        <h4><a href="#">Катя Самбука</a></h4>
                        <p>Львів &nbsp;</p>
                        <div class="action-invite-friend js-follow-links">
                            <div class="">
                                <a href="" class="hypothetically-friend follow" rel="" ><i class="icon-dodaty-druzi svoe-lg svoe-icon"></i> {{ trans('friend.add_to_friends') }}</a>
                            </div>
                            <div class="hidden">
                                <a href="" style="background-color: #f59d1a !important;" class="hypothetically-friend unfollow" rel="" ><i class="icon-vidpysatys svoe-lg svoe-icon"></i> {{ trans('friend.cancel_request') }}</a>
                            </div>
                            {{--<span>
                                <i class="icon-zakrutu svoe-icon"></i>
                            </span>--}}
                        </div>
                    </div>
                    <div class="wrap-own-invite">
                        <a href="#">
                            <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');" title="">
                            </div>
                        </a>
                        <h4><a href="#">Катя Самбука</a></h4>
                        <p>Львів &nbsp;</p>
                        <div class="action-invite-friend js-follow-links">
                            <div class="">
                                <a href="" class="hypothetically-friend follow" rel="" ><i class="icon-dodaty-druzi svoe-lg svoe-icon"></i> {{ trans('friend.add_to_friends') }}</a>
                            </div>
                            <div class="hidden">
                                <a href="" style="background-color: #f59d1a !important;" class="hypothetically-friend unfollow" rel="" ><i class="icon-vidpysatys svoe-lg svoe-icon"></i> {{ trans('friend.cancel_request') }}</a>
                            </div>
                            {{--<span>
                                <i class="icon-zakrutu svoe-icon"></i>
                            </span>--}}
                        </div>
                    </div>
                    <div class="wrap-own-invite">
                        <a href="#">
                            <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');" title="">
                            </div>
                        </a>
                        <h4><a href="#">Катя Самбука</a></h4>
                        <p>Львів &nbsp;</p>
                        <div class="action-invite-friend js-follow-links">
                            <div class="">
                                <a href="" class="hypothetically-friend follow" rel="" ><i class="icon-dodaty-druzi svoe-lg svoe-icon"></i> {{ trans('friend.add_to_friends') }}</a>
                            </div>
                            <div class="hidden">
                                <a href="" style="background-color: #f59d1a !important;" class="hypothetically-friend unfollow" rel="" ><i class="icon-vidpysatys svoe-lg svoe-icon"></i> {{ trans('friend.cancel_request') }}</a>
                            </div>
                            {{--<span>
                                <i class="icon-zakrutu svoe-icon"></i>
                            </span>--}}
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-lg-8 col-wallet">
            <div class="wrap-content-tab tab-page-friend">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




