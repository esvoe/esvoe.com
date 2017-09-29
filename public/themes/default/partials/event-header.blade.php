<div class="profheader-wrapper">
    <div class="profheader" id="profheader" data-eventid="{{ $event->id }}">

        <div class="profheader-bg profheader-bg_custom profheader-bg_event" style="background-image: url(@if($timeline->cover_id) {{ url('event/cover/'.$timeline->cover->source) }} @else {{ url('event/cover/default-cover-event.png') }} @endif" title="{{ $timeline->name }}">
            @if($timeline->event->is_eventadmin(Auth::user()->id, $event->id))
                <a href="#" class="btn btn-camera-cover btn-camera-cover_event change-cover">
                    <i class="icon-photo svoe-icon"></i>
                    <span class="change-cover-text">{{ trans('common.change_cover') }}</span>
                </a>
            @endif
            <div class="user-cover-progress hidden"></div>
        </div><!-- /profheader-bg profheader-bg_event -->

        <div class="profheader-event">
            <div class="profheader-event-date">
                <div class="profheader-event-day">
                    {{ date("d", strtotime($event->start_date)) }}
                </div>
                <div class="profheader-event-month">
                    {{ date("M", strtotime($event->start_date)) }}
                </div>              
            </div>
        </div><!-- /profheader-event -->

        <div class="profheader-content profheader-content_custom">
            <div class="profheader-text profheader-text_custom">

                <div class="row">
                    <div class="col-md-7">
                        <div class="profheader-name profheader-name_event">
                            {{ $timeline->name }}
                            {!! verifiedBadge($timeline) !!}
                        </div>
                    </div>
                    <div class="col-md-5 text-right">

                        <div class="profheader-btns">

                            <!-- case 0 event: init -->
                            <div class="dropdown ---hidden" data-role="event-action-init">
                                <button  class="dropdown-toggle btn-profheader" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    {{ trans('common.my_actions') }}<i class="icon-strilka svoe-icon dropdown-toggle-icon"></i>
                                </button >
                                <ul class="dropdown-menu profheader-ctrl-dropdown profheader-ctrl-dropdown_w100 dropdown-unclosed">
                                    <li>
                                        <a href="#" data-action="go" class="sub">
                                            <i class="icon-pereytu svoe-icon"></i>{{ trans('common.go') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-action="follow" class="sub">
                                            <i class="icon-pidpysatysya svoe-icon"></i>{{ trans('common.tofollow') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-action="no" class="sub">
                                            <i class="icon-vidpysatys svoe-icon"></i>{{ trans('common.not_interested') }}
                                        </a>
                                    </li>
                                </ul>                                
                            </div>

                            <!-- case 1 event: go -->
                            <div class="dropdown hidden" data-role="event-action-go">
                                <button  class="dropdown-toggle btn-profheader btn-profheader-selected" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="icon-pereytu svoe-icon"></i>{{ trans('common.go') }}
                                </button >
                                <ul class="dropdown-menu profheader-ctrl-dropdown profheader-ctrl-dropdown_w100 dropdown-unclosed">
                                    <li>
                                        <a href="#" data-action="follow" class="sub">
                                            <i class="icon-pidpysatysya svoe-icon"></i>{{ trans('common.tofollow') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-action="no" class="sub">
                                            <i class="icon-vidpysatys svoe-icon"></i>{{ trans('common.not_interested') }}
                                        </a>
                                    </li>
                                </ul>                                
                            </div>

                            <!-- case 2 event: follow -->
                            <div class="dropdown hidden" data-role="event-action-follow">
                                <button  class="dropdown-toggle btn-profheader btn-profheader-selected" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="icon-pidpysatysya svoe-icon"></i>{{ trans('common.tofollow') }}
                                </button >
                                <ul class="dropdown-menu profheader-ctrl-dropdown profheader-ctrl-dropdown_w100 dropdown-unclosed">
                                    <li>
                                        <a href="#" data-action="go" class="sub">
                                            <i class="icon-pereytu svoe-icon"></i>{{ trans('common.go') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-action="no" class="sub">
                                            <i class="icon-vidpysatys svoe-icon"></i>{{ trans('common.not_interested') }}
                                        </a>
                                    </li>
                                </ul>                                
                            </div>

                            <!-- case 3 event: no -->
                            <div class="dropdown hidden" data-role="event-action-no">
                                <button  class="dropdown-toggle btn-profheader btn-profheader-selected" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="icon-vidpysatys svoe-icon"></i>{{ trans('common.not_interested') }}
                                </button >
                                <ul class="dropdown-menu profheader-ctrl-dropdown profheader-ctrl-dropdown_w100 dropdown-unclosed">
                                    <li>
                                        <a href="#" data-action="go" class="sub">
                                            <i class="icon-pereytu svoe-icon"></i>{{ trans('common.go') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-action="follow" class="sub">
                                            <i class="icon-pidpysatysya svoe-icon"></i>{{ trans('common.tofollow') }}
                                        </a>
                                    </li>
                                </ul>                                
                            </div>

                            <a href="#" class="btn-profheader" id="bay_ticket_button">
                                <i class="icon-kvytky svoe-icon"></i>{{ trans('common.buy_ticket') }}
                                <form id="bay_ticket_form" method="post" action="https://e-tickets.esvoe.com/event/test/order">
                                    <input type="hidden" name="name" value="<?=Auth::user()->getNameAttribute('')?>">
                                    <input type="hidden" name="birthday" value="<?=Auth::user()->getBirthdayAttribute('')?>">
                                    <input type="hidden" name="email" value="<?=Auth::user()->email?>">
                                    <input type="hidden" name="phone" value="">
                                    <input type="hidden" name="event_link" value="<?=$event->eticket_event_id?>">
                                    <input type="hidden" name="cancel_redirect" value="https://sand.esvoe.com/">
                                    <input type="hidden" name="success_redirect" value="https://sand.esvoe.com/">
                                    <input type="hidden" name="result_url" value="https://sand.esvoe.com/">
                                    <input type="hidden" name="buy_access" value="true">
                                    <input type="hidden" name="pay_id" value="<?=Auth::user()->wallet->pay_id?>">
                                    <input type="hidden" name="userId" value="<?=Auth::user()->id?>">
                                    <input type="hidden" name="img" value="{{ Auth::user()->avatar }}">
                                </form>
                            </a>
                        </div> 

                    </div>
                </div>

            </div>
            <div class="profheader-nav profheader-nav_custom profheader-nav_event">

                <div class="row">
                    <div class="col-md-6">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profheader-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="navbar-collapse collapse" id="profheader-navbar-collapse" aria-expanded="false">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                         
                                <!-- 1 -->
                                <li role="presentation" class="active">
                                    <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">{{ trans('common.home') }}</a>
                                </li>

                                <!-- 2 -->
                                <li role="presentation">
                                    <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">{{ trans('common.guests') }}</a>
                                </li>   

                            </ul>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="group-ctrl">

                            <div class="comment-like-share share-post-new ---active-share-link">
                                <div class="count-commlikeshare show-users-modal">
                                    <i class="icon-podilutus svoe-icon"></i>
                                    <span class="count"></span>
                                </div>
                                <span class="share-link">{{ trans('common.share') }}</span>
                            </div>

                            <div class="dropdown dropdown-profheader">
                                <button class="dropdown-toggle" type="button" id="dropdownMenu-event" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="icon-menyu svoe-icon"></i>
                                </button>
                                <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-event">
                                    <li>
                                        <a href="#" class="">
                                            <i class="icon-bachymo svoe-icon"></i>Пункт меню 1
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#" class="">
                                            <i class="icon-vydalyty svoe-icon"></i>Пункт меню 2
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="">
                                            <i class="icon-zablokuvaty svoe-icon"></i>Пункт меню 3
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    
                    </div>
                </div>

            </div>
        </div><!-- /profheader-content -->

    </div> <!-- /profheader -->
</div> <!-- /profheader-wrapper -->

<!-- Change cover form -->
<form class="change-cover-form hidden" action="{{ url('ajax/change-cover') }}" method="post" enctype="multipart/form-data">
    <input name="timeline_id" value="{{ $timeline->id }}" type="hidden">
    <input name="timeline_type" value="{{ $timeline->type }}" type="hidden">
    <input class="change-cover-input hidden" accept="image/jpeg,image/png" type="file" name="change_cover" >
</form>



<!-- Tab panes -->
<!-- <div class="container container-grid section-container"> -->
    <div class="tab-content profheader-tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="tab-1">Tab 1 ...</div>
        <div role="tabpanel" class="tab-pane fade" id="tab-2">Tab 2 ...</div>
    </div>
<!-- </div> -->



<script type="text/javascript">

    $(function(){

        // Fixed position Profile Header Nav when scroll
        function profHeaderNavFix() {
            var $box = $('#profheader');
            var $nav = $box.find('.profheader-nav');
            var $boxBg = $box.find('.profheader-bg');
            var $boxWrapper = $('.profheader-wrapper');

            $boxWrapper.css('min-height', $boxBg.outerHeight() + $box.find('.profheader-text').outerHeight() + $nav.outerHeight() );

            var topScroll =  $boxWrapper.outerHeight() - $nav.outerHeight() + 6;
            var topOffset = 60;

            if ($(window).scrollTop() > topScroll) {
                $('body').addClass('profheader-fixed');
                $nav.css({
                'position': 'fixed',
                'top': topOffset + 'px',
                'left': $boxWrapper.offset().left,
                'width': $boxWrapper.width()
                });
            } else {
                $('body').removeClass('profheader-fixed');
                $nav.css({
                'position': 'relative',
                'top': 'auto',
                'left': 'auto',
                'width': ''
                });
            }
        }
      
        $(window).scroll(profHeaderNavFix);

        profHeaderNavFix();

        
        // Tabs
        $('.profheader-nav a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            //e.target // newly activated tab
            //e.relatedTarget // previous active tab
            //console.log( e.target );
            //console.log( e.target.href );
            console.log( e.target.attributes['aria-controls'].value );
        });

        // USER EVENT ACTION

        var eventid = $('#profheader').data('eventid');
            token  = $('meta[name="csrf_token"]').attr('content');

        var $btnsEvent = $('.profheader-btns .dropdown[data-role]'),
            $btnEventGo  = $('.profheader-btns .dropdown[data-role="event-action-go"]'),
            $btnEventFollow  = $('.profheader-btns .dropdown[data-role="event-action-follow"]'),
            $btnEventNo  = $('.profheader-btns .dropdown[data-role="event-action-no"]');

        var eventRequest;

        var reqUrlEventGo = '/ajax/get-foo', // ### DEBUG set real url's
            reqUrlEventFollow = '/ajax/get-foo',
            reqUrlEventNo = '/ajax/get-foo';    

        // click n close dropdown
        $('.profheader-btns').on('click', 'a[data-action]', function(e){
            eventAction( $(this).data('action') );
            e.preventDefault();
        });

        // click but not close dropdown (.dropdown-unclosed)
        $('.profheader-btns .dropdown-menu').click(function(e) {
            if ( $(e.target).is('.dropdown-unclosed') || $(e.target).is('.dropdown-unclosed *') ) {
                if ( $(e.target).is('a[data-action]') ) eventAction( $(e.target).data('action') );
                e.stopPropagation();
            }
        });

        function eventAction(action) {
            console.log('event-action: ' + action);

            switch(action) {
                case 'go':
                    event.go();
                    break;

                case 'follow':
                    event.follow();
                    break;

                case 'no':
                    event.no();
                    break;

                default: 
                    //console.log('unknown user-action...');
            }

        }

        var event = {
            go: function() {
                console.log('Request url: reqUrlEventGo');

                $btnsEvent.addClass('wait');

                eventRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlEventGo,
                    data: { 
                        event_id: eventid,
                        _token: token
                    }
                }).done(function(response) {
                    // ### DEBUG fake response for testing
                    response = {
                        'result': 'false'
                        //'result': 'true'
                    }
                    console.log("ajax request done:", response);

                    if (response.result === "true") {
                        $btnsEvent.addClass('hidden').removeClass('wait');
                        $btnEventGo.removeClass('hidden');  
                    } else {
                        $btnsEvent.removeClass('wait');
                        $('.dropdown.open').removeClass('open');              
                    }
                });

            }, // event.go()

            follow: function() {
                console.log('Request url: reqUrlEventFollow');

                $btnsEvent.addClass('wait');

                eventRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlEventFollow,
                    data: { 
                        event_id: eventid,
                        _token: token
                    }
                }).done(function(response) {
                    // ### DEBUG fake response for testing
                    response = {
                        //'result': 'false'
                        'result': 'true'
                    }
                    console.log("ajax request done:", response);

                    if (response.result === "true") {
                        $btnsEvent.addClass('hidden').removeClass('wait');
                        $btnEventFollow.removeClass('hidden');  
                    } else {
                        $btnsEvent.removeClass('wait');
                        $('.dropdown.open').removeClass('open');                
                    }
                });

            }, // event.follow()

            no: function() {
                console.log('Request url: reqUrlEventNo');

                $btnsEvent.addClass('wait');

                eventRequest = $.ajax({
                    method: 'POST',
                    url: reqUrlEventNo,
                    data: { 
                        event_id: eventid,
                        _token: token
                    }
                }).done(function(response) {
                    // ### DEBUG fake response for testing
                    response = {
                        //'result': 'false'
                        'result': 'true'
                    }
                    console.log("ajax request done:", response);

                    if (response.result === "true") {
                        $btnsEvent.addClass('hidden').removeClass('wait');
                        $btnEventNo.removeClass('hidden');  
                    } else {
                        $btnsEvent.removeClass('wait');
                        $('.dropdown.open').removeClass('open');               
                    }
                });

            }, // event.no()

        }; // event

    });

    @if($timeline->background_id != NULL)
        $('body')
        .css('background-image', "url({{ url('/wallpaper/'.$timeline->wallpaper->source) }})")
        .css('background-attachment', 'fixed');

    @endif

</script>