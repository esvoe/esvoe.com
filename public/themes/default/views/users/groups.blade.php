<div class="container container-grid">
    <div class="row">
        <div class="visible-lg col-lg-3 hide-1">
            {!! Theme::partial('advertising') !!}
        </div>
        <div class="col-lg-9 col-wallet">

                <div class="game-container">

                    <div class="row" style="margin: 0 -5px;" >

                        <div class="col-xs-12 games-search-box" style="padding: 0 5px;">

                            <!-- my group -->
                            <div class="games-search-box games-search-box_cat">
                                
                                <div class="groups-box-head">
                                    <div class="side-right">
                                        <a href="{{ url(Auth::user()->username.'/create-group') }}" class="groups-create-btn"><i class="icon-prisoidenitsa svoe-icon"></i>{{ trans('common.create_group') }}</a>
                                    </div>
                                    <div class="groups-title">
                                        <i class="icon-grupy svoe-icon"></i>{{ trans('messages.groups-manage') }}
                                    </div>
                                    <!-- <a href="#" class="groups-box-head-link">Смотреть все<i class="icon-strilka svoe-icon"></i></a> -->
                                </div>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active">
                                        <div class="row" style="margin: 0 -5px;">

                                            @if(Auth::user()->own_groups()->count())
                                                <div class="wrap-group-col">
                                                    <div class="row">
                                                        @foreach(Auth::user()->own_groups() as $group)
                                                        <div class="col-xs-6 col-md-4 groups-item">
                                                            <div class="wrap-one-group-prof">
                                                                <div class="photo-group-col"  style="background-image: url('{{ '/group/cover/'.$group['cover'] }}');">
                                                                    <div>
                                                                        {{--
                                                                        @foreach($group['friends'] as $friend)
                                                                        <div class="your-group-friend" style="background-image: url('{{ $friend->avatar }}')">
                                                                            <a href="{{ url($friend->username) }}"></a>
                                                                        </div>
                                                                        @endforeach
                                                                        --}}
                                                                    </div>
                                                                </div>                                                 
                                                                <div class="content-group-col">
                                                                    <p><a href="{{ url($group['username']) }}">{{ $group['name'] }}</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
                                                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> {{ number_format($group['members_count'], 0, '', ' ') }} ({{ number_format($group['friends_count'], 0, '', ' ') }} {{ trans('timeline.of_friends_lcf') }})</span>
                                                                    <div class="btn-group-col">
                                                                        @if($group['notMember'])
                                                                        <a href="">
                                                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                                                            {{ trans('common.join') }}
                                                                        </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                    
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="wrap-group-more">
                                                    <a href="#">Показати ще...</a>
                                                </div> 

                                            @else
                                                <div class="groups-empty">
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
                                                    {{ trans('messages.no_groups') }}
                                                </div>
                                            @endif  
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /games-search-box games-search-box_cat -->


                            <!-- suggested group -->
                            <div class="games-search-box games-search-box_cat">
                                
                                <div class="groups-box-head">
                                    <div class="groups-title">
                                        <i class="icon-grupy svoe-icon"></i>{{ trans('common.suggested_groups') }}
                                    </div>
                                </div>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active">
                                        <div class="row" style="margin: 0 -5px;">
                                            {{--
                                            @if(Auth::user()->suggested_groups()->count())
                                                <div class="wrap-group-col">
                                                    <div class="row">
                                                        @foreach(Auth::user()->suggested_groups() as $group)
                                                        <div class="col-xs-6 col-md-4 groups-item">
                                                            <div class="wrap-one-group-prof">
                                                                <div class="photo-group-col"  style="background-image: url('{{ '/group/cover/'.$group['cover'] }}');">
                                                                    <div>
                                                                        @foreach($group['friends'] as $friend)
                                                                        <div class="your-group-friend" style="background-image: url('{{ $friend->avatar }}')">
                                                                            <a href="{{ url($friend->username) }}"></a>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>                                                 
                                                                <div class="content-group-col">
                                                                    <p><a href="{{ url($group['username']) }}">{{ $group['name'] }}</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
                                                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> {{ number_format($group['members_count'], 0, '', ' ') }} ({{ number_format($group['friends_count'], 0, '', ' ') }} {{ trans('timeline.of_friends_lcf') }})</span>
                                                                    <div class="btn-group-col">
                                                                        @if($group['notMember'])
                                                                        <a href="">
                                                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                                                            {{ trans('common.join') }}
                                                                        </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                    
                                                        @endforeach
                                                    </div>
                                                </div>

                                            @else
                                                <div class="groups-empty">
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
                                                    {{ trans('messages.no_groups') }}
                                                </div>
                                            @endif 
                                            --}}
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /games-search-box games-search-box_cat -->


                            <!-- in group -->
                            <div class="games-search-box games-search-box_cat">                           
                                <div class="groups-box-head">
                                    <div class="groups-title">
                                        <i class="icon-grupy svoe-icon"></i>{{ trans('common.joined_groups') }}
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active">
                                        <div class="row" style="margin: 0 -5px;">


                                            @if(Auth::user()->joinedGroups()->count())
                                                <div class="wrap-group-col">
                                                    <div class="row">
                                                        @foreach(Auth::user()->joinedGroups() as $group)
                                                        <div class="col-xs-6 col-md-4 groups-item">
                                                            <div class="wrap-one-group-prof">
                                                                <div class="photo-group-col"  style="background-image: url('{{ '/group/cover/'.$group['cover'] }}');">
                                                                    <div>
                                                                        {{--
                                                                        @foreach($group['friends'] as $friend)
                                                                        <div class="your-group-friend" style="background-image: url('{{ $friend->avatar }}')">
                                                                            <a href="{{ url($friend->username) }}"></a>
                                                                        </div>
                                                                        @endforeach
                                                                        --}}
                                                                    </div>
                                                                </div>                                                 
                                                                <div class="content-group-col">
                                                                    <p><a href="{{ url($group['username']) }}">{{ $group['name'] }}</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
                                                                    <span><i class="icon-grupy svoe-lg svoe-icon"></i> {{ number_format($group['members_count'], 0, '', ' ') }} ({{ number_format($group['friends_count'], 0, '', ' ') }} {{ trans('timeline.of_friends_lcf') }})</span>
                                                                    <div class="btn-group-col page-links">
                                                                        @if($group['notMember'])
                                                                        <a href="">
                                                                            <i class="icon-prisoidenitsa svoe-icon"></i>
                                                                            {{ trans('common.join') }}
                                                                        </a>
                                                                        @endif

                                                                        <a class="btn group-join joined" href="#" data-timeline-id="{{ $group->timeline_id }}">
                                                                            <i class="fa fa-check"></i> {{ trans('common.joined') }}
                                                                        </a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                    
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                <div class="groups-empty">
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
                                                    {{ trans('messages.no-joined-goups') }}
                                                </div>                                              
                                            @endif                                            

                                        </div>
                                    </div>
                                </div>
                            </div><!-- /games-search-box games-search-box_cat -->

                        </div><!-- / games-search-box -->
                    </div>
                </div>
        </div>
    </div>
</div>