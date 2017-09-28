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

                                        <div class="games-grid">
                                            <a href="">
                                                <div class="game-image" style="background-image:url('{!! Theme::asset()->url('images/reklama-1.jpg') !!}')">

                                                </div>

                                                <h5>My summer car</h5>
                                                <span>{{ trans('common.sport') }}</span>
                                                <div class="rating">
                                                    <div >
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
                                                <p class="game-members">7 600 000 участников</p>
                                            </a>
                                        </div>

                                        <div class="games-grid">
                                            <a href="">
                                                <div class="game-image" style="background-image:url('{!! Theme::asset()->url('images/reklama-1.jpg') !!}')">

                                                </div>

                                                <h5>Pro evolution soccer</h5>
                                                <span>{{ trans('common.sport') }}</span>
                                                <div class="rating">
                                                    <div >
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
                                                <p class="game-members">7 600 000 участников</p>
                                            </a>
                                        </div>

                                        <div class="games-grid">
                                            <a href="">
                                                <div class="game-image" style="background-image:url('{!! Theme::asset()->url('images/reklama-1.jpg') !!}')">

                                                </div>

                                                <h5>My summer car</h5>
                                                <span>{{ trans('common.sport') }}</span>
                                                <div class="rating">
                                                    <div >
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
                                                <p class="game-members">7 600 000 участников</p>
                                            </a>
                                        </div>
                                        <div class="games-grid">
                                            <a href="">
                                                <div class="game-image" style="background-image:url('{!! Theme::asset()->url('images/reklama-1.jpg') !!}')"></div>
                                                <h5>My summer car</h5>
                                                <span>{{ trans('common.sport') }}</span>
                                                <div class="rating">
                                                    <div >
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
                                                <p class="game-members">7 600 000 участников</p>
                                            </a>
                                        </div>
                                        <div class="games-grid">
                                            <a href="">
                                                <div class="game-image" style="background-image:url('{!! Theme::asset()->url('images/reklama-1.jpg') !!}')"></div>
                                                <h5>My summer car</h5>
                                                <span>{{ trans('common.sport') }}</span>
                                                <div class="rating">
                                                    <div >
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
                                                <p class="game-members">7 600 000 участников</p>
                                            </a>
                                        </div>
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

<script type="text/javascript">
    $(function() {
        $('.rating-block').barrating({
            theme: 'fontawesome-stars'
        });
    });
</script>


