<!-- main-section -->

	<div class="container container-grid section-container @if($timeline->hide_cover) no-cover @endif">
		<div class="row">
			<div class="col-md-12 profile-col">
				@if($timeline->type == "user")
					{!! Theme::partial('user-header',compact('user','timeline','liked_pages','joined_groups','isMe','type_friend','is_follower','available_relative', 'curStatuses', 'curRelative','requestInviteMe','followRequests','following_count','followers_count','follow_confirm','user_post','joined_groups_count','guest_events', 'dialog_id', 'counters')) !!}
				@elseif($timeline->type == "page")
					{!! Theme::partial('page-header',compact('page','timeline')) !!}
				@elseif($timeline->type == "group")
					{!! Theme::partial('group-header',compact('timeline','group')) !!}
				@elseif($timeline->type == "event")
					{!! Theme::partial('event-header',compact('event','timeline')) !!}
				@endif
			</div>
		</div>


		@if($timeline->type == "user")
		<div class="row">
			<div class="col-xs-12 profile-col">
				<!-- Tab panes -->
				<!-- <div class="container container-grid section-container"> -->
				<div class="tab-content profheader-tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="tab-chronicle">
						<div class="row">
							<div class="col-md-5  col-lg-4  col-grid-2">
								<div class="wrap-panel-prof">
									<div class="info-block-prof">
										<div class="title-info-prof">
											<i class="icon-informaciya svoe-icon" style="top: 2px;"></i>
											{{ trans('timeline.info') }}
										</div>
										<div class="info-contact-prof">
											@if((($user->about != NULL) && ($user->about != 'write something about yourself')) || $isMe)
												<div class="own-info-contact more-info-span-tab">
													<span><i class="fa fa-user" aria-hidden="true"></i>{{ trans('common.bio') }}:</span>
													<span>{{ $user->about }}</span>
												</div>
											@endif
											@if($user->hobbies != NULL || $isMe)
											<div class="own-info-contact more-info-span-tab">
												<span><i class="fa fa-gamepad" aria-hidden="true"></i>{{ trans('common.hobbies') }}:</span>
												<span>{{ $user->hobbies }}</span>
											</div>
											@endif
											@if($user->interests != NULL || $isMe)
											<div class="own-info-contact more-info-span-tab">
												<span><i class="fa fa-question" aria-hidden="true"></i>{{ trans('common.interests') }}:</span>
												<span>{{ $user->interests }}</span>
											</div>
											@endif
											@if($user->designation != NULL || $isMe)
											<div class="own-info-contact">
												<span><i class="fa fa-graduation-cap" aria-hidden="true"></i>{{ trans('common.designation') }}:</span>
												<span>{{ $user->designation }}</span>
											</div>
											@endif
											@if($user->birthday != NULL || $isMe)
											<div class="own-info-contact">
												<span><i class="fa fa-birthday-cake " style="top: 10px;" aria-hidden="true"></i>{{ trans('timeline.birthday') }}:</span>
												<span>{{ $user->birthday }}</span>
											</div>
											@endif
											@if($user->country != NULL || $isMe)
											<div class="own-info-contact">
												<span><i class="fa fa-globe " aria-hidden="true"></i>{{ trans('common.country') }}:</span>
												<span>{{ $user->country }}</span>
											</div>
											@endif
											@if($user->city != NULL || $isMe)
											<div class="own-info-contact">
												<span><i class="fa fa-home" aria-hidden="true"></i>{{ trans('timeline.city') }}:</span>
												<span>{{ $user->city }}</span>
											</div>
											@endif
											@if($user->custom_option1 != NULL && Setting::get('custom_option1') != NULL)
												<div class="own-info-contact">
													<span>{{ Setting::get('custom_option1') }}</span>
													<span>{{ $user->custom_option1 }}</span>
												</div>
											@endif
											@if($user->custom_option2 != NULL && Setting::get('custom_option2') != NULL)
												<div class="own-info-contact">
													<span>{{ Setting::get('custom_option2') }}</span>
													<span>{{ $user->custom_option2 }}</span>
												</div>
											@endif
											@if($user->custom_option3 != NULL && Setting::get('custom_option3') != NULL)
												<div class="own-info-contact">
													<span>{{ Setting::get('custom_option3') }}</span>
													<span>{{ $user->custom_option3 }}</span>
												</div>
											@endif
											@if($user->custom_option4 != NULL && Setting::get('custom_option4') != NULL)
												<div class="own-info-contact">
													<span>{{ Setting::get('custom_option4') }}</span>
													<span>{{ $user->custom_option4 }}</span>
												</div>
											@endif
											<div class="own-info-contact social-link-prof">
												@if($user->facebook_link != NULL)
													<a target="_blank" href="{{ $user->facebook_link }}" class="btn btn-facebook" style="background-color: #334f8d;"><i class="fa fa-facebook"></i></a>
												@endif
												@if($user->twitter_link != NULL)
													<a target="_blank" href="{{ $user->twitter_link }}" class="btn btn-twitter" style="background-color: #1a97f0;"><i class="fa fa-twitter"></i></a>
												@endif
												@if($user->dribbble_link != NULL)
													<a target="_blank" href="{{ $user->dribbble_link }}" class="btn btn-dribbble" style="background-color: #ea4c89;"><i class="fa fa-dribbble"></i></a>
												@endif
												@if($user->youtube_link != NULL)
													<a target="_blank" href="{{ $user->youtube_link }}" class="btn btn-youtube" style="background-color: #c61d1d;"><i class="fa fa-youtube"></i></a>
												@endif
												@if($user->instagram_link != NULL)
													<a target="_blank" href="{{ $user->instagram_link }}" class="btn btn-instagram" style="background-color: #f45538;"><i class="fa fa-instagram"></i></a>
												@endif
												@if($user->linkedin_link != NULL)
													<a target="_blank" href="{{ $user->linkedin_link }}" class="btn btn-linkedin" style="background-color: #0077b5;"><i class="fa fa-linkedin"></i></a>
												@endif
											</div>
										</div>
									</div>
								</div>
								@if($counters['photos'])
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="#">
											<i class="icon-photoalbomy svoe-icon" style="top: 23px;"></i>
											{{ trans('timeline.last_photos') }}
											<span onclick="location='{{ url('/'.Auth::user()->username.'/photos') }}'">{{ trans('common.all_photos') }}</span>
										</a>
									</div>
									<div class="last-photo-prof">
										<div class="row">
											@foreach($photos_last as $url)
											<div class="col-xs-6">
												<div class="chronicle" style="background-image: url('{{ $url }}');"></div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="{{ url('/'.Auth::user()->username.'/albums') }}">
											<i class="icon-photoalbomy svoe-icon" style="top: 22px;"></i>
											{{ trans('timeline.photoalbums') }}
											<span>({{ $counters['albums'] }} {{ trans('timeline.of_photoalbums') }})</span>
										</a>
									</div>
									<div class="album-prof-block album-last">
										<div class="row">
											@foreach($albums_last as $album)
											<div class="col-xs-6">
												<div class="wrap-album-prof-last">
													<div class="album-prof" href="#">
														<a href="{{ $album['href'] }}" style="background-image: url({{ $album['preview'] }})"></a>
													</div>
													<a href="{{ $album['href'] }}">{{ $album['name'] }}</a>
													<span>({{ $album['photos_count'] }} {{ trans('timeline.photo_lcf') }})</span>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
								@endif
								@if($counters['friends'])
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="{{ url($user->username.'/friends') }}">
											<i class="icon-druzi svoe-lg svoe-icon" style="top: 20px;left: 15px;"></i>
											{{ trans('timeline.friends') }}
											<span>({{ $counters['friends'] }} {{ trans('timeline.of_friends_lcf') }})</span>
										</a>
									</div>
									<div class="friend-prof-block">
										<div class="row">
											@foreach($friends_last as $friend)
											<div class="col-xs-4">
												<div class="own-friend-prof" style="background-image: url({{ $friend->avatar }})">
													<a href="{{ url($friend->username) }}">
														<span>{{ $friend->firstname }}<br>{{ $friend->lastname }}</span>
													</a>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
								@endif
								@if($counters['pages'])
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="{{ url($user->username.'/pages') }}">
											<i class="icon-storinky  svoe-icon" style="top: 22px;"></i>
											{{ trans('timeline.pages') }}
											<span class="show-all-title">{{ trans('timeline.all') }}</span>
										</a>
									</div>
									<div class="album-prof-block">
										<div class="row">
											@foreach($pages_last as $page)
											<div class="col-xs-6">
												<div class="own-page-rightbar">
													<div class="photo-page-rightbar" style="background-image: url({{ url('page/avatar/'.$page->avatar) }})">
														<a href="#"></a>
													</div>
													<div class="content-page-rightbar">
														<h4><a href="{{ 'page/'.$page->slug }}">{{ $page->name }}</a></h4>
														<p>{{ $page->category()->value('name') }}</p>
														<span><i class="icon-like  svoe-icon"></i> {{ $page->likes_count }}</span>
														<div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
															<div class="btn-follow page @if($page->liked) hidden @endif"><a href="#" class="btn btn-options btn-block btn-default page-like like" @if($page->liked) aria-hidden="true" @endif><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
															<div class="btn-follow page @if(!$page->liked) hidden @endif"><a href="#" class="btn btn-options btn-block btn-success page-like liked " ><i class="fa fa-heart" @if(!$page->liked) aria-hidden="true" @endif></i> <span>{{ trans('common.liked') }}</span></a></div>

															<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if($page->subscribed) hidden @endif">
																<i class="icon-pidpysatysya  svoe-icon"></i>
																{{ trans('friend.subscribe') }}
															</a>
															<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if(!$page->subscribed) hidden @endif">
																<i class="icon-vidpysatys svoe-icon"></i>
																{{ trans('friend.unsubscribe') }}
															</a>
														</div>
													</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
								@endif
								@if($counters['groups'])
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="#">
											<i class="icon-grupy svoe-lg svoe-icon" style="top: 21px;"></i>
											{{ trans('timeline.groups') }}
											<span class="show-all-title">{{ trans('timeline.all') }}</span>
										</a>
									</div>
									@foreach($groups_last->take(2) as $group)
									<div class="wrap-group-prof">
										<div class="wrap-padding-group">
											<div class="own-photo-group" style="background-image: url({{ url('group/cover/'.$group['cover']) }})">
												<a href="{{ url($group['username']) }}"></a>
												<div>
													@foreach($group['friends'] as $friend)
													<div class="your-group-friend" style="background-image: url({{ $friend->avatar }})">
														<a href="{{ url($friend->username) }}"></a>
													</div>
													@endforeach
												</div>
											</div>
											<div class="content-group-profile">
												<a href="{{ url($group['username']) }}"><i class="
													@if($group['type'] == 'closed')
															icon-zakryto
													@elseif($group['type'] == 'open')
															icon-vidkryto
													@else
															icon-secret
													@endif
															svoe-icon"></i> {{ $group['name'] }}
												</a>

												<div class="btn-joined-prof-group">
													<i class="icon-prisoidenitsa svoe-icon"></i> {{ trans('common.join') }}
												</div>
												<span>{{ $group['friends_count'] }} {{ trans('timeline.of_friends_lcf') }}</span>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								@endif
								@if($counters['events'])
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="#">
											<i class="icon-podii  svoe-icon" style="top: 23px;left: 19px;"></i>
											{{ trans('timeline.events') }}
											<span class="show-all-title">{{ trans('timeline.all') }}</span>
										</a>
									</div>
									@foreach($events_last->take(2) as $event)
									<div class="wrap-event-prof">
										<div class="photo-event-prof" style="background-image: url({{ url('event/cover/'.$event->cover) }})">
											<div class="shadow-event-prof">
												<div class="date-event-prof">
													<span class="number-date">{{ $event->start_date->format('d') }}</span>
													<span>{{ trans('timeline.at_month')[$event->start_date->format('n')] }}</span>
												</div>
											</div>
										</div>
										<a href="{{ url($event->timeline->username) }}">{{ $event->timeline->name }}</a>
										<span>{{ number_format($event->users()->count(), 0, '', ' ') }} {{ trans('timeline.of_participants') }}</span>
									</div>
									@endforeach
								</div>
								@endif
							</div>
							<div class="col-md-7  col-lg-5  col-grid-1">
								{{--<div style="height: 600px;background-color: #ccc;"></div>--}}
								<!-- Post box on timeline,page,group -->

										@if($timeline->type == "user" && $timeline_post == true)
											{!! Theme::partial('create-post',compact('timeline','user_post')) !!}

										<div class="timeline-posts">
											@if($user_post == "user" || $user_post == "page" || $user_post == "group")
												@if(count($posts) > 0)
													@foreach($posts as $post)
														{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
													@endforeach
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
												@endif
											@endif

											@if($user_post == "event")
												@if($event->type == 'private' && Auth::user()->get_eventuser($event->id) || $event->type == 'public')
													@if(count($posts) > 0)
														@foreach($posts as $post)
															{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
														@endforeach
													@else
														<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
													@endif
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.private_posts') }}</div>
												@endif
											@endif
										</div>
										@endif

							</div>
							<div class="visible-lg col-lg-3 hide-1">
								{!! Theme::partial('advertising') !!}
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-friends">
						<div class="row">
							<div class="visible-lg col-lg-3 hide-1">
								{!! Theme::partial('advertising') !!}
							</div>
							<div class="col-lg-9 col-wallet">
								<div class="wrap-content-tab">
									<div class="wrap-photo-tab">
										<ul class="nav nav-tabs" role="tablist">
											@foreach($relations as $relation => $users)
												@continue($isMe && ($relation == 'mutual_friends'))
											<li role="presentation" @if($loop->iteration == 1) class="active" @endif><a href="#tab-friend-{{ $loop->iteration }}" aria-controls="tab-friend-{{ $loop->iteration }}" role="tab" data-toggle="tab">{{ trans('timeline.'.$relation) }}</a></li>
											@endforeach
											<li class="grid-col-friend">
												<div class="search-friend-tab">
													<input type="text" class="form-control">
													<i class="icon-shukaty svoe-lg svoe-icon"></i>
												</div>
                                    <span class="sort-small">
                                        <i class="icon-sort-c svoe-sort svoe-icon"></i>
                                    </span>
                                    <span class="active-col-friend sort-big">
                                        <i class="icon-sort-d svoe-sort svoe-icon"></i>
                                    </span>
											</li>
										</ul>
										<div class="tab-content">
											@foreach($relations as $users)
											<div role="tabpanel" class="tab-pane fade @if($loop->iteration == 1) in active @endif" id="tab-friend-{{ $loop->iteration }}">
												<div class="wrap-friend-tab-prof">
													<div class="row small-tab-friend row-big-tab-friend">
														@foreach($users as $friend)
														<div class="col-sm-6">
															<div class="own-friend-tab-prof">
																<div class="bg-wall-friend-tab" style="background-image: url('{{ url('user/cover/'.$friend->cover) }}')" ></div>
																<div class="photo-friend-tab" style="background-image: url('{{ $friend->avatar }}')"></div>
																<div class="content-friend-tab">
																	<ul class="list-inline no-margin">
																		<li class="dropdown">
																			<a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																				<i class="icon-menyu svoe-lg svoe-icon"></i>
																			</a>
																			<ul class="dropdown-menu">
																				<li>
																					<a href="#">
																						{{ trans('common.report') }}
																					</a>
																				</li>
																			</ul>
																		</li>
																	</ul>
																	<div class="info-action-friend-tab">
																		<p><a href="{{ url($friend->username) }}">{{ $friend->name }}</a></p>
																		<span>{{ $friend->city }}</span>
																		<div class="count-friend-photo-block">
																			<div class="row">
																				<div class="col-xs-3">
																					<span>{{ $friend->profile->count_friend }}</span>
																					<p>{{ trans('timeline.of_friends_ucf') }}</p>
																				</div>
																				<div class="col-xs-4">
																					<span>{{ $friend->profile->count_follower }}</span>
																					<p>{{ trans('timeline.of_followers') }} </p>
																				</div>
																				<div class="col-xs-5">
																					<span>{{ $friend->photos_count }}</span>
																					<p>{{ trans('timeline.of_photos') }}</p>
																				</div>
																			</div>
																		</div>
																		@if($friend->id != Auth::id())
																		<div class="profheader-ctrl">
																			<!-- case 0 : confirm request for friendship -->
																			<div class="profheader-ctrl-item" data-role="friend-request" @if($friend->type_friend != 4) style="display: none;" @endif>
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-druzhyty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">{{ trans('friend.want_friend') }}</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a data-action="friend-accept" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend" >
																								<i class="icon-prinyat svoe-icon"></i>{{ trans('common.accept') }}
																							</a>
																						</li>
																						<li>
																							<a data-action="friend-cancel" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend">
																								<i class="icon-vidpysatys svoe-icon"></i>{{ trans('common.decline') }}
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 1 : add to friend -->
																			<div class="profheader-ctrl-item" data-role="add-to-friend" @if($friend->type_friend != 0) style="display: none;" @endif>
																				<a data-action="add" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
																					<i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">{{ trans('friend.add_to_friends') }}</span>
																				</a>
																			</div>
																			<!-- case 2 : not allowed, cancel adding -->
																			<div class="profheader-ctrl-item" data-role="not-allowed" @if($friend->type_friend != 1) style="display: none;" @endif>
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-chekaty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">{{ trans('friend.not_confirmed') }}</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="cancel" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend">
																								<i class="icon-vidpysatys svoe-icon"></i>{{ trans('friend.cancel_request') }}
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 3 : your friend -->
																			<div class="profheader-ctrl-item" data-role="your-friend" @if($friend->type_friend != 3) style="display: none;" @endif>
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-prinyat svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">{{ trans('friend.in_your_friends') }}</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="delete" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend dropdown-unclosed">
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
																												<div class="jq-checkbox" id="{{$status}}-styler">
																													<input data-action="status" data-user-id="{{$friend->id}}" class="ctrlFriend" type="checkbox" name="status" data-action-friend-status="{{$status}}" value="{{$status}}" @if(isset($friend->curStatuses) AND strpos($friend->curStatuses, $status)!==false) checked="checked" @endif /><div class="jq-checkbox__div"></div>
																												</div>
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
																													<div class="jq-radio" id="{{$rl}}-styler">
		                            																					<input data-action="relative"  data-user-id="{{$friend->id}}" class="ctrlFriend" type="radio" name="relative" data-action-friend-relative="{{$rl}}" value="{{$rl}}" @if($rlValue == $friend->curRelative) checked="checked" @endif /><div class="jq-radio__div"></div>
																													</div>
		                            																			</span>
																													{{ trans('friend.rl_'.$rl) }}
																												</label>
																											</li>
																										@endforeach
																									@else
																										<small> ---</small>
																									@endif
																								</ul>
																							</form>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<div class="profheader-ctrl-item profheader-ctrl-item___message">
																				<a data-action="subscribe"  data-user-id="{{$friend->id}}" href="#" class="ctrlFriend profheader-ctrl-btn profheader-ctrl-message" @if($friend->is_follower) style="display: none;" @endif>
																					<i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">{{ trans('friend.subscribe') }}</span>
																				</a>
																				<a data-action="unsubscribe" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend profheader-ctrl-btn profheader-ctrl-message" @if(!$friend->is_follower) style="display: none;" @endif>
																					<i class="icon-vidpysatys svoe-icon"></i>
																					<span class="profheader-ctrl-text">{{ trans('friend.unsubscribe') }}</span>
																				</a>
																			</div>
																			<div class="profheader-ctrl-item">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																						<i class="icon-menyu svoe-lg svoe-icon"></i>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a href="#" class="">
																								<i class="icon-povidomlennia svoe-icon"></i>{{ trans('friend.write_message') }}
																							</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																							<a data-action="claim" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend sub">
																								<i class="icon-poskarzhytysya svoe-icon"></i>{{ trans('common.report') }}
																							</a>
																						</li>
																						<li>
																							<a data-action="block" data-user-id="{{$friend->id}}" href="#" class="ctrlFriend sub">
																								<i class="icon-zablokuvaty svoe-icon"></i>{{ trans('friend.block') }}
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																		</div>
																		@endif
																	</div>
																</div>
															</div>
														</div>
														@endforeach
													</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-groups">
						<div class="wrap-content-tab">
							<div class="title-tab-prof">
								<i class="icon-grupy svoe-lg svoe-icon"></i>
								{{ trans('sidebar.my_groups') }}
								<div class="search-friend-tab search-other">
									<input type="text" class="form-control" style="display: none;">
									<i class="icon-shukaty svoe-icon"></i>
								</div>
							</div>
							<div class="wrap-group-col">
								<div class="row">
									@foreach($groups_last as $group)
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-group-prof">
											<div class="photo-group-col"  style="background-image: url('{{ 'group/cover/'.$group['cover'] }}');">
												<div>
													@foreach($group['friends'] as $friend)
													<div class="your-group-friend" style="background-image: url('{{ $friend->avatar }}')">
														<a href="{{ url($friend->username) }}"></a>
													</div>
													@endforeach
												</div>
											</div>
											<div class="content-group-col">
												<p><a href="{{ url($group['username']) }}">{{ $group['name'] }}</a><i style="left: 4px;" class="fa @if($group['type'] == 'open') fa-unlock @else fa-lock @endif fa-lg" aria-hidden="true"></i></p>
												<span><i class="icon-grupy svoe-lg svoe-icon"></i> {{ number_format($group['members_count'], 0, '', ' ') }} ({{ number_format($group['friends_count'], 0, '', ' ') }} {{ trans('timeline.of_friends_lcf') }})</span>
												<div class="btn-group-col">

													<a href="#">
														<i class="icon-prisoidenitsa svoe-icon"></i>
														{{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-pages">
						<div class="row">
							<div class="visible-lg col-lg-3 hide-1">
								{!! Theme::partial('advertising') !!}
							</div>
							<div class="col-lg-9 col-wallet">
								<div class="wrap-content-tab">
									<div class="wrap-photo-tab">
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active"><a href="#tab-pages-1" aria-controls="tab-pages-1" role="tab" data-toggle="tab">{{ trans('timeline.all') }}</a></li>
											@foreach($pages_cat as $category => $pages)
											<li role="presentation"><a href="#tab-pages-{{ ($loop->index + 2) }}" aria-controls="tab-pages-{{ ($loop->index + 2) }}" role="tab" data-toggle="tab">{{ $category }}</a></li>
											@endforeach
										</ul>
										<div class="tab-content">
											<div role="tabpanel" class="tab-pane fade in active" id="tab-pages-1">
												<div class="row">
													@foreach($pages_cat as $category => $pages)
													@foreach($pages as $page)
													<div class="col-xs-3">
														<div class="own-page-rightbar">
															<div class="photo-page-rightbar" style="background-image: url({{ url('page/avatar/'.$page->avatar) }})">
																<a href="{{ url($page->username) }}"></a>
															</div>
															<div class="content-page-rightbar">
																<h4><a href="{{ url($page->username) }}">{{ $page->name }}</a></h4>
																<p>{{ $category }}</p>
																<span><i class="icon-like  svoe-icon"></i> {{ $page->likes_count }}</span>
																<div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
																	<div class="btn-follow page @if($page->liked) hidden @endif"><a href="#" class="btn btn-options btn-block btn-default page-like like" @if($page->liked) aria-hidden="true" @endif><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
																	<div class="btn-follow page @if(!$page->liked) hidden @endif"><a href="#" class="btn btn-options btn-block btn-success page-like liked " ><i class="fa fa-heart" @if(!$page->liked) aria-hidden="true" @endif></i> <span>{{ trans('common.liked') }}</span></a></div>

																	<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if($page->subscribed) hidden @endif">
																		<i class="icon-pidpysatysya  svoe-icon"></i>
																		{{ trans('friend.subscribe') }}
																	</a>
																	<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if(!$page->subscribed) hidden @endif">
																		<i class="icon-vidpysatys svoe-icon"></i>
																		{{ trans('friend.unsubscribe') }}
																	</a>
																</div>
															</div>
														</div>
													</div>
													@endforeach
													@endforeach
												</div>
											</div>
											@foreach($pages_cat as $category => $pages)
											<div role="tabpanel" class="tab-pane fade" id="tab-pages-{{ ($loop->index + 2) }}">
												@foreach($pages as $page)
												<div class="col-xs-3">
													<div class="own-page-rightbar">
														<div class="photo-page-rightbar" style="background-image: url({{ url('page/avatar/'.$page->avatar) }})">
															<a href="{{ url($page->username) }}"></a>
														</div>
														<div class="content-page-rightbar">
															<h4><a href="{{ url($page->username) }}">{{ $page->name }}</a></h4>
															<p>{{ $category }}</p>
															<span><i class="icon-like  svoe-icon"></i> {{ $page->likes_count }}</span>
															<div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
																<div class="btn-follow page @if($page->liked) hidden @endif"><a href="#" class="btn btn-options btn-block btn-default page-like like" @if($page->liked) aria-hidden="true" @endif><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
																<div class="btn-follow page @if(!$page->liked) hidden @endif"><a href="#" class="btn btn-options btn-block btn-success page-like liked " ><i class="fa fa-heart" @if(!$page->liked) aria-hidden="true" @endif></i> <span>{{ trans('common.liked') }}</span></a></div>

																<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if($page->subscribed) hidden @endif">
																	<i class="icon-pidpysatysya  svoe-icon"></i>
																	{{ trans('friend.subscribe') }}
																</a>
																<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if(!$page->subscribed) hidden @endif">
																	<i class="icon-vidpysatys svoe-icon"></i>
																	{{ trans('friend.unsubscribe') }}
																</a>
															</div>
														</div>
													</div>
												</div>
												@endforeach
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-photos">
						<div class="wrap-content-tab">
							<div class="wrap-photo-tab">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#tab-photo-1" aria-controls="tab-photo-1" role="tab" data-toggle="tab">{{ trans('timeline.albums') }} <span>({{ $counters['albums'] }})</span></a></li>
									{{--<li role="presentation"><a href="#tab-photo-2" aria-controls="tab-photo-2" role="tab" data-toggle="tab" aria-expanded="true">Світлини з Катерина <span>(13)</span></a></li>--}}
									{{--<li role="presentation"><a class="switch-grid" href="#tab-photo-3" aria-controls="tab-photo-3" role="tab" data-toggle="tab" aria-expanded="true">Світлини Катерины <span>(458)</span></a></li>--}}
									<li class="grid-col">
										<span class="own-grid-bootstrap">
											<i class="icon-sort-b svoe-sort svoe-icon"></i>
										</span>
										<span class="own-grid-mosaic active-grid">
											<i class="icon-sort-a svoe-sort svoe-icon"></i>
										</span>
									</li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="tab-photo-1">
										<div class="wrap-album-tab">
											<div class="row">
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border album-main">
															<div class="create-album-tab">
																<i class="icon-prisoidenitsa svoe-sort svoe-icon"></i>
																<span>{{ trans('common.create-album') }}</span>
															</div>
														</div>
														<div class="title-album-count create-empty">
															<a href="#">&nbsp;</a>
															<span>&nbsp;</span>
														</div>
													</div>
												</div>
												@foreach($albums_last as $album)
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('{{ $album['preview'] }}')">
																<a href="{{ $album['href'] }}"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="{{ $album['href'] }}">{{ $album['name'] }}</a>
															<span>({{ $album['photos_count'] }} {{ trans('timeline.photo_lcf') }})</span>
														</div>
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>
									{{--<div role="tabpanel" class="tab-pane fade" id="tab-photo-2"></div>--}}
									{{--<div role="tabpanel" class="tab-pane fade" id="tab-photo-3"></div>--}}
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-videos">
						<div class="wrap-content-tab">
							<div class="wrap-photo-tab"></div>
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#tab-video-1" aria-controls="tab-video-1" role="tab" data-toggle="tab">{{ trans('timeline.albums_with_video') }}</a></li>
									<li role="presentation" ><a class="switch-grid" href="#tab-video-2" aria-controls="tab-video-2" role="tab" data-toggle="tab">{{ trans('timeline.all_videos') }}</a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="tab-video-1">
										<div class="wrap-video-tab">
											<div class="row">
												@foreach($albums_last as $album)
													@continue(!$album['videos']->count())
												<div class="col-sm-3">
													<div class="wrap-video-album-tab">
														<div class="own-album-video">
															<div class="embed-video" data-source="{{ $album['videos'][0]['type'] }}" data-video-url="https://youtu.be/{{ $album['videos'][0]['source'] }}"></div>
														</div>
													</div>
													<div class="title-video-tab">
														<p><a href="{{ $album['href'] }}">{{ $album['name'] }}</a></p>
														<span>({{ $album['videos']->count() }} {{ trans('timeline.video_lcf') }})</span>
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab-video-2">
										<div class="wrap-video-tab">
											<div class="row">
												@foreach($albums_last as $album)
													@continue(!$album['videos']->count())
												@foreach($album['videos'] as $video)
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/{{ $video->source }}"></div>
													<div class="title-video-tab">
														<p><a href="">{{ $video->title }}</a></p>
														<a href="">{{ $album['name'] }}</a>
{{--														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>--}}
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">{{ $video->created_at->format('d.m.Y') }}</span>
													</div>
												</div>
												@endforeach
												@endforeach
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-events">
						<div class="wrap-content-tab">
							<div class="title-tab-prof">
								<i class="icon-podii svoe-lg svoe-icon"></i>
								{{ trans('sidebar.my_events') }}
								<div class="search-friend-tab search-other">
									<input type="text" class="form-control" style="display: none;">
									<i class="icon-shukaty svoe-icon"></i>
								</div>
							</div>
							<div class="wrap-event-col">
								<div class="row">
									@foreach($events_last as $event)
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-event-col">
											<div class="photo-event-col" style="background-image: url('{{ url('event/cover/'.$event->cover) }}')">
												<div class="shadow-event-prof">
													<div class="date-event-prof">
														<span class="number-date">{{ $event->start_date->format('d') }}</span>
														<span>{{ trans('timeline.at_month')[$event->start_date->format('n')] }}</span>
													</div>
												</div>
												<div class="wrap-event-friend">
													@foreach($event->users as $user)
													<div class="your-group-friend" style="background-image: url('{{ $user->avatar }}')">
														<a href="{{ url($user->username) }}"></a>
													</div>
													@endforeach
												</div>
											</div>
											<div class="content-event-col">
												<p><a href="{{ url($event->timeline->username) }}">{{ $event->timeline->name }}</a></p>
												<div class="btn-hover-wrap">
													<a href="#" class="btn-action-hover">
														<i class="icon-pereytu  svoe-icon"></i>
														{{ trans('timeline.visit') }}
													</a>
{{--
													<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if($event->subscribed) hidden @endif">
														<i class="icon-pidpysatysya  svoe-icon"></i>
														{{ trans('friend.subscribe') }}
													</a>
													<a href="#" class="btn-action-hover show-action-hover hidden-action-hover @if(!$event->subscribed) hidden @endif">
														<i class="icon-vidpysatys  svoe-icon"></i>
														{{ trans('friend.unsubscribe') }}
													</a>
--}}
												</div>
												<span>{{ number_format($event->users_count, 0, '', ' ') }} {{ trans('timeline.of_participants') }}</span>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-bookmarks">Tab Bookmarks ...</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-audio">Tab Audio ...</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-apps">
						<div class="wrap-content-tab">
							<div class="wrap-photo-tab">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#all-apps" aria-controls="tab-app-1" role="tab" data-toggle="tab">{{ trans('timeline.all') }}</a></li>
									@foreach($applications_cat as $category => $apps)
									<li role="presentation"><a href="#tab-app-{{ ($loop->index + 2) }}" aria-controls="tab-app-{{ ($loop->index + 2) }}" role="tab" data-toggle="tab">@if($category == 'other') {{ trans('timeline.other') }} @else {{ $category }} @endif</a></li>
									@endforeach
									{{--<li class="grid-col-friend">--}}
									{{--<div class="search-friend-tab">--}}
									{{--<input type="text" class="form-control">--}}
									{{--<i class="icon-shukaty svoe-lg svoe-icon"></i>--}}
									{{--</div>--}}
									{{--<span class="sort-small">--}}
									{{--<i class="icon-sort-c svoe-sort svoe-icon"></i>--}}
									{{--</span>--}}
									{{--<span class="active-col-friend sort-big">--}}
									{{--<i class="icon-sort-d svoe-sort svoe-icon"></i>--}}
									{{--</span>--}}
									{{--</li>--}}
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="all-apps">
										<div class="wrap-app-tab">
											<div class="row">
												@foreach($applications_cat as $category => $apps)
												@foreach($apps as $app)
												<div class="games-grid">
													<a href="{{ $app->url_main }}">
														<div class="game-image" style="background-image:url({{ static_uploads($app->image_main) }})"></div>
														<div class="content-app-tab">
															<h5>{{ $app->title }}</h5>
															<span>@if($category == 'other') {{ trans('timeline.other') }} @else {{ $category }} @endif</span>
															<div class="rating">
																<div>
																	<span class="rating-counter">
																		{{ $app->ratingStr }}
																	</span>
																</div>
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
															</div>
															<p class="game-members">{{ $app->count_users }} {{ trans('timeline.of_participants') }}</p>
														</div>
													</a>
												</div>
												@endforeach
												@endforeach
											</div>
										</div>
									</div>
									@foreach($applications_cat as $category => $apps)
									<div role="tabpanel" class="tab-pane fade" id="tab-app-{{ ($loop->index + 2) }}">
										<div class="wrap-app-tab">
											<div class="row">
												@foreach($apps as $app)
												<div class="games-grid">
													<a href="{{ $app->url_main }}">
														<div class="game-image" style="background-image:url({{ static_uploads($app->image_main) }})"></div>
														<div class="content-app-tab">
															<h5>{{ $app->title }}</h5>
															<span>@if($category == 'other') {{ trans('timeline.other') }} @else {{ $category }} @endif</span>
															<div class="rating">
																<div>
																	<span class="rating-counter">
																		{{ $app->ratingStr }}
																	</span>
																</div>
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
															</div>
															<p class="game-members">{{ $app->count_users }} {{ trans('timeline.of_participants') }}</p>
														</div>
													</a>
												</div>
												@endforeach
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- </div> -->
			</div>
		</div><!-- end user profile tab -->
			<script type="text/javascript">
				//For blocks or images of size, you can use $(document).ready
				$(document).ready(function() {
					$('.life-line').on('shown.bs.tab',function(){
						$('.last-photo-mosaic-1').jMosaic({items_type: "li", margin: 1});
					})
					$('.last-photo-mosaic-1').jMosaic({items_type: "li", margin: 1});
					$('.switch-grid').on('shown.bs.tab',function(){
						if($('.user-blocks-photo').find('li').hasClass('scale-animate')){
							$('.user-blocks-photo').find('li').removeClass('scale-animate');
						}
						$('.own-grid-mosaic').click();
					})
					$('.embed-video').embedVideo();
				});

				//You can update on $(window).resize
				$(window).resize(function() {
					$('.user-blocks-photo').jMosaic({items_type: "li", margin: 3});
					$('.last-photo-mosaic-1').jMosaic({items_type: "li", margin: 1});
				});
			</script>
		@elseif($timeline->type == "page")

				<div class="row">
					<div class="col-xs-12 profile-col">
						<!-- Tab panes -->
						<!-- <div class="container container-grid section-container"> -->
						<div class="tab-content profheader-tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="tab-chronicle">
								<div class="row">
									<div class="col-md-7  col-lg-5  col-grid-1">

										@if(($page->timeline_post_privacy == "only_admins" && $page->is_admin(Auth::user()->id)) || ($page->timeline_post_privacy == "everyone"))
											{!! Theme::partial('create-post',compact('timeline','user_post')) !!}
										@elseif($page->timeline_post_privacy == "everyone")
											{!! Theme::partial('create-post',compact('timeline','user_post')) !!}
										@endif

										<div class="timeline-posts">
											@if($user_post == "user" || $user_post == "page" || $user_post == "group")
												@if(count($posts) > 0)
													@foreach($posts as $post)
														{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
													@endforeach
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
												@endif
											@endif

											@if($user_post == "event")
												@if($event->type == 'private' && Auth::user()->get_eventuser($event->id) || $event->type == 'public')
													@if(count($posts) > 0)
														@foreach($posts as $post)
															{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
														@endforeach
													@else
														<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
													@endif
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.private_posts') }}</div>
												@endif
											@endif
										</div>
									</div>
									<div class="visible-lg col-lg-3 hide-1">
										{!! Theme::partial('advertising') !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

		@elseif($timeline->type == "group")
				<div class="row">
					<div class="col-xs-12 profile-col">
						<!-- Tab panes -->
						<!-- <div class="container container-grid section-container"> -->
						<div class="tab-content profheader-tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="tab-chronicle">
								<div class="row">
									<div class="col-md-7  col-lg-5  col-grid-1">

										@if(($group->post_privacy == "only_admins" && $group->is_admin(Auth::user()->id))|| ($group->post_privacy == "members" && Auth::user()->get_group($group->id) == 'approved') || $group->post_privacy == "everyone")
											{!! Theme::partial('create-post',compact('timeline','user_post','username')) !!}
										@endif

										<div class="timeline-posts">
											@if($user_post == "user" || $user_post == "page" || $user_post == "group")
												@if(count($posts) > 0)
													@foreach($posts as $post)
														{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
													@endforeach
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
												@endif
											@endif

											@if($user_post == "event")
												@if($event->type == 'private' && Auth::user()->get_eventuser($event->id) || $event->type == 'public')
													@if(count($posts) > 0)
														@foreach($posts as $post)
															{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
														@endforeach
													@else
														<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
													@endif
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.private_posts') }}</div>
												@endif
											@endif
										</div>
									</div>
									<div class="visible-lg col-lg-3 hide-1">
										{!! Theme::partial('advertising') !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

		@elseif($timeline->type == "event")

				<div class="row">
					<div class="col-xs-12 profile-col">
						<!-- Tab panes -->
						<!-- <div class="container container-grid section-container"> -->
						<div class="tab-content profheader-tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="tab-chronicle">
								<div class="row">
									<div class="col-md-7  col-lg-5  col-grid-1">

										@if(($event->timeline_post_privacy == 'only_admins' && $event->is_eventadmin(Auth::user()->id, $event->id)) || ($event->timeline_post_privacy == 'only_guests' && Auth::user()->get_eventuser($event->id)))
											{!! Theme::partial('create-post',compact('timeline','user_post')) !!}
										@endif

										<div class="timeline-posts">
											@if($user_post == "user" || $user_post == "page" || $user_post == "group")
												@if(count($posts) > 0)
													@foreach($posts as $post)
														{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
													@endforeach
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
												@endif
											@endif

											@if($user_post == "event")
												@if($event->type == 'private' && Auth::user()->get_eventuser($event->id) || $event->type == 'public')
													@if(count($posts) > 0)
														@foreach($posts as $post)
															{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
														@endforeach
													@else
														<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
													@endif
												@else
													<div class="no-posts alert alert-warning">{{ trans('messages.private_posts') }}</div>
												@endif
											@endif
										</div>
									</div>
									<div class="visible-lg col-lg-3 hide-1">
										{!! Theme::partial('advertising') !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

		@endif
{{--
		<div class="row">
			<div class="col-md-10">

				<div class="row">
					<div class="timeline">

						<div class="col-md-4">
							@if($timeline->type == "user")
							{!! Theme::partial('user-leftbar',compact('timeline','user','type_friend','own_pages','own_groups','user_events')) !!}
							@elseif($timeline->type == "page")
							{!! Theme::partial('page-leftbar',compact('timeline','page','page_members')) !!}
							@elseif($timeline->type == "group")
								{!! Theme::partial('group-leftbar',compact('timeline','group','group_members','group_events','ongoing_events','upcoming_events')) !!}
							@elseif($timeline->type == "event")
								{!! Theme::partial('event-leftbar',compact('event','timeline')) !!}
							@endif
						</div>
						<!-- Post box on timeline,page,group -->
						<div class="col-md-8">

							@if($timeline->type == "user" && $timeline_post == true)
								{!! Theme::partial('create-post',compact('timeline','user_post')) !!}

							@elseif($timeline->type == "page")
								@if(($page->timeline_post_privacy == "only_admins" && $page->is_admin(Auth::user()->id)) || ($page->timeline_post_privacy == "everyone"))
									{!! Theme::partial('create-post',compact('timeline','user_post')) !!}
								@elseif($page->timeline_post_privacy == "everyone")
									{!! Theme::partial('create-post',compact('timeline','user_post')) !!}
								@endif

							@elseif($timeline->type == "group")
								@if(($group->post_privacy == "only_admins" && $group->is_admin(Auth::user()->id))|| ($group->post_privacy == "members" && Auth::user()->get_group($group->id) == 'approved') || $group->post_privacy == "everyone")
									{!! Theme::partial('create-post',compact('timeline','user_post','username')) !!}
								@endif

							@elseif($timeline->type == "event")
								@if(($event->timeline_post_privacy == 'only_admins' && $event->is_eventadmin(Auth::user()->id, $event->id)) || ($event->timeline_post_privacy == 'only_guests' && Auth::user()->get_eventuser($event->id)))
									{!! Theme::partial('create-post',compact('timeline','user_post')) !!}
								@endif
							@endif

							<div class="timeline-posts">
								@if($user_post == "user" || $user_post == "page" || $user_post == "group")
									@if(count($posts) > 0)
	 									@foreach($posts as $post)
	 										{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
	 									@endforeach
 									@else
 										<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
 									@endif
 								@endif

 								@if($user_post == "event")
 									@if($event->type == 'private' && Auth::user()->get_eventuser($event->id) || $event->type == 'public')
 										@if(count($posts) > 0)
		 									@foreach($posts as $post)
		 										{!! Theme::partial('post',compact('post','timeline','next_page_url','user')) !!}
		 									@endforeach
	 									@else
	 										<div class="no-posts alert alert-warning">{{ trans('messages.no_posts') }}</div>
	 									@endif
 									@else
 										<div class="no-posts alert alert-warning">{{ trans('messages.private_posts') }}</div>
 									@endif
 								@endif
							</div>
						</div>
					</div>
				</div><!-- /row -->
			</div><!-- /col-md-10 -->

			<div class="col-md-2">
				{!! Theme::partial('timeline-rightbar') !!}
			</div>

		</div><!-- /row --> --}}
	</div>
