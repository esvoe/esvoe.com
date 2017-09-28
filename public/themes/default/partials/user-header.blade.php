<div class="profheader-wrapper">
	<div class="profheader" id="profheader" data-userid="{{ $user->id }}">

	    <div class="profheader-ava">

	    	<div class="profheader-ava-wrapper">
	        	<img class="profheader-ava-img" src="{{ $user->avatar }}" alt="{{ $user->name }}" title="{{ $user->name }}" />

	        	@if($timeline->id == Auth::user()->timeline_id)
		        <div class="chang-user-avatar">
		            <a href="#" class="btn btn-camera change-avatar"><i class="icon-photo svoe-icon"></i><span class="avatar-text">{{ trans('common.update_avatar') }}</span></a>
		        </div>
				@endif
		        <div class="user-avatar-progress hidden"></div>
	    	</div>	

			@if(Auth::id() != $user->id)
	        <div class="profheader-ctrl">

	        	<!-- case 0 : confirm request for friendship -->
	            <div class="profheader-ctrl-item" data-role="friend-request" @if($type_friend != 4) style="display: none;" @endif>
	            	<div class="dropdown">
		                <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		                    <i class="icon-druzhyty svoe-lg svoe-icon"></i>
		                    <span class="profheader-ctrl-text">{{ trans('friend.want_friend') }}</span>
		                </a>
		                <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
	                        <li>
	                            <a data-action="friend-accept" href="#" class="">
	                                <i class="icon-prinyat svoe-icon"></i>{{ trans('friend.accept') }}
	                            </a>
	                        </li>
	                        <li>
	                            <a data-action="friend-cancel" href="#" class="">
	                                <i class="icon-vidpysatys svoe-icon"></i>{{ trans('friend.decline') }}
	                            </a>
	                        </li>
	                    </ul>
					</div>
	            </div>

				<!-- case 1 : add to friend -->
	            <div class="profheader-ctrl-item" data-role="add-to-friend" @if($type_friend != 0) style="display: none;" @endif>
	                <a data-action="add" href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend">
	                    <i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
	                    <span class="profheader-ctrl-text">{{ trans('friend.add_to_friends') }}</span>
	                </a>
	            </div>

	            <!-- case 2 : not allowed, cancel adding -->
	            <div class="profheader-ctrl-item" data-role="not-allowed" @if($type_friend != 1) style="display: none;" @endif>
	            	<div class="dropdown">
		                <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		                    <i class="icon-chekaty svoe-lg svoe-icon"></i>
		                    <span class="profheader-ctrl-text">{{ trans('friend.not_confirmed') }}</span>
		                </a>
		                <ul class="dropdown-menu profheader-ctrl-dropdown">
	                        <li>
	                            <a data-action="cancel" href="#" class="">
	                                <i class="icon-vidpysatys svoe-icon"></i>{{ trans('friend.cancel_request') }}
	                            </a>
	                        </li>
	                    </ul>
					</div>
	            </div>

	            <!-- case 3 : your friend -->
	            <div class="profheader-ctrl-item" data-role="your-friend" @if($type_friend != 3) style="display: none;" @endif>
	            	<div class="dropdown">
		                <a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		                    <i class="icon-prinyat svoe-lg svoe-icon"></i>
		                    <span class="profheader-ctrl-text">{{ trans('friend.in_your_friends') }}</span>
		                </a>
		                <ul class="dropdown-menu profheader-ctrl-dropdown">
	                        <li>
	                            <a data-action="delete" href="#" class="dropdown-unclosed">
	                                <i class="icon-vidpysatys svoe-icon"></i>{{ trans('friend.delete_from_friends') }}
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                        	<form name="user-status-form">
		                            <a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
		                                <i class="icon-strilka svoe-icon"></i>{{ trans('friend.friendship_status') }}
		                            </a>
		                            
		                            <ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">

                                        @foreach(config('friend.status') as $status)
		                            	<li class="profheader-ctrl-submenu-item">
		                            		<label for="{{$status}}">
		                            			<span class="wrap-checker-sett">
		                            				<input data-action="status" type="checkbox" name="status" id="{{$status}}" value="{{$status}}" @if(isset($curStatuses) AND strpos($curStatuses, $status)!==FALSE) checked="checked" @endif />
		                            			</span>
		                            			{{ trans('friend.status_'.$status) }}
		                            		</label>
		                            	</li>
                                        @endforeach
		                            </ul>
								</form>
	                        </li>
	                        <li>
	                            <form name="user-relative-form">
		                            <a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
		                                <i class="icon-strilka svoe-icon"></i>{{ trans('friend.relatives') }}
		                            </a>
		                            
		                            <ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
										@if (isset($available_relative))
                                        @foreach($available_relative as $rl => $rlValue)
                                            <li class="profheader-ctrl-submenu-item">
                                                <label for="{{$rl}}">
		                            			<span class="wrap-checker-sett">
		                            				<input data-action="relative" type="radio" name="relative" id="{{$rl}}" value="{{$rl}}" @if($rlValue == $curRelative) checked="checked" @endif />
		                            			</span>
                                                    {{ trans('friend.rl_'.$rl) }}
                                                </label>
                                            </li>
                                        @endforeach
											@else
											<small> --- </small>
										@endif
		                            </ul>
								</form>
	                        </li>
	                    </ul>
					</div>
	            </div>


                @if($type_friend != 2)
	            <div class="profheader-ctrl-item profheader-ctrl-item___message">
	                <a href="#" class="profheader-ctrl-btn profheader-ctrl-message" onClick="chatBoxes.showChatBox({{ $dialog_id }}, {{ $user->id }})">
	                	<i class="icon-povidomlennia svoe-lg svoe-icon"></i>
	                    <span class="profheader-ctrl-text">{{ trans('common.message') }}</span>
	                </a>
	            </div>
                @endif

	            <div class="profheader-ctrl-item">
	                <div class="dropdown">
	                    <a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	                        <i class="icon-menyu svoe-lg svoe-icon"></i>
	                    </a>
	                    <ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">

	                        <li>
	                            <a data-action="subscribe" href="#" @if($is_follower) style="display: none;" @endif>
	                                <i class="icon-pidpysatysya svoe-icon"></i>{{ trans('friend.subscribe') }}
	                            </a>
	                        </li>

	                        <li>
	                            <a data-action="unsubscribe" href="#" @if(!$is_follower) style="display: none;" @endif>
	                                <i class="icon-vidpysatys svoe-icon"></i>{{ trans('friend.unsubscribe') }}
	                            </a>
	                        </li>


                            @if($type_friend == 2)
	                        <li class="divider"></li>
	                        <li>
	                            <a data-action="claim" href="#" class="sub">
	                                <i class="icon-poskarzhytysya svoe-icon"></i>{{ trans('friend.report') }}
	                            </a>
	                        </li>
	                        <li>
	                            <a data-action="block" href="#" class="sub">
	                                <i class="icon-zablokuvaty svoe-icon"></i>{{ trans('friend.block') }}
	                            </a>
	                        </li>
                            @endif
	                    </ul>
	                </div>
	            </div>
	        </div> <!-- /profheader-ctrl -->
			@endif
			<div class="profheader-ctrl-bg"></div>
	    </div> <!-- /profheader-ava -->



	    <div class="clearfix"></div>

	    <div class="profheader-bg" style="background-image: url(@if($timeline->cover_id) {{ url('user/cover/'.$timeline->cover->source) }} @else {{ url('user/cover/default-cover-user.png') }} @endif" title="{{ $user->name }}">
	    	@if($timeline->id == Auth::user()->timeline_id)
				<a href="#" class="btn btn-camera-cover change-cover">
					<i class="icon-photo svoe-icon"></i>
					<span class="change-cover-text">{{ trans('common.change_cover') }}</span>
				</a>
			@endif
	        <div class="user-cover-progress hidden"></div>
	    </div>

	    <div class="profheader-content">
	        <div class="profheader-text">

	            <div class="profheader-name">
	            	{{ $user->name }}
					{!! verifiedBadge($timeline) !!}
				</div>
	            <div class="profheader-note">{{ $user->about }}</div>
	            <div class="profheader-status online">В мережі 20:32</div>

	        </div>
	        <div class="profheader-nav">

	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profheader-navbar-collapse" aria-expanded="false">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>

	            <div class="navbar-collapse collapse" id="profheader-navbar-collapse" aria-expanded="false">
	                <ul class="nav nav-tabs nav-justified" role="tablist">
	             
						<!-- Летопись (Главная) -->
	                    <li role="presentation" class="active"><a href="#tab-chronicle" class="life-line" aria-controls="tab-chronicle" role="tab" data-toggle="tab">{{ trans('sidebar.my_chronicle') }}</a></li>

	                    <!-- Информация -->
						<!--<li role="presentation"><a href="#tab-info" aria-controls="tab-info" role="tab" data-toggle="tab">{{ trans('sidebar.my_info') }}</a></li>-->

	                    <!-- Друзья (3 общих) -->
	                    <li role="presentation" class="{{ Request::segment(2) == 'groups' ? 'active' : '' }}"><a href="#tab-friends" aria-controls="tab-friends" role="tab" data-toggle="tab">{{ trans('sidebar.my_friends') }}</a></li>

	                    <!-- Группы -->
	                    <li role="presentation" class="{{ Request::segment(2) == 'groups' ? 'active' : '' }}"><a href="#tab-groups" aria-controls="tab-groups" role="tab" data-toggle="tab">{{ trans('sidebar.my_groups') }}</a></li>

						<!-- Страницы -->
	                    <li role="presentation" class="{!! (Request::segment(2)=='pages' ? 'active' : '') !!}"><a href="#tab-pages" aria-controls="tab-pages" role="tab" data-toggle="tab">{{ trans('sidebar.pages') }}</a></li>

						<!-- Фото -->
	                    <li role="presentation" class="{!! (Request::segment(2)=='photos' ? 'active' : '') !!}"><a href="#tab-photos" class="photo-shown-tab" aria-controls="tab-photos" role="tab" data-toggle="tab">{{ trans('sidebar.my_photos') }}</a></li>

						<!-- Видео -->
	                    <li role="presentation" class="{!! (Request::segment(2)=='videos' ? 'active' : '') !!}"><a href="#tab-videos" aria-controls="tab-videos" role="tab" data-toggle="tab">{{ trans('sidebar.my_videos') }}</a></li>

	                    
	                    <!-- MORE -->
						<li class="dropdown">
							<a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('sidebar.more') }}</a>

							<ul class="dropdown-menu profheader-dropdown">

								<!-- События -->
			                    <li role="presentation" class="{!! (Request::segment(2)=='events' ? 'active' : '') !!}"><a href="#tab-events" aria-controls="tab-events" role="tab" data-toggle="tab">{{ trans('sidebar.my_events') }}</a></li>

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

        // Fixed position Profile Header when scroll
        function profHeaderFix() {
			var $box = $('#profheader');
			var $boxWrapper = $('.profheader-wrapper');
			var topScroll = 233; //top scroll: 293 - 60 = 233
			var topOffset = -163; // top ofsset: - 223 - 60 = -163

			if ($(window).scrollTop() > topScroll) {
				$('body').addClass('profheader-fixed');
				$box.css({
				'position': 'fixed',
				'top': topOffset + 'px',
				'left': $boxWrapper.offset().left,
				'width': $boxWrapper.width()
				});
			} else {
				$('body').removeClass('profheader-fixed');
				$box.css({
				'position': 'relative',
				'top': 'auto',
				'left': 'auto',
				'width': ''
				});
			}
		}		
	  
		$(window).scroll(profHeaderFix);

		profHeaderFix();

		
		// Tabs
		$('.profheader-nav a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			//e.target // newly activated tab
			//e.relatedTarget // previous active tab
			//console.log( e.target );
			//console.log( e.target.href );
			console.log( e.target.attributes['aria-controls'].value );
		});

	
		// USER ACTION

		var userid = $('#profheader').data('userid');
			token  = $('meta[name="csrf_token"]').attr('content');

		var $btnAddToFriend = $('.profheader-ctrl-item[data-role="add-to-friend"]'),
			$btnNotAllowed  = $('.profheader-ctrl-item[data-role="not-allowed"]'),
			$btnYourFriend  = $('.profheader-ctrl-item[data-role="your-friend"]'),
			$btnFriendRequest  = $('.profheader-ctrl-item[data-role="friend-request"]'),
			$btnSubscribe  = $('.profheader-ctrl-item a[data-action="subscribe"]'),
			$btnUnsubscribe  = $('.profheader-ctrl-item a[data-action="unsubscribe"]'),
			$btnClaim  = $('.profheader-ctrl-item a[data-action="claim"]'),
			$btnBlock  = $('.profheader-ctrl-item a[data-action="block"]'),
			$btnDelete  = $('.profheader-ctrl-item a[data-action="delete"]'),
			$btnFriendAccept  = $('.profheader-ctrl-item a[data-action="friend-accept"]'),
			$btnFriendCancel  = $('.profheader-ctrl-item a[data-action="friend-cancel"]');

		var userRequest;

		var reqUrlUserAdd = '{{route('friend.add')}}', 				// ### DEBUG set real url's
			reqUrlUserDelete = '{{route('friend.delete')}}',
			reqUrlUserCancel = '{{route('friend.cancel')}}',	//cancel invite
			reqUrlUserFriendAccept = '{{route('friend.accept')}}',
			reqUrlUserFriendCancel = '{{route('friend.reject')}}',
			reqUrlUserSubscribe = '{{route('friend.follower.add')}}',
			reqUrlUserUnsubscribe = '{{route('friend.follower.remove')}}',
			reqUrlUserClaim = '{{route('friend.complain')}}',		    //complain
			reqUrlUserBlock = '{{route('friend.block')}}',				//block
			reqUrlUserStatus = '{{route('friend.setStatus')}}',       //set status
			reqUrlUserRelative = '{{route('friend.setRelative')}}';

		var userRelativeCache;

		// click n close dropdown
		$('.profheader-ctrl').on('click', 'a[data-action]', function(e){
			userAction( $(this).data('action') );
			e.preventDefault();
		});

		// click but not close dropdown (.dropdown-unclosed)
		$('.profheader-ctrl .dropdown-menu').click(function(e) {
			if ( $(e.target).is('.dropdown-unclosed') || $(e.target).is('.dropdown-unclosed *') ) {
				if ( $(e.target).is('a[data-action]') ) userAction( $(e.target).data('action') );
				e.stopPropagation();
			}
		});

		// input
		$('.profheader-ctrl').on('change', 'input[data-action]', function(e){
			userAction( $(this).data('action') );
		});	 

		function userAction(event) {
			console.log('user-action: ' + event);

			switch(event) {
				case 'add':
					user.add(userid);
					break;

				case 'cancel':
					user.cancel(userid);
					break;

				case 'subscribe':
					user.subscribe(userid);
					break;

				case 'unsubscribe':
					user.unsubscribe(userid);
					break;

				case 'claim':
					user.claim(userid);
					break;

				case 'block':
					user.block(userid);
					break;

				case 'delete':
					user.delete(userid);
					break;

				case 'relative':
					user.relative(userid);
					break;

				case 'status':
					user.status(userid);
					break;

				case 'friend-accept':
					user.friendAccept(userid);
					break;

				case 'friend-cancel':
					user.friendCancel(userid);
					break;
				
				default: 
					//console.log('unknown user-action...');
			}

		}

		var user = {
			add: function() {
				console.log('Request url: reqUrlUserAdd');
				$btnAddToFriend.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserAdd,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
					// ### DEBUG fake response for testing
					/*response = {
			            //'result': 'false'
			            'result': 'true'
			        }*/
				    console.log("ajax request done:", response);

				    if (response.result === "true") {
						$btnAddToFriend.hide().removeClass('wait');
						$btnNotAllowed.show();
						$btnSubscribe.hide(); // if add to friend auto subscribe
						$btnUnsubscribe.show();   	
				    } else {
						$btnAddToFriend.removeClass('wait');		       
				    }
				});

			}, // user.add()

			cancel: function() {
				console.log('Request url: reqUrlUserCancel');
				$btnNotAllowed.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserCancel,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
			    		$btnNotAllowed.hide().removeClass('wait');
			    		$btnAddToFriend.show();  
				    } else {
				    	$btnNotAllowed.removeClass('wait');
				    }
				});
			}, // user.cancel()

			subscribe: function() {
				console.log('Request url: reqUrlUserSubscribe');
				$btnSubscribe.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserSubscribe,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
			    		$btnSubscribe.hide().removeClass('wait');
			    		$btnUnsubscribe.show();
				    } else {
				    	$btnSubscribe.removeClass('wait');			       
				    }
				});
			}, // user.subscribe()

			unsubscribe: function() {
				console.log('Request url: reqUrlUserUnsubscribe');
				$btnUnsubscribe.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserUnsubscribe,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
				    	$btnUnsubscribe.hide().removeClass('wait');
						$btnSubscribe.show(); 
				    } else {
				    	$btnUnsubscribe.removeClass('wait');			       
				    }
				});
			}, // user.unsubscribe()

			claim: function() {
				console.log('Request url: reqUrlUserClaim');
				$btnClaim.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserClaim,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
				    	$btnClaim.removeClass('wait');
				    	$('body').click(); //close dropdown
				    } else {
				    	$btnClaim.removeClass('wait');		       
				    }
				});
			}, // user.claim()

			block: function() {
				console.log('Request url: reqUrlUserBlock');
				$btnBlock.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserBlock,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
				    	$btnBlock.removeClass('wait');
				    	$('body').click(); //close dropdown 
				    } else {
				    	$btnBlock.removeClass('wait');		       
				    }
				});

			}, // user.block()

			delete: function() {
				console.log('Request url: reqUrlUserDelete');
				$btnDelete.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserDelete,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);

				    if (response.result === "true") {
						$btnDelete.removeClass('wait');
						$btnYourFriend.hide();
						$btnAddToFriend.show();
				    } else {
				    	$btnDelete.removeClass('wait');		       
				    }
				});

			}, // user.delete()

			status: function() {
				console.log('Request url: reqUrlUserStatus');
				var $form = $('form[name="user-status-form"]');
				$form.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserStatus,
					data: $form.serialize() + '&user_id=' + userid + '&_token=' + token,
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
						$form.removeClass('wait');   	
				    } else {
				    	$form.removeClass('wait');		       
				    }
				});
			}, // user.status()

			relative: function() {
				console.log('Request url: reqUrlUserRelative');
				var $form = $('form[name="user-relative-form"]');
				if ( userRelativeCache != $form.serialize() ) {
					userRelativeCache = $form.serialize();
					$form.addClass('wait');
					userRequest = $.ajax({
						method: 'POST',
						url: reqUrlUserRelative,
						data: userRelativeCache + '&user_id=' + userid + '&_token=' + token,
					}).done(function(response) {
					    console.log("ajax request done:", response);
					    if (response.result === "true") {
							$form.removeClass('wait');   	
					    } else {
					    	$form.removeClass('wait');			       
					    }
					});
				} 

			}, // user.relative()

			friendAccept: function() {
				console.log('Request url: reqUrlUserFriendAccept');
				$btnFriendAccept.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserFriendAccept,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
						$btnFriendAccept.removeClass('wait');
						$btnFriendRequest.hide();
						$btnYourFriend.show();
				    } else {
				    	$btnFriendAccept.removeClass('wait');		       
				    }
				});

			}, // user.friendAccept()

			friendCancel: function() {
				console.log('Request url: reqUrlUserFriendCancel');
				$btnFriendCancel.addClass('wait');
				userRequest = $.ajax({
					method: 'POST',
					url: reqUrlUserFriendCancel,
					data: { 
						user_id: userid,
						_token: token
					}
				}).done(function(response) {
				    console.log("ajax request done:", response);
				    if (response.result === "true") {
						$btnFriendCancel.removeClass('wait');
						$btnFriendRequest.hide();
						$btnAddToFriend.show();
				    } else {
				    	$btnFriendCancel.removeClass('wait');		       
				    }
				});

			} // user.friendCancel()

		}; // user



    }); // ready end

	@if($timeline->background_id != NULL)
		$('body')
			.css('background-image', "url({{ url('/wallpaper/'.$timeline->wallpaper->source) }})")
			.css('background-attachment', 'fixed');
	@endif

</script>