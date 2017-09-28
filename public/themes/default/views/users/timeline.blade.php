<!-- main-section -->

	<div class="container container-grid section-container @if($timeline->hide_cover) no-cover @endif">
		<div class="row">
			<div class="col-md-12 profile-col">
				@if($timeline->type == "user")
					{!! Theme::partial('user-header',compact('user','timeline','liked_pages','joined_groups','isMe','type_friend','is_follower','available_relative', 'curStatuses', 'curRelative','requestInviteMe','followRequests','following_count','followers_count','follow_confirm','user_post','joined_groups_count','guest_events', 'dialog_id')) !!}
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
										<div class="count-friend-photo-block">
											<div class="row">
												<div class="col-xs-4">
													<span>{{ $user->profile->count_friend }}</span>
													<p>{{ trans('timeline.of_friends_ucf') }}</p>
												</div>
												<div class="col-xs-4">
													<span>{{ $user->profile->count_follower }}</span>
													<p>{{ trans('timeline.followers') }}</p>
												</div>
												<div class="col-xs-4">
													<span>{{ $photos_count }}</span>
													<p>{{ trans('timeline.photos') }}</p>
												</div>
											</div>
										</div>
										<div class="info-contact-prof">
											@if($user->about != NULL)
												<div class="own-info-contact more-info-span-tab">
													<span><i class="fa fa-user" aria-hidden="true"></i>{{ trans('common.bio') }}:</span>
													<span>{{ $user->about }}</span>
												</div>
											@endif
											@if($user->hobbies != NULL)
											<div class="own-info-contact more-info-span-tab">
												<span><i class="fa fa-gamepad" aria-hidden="true"></i>{{ trans('common.hobbies') }}:</span>
												<span>{{ $user->hobbies }}</span>
											</div>
											@endif
											@if($user->interests != NULL)
											<div class="own-info-contact more-info-span-tab">
												<span><i class="fa fa-question" aria-hidden="true"></i>{{ trans('common.interests') }}:</span>
												<span>{{ $user->interests }}</span>
											</div>
											@endif
											@if($user->designation != NULL)
											<div class="own-info-contact">
												<span><i class="fa fa-graduation-cap" aria-hidden="true"></i>{{ trans('common.designation') }}:</span>
												<span>{{ $user->designation }}</span>
											</div>
											@endif
											@if($user->birthday != NULL)
											<div class="own-info-contact">
												<span><i class="fa fa-birthday-cake " style="top: 10px;" aria-hidden="true"></i>{{ trans('timeline.birthday') }}:</span>
												<span>{{ $user->birthday }}</span>
											</div>
											@endif
											@if($user->country != NULL)
											<div class="own-info-contact">
												<span><i class="fa fa-globe " aria-hidden="true"></i>{{ trans('common.country') }}:</span>
												<span>{{ $user->country }}</span>
											</div>
											@endif
											@if($user->city != NULL)
											<div class="own-info-contact">
												<span><i class="fa fa-home" aria-hidden="true"></i>>{{ trans('timeline.city') }}:</span>
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
											<div class="own-info-contact">
												<span><i class="fa fa-mobile " style="left: 4px;" aria-hidden="true"></i>{{ trans('common.phone') }}:</span>
												<span></span>
											</div>
											<div class="own-info-contact">
												<span><i class="fa fa-skype " aria-hidden="true"></i>Skype:</span>
												<span></span>
											</div>
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
								@if($photos_count)
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="#">
											<i class="icon-photoalbomy svoe-icon" style="top: 23px;"></i>
											{{ trans('timeline.last_photos') }}
											<span>({{ $photos_count }} {{ trans('timeline.foto') }})</span>
										</a>
									</div>
									<div class="last-photo-prof">
										<div class="row">
											<div class="col-xs-12">
												<div class="chronicle">
													@foreach($photos_last as $url)
														<img src="{{ $url }}" alt="" />
													@endforeach
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="#">
											<i class="icon-photoalbomy svoe-icon" style="top: 22px;"></i>
											{{ trans('timeline.albums') }}
											<span>({{ $albums_count }} {{ trans('timeline.of_albums') }})</span>
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
													<span>({{ $album['count'] }} {{ trans('timeline.foto') }})</span>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
								@endif
								@if($user->profile->count_friend)
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="{{ url($user->username.'/friends') }}">
											<i class="icon-druzi svoe-lg svoe-icon" style="top: 20px;left: 15px;"></i>
											{{ trans('timeline.friends') }}
											<span>({{ $user->profile->count_friend }} {{ trans('timeline.of_friends_lcf') }})</span>
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
								@if($pages_count)
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
														<span><i class="icon-like  svoe-icon"></i> {{ $page->likes()->count() }}</span>
														<div class="btn-hover-wrap wrap-btn-hover-pages pagelike-links">
															<div class="btn-follow page"><a href="#" class="btn btn-options btn-block btn-default page-like like" ><i class="icon-like  svoe-icon"></i> <span>{{ trans('common.like') }}</span></a></div>
															<div class="btn-follow page hidden"><a href="#" class="btn btn-options btn-block btn-success page-like liked " ><i class="fa fa-heart" aria-hidden="true"></i> <span>{{ trans('common.liked') }}</span></a></div>

															<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
																<i class="icon-pidpysatysya  svoe-icon"></i>
																{{ trans('friend.subscribe') }}
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
								@if($groups_last->count())
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="#">
											<i class="icon-grupy svoe-lg svoe-icon" style="top: 21px;"></i>
											{{ trans('timeline.groups') }}
											<span class="show-all-title">{{ trans('timeline.all') }}</span>
										</a>
									</div>
									@foreach($groups_last as $group)
									<div class="wrap-group-prof">
										<div class="wrap-padding-group">
											<div class="own-photo-group" style="background-image: url({{ url('group/cover/'.$group['cover']) }})">
												<a href=""></a>
												<div>
													@foreach($group['friends'] as $friend)
													<div class="your-group-friend" style="background-image: url({{ $friend->avatar }})">
														<a href="{{ url($friend->username) }}"></a>
													</div>
													@endforeach
												</div>
											</div>
											<div class="content-group-profile">
												<a href=""><i class="
													@if($group['type'] == 'closed') icon-zakryto @else icon-vidkryto @endif svoe-icon"></i> {{ $group['name'] }}
												</a>
												@if($group['notMember'])
												<div class="btn-joined-prof-group">
													<i class="icon-prisoidenitsa svoe-icon"></i> {{ trans('common.join') }}
												</div>
												@endif
												<span>{{ $group['friends']->count() }} {{ trans('timeline.of_friends_lcf') }}</span>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								@endif
								<div class="wrap-panel-prof">
									<div class="title-link-album">
										<a href="#">
											<i class="icon-podii  svoe-icon" style="top: 23px;left: 19px;"></i>
											События
											<span class="show-all-title">Все</span>
										</a>
									</div>
									<div class="wrap-event-prof">
										<div class="photo-event-prof" style="background-image: url({!! Theme::asset()->url('images/event-prof-1.png') !!})">
											<div class="shadow-event-prof">
												<div class="date-event-prof">
													<span class="number-date">26</span>
													<span>серпня</span>
												</div>
											</div>
										</div>
										<a href="">LET SWIFT - iOS Developers Meet-up</a>
										<span>3 246 учасників</span>
									</div>
									<div class="wrap-event-prof">
										<div class="photo-event-prof" style="background-image: url({!! Theme::asset()->url('images/event-prof-1.png') !!})">
											<div class="shadow-event-prof">
												<div class="date-event-prof">
													<span class="number-date">26</span>
													<span>серпня</span>
												</div>
											</div>
										</div>
										<a href="">LET SWIFT - iOS Developers Meet-up</a>
										<span>3 246 учасників</span>
									</div>
								</div>
							</div>
							<div class="col-md-7  col-lg-5  col-grid-1">
								{{--<div style="height: 600px;background-color: #ccc;"></div>--}}
								<!-- Post box on timeline,page,group -->

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
											<li role="presentation" class="active"><a href="#tab-friend-1" aria-controls="tab-friend-1" role="tab" data-toggle="tab">Друзі</a></li>
											<li role="presentation"><a href="#tab-friend-2" aria-controls="tab-friend-2" role="tab" data-toggle="tab">Підписники</a></li>
											<li role="presentation" ><a href="#tab-friend-3" aria-controls="tab-friend-3" role="tab" data-toggle="tab">Спільні друзі</a></li>
											<li role="presentation" ><a href="#tab-friend-4" aria-controls="tab-friend-4" role="tab" data-toggle="tab">Родина</a></li>
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
											<div role="tabpanel" class="tab-pane fade in active" id="tab-friend-1">
												<div class="wrap-friend-tab-prof">
													<div class="row small-tab-friend row-big-tab-friend">
														<div class="col-sm-6">
															<div class="own-friend-tab-prof">
																<div class="bg-wall-friend-tab" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')" ></div>
																<div class="photo-friend-tab" style="background-image: url('https://sand.esvoe.com/user/avatar/2017-06-08-19-43-0612208272_784130515042917_6144586870815355082_n.jpg')"></div>
																<div class="content-friend-tab">
																	<ul class="list-inline no-margin">
																		<li class="dropdown">
																			<a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																				<i class="icon-menyu svoe-lg svoe-icon"></i>
																			</a>
																			<ul class="dropdown-menu">
																				<li>
																					<a href="#">
																						Поскаржитись
																					</a>
																				</li>
																			</ul>
																		</li>
																	</ul>
																	<div class="info-action-friend-tab">
																		<p><a href="">Vitalii Oleniichuk</a></p>
																		<span>Львів</span>
																		<div class="count-friend-photo-block">
																			<div class="row">
																				<div class="col-xs-3">
																					<span>320</span>
																					<p>Друзів</p>
																				</div>
																				<div class="col-xs-4">
																					<span>229</span>
																					<p>Підписників </p>
																				</div>
																				<div class="col-xs-5">
																					<span>356</span>
																					<p>Фотографий</p>
																				</div>
																			</div>
																		</div>
																		<div class="profheader-ctrl">
																			<!-- case 0 : confirm request for friendship -->
																			<div class="profheader-ctrl-item" data-role="friend-request" style="display: ---none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-druzhyty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">Хочет дружить</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a data-action="friend-accept" href="#" class="">
																								<i class="icon-prinyat svoe-icon"></i>Принять
																							</a>
																						</li>
																						<li>
																							<a data-action="friend-cancel" href="#" class="">
																								<i class="icon-vidpysatys svoe-icon"></i>Отказать
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 1 : add to friend -->
																			<div class="profheader-ctrl-item" data-role="add-to-friend" style="display: none;">
																				<a data-action="add" href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
																					<i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">Добавить в друзья</span>
																				</a>
																			</div>
																			<!-- case 2 : not allowed, cancel adding -->
																			<div class="profheader-ctrl-item" data-role="not-allowed" style="display: none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-chekaty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">Не подтверждено</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="cancel" href="#" class="">
																								<i class="icon-vidpysatys svoe-icon"></i>Отменить заявку
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 3 : your friend -->
																			<div class="profheader-ctrl-item" data-role="your-friend" style="display: none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-prinyat svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">У Вас в друзьях</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="delete" href="#" class="dropdown-unclosed">
																								<i class="icon-vidpysatys svoe-icon"></i>Удалить из друзей
																							</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																							<form name="user-status-form">
																								<a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
																									<i class="icon-strilka svoe-icon"></i>Статус дружбы
																								</a>
																								<ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">
																									<li class="profheader-ctrl-submenu-item">
																										<label for="bestfriends">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="bestfriends-styler"><input data-action="status" type="checkbox" name="status" id="bestfriends" value="bestfriends"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Лучшие друзья
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="colleagues">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="colleagues-styler"><input data-action="status" type="checkbox" name="status" id="colleagues" value="colleagues"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Коллеги
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="employees">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="employees-styler"><input data-action="status" type="checkbox" name="status" id="employees" value="employees"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Сотрудники
																										</label>
																									</li>
																								</ul>
																							</form>
																						</li>
																						<li>
																							<form name="user-relative-form">
																								<a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
																									<i class="icon-strilka svoe-icon"></i>Родственники
																								</a>
																								<ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
																									<li class="profheader-ctrl-submenu-item">
																										<label for="mother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="mother-styler"><input data-action="relative" type="radio" name="relative" id="mother" value="mother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Мать
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="doughter">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="doughter-styler"><input data-action="relative" type="radio" name="relative" id="doughter" value="doughter"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Дочь
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="grandmother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="grandmother-styler"><input data-action="relative" type="radio" name="relative" id="grandmother" value="grandmother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Бабушка
																										</label>
																									</li>
																								</ul>
																							</form>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<div class="profheader-ctrl-item profheader-ctrl-item___message">
																				<a href="#" class="profheader-ctrl-btn profheader-ctrl-message" style="">
																					<i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">Подписаться</span>
																				</a>
																			</div>
																			<div class="profheader-ctrl-item">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																						<i class="icon-menyu svoe-lg svoe-icon"></i>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a data-action="subscribe" href="#" class="">
																								<i class="icon-povidomlennia svoe-icon"></i>Написать сообщение
																							</a>
																						</li>
																						<li>
																							<a data-action="unsubscribe" href="#" class="" style="display:none;">
																								<i class="icon-vidpysatys svoe-icon"></i>Подписаться
																							</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																							<a data-action="claim" href="#" class="sub">
																								<i class="icon-poskarzhytysya svoe-icon"></i>Пожаловаться
																							</a>
																						</li>
																						<li>
																							<a data-action="block" href="#" class="sub">
																								<i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="own-friend-tab-prof">
																<div class="bg-wall-friend-tab" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')" ></div>
																<div class="photo-friend-tab" style="background-image: url({!! Theme::asset()->url('https://sand.esvoe.com/user/avatar/2017-07-18-13-21-54AGp7eZ4Z.png') !!})"></div>
																<div class="content-friend-tab">
																	<ul class="list-inline no-margin">
																		<li class="dropdown">
																			<a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																				<i class="icon-menyu svoe-lg svoe-icon"></i>
																			</a>
																			<ul class="dropdown-menu">
																				<li>
																					<a href="#">
																						Поскаржитись
																					</a>
																				</li>
																			</ul>
																		</li>
																	</ul>
																	<div class="info-action-friend-tab">
																		<p><a href="">Andriy Vynarchyk</a></p>
																		<span>Львів</span>
																		<div class="count-friend-photo-block">
																			<div class="row">
																				<div class="col-xs-3">
																					<span>320</span>
																					<p>Друзів</p>
																				</div>
																				<div class="col-xs-4">
																					<span>229</span>
																					<p>Підписників </p>
																				</div>
																				<div class="col-xs-5">
																					<span>356</span>
																					<p>Фотографий</p>
																				</div>
																			</div>
																		</div>
																		<div class="profheader-ctrl">
																			<!-- case 0 : confirm request for friendship -->
																			<div class="profheader-ctrl-item" data-role="friend-request" style="display: ---none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-druzhyty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">Хочет дружить</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a data-action="friend-accept" href="#" class="">
																								<i class="icon-prinyat svoe-icon"></i>Принять
																							</a>
																						</li>
																						<li>
																							<a data-action="friend-cancel" href="#" class="">
																								<i class="icon-vidpysatys svoe-icon"></i>Отказать
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 1 : add to friend -->
																			<div class="profheader-ctrl-item" data-role="add-to-friend" style="display: none;">
																				<a data-action="add" href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
																					<i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">Добавить в друзья</span>
																				</a>
																			</div>
																			<!-- case 2 : not allowed, cancel adding -->
																			<div class="profheader-ctrl-item" data-role="not-allowed" style="display: none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-chekaty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">Не подтверждено</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="cancel" href="#" class="">
																								<i class="icon-vidpysatys svoe-icon"></i>Отменить заявку
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 3 : your friend -->
																			<div class="profheader-ctrl-item" data-role="your-friend" style="display: none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-prinyat svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">У Вас в друзьях</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="delete" href="#" class="dropdown-unclosed">
																								<i class="icon-vidpysatys svoe-icon"></i>Удалить из друзей
																							</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																							<form name="user-status-form">
																								<a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
																									<i class="icon-strilka svoe-icon"></i>Статус дружбы
																								</a>
																								<ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">
																									<li class="profheader-ctrl-submenu-item">
																										<label for="bestfriends">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="bestfriends-styler"><input data-action="status" type="checkbox" name="status" id="bestfriends" value="bestfriends"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Лучшие друзья
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="colleagues">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="colleagues-styler"><input data-action="status" type="checkbox" name="status" id="colleagues" value="colleagues"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Коллеги
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="employees">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="employees-styler"><input data-action="status" type="checkbox" name="status" id="employees" value="employees"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Сотрудники
																										</label>
																									</li>
																								</ul>
																							</form>
																						</li>
																						<li>
																							<form name="user-relative-form">
																								<a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
																									<i class="icon-strilka svoe-icon"></i>Родственники
																								</a>
																								<ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
																									<li class="profheader-ctrl-submenu-item">
																										<label for="mother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="mother-styler"><input data-action="relative" type="radio" name="relative" id="mother" value="mother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Мать
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="doughter">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="doughter-styler"><input data-action="relative" type="radio" name="relative" id="doughter" value="doughter"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Дочь
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="grandmother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="grandmother-styler"><input data-action="relative" type="radio" name="relative" id="grandmother" value="grandmother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Бабушка
																										</label>
																									</li>
																								</ul>
																							</form>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<div class="profheader-ctrl-item profheader-ctrl-item___message">
																				<a href="#" class="profheader-ctrl-btn profheader-ctrl-message" style="">
																					<i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">Подписаться</span>
																				</a>
																			</div>
																			<div class="profheader-ctrl-item">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																						<i class="icon-menyu svoe-lg svoe-icon"></i>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a data-action="subscribe" href="#" class="">
																								<i class="icon-povidomlennia svoe-icon"></i>Написать сообщение
																							</a>
																						</li>
																						<li>
																							<a data-action="unsubscribe" href="#" class="" style="display:none;">
																								<i class="icon-vidpysatys svoe-icon"></i>Подписаться
																							</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																							<a data-action="claim" href="#" class="sub">
																								<i class="icon-poskarzhytysya svoe-icon"></i>Пожаловаться
																							</a>
																						</li>
																						<li>
																							<a data-action="block" href="#" class="sub">
																								<i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="own-friend-tab-prof">
																<div class="bg-wall-friend-tab" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')" ></div>
																<div class="photo-friend-tab" style="background-image: url('https://sand.esvoe.com/user/avatar/2017-06-08-19-43-0612208272_784130515042917_6144586870815355082_n.jpg')"></div>
																<div class="content-friend-tab">
																	<ul class="list-inline no-margin">
																		<li class="dropdown">
																			<a href="#" class="dropdown-togle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																				<i class="icon-menyu svoe-lg svoe-icon"></i>
																			</a>
																			<ul class="dropdown-menu">
																				<li>
																					<a href="#">
																						Поскаржитись
																					</a>
																				</li>
																			</ul>
																		</li>
																	</ul>
																	<div class="info-action-friend-tab">
																		<p><a href="">Vitalii Oleniichuk</a></p>
																		<span>Львів</span>
																		<div class="count-friend-photo-block">
																			<div class="row">
																				<div class="col-xs-3">
																					<span>320</span>
																					<p>Друзів</p>
																				</div>
																				<div class="col-xs-4">
																					<span>229</span>
																					<p>Підписників </p>
																				</div>
																				<div class="col-xs-5">
																					<span>356</span>
																					<p>Фотографий</p>
																				</div>
																			</div>
																		</div>
																		<div class="profheader-ctrl">
																			<!-- case 0 : confirm request for friendship -->
																			<div class="profheader-ctrl-item" data-role="friend-request" style="display: ---none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-confirm dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-druzhyty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">Хочет дружить</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a data-action="friend-accept" href="#" class="">
																								<i class="icon-prinyat svoe-icon"></i>Принять
																							</a>
																						</li>
																						<li>
																							<a data-action="friend-cancel" href="#" class="">
																								<i class="icon-vidpysatys svoe-icon"></i>Отказать
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 1 : add to friend -->
																			<div class="profheader-ctrl-item" data-role="add-to-friend" style="display: none;">
																				<a data-action="add" href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-addtofriend" style="">
																					<i class="icon-dodaty-druzi svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">Добавить в друзья</span>
																				</a>
																			</div>
																			<!-- case 2 : not allowed, cancel adding -->
																			<div class="profheader-ctrl-item" data-role="not-allowed" style="display: none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-cancel dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-chekaty svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">Не подтверждено</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="cancel" href="#" class="">
																								<i class="icon-vidpysatys svoe-icon"></i>Отменить заявку
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<!-- case 3 : your friend -->
																			<div class="profheader-ctrl-item" data-role="your-friend" style="display: none;">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-togglewidth profheader-ctrl-friend dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="">
																						<i class="icon-prinyat svoe-lg svoe-icon"></i>
																						<span class="profheader-ctrl-text">У Вас в друзьях</span>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown">
																						<li>
																							<a data-action="delete" href="#" class="dropdown-unclosed">
																								<i class="icon-vidpysatys svoe-icon"></i>Удалить из друзей
																							</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																							<form name="user-status-form">
																								<a class="sub profheader-ctrl-submenu-btn" data-toggle="collapse" href="#collapseMenu-1" aria-expanded="true" aria-controls="collapseMenu-1">
																									<i class="icon-strilka svoe-icon"></i>Статус дружбы
																								</a>
																								<ul id="collapseMenu-1" class="profheader-ctrl-submenu collapse in" role="tabpanel">
																									<li class="profheader-ctrl-submenu-item">
																										<label for="bestfriends">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="bestfriends-styler"><input data-action="status" type="checkbox" name="status" id="bestfriends" value="bestfriends"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Лучшие друзья
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="colleagues">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="colleagues-styler"><input data-action="status" type="checkbox" name="status" id="colleagues" value="colleagues"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Коллеги
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="employees">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-checkbox" id="employees-styler"><input data-action="status" type="checkbox" name="status" id="employees" value="employees"><div class="jq-checkbox__div"></div></div>
                                                                                                </span>
																											Сотрудники
																										</label>
																									</li>
																								</ul>
																							</form>
																						</li>
																						<li>
																							<form name="user-relative-form">
																								<a class="sub profheader-ctrl-submenu-btn collapsed" data-toggle="collapse" href="#collapseMenu-2" aria-expanded="false" aria-controls="collapseMenu-2">
																									<i class="icon-strilka svoe-icon"></i>Родственники
																								</a>
																								<ul id="collapseMenu-2" class="profheader-ctrl-submenu collapse" role="tabpanel">
																									<li class="profheader-ctrl-submenu-item">
																										<label for="mother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="mother-styler"><input data-action="relative" type="radio" name="relative" id="mother" value="mother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Мать
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="doughter">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="doughter-styler"><input data-action="relative" type="radio" name="relative" id="doughter" value="doughter"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Дочь
																										</label>
																									</li>
																									<li class="profheader-ctrl-submenu-item">
																										<label for="grandmother">
                                                                                                <span class="wrap-checker-sett">
                                                                                                    <div class="jq-radio" id="grandmother-styler"><input data-action="relative" type="radio" name="relative" id="grandmother" value="grandmother"><div class="jq-radio__div"></div></div>
                                                                                                </span>
																											Бабушка
																										</label>
																									</li>
																								</ul>
																							</form>
																						</li>
																					</ul>
																				</div>
																			</div>
																			<div class="profheader-ctrl-item profheader-ctrl-item___message">
																				<a href="#" class="profheader-ctrl-btn profheader-ctrl-message" style="">
																					<i class="icon-pidpysatysya svoe-lg svoe-icon"></i>
																					<span class="profheader-ctrl-text">Подписаться</span>
																				</a>
																			</div>
																			<div class="profheader-ctrl-item">
																				<div class="dropdown">
																					<a href="#" class="profheader-ctrl-btn profheader-ctrl-menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
																						<i class="icon-menyu svoe-lg svoe-icon"></i>
																					</a>
																					<ul class="dropdown-menu profheader-ctrl-dropdown dropdown-unclosed">
																						<li>
																							<a data-action="subscribe" href="#" class="">
																								<i class="icon-povidomlennia svoe-icon"></i>Написать сообщение
																							</a>
																						</li>
																						<li>
																							<a data-action="unsubscribe" href="#" class="" style="display:none;">
																								<i class="icon-vidpysatys svoe-icon"></i>Подписаться
																							</a>
																						</li>
																						<li class="divider"></li>
																						<li>
																							<a data-action="claim" href="#" class="sub">
																								<i class="icon-poskarzhytysya svoe-icon"></i>Пожаловаться
																							</a>
																						</li>
																						<li>
																							<a data-action="block" href="#" class="sub">
																								<i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane fade" id="tab-friend-2">

											</div>
											<div role="tabpanel" class="tab-pane fade " id="tab-friend-3">

											</div>
											<div role="tabpanel" class="tab-pane fade " id="tab-friend-4">

											</div>
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
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-group-prof">
											<div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!}');">
												<div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-group-col">
												<p><a href="">Cтудія меблів «Файно»</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
												<span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
												<div class="btn-group-col">
													<a href="">
														<i class="icon-prisoidenitsa svoe-icon"></i>
														{{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-group-prof">
											<div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}');">
												<div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-group-col">
												<p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
												<span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
												<div class="btn-group-col">

													<a href="">
														<i class="icon-prisoidenitsa svoe-icon"></i>
														{{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-group-prof">
											<div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}');">
												<div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-group-col">
												<p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
												<span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
												<div class="btn-group-col">
													<a href="">
														<i class="icon-prisoidenitsa svoe-icon"></i>
														{{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-group-prof">
											<div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-bg.jpg') !!}');">
												<div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-group-col">
												<p><a href="">Cтудія меблів «Файно»</a><i style="left: 4px;" class="fa fa-lock fa-lg" aria-hidden="true"></i></p>
												<span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
												<div class="btn-group-col">
													<a href="">
														<i class="icon-prisoidenitsa svoe-icon"></i>
														{{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-group-prof">
											<div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}');">
												<div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-group-col">
												<p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
												<span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
												<div class="btn-group-col">
													<a href="">
														<i class="icon-prisoidenitsa svoe-icon"></i>
														{{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-group-prof">
											<div class="photo-group-col"  style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}');">
												<div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-group-col">
												<p><a href="">Cтудія меблів «Файно»</a><i class="fa fa-unlock fa-lg" aria-hidden="true"></i></p>
												<span><i class="icon-grupy svoe-lg svoe-icon"></i> 3 141(3 друзей)</span>
												<div class="btn-group-col">
													<a href="">
														<i class="icon-prisoidenitsa svoe-icon"></i>
														{{ trans('common.join') }}
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-pages">Tab Pages ...</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-photos">
						<div class="wrap-content-tab">
							<div class="wrap-photo-tab">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#tab-photo-1" aria-controls="tab-photo-1" role="tab" data-toggle="tab">Альбоми <span>(8)</span></a></li>
									<li role="presentation"><a href="#tab-photo-2" aria-controls="tab-photo-2" role="tab" data-toggle="tab">Світлини з Катерина <span>(13)</span></a></li>
									<li role="presentation" ><a class="switch-grid" href="#tab-photo-3" aria-controls="tab-photo-3" role="tab" data-toggle="tab">Світлини Катерины <span>(458)</span></a></li>
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
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Всяке прирізне</a>
															<span>(458 фото)</span>
														</div>
													</div>
												</div>
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Шопінг у Львові</a>
															<span>(8 фото)</span>
														</div>
													</div>
												</div>
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/reklama-1.jpg') !!}')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Фотосесія на кухні</a>
															<span>(36 фото)</span>
														</div>
													</div>
												</div>
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-20-12-29-22Ie0V3.jpg')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Шопінг у Львові</a>
															<span>(8 фото)</span>
														</div>
													</div>
												</div>
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Всяке прирізне</a>
															<span>(458 фото)</span>
														</div>
													</div>
												</div>
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('{!! Theme::asset()->url('images/test-img-modal.png') !!}')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Шопінг у Львові</a>
															<span>(8 фото)</span>
														</div>
													</div>
												</div>
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-20-12-29-22Ie0V3.jpg')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Фотосесія на кухні</a>
															<span>(36 фото)</span>
														</div>
													</div>
												</div>
												<div class="col-album">
													<div class="own-album-tab">
														<div class="photo-album-tab-border">
															<div class="one-photo-album" style="background-image: url('https://sand.esvoe.com/user/gallery/2017-08-20-12-29-22Ie0V3.jpg')">
																<a href="#"></a>
															</div>
														</div>
														<div class="title-album-count">
															<a href="">Шопінг у Львові</a>
															<span>(8 фото)</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab-photo-2">Tab 6 ...</div>
									<div role="tabpanel" class="tab-pane fade " id="tab-photo-3">
										<div class="one-date-photo">
											<span>2017 год</span>
											<div class="tjpictures">
												<img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/8.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/9.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/10.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/11.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
											</div>
										</div>
										<div class="one-date-photo">
											<span>2016 год</span>
											<div class="tjpictures">
												<img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/8.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/9.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/10.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/11.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/1.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/2.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/3.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/4.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/5.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/6.jpg') !!}" alt="" />
												<img src="{!! Theme::asset()->url('images/set3/7.jpg') !!}" alt="" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-videos">
						<div class="wrap-content-tab">

							<div class="wrap-photo-tab">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#tab-video-1" aria-controls="tab-video-1" role="tab" data-toggle="tab">Альбоми з відео</a></li>
									<li role="presentation" ><a class="switch-grid" href="#tab-video-2" aria-controls="tab-video-2" role="tab" data-toggle="tab">Всі відео</a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="tab-video-1">
										<div class="wrap-video-tab">
											<div class="row">
												<div class="col-sm-3">
													<div class="wrap-video-album-tab">
														<div class="own-album-video">
															<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/KyyvXziUGCQ"></div>
														</div>
													</div>
													<div class="title-video-tab">
														<p><a href="">PSG vs Toulouse 6-2 - All Goals & Highlights</a></p>
														<span>(28 видео)</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="wrap-video-album-tab">
														<div class="own-album-video">
															<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/MXGORPXI6QQ"></div>
														</div>
													</div>
													<div class="title-video-tab">
														<p><a href="">Chalissery program 2015</a></p>
														<span>(28 видео)</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="wrap-video-album-tab">
														<div class="own-album-video">
															<div class="embed-video" data-source="youtube" data-video-url="https://www.youtube.com/watch?v=C-Q7GeQG6iE"></div>
														</div>
													</div>
													<div class="title-video-tab">
														<p><a href="">TRADA's National Student Design</a></p>
														<span>(28 видео)</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="wrap-video-album-tab">
														<div class="own-album-video">
															<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/adFIMREcfog"></div>
														</div>
													</div>
													<div class="title-video-tab">
														<p><a href="">Вечерний Квартал 2016</a></p>
														<span>(28 видео)</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab-video-2">
										<div class="wrap-video-tab">
											<div class="row">
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/KyyvXziUGCQ"></div>
													<div class="title-video-tab">
														<p><a href="">PSG vs Toulouse 6-2 - All Goals & Highlights</a></p>
														<a href="">Vine Video</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/MXGORPXI6QQ"></div>
													<div class="title-video-tab">
														<p><a href="">Chalissery program 2015</a></p>
														<a href="">Vine Video</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://www.youtube.com/watch?v=C-Q7GeQG6iE"></div>
													<div class="title-video-tab">
														<p><a href="">TRADA's National Student Design</a></p>
														<a href="">Vine Video</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/adFIMREcfog"></div>
													<div class="title-video-tab">
														<p><a href="">Вечерний Квартал 2016</a></p>
														<a href="">Студия Квартал 95</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/uhmcyFSJYXg"></div>
													<div class="title-video-tab">
														<p><a href="">Топ 5 противостояний Конора Макгрегора</a></p>
														<a href="">TOP TIP TOP MMA</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/L3wKzyIN1yk"></div>
													<div class="title-video-tab">
														<p><a href="">Rag'n'Bone Man - Human</a></p>
														<a href="">RagnBoneManVEVO</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/kJQP7kiw5Fk"></div>
													<div class="title-video-tab">
														<p><a href="">Ed Sheeran - Shape of You</a></p>
														<a href="">Ed Sheeran</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">три года назад</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/th63_uyJsWI"></div>
													<div class="title-video-tab">
														<p><a href="">ТОП-10 трансферов, которые потрясли мир</a></p>
														<a href="">oSporte TV</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">два года назад</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/KyyvXziUGCQ"></div>
													<div class="title-video-tab">
														<p><a href="">PSG vs Toulouse 6-2 - All Goals & Highlights</a></p>
														<a href="">Vine Video</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="embed-video" data-source="youtube" data-video-url="https://youtu.be/MXGORPXI6QQ"></div>
													<div class="title-video-tab">
														<p><a href="">Chalissery program 2015</a></p>
														<a href="">Vine Video</a>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">1 388</span>
														<span><img src="{!! Theme::asset()->url('images/eye-video.png') !!}" alt="">13.09.18</span>
													</div>
												</div>
											</div>
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
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-event-col">
											<div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-2.png') !!}')">
												<div class="shadow-event-prof">
													<div class="date-event-prof">
														<span class="number-date">26</span>
														<span>серпня</span>
													</div>
												</div>
												<div class="wrap-event-friend">
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-event-col">
												<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
												<div class="btn-hover-wrap">
													<a href="" class="btn-action-hover">
														<i class="icon-pereytu  svoe-icon"></i>
														Посетить
													</a>
													<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
														<i class="icon-pidpysatysya  svoe-icon"></i>
														Подписаться
													</a>
												</div>
												<span>295 374 участников</span>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-event-col">
											<div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-3.png') !!}')">
												<div class="shadow-event-prof">
													<div class="date-event-prof">
														<span class="number-date">26</span>
														<span>серпня</span>
													</div>
												</div>
												<div class="wrap-event-friend">
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-event-col">
												<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
												<div class="btn-hover-wrap">
													<a href="" class="btn-action-hover">
														<i class="icon-pereytu  svoe-icon"></i>
														Посетить
													</a>
													<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
														<i class="icon-pidpysatysya  svoe-icon"></i>
														Подписаться
													</a>
												</div>
												<span>295 374 участников</span>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-event-col">
											<div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}')">
												<div class="shadow-event-prof">
													<div class="date-event-prof">
														<span class="number-date">26</span>
														<span>серпня</span>
													</div>
												</div>
												<div class="wrap-event-friend">
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-event-col">
												<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
												<div class="btn-hover-wrap">
													<a href="" class="btn-action-hover">
														<i class="icon-pereytu  svoe-icon"></i>
														Посетить
													</a>
													<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
														<i class="icon-pidpysatysya  svoe-icon"></i>
														Подписаться
													</a>
												</div>
												<span>295 374 участников</span>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-event-col">
											<div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-2.png') !!}')">
												<div class="shadow-event-prof">
													<div class="date-event-prof">
														<span class="number-date">26</span>
														<span>серпня</span>
													</div>
												</div>
												<div class="wrap-event-friend">
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-event-col">
												<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
												<div class="btn-hover-wrap">
													<a href="" class="btn-action-hover">
														<i class="icon-pereytu  svoe-icon"></i>
														Посетить
													</a>
													<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
														<i class="icon-pidpysatysya  svoe-icon"></i>
														Подписаться
													</a>
												</div>
												<span>295 374 участников</span>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-event-col">
											<div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/set3/other-img-3.png') !!}')">
												<div class="shadow-event-prof">
													<div class="date-event-prof">
														<span class="number-date">26</span>
														<span>серпня</span>
													</div>
												</div>
												<div class="wrap-event-friend">
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-event-col">
												<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
												<div class="btn-hover-wrap">
													<a href="" class="btn-action-hover">
														<i class="icon-pereytu  svoe-icon"></i>
														Посетить
													</a>
													<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
														<i class="icon-pidpysatysya  svoe-icon"></i>
														Подписаться
													</a>
												</div>
												<span>295 374 участников</span>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-md-4">
										<div class="wrap-one-event-col">
											<div class="photo-event-col" style="background-image: url('{!! Theme::asset()->url('images/event-prof-1.png') !!}')">
												<div class="shadow-event-prof">
													<div class="date-event-prof">
														<span class="number-date">26</span>
														<span>серпня</span>
													</div>
												</div>
												<div class="wrap-event-friend">
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/profheader/profheader-ava.jpg') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/orher-img-1.png') !!}')">
														<a href=""></a>
													</div>
													<div class="your-group-friend" style="background-image: url('{!! Theme::asset()->url('images/set3/8.jpg') !!}')">
														<a href=""></a>
													</div>
												</div>
											</div>
											<div class="content-event-col">
												<p><a href="">LET SWIFT - iOS Developers Meet-up</a></p>
												<div class="btn-hover-wrap">
													<a href="" class="btn-action-hover">
														<i class="icon-pereytu  svoe-icon"></i>
														Посетить
													</a>
													<a href="" class="btn-action-hover show-action-hover hidden-action-hover">
														<i class="icon-pidpysatysya  svoe-icon"></i>
														Подписаться
													</a>
												</div>
												<span>295 374 участников</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-bookmarks">Tab Bookmarks ...</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-audio">Tab Audio ...</div>
					<div role="tabpanel" class="tab-pane fade" id="tab-apps">Tab Apps ...</div>
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
