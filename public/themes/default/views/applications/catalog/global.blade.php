<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {!! Theme::partial('advertising') !!}
        </div>
        <div class="col-lg-9 col-wallet">

                <div class="game-container">

                    <div class="row" style="margin: 0 -5px;" >

                        <div class="col-xs-12 games-search-box" style="padding: 0 5px;">
                            @foreach( $catalog as $section )
                            <div class="games-search-box games-search-box_cat">
                                
                                <div class="games-box-head">
                                    <div class="games-box-head-title">
                                        <i class="icon-dodatky svoe-icon"></i>{{$section->title}}
                                    </div>
                                    @if(count($section['applications']) >= 5)
                                    <a href="#" class="games-box-head-link">Смотреть все<i class="icon-strilka svoe-icon"></i></a>
                                    @endif
                                </div>

                                @if (count($section['applications']) < 1)
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active">
                                            <div class="row" style="margin: 0 -5px;">

                                                <div class="games-box-empty">
                                                    <div class="svg-pic">
                                                        <svg x="0px" y="0px"
                                                             viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve">
                                                    <path d="M57.49,21.5H54v-6.268c0-1.507-1.226-2.732-2.732-2.732H26.515l-5-7H2.732C1.226,5.5,0,6.726,0,8.232v43.687l0.006,0
                                                    c-0.005,0.563,0.17,1.114,0.522,1.575C1.018,54.134,1.76,54.5,2.565,54.5h44.759c1.156,0,2.174-0.779,2.45-1.813L60,24.649v-0.177
                                                    C60,22.75,58.944,21.5,57.49,21.5z M2,8.232C2,7.828,2.329,7.5,2.732,7.5h17.753l5,7h25.782c0.404,0,0.732,0.328,0.732,0.732V21.5
                                                    H12.731c-0.144,0-0.287,0.012-0.426,0.036c-0.973,0.163-1.782,0.873-2.023,1.776L2,45.899V8.232z M47.869,52.083
                                                    c-0.066,0.245-0.291,0.417-0.545,0.417H2.565c-0.243,0-0.385-0.139-0.448-0.222c-0.063-0.082-0.16-0.256-0.123-0.408l10.191-27.953
                                                    c0.066-0.245,0.291-0.417,0.545-0.417H54h3.49c0.38,0,0.477,0.546,0.502,0.819L47.869,52.083z"/>
                                                    </svg>
                                                    </div>
                                                    Еще нет приложений в даной категории
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active">
                                            <div class="row" style="margin: 0 -5px;">

                                                @foreach($section['applications'] as $application)
                                                    <div class="games-grid">
                                                        <a href="{{route('applications.container', array('gamename'=>$application->name))}}">
                                                            <div class="game-image" style="background-image:url('{!! static_uploads($application->image_main) !!}')"></div>
                                                            <h5>{{$application->title}}</h5>
                                                            <span>{{$application->category->title}}</span>
                                                            <div class="rating ratingblock">
                                                                <div class="ratingblock-content">
                                                                    <span class="ratingblock-value">2.7</span>
                                                                    <div class="stars stars-example-fontawesome-o">
                                                                        <div class="br-wrapper br-theme-fontawesome-stars-o">
                                                                            <div class="br-widget">
                                                                                <span class="br-selected"></span>
                                                                                <span class="br-selected"></span>
                                                                                <span class="br-selected br-fractional"></span>
                                                                                <span></span>
                                                                                <span></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="game-members">{{$application->count_users}} участников</p>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div><!-- /games-search-box games-search-box_cat -->

                            @endforeach


                        </div><!-- / games-search-box -->
                    </div>
                </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{Theme::asset()->url('css/fontawesome-stars-o.css')}}">










<!-- TEMP -->
<div class="container container-grid">
    <div class="row">
        <div class="col-lg-12">
  
            <a href="#" data-toggle="modal" data-target=".view-game">Static App Popup</a>
            <br />
            <a href="https://sand.esvoe.com/app/1/preview" data-app-id>Dynamic App Popup 1</a>
            <br />
            <a href="https://sand.esvoe.com/app/2/preview" data-app-id>Dynamic App Popup 2</a>
            <br />
            <a href="https://sand.esvoe.com/app/18/preview" data-app-id>Dynamic App Popup 18</a>

        </div>
    </div>
</div>

Modal Static 
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

        /*$('.view-game .rating-block').barrating({
            theme: 'fontawesome-stars',
            onSelect:function(value, text, event){
                var arr = value.split('-');
                var app_id = arr[1];
                value = arr[0];
                console.log(app_id,value);
            }
        });
        $('.view-game .rating-block').barrating('readonly', true);
        $('.view-game .rating-block').barrating('set', 4);*/

    });
</script>

<!-- / TEMP  -->