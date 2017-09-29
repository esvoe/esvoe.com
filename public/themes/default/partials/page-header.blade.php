<div class="profheader-wrapper">
    <div class="profheader" id="profheader">

        <div class="profheader-ava">

            <div class="profheader-ava-wrapper">
                <img class="profheader-ava-img" src=" @if($timeline->avatar_id) {{ url('page/avatar/'.$timeline->avatar->source) }} @else {{ url('page/avatar/default-page-avatar.png') }} @endif" alt="{{ $timeline->name }}" title="{{ $timeline->name }}" />

                @if($timeline->page->is_admin(Auth::user()->id) == true)
                <div class="chang-user-avatar">
                    <a href="#" class="btn btn-camera change-avatar"><i class="icon-photo svoe-icon"></i><span class="avatar-text">{{ trans('common.update_avatar') }}</span></a>
                </div>
                @endif
                <div class="user-avatar-progress hidden"></div>
            </div>  

            <div class="profheader-ctrl-bg"></div>
        </div> <!-- /profheader-ava -->

        <div class="clearfix"></div>

        <div class="profheader-bg profheader-bg_page" style="background-image: url(@if($timeline->cover_id) {{ url('page/cover/'.$timeline->cover->source) }} @else {{ url('page/cover/default-cover-page.png') }} @endif" title="{{ $timeline->name }}">
            @if($timeline->page->is_admin(Auth::user()->id) == true)
                <a href="#" class="btn btn-camera-cover change-cover">
                    <i class="icon-photo svoe-icon"></i>
                    <span class="change-cover-text">{{ trans('common.change_cover') }}</span>
                </a>
            @endif
            <div class="user-cover-progress hidden"></div>
        </div>

        <div class="profheader-content profheader-content_custom profheader-content_page">
            <div class="profheader-text">

            	<div class="row">
            		<div class="col-md-7">
            			<div class="profheader-name profheader-name_page">
		                    {{ $timeline->name }}
		                    {!! verifiedBadge($timeline) !!}
		                </div>
            		</div>
            		<div class="col-md-5 text-right">

                        <div class="rating">
                            <span>4,7</span>
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
                            <span class="voted hidden-xs hidden-sm">(967)</span>
                        </div>

                        <div class="btn-hover-wrap">
                            <a href="" class="btn-action-hover">
                                <i class="icon-igry svoe-icon"></i>
                                {{ trans('common.play') }}
                            </a>
                            <a href="" class="btn-action-hover show-action-hover hidden-action-hover">
                                <i class="icon-pidpysatysya svoe-icon"></i>
                                {{ trans('friend.subscribe') }}
                            </a>
                        </div>

            		</div>
            	</div>		                

            </div>
            <div class="profheader-nav profheader-nav_custom">

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
		                 
		                        <!-- Главная -->
		                        <li role="presentation" class="active"><a href="#tab-chronicle" class="life-line" aria-controls="tab-chronicle" role="tab" data-toggle="tab">{{ trans('common.home') }}</a></li>

		                        <!-- Информация -->
		                        <li role="presentation"><a href="#tab-info" aria-controls="tab-info" role="tab" data-toggle="tab">{{ trans('sidebar.my_info') }}</a></li>

		                        <!-- События -->
		                        <li role="presentation" class="{!! (Request::segment(2)=='events' ? 'active' : '') !!}"><a href="#tab-events" aria-controls="tab-events" role="tab" data-toggle="tab">{{ trans('sidebar.my_events') }}</a></li>

		                        <!-- Фото -->
		                        <li role="presentation" class="{!! (Request::segment(2)=='photos' ? 'active' : '') !!}"><a href="#tab-photos" class="photo-shown-tab" aria-controls="tab-photos" role="tab" data-toggle="tab">{{ trans('sidebar.my_photos') }}</a></li>
		                        
		                        <!-- MORE -->
		                        <li class="dropdown">
		                            <a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('sidebar.more') }}</a>

		                            <ul class="dropdown-menu profheader-dropdown">

		                                <!-- Группы -->
		                                <li role="presentation" class="{{ Request::segment(2) == 'groups' ? 'active' : '' }}"><a href="#tab-groups" aria-controls="tab-groups" role="tab" data-toggle="tab">{{ trans('sidebar.my_groups') }}</a></li>

		                                <!-- Страницы -->
		                                <li role="presentation" class="{!! (Request::segment(2)=='pages' ? 'active' : '') !!}"><a href="#tab-pages" aria-controls="tab-pages" role="tab" data-toggle="tab">{{ trans('sidebar.pages') }}</a></li>

		                                <!-- Видео -->
		                                <li role="presentation" class="{!! (Request::segment(2)=='videos' ? 'active' : '') !!}"><a href="#tab-videos" aria-controls="tab-videos" role="tab" data-toggle="tab">{{ trans('sidebar.my_videos') }}</a></li>

		                                <!-- Закладки -->
		                                <li role="presentation" class="{!! (Request::segment(2)=='note' ? 'active' : '') !!}"><a href="#tab-bookmarks" aria-controls="tab-bookmarks" role="tab" data-toggle="tab">{{ trans('sidebar.my_bookmarks') }}</a></li>

		                                <!-- Музика -->
		                                <li role="presentation" class="{!! (Request::segment(2)=='audio-recordings' ? 'active' : '') !!}"><a href="#tab-audio" aria-controls="tab-audio" role="tab" data-toggle="tab">{{ trans('sidebar.my_audio_records') }}</a></li>

		                                <!-- Приложения -->
		                                <li role="presentation" class="{!! (Request::segment(2)=='apps' ? 'active' : '') !!}"><a href="#tab-apps" aria-controls="tab-apps" role="tab" data-toggle="tab">{{ trans('sidebar.attachments') }}</a></li>

		                            </ul>
		                        </li>           

		                    </ul>
		                </div>

					</div>
					<div class="col-md-6">

						<div class="group-ctrl">

                            <div class="comment-like-share like-post-new ---active-like-link">
                                <div class="count-commlikeshare show-users-modal">
                                    <i class="icon-like svoe-icon"></i>
                                    <span class="count"></span>
                                </div>
                                <span class="like-link" data-like="{{ trans('common.like') }}" data-unlike="{{ trans('common.liked') }}">{{ trans('common.like') }}</span>
                            </div>

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
        </div>

    </div> <!-- /profheader -->
</div> <!-- /profheader-wrapper -->

<!-- Change avatar form -->
<form class="change-avatar-form hidden" action="{{ url('ajax/change-avatar') }}" method="post" enctype="multipart/form-data">
	<input name="timeline_id" value="{{ $timeline->id }}" type="hidden">
	<input name="timeline_type" value="{{ $timeline->type }}" type="hidden">
	<input class="change-avatar-input hidden" accept="image/jpeg,image/png" type="file" name="change_avatar" >
</form>

<!-- Change cover form -->
<form class="change-cover-form hidden" action="{{ url('ajax/change-cover') }}" method="post" enctype="multipart/form-data">
	<input name="timeline_id" value="{{ $timeline->id }}" type="hidden">
	<input name="timeline_type" value="{{ $timeline->type }}" type="hidden">
	<input class="change-cover-input hidden" accept="image/jpeg,image/png" type="file" name="change_cover" >
</form>



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

        $('.rating-block').barrating({
            theme: 'fontawesome-stars'
        });

    }); // ready end

    @if($timeline->background_id != NULL)
        $('body')
        .css('background-image', "url({{ url('/wallpaper/'.$timeline->wallpaper->source) }})")
        .css('background-attachment', 'fixed');
    @endif

</script>
