<div class="profheader-wrapper">
	<div class="profheader" id="profheader">

	    <div class="profheader-bg profheader-bg_custom" style="background-image: url(@if($timeline->cover_id) {{ url('group/cover/'.$timeline->cover->source) }} @else {{ url('group/cover/default-cover-group.png') }} @endif" title="{{ $timeline->name }}">
	    	@if($timeline->groups->is_admin(Auth::user()->id) == true)
				<a href="#" class="btn btn-camera-cover change-cover">
					<i class="icon-photo svoe-icon"></i>
					<span class="change-cover-text">{{ trans('common.change_cover') }}</span>
				</a>
			@endif
	        <div class="user-cover-progress hidden"></div>
	    </div>

	    <div class="profheader-content profheader-content_custom">
	        <div class="profheader-text profheader-text_custom">

		        <div class="row">
		        	<div class="col-md-7">
		        		<div class="profheader-name profheader-name_group">
			            	{{ $timeline->name }}
							{!! verifiedBadge($timeline) !!}
						</div>
			            <div class="profheader-status profheader-status_group">
			            	<i class="icon-vidkryto svoe-icon"></i>{{ trans('common.open_group') }}
			            	<!-- <i class="icon-zakryto svoe-icon"></i>{{ trans('common.closed_group') }} -->
			            	<!-- <i class="icon-sekret svoe-icon"></i>{{ trans('common.secret_group') }} -->
			            </div>
		        	</div>
		        	<div class="col-md-5 text-right">

		        		<div class="group-users">
							<div class="user-avatar" style="background-image: url('/user/avatar/2017-09-15-17-19-57competition-photo.jpg')">
								<a href="https://sand.esvoe.com/balani" title="Балан"></a>
							</div>
							<div class="user-avatar" style="background-image: url('/group/avatar/default-group-avatar.png')">
								<a href="https://sand.esvoe.com/balani" title="Балан"></a>
							</div>
							<div class="user-avatar" style="background-image: url('/group/avatar/default-group-avatar.png')">
								<a href="https://sand.esvoe.com/balani" title="Балан"></a>
							</div>
							<div class="user-avatar" style="background-image: url('/user/avatar/2017-09-15-17-19-57competition-photo.jpg')">
								<a href="https://sand.esvoe.com/balani" title="Балан"></a>
							</div>
							<div class="user-avatar" style="background-image: url('/user/avatar/2017-09-15-17-19-57competition-photo.jpg')">
								<a href="https://sand.esvoe.com/balani" title="Балан"></a>
							</div>
							<a href="#" class="user-more">+15</a>
		        		</div>
		        		<div class="clearfix"></div>
		        		<div class="group-total">
		        			<i class="icon-grupy svoe-icon"></i>{{ trans('common.in_group') }} 158 (16 {{ trans('common.hasfriends') }})
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
			             
								<!-- 1 -->
			                    <li role="presentation" class="active">
		                            <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">{{ trans('common.all_posts') }}</a>
		                        </li>

			                    <!-- 2 -->
			                    <li role="presentation">
		                            <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">{{ trans('common.members') }}</a>
		                        </li>

			                    <!-- 3 -->
			                    <li role="presentation" class="">
		                            <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">{{ trans('sidebar.my_events') }}</a>
		                        </li>

			                    <!-- 4 -->
			                    <li role="presentation" class="">
		                            <a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab">{{ trans('sidebar.my_photos') }}</a>
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

							<a href="#" class="btn-profheader">
								<i class="icon-dodaty-druzi svoe-icon"></i><span>{{ trans('common.join') }}</span>
							</a>							

		        		</div>
					
		        	</div>
		        </div>

	        </div>
	    </div>

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
	<div role="tabpanel" class="tab-pane fade" id="tab-3">Tab 3 ...</div>
	<div role="tabpanel" class="tab-pane fade" id="tab-4">Tab 4 ...</div>
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

	});

	@if($timeline->background_id != NULL)
		$('body')
		.css('background-image', "url({{ url('/wallpaper/'.$timeline->wallpaper->source) }})")
		.css('background-attachment', 'fixed');

	@endif

</script>