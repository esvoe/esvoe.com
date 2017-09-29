<!-- main-section -->

<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {{--{!! Theme::partial('home-leftbar',compact('trending_tags')) !!}--}}
            {!! Theme::partial('advertising') !!}
        </div>

        <div class="col-lg-9 col-row-1 col-wallet">
            <div class="wrap-create-album-page">
                @include('flash::message')
                <div class="panel panel-default">
                    <div class="panel-heading no-bg user-pages no-paddingbottom navbars">
                        <div class="page-heading header-text">
                            {{ trans('common.all_albums') }}
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
                <div class="row">
                    @if(count($albums) > 0)
                        @if(Auth::user()->id == $timeline->user->id)
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body nopadding">
                                    <div class="widget-card">
                                        <div class="wrap-widget-cover">
                                            <div class="widget-card-bg" style="background-image: url('');">
                                                <a href="{{ url('/'.Auth::user()->username.'/album/create') }}" class="own-create-link">
                                                    <i class="icon-prisoidenitsa svoe-sort svoe-icon"></i>
                                                    <span>Создать новый альбом</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-card-project">
                                            <div class="bridge-text">
                                                <div class="pull-right">
                                                    &nbsp;
                                                </div>
                                                <a href="#">&nbsp;</a>
                                            </div>
                                            <div class="upadate-project description">
                                                &nbsp;
                                            </div>
                                        </div><!-- /widget-card -->
                                    </div>
                                </div>
                            </div><!-- /panel -->
                        </div>
                        @endif
                        <?php $i = 1; ?>
                        @foreach($albums as $album)
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body nopadding">
                                        <div class="widget-card">
                                            @if($album->previewImage()->first() != null)
                                                <div class="wrap-widget-cover">
                                                    <div class="widget-card-bg" style="background-image: url('{!! $album->previewImage()->first()->albumUrl($user->id,280,220) !!}');" title="{{ $album->name }}">
                                                        <a href="{{ url($timeline->username.'/album/show/'.$album->id) }}"></a>
                                                    </div>
                                                </div>
                                            @elseif ($album->photos()->first() != null)
                                                <div class="wrap-widget-cover">
                                                    <div class="widget-card-bg" style="background-image: url('{{ $album->photos()->first()->albumUrl($user->id,280,220) }}');" title="{{ $album->name }}">
                                                        <a href="{{ url($timeline->username.'/album/show/'.$album->id) }}"></a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="wrap-widget-cover">
                                                    <div class="widget-card-bg" style="background-image: url('');" title="{{ $album->name }}">
                                                        <a href="{{ url($timeline->username.'/album/show/'.$album->id) }}"></a>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="widget-card-project">
                                                <div class="bridge-text">
                                                    <div class="pull-right">
                                                        <span class="label label-info">{{ $album->privacy }}</span>
                                                    </div>
                                                    <a href="{{ url($timeline->username.'/album/show/'.$album->id) }}">{{ $album->name }} </a>
                                                </div>
                                                <div class="upadate-project description">
                                                    {{ str_limit($album->about, $limit = 39, $end = '...') }}
                                                </div>
                                                {{--<div class="upadate-project">--}}
                                                    {{--{{ trans('common.last_updated') }} : <span> {{ date('d M y', strtotime($album->updated_at)) }}--}}
                                                    {{--</span>--}}
                                                {{--</div>--}}

                                            </div><!-- /widget-card -->
                                        </div>
                                    </div>
                                </div><!-- /panel -->
                            </div>
                            @if($i % 3 == 0)
                </div>
                <div class="row album-row lightgallery">
                    @endif
                    <?php $i++; ?>
                    @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="no-album-block">
                                <i class="icon-papka svoe-4x svoe-icon"></i>
                                <p>У пользователя еще нет фотографий</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div><!-- /col-md-10 -->

    </div>
</div><!-- /container -->

<!-- /main-section -->