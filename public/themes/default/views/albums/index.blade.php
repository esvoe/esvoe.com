<!-- main-section -->

<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {{--{!! Theme::partial('home-leftbar',compact('trending_tags')) !!}--}}
            {!! Theme::partial('advertising') !!}
        </div>

        <div class="col-lg-9 col-row-1">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading no-bg user-pages no-paddingbottom navbars">
                    <div class="page-heading header-text">
                        {{ trans('common.all_albums') }}
                    </div>
                    @if(Auth::user()->id == $timeline->user->id)
                        <div class="pull-right">
                            <a href="{{ url('/'.Auth::user()->username.'/album/create') }}" class="btn btn-success btn-downloadreport create-album-btn">{{ trans('common.create_album') }}</a>
                        </div>
                    @endif
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="row">
                @if(count($albums) > 0)
                    <?php $i = 1; ?>
                    @foreach($albums as $album)
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body nopadding">
                                    <div class="widget-card">
                                        <div class="widget-card-bg">
                                            <a href="{{ url($timeline->username.'/album/show/'.$album->id) }}">
                                                @if($album->previewImage()->first() != null)
                                                    <img src="{!! $album->previewImage()->first()->albumUrl($timeline->username,280,220) !!}" alt="{{ $album->name }}" title="{{ $album->name }}">
                                                @elseif ($album->photos()->first() != null)
                                                    <img src="{{ $album->photos()->first()->albumUrl($timeline->username,280,220) }}" alt="{{ $album->name }}" title="{{ $album->name }}">
                                                @else
                                                    <img src="#" alt="{{ $album->name }}" title="{{ $album->name }}">
                                                @endif
                                            </a>
                                        </div>
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
                                            <div class="upadate-project">
                                                {{ trans('common.last_updated') }} : <span> {{ date('d M y', strtotime($album->updated_at)) }}
                                        </span>
                                            </div>

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
                        <div class="alert alert-warning">
                            {{ trans('messages.no_albums') }}
                        </div>
                    </div>
                @endif
            </div>

        </div><!-- /col-md-10 -->

    </div>
</div><!-- /container -->

<!-- /main-section -->