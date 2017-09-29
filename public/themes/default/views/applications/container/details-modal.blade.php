<div class="row">
    <div class="col-xs-6">
        <div class="wrap-own-modal-game">
            <h3>{{$application->title}}</h3>
            <p>{{$application->category->title}}</p>
            <span>{{$application->count_users}} Учасників</span>
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
                <button class="btn-play-game-modal">
                    <i class="icon-igry svoe-lg svoe-icon"></i> Играть
                </button>
            </div>

            <div class="gallery-modal-game">
                @if ($screenshots)

                <ul id="image-gallery-modal" class="gallery list-unstyled cS-hidden">
                    @foreach($screenshots as $screenshot)
                        <li style="background-image: url('{{static_uploads($screenshot->path)}}')" data-thumb="{{static_uploads($screenshot->path)}}"></li>
                    @endforeach
                </ul>

                @endif
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="modal-game-desc">
            <div class="title-modal-game">
                Описание Игры
            </div>
            <p class="desc-modal-game text-expand" data-expand="160|{{ trans('sidebar.more') }}|{{ trans('common.unshare') }}">
                {{$application->description}}
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro labore, soluta cum! Consequatur, dolor in incidunt animi repellat quos placeat hic at quam nulla explicabo voluptate, magnam unde est aliquam.
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