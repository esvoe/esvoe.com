<!-- main-section -->
<!-- <div class="main-content"> -->
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
                            Пошук друзів
                        </div>
                        <form action="">
                            <div class="wrap-group-find">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Ім'я">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Прізвище">
                                </div>
                            </div>


                            <div class="wrap-group-find">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Введіть номер Школи">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Введіть назву Внз">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-md-pull-5 col-lg-5 col-lg-pull-4 col-grid-1">
            <div class="panel panel-default">
                <div class="title-invite">
                    Запити на дружбу
                </div>

                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile01.png') !!}')"></div>
                    <h4><a href="">Оксана Габалевич</a></h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="{{route('user.showTimeline', array('username'=>$invite['EID']))}}">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span><i class="icon-zakrutu svoe-icon"></i></span>
                    </div>
                </div>


                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile02.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile03.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span>6 спільних друзів </span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile04.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile05.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span>6 спільних друзів</span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile06.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile07.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span>6 спільних друзів </span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile08.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span><a href="">Христина Кутинська</a> та ще 12 спільних друзів</span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="wrap-own-invite">
                    <div class="photo-invite" style="background-image: url('{!! Theme::asset()->url('images/profiles/profile09.png') !!}')"></div>
                    <h4>
                        <a href="">Оксана Габалевич</a>
                    </h4>
                    <p>UI/UX Designer — HAPPY</p>
                    <span>6 спільних друзів </span>
                    <div class="action-invite-friend">
                        <a href="">Підтвердити</a>
                        <span>
                            <i class="icon-zakrutu svoe-icon"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div><!-- /col-md-6 -->


    </div>
</div>
<!-- </div> -->
<!-- /main-section -->