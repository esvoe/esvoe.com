<div class="container container-grid">
    <div class="row">
        <div class="panel-page-photo panel-my-photo">
            <div class="title-page-photo">
                <i class="icon-photo  svoe-icon"></i>{{trans('common.my-photo')}}
            </div>
            <div class="wrap-photo-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#my-last" aria-controls="my-last" role="tab" data-toggle="tab">{{trans('timeline.last_photos')}}</a></li>
                    <li role="presentation"><a href="#my-favourite" aria-controls="my-favourite" role="tab" data-toggle="tab">Найулюбленіші</a></li>
                    <li role="presentation" ><a href="#my-comment" aria-controls="my-comment" role="tab" data-toggle="tab">Найбільш коментовані</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="my-last">
                        <div class="wrap-grid last-grid-photo">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/1.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/2.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/3.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/4.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/5.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/6.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="show-more-page-photo">
                                {{ trans('common.view_more') }} <i class="icon-menyu svoe-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active" id="my-favourite"></div>
                    <div role="tabpanel" class="tab-pane fade in active" id="my-comment"></div>
                </div>
            </div>
        </div>
        <div class="panel-page-photo panel-pop-photo">
            <div class="title-page-photo">
                <i class="icon-photo-favourite svoe-icon svoe-lg"></i>{{ trans('common.popular-photo') }}
            </div>
            <div class="wrap-photo-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#pop-today" aria-controls="my-last" role="tab" data-toggle="tab">Сьогодні</a></li>
                    <li role="presentation"><a href="#pop-week" aria-controls="my-favourite" role="tab" data-toggle="tab">Останній тиждень</a></li>
                    <li role="presentation" ><a href="#pop-month" aria-controls="my-favourite" role="tab" data-toggle="tab">За місяць</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="pop-today">
                        <div class="wrap-grid last-grid-photo">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="author-page-photo">
                                        <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                            <a href="#"></a>
                                        </div>
                                        <p><a href="">Mariana Prushlyak</a></p>
                                    </div>
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-1.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                            <span><i class="icon-podilutus svoe-icon"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="author-page-photo">
                                        <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                            <a href="#"></a>
                                        </div>
                                        <p><a href="">Mariana Prushlyak</a></p>
                                    </div>
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-2.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                            <span><i class="icon-podilutus svoe-icon"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="author-page-photo">
                                        <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                            <a href="#"></a>
                                        </div>
                                        <p><a href="">Mariana Prushlyak</a></p>
                                    </div>
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-3.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                            <span><i class="icon-podilutus svoe-icon"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="author-page-photo">
                                        <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                            <a href="#"></a>
                                        </div>
                                        <p><a href="">Mariana Prushlyak</a></p>
                                    </div>
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-4.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                            <span><i class="icon-podilutus svoe-icon"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="author-page-photo">
                                        <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                            <a href="#"></a>
                                        </div>
                                        <p><a href="">Mariana Prushlyak</a></p>
                                    </div>
                                    <div class="wrap-block-photo-page">
                                        <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-5.jpg') !!}')">
                                            <a href=""></a>
                                        </div>
                                        <div class="content-page-photo">
                                            <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                            <span><i class="icon-like svoe-icon"></i> 38</span>
                                            <span><i class="icon-podilutus svoe-icon"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="show-more-page-photo">
                                {{ trans('common.view_more') }} <i class="icon-menyu svoe-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active" id="pop-week"></div>
                    <div role="tabpanel" class="tab-pane fade in active" id="pop-month"></div>
                </div>
            </div>
        </div>
        <div class="panel-page-photo panel-pop-photo last-friend-photo">
            <div class="title-page-photo">
                <i class="icon-photo-last-friend svoe-icon svoe-lg"></i>Останні фото друзів
            </div>
            <div class="wrap-grid last-grid-photo">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="author-page-photo">
                            <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                <a href="#"></a>
                            </div>
                            <p><a href="">Mariana Prushlyak</a></p>
                        </div>
                        <div class="wrap-block-photo-page">
                            <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-6.jpg') !!}')">
                                <a href=""></a>
                            </div>
                            <div class="content-page-photo">
                                <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                <span><i class="icon-like svoe-icon"></i> 38</span>
                                <span><i class="icon-podilutus svoe-icon"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="author-page-photo">
                            <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                <a href="#"></a>
                            </div>
                            <p><a href="">Mariana Prushlyak</a></p>
                        </div>
                        <div class="wrap-block-photo-page">
                            <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-7.jpg') !!}')">
                                <a href=""></a>
                            </div>
                            <div class="content-page-photo">
                                <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                <span><i class="icon-like svoe-icon"></i> 38</span>
                                <span><i class="icon-podilutus svoe-icon"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="author-page-photo">
                            <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                <a href="#"></a>
                            </div>
                            <p><a href="">Mariana Prushlyak</a></p>
                        </div>
                        <div class="wrap-block-photo-page">
                            <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-8.jpg') !!}')">
                                <a href=""></a>
                            </div>
                            <div class="content-page-photo">
                                <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                <span><i class="icon-like svoe-icon"></i> 38</span>
                                <span><i class="icon-podilutus svoe-icon"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="author-page-photo">
                            <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                <a href="#"></a>
                            </div>
                            <p><a href="">Mariana Prushlyak</a></p>
                        </div>
                        <div class="wrap-block-photo-page">
                            <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-9.jpg') !!}')">
                                <a href=""></a>
                            </div>
                            <div class="content-page-photo">
                                <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                <span><i class="icon-like svoe-icon"></i> 38</span>
                                <span><i class="icon-podilutus svoe-icon"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="author-page-photo">
                            <div class="photo-author-page" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}');">
                                <a href="#"></a>
                            </div>
                            <p><a href="">Mariana Prushlyak</a></p>
                        </div>
                        <div class="wrap-block-photo-page">
                            <div class="photo-wall-page" style="background-image: url('{!! Theme::asset()->url('images/set3/cS-10.jpg') !!}')">
                                <a href=""></a>
                            </div>
                            <div class="content-page-photo">
                                <span><i class="icon-comentyvatu svoe-icon"></i> 49</span>
                                <span><i class="icon-like svoe-icon"></i> 38</span>
                                <span><i class="icon-podilutus svoe-icon"></i></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="show-more-page-photo">
                    {{ trans('common.view_more') }} <i class="icon-menyu svoe-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>