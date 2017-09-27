<div class="container container-grid">
    <div class="row">
        <div class="col-xs-12">
  
            <a href="#" data-toggle="modal" data-target=".view-game">Static App Popup</a>
            <br />

            <!-- app ID insert in url href -->
            <a href="https://sand.esvoe.com/app/1/preview" data-app-id>Dynamic App Popup 1</a>
            <br />
            <a href="https://sand.esvoe.com/app/2/preview" data-app-id>Dynamic App Popup 2</a>
            <br />
            <a href="https://sand.esvoe.com/app/18/preview" data-app-id>Dynamic App Popup 18</a>

        </div>
    </div>
</div>


<!-- Modal Static -->
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

        $('.view-game .rating-block').barrating({
            theme: 'fontawesome-stars',
            onSelect:function(value, text, event){
                var arr = value.split('-');
                var app_id = arr[1];
                value = arr[0];
                console.log(app_id,value);
            }
        });
        $('.view-game .rating-block').barrating('readonly', true);
        $('.view-game .rating-block').barrating('set', 4);
       
    });
</script>