<!-- <div class="main-content">-->	
<div class="container">

	<div class="row">
		<div class="col-md-2 visible-lg">
			{!! Theme::partial('home-leftbar',compact('trending_tags')) !!}			
		</div>
		<div class="col-lg-10 col-md-12">
			<div class="messages-page" id="messages-page">
				<div class="panel panel-default">
					<div class="panel-heading no-bg user-pages">
						<div class="page-heading header-text">
							messages
						</div>
						<div class="user-info-bk">
							<a href="#">
								<div class="user-img">
									<img src="{!! Theme::asset()->url('images/avatar.png') !!}" class="img-icon img-50" alt="images">
									<div class="status">
										<span class="status-circle"></span>
									</div>
								</div>
							</a>
							<div class="user-details">
								<div class="pull-left">
									<div class="user-name">
										<a href="#">Jordan.j</a>
									</div>
									<div class="user-role">
										administrator
									</div>
								</div>
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<i class="fa fa-angle-down" aria-hidden="true"></i>
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body nopadding">

						{{-- messagebox --}}
						<div class="row message-box">
							<div class="col-md-4 message-col-4">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
									</span>
								</div><!-- /input-group -->    
								<ul class="list-unstyled coversations-list scrollable">
									<li class="message-holder"  v-for="conversation in conversations.data">
										<a href="#" class="show-conversation" data-id="@{{ conversation.id }}">
											<div v-for="message in converstaion.messages">
												<div class="media post-list">
													<div class="media-left">
														<img src="" alt="images"  class="img-radius img-46">
													</div>
													<div class="media-body">
														<div class="post-time">2m</div>
														<h4 class="media-heading">
															sender name
														</h4>
														<div class="post-text">
															message description
															<div class="unseen-messages">
																1
															</div>
														</div>
													</div>
												</div>
											</div>
										</a>
									</li>
								</ul>

								<ul class="list-unstyled coversations-list scrollable hidden">
									@if($conversations->count() > 0)
										@foreach($conversations as $conversation)
											@if($conversation->users->count() == 2)
												@foreach($conversation->users as $user)
													@if($user->id != Auth::user()->id)
													<li class="message-holder">
														<a href="#" class="show-conversation" data-id="{{ $conversation->id }}">
															<div class="media post-list">
																<div class="media-left">
																	<img src="{{ $user->avatar }}" alt="images"  class="img-radius img-46">
																</div>
																@foreach($conversation->users as $user)
																	@if($user->id != Auth::user()->id)
																		<div class="media-body">
																			<div class="post-time">2m</div>
																			<h4 class="media-heading">
																				{{ $user->name }}
																			</h4>
																			<div class="post-text">
																				@foreach($conversation->messages as $key => $message)
																				{{  $message->description  }}	
																				<div class="unseen-messages">
																					1
																				</div>
																				@break

																				@endforeach


																			</div>
																		</div>
																	@endif
																@endforeach


															</div>
														</a>
													</li>
													@endif
												@endforeach
											@endif
										@endforeach
									@else
									<li>
										No messages
									</li>
									@endif
								</ul>
							</div>

							<div class="col-md-8 message-col-8">
								<div class="coversation-tree">
									{!! Theme::partial('conversation-thread',compact('latest_conversation')) !!}	
								</div>

								<div class="input-group new-message">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">+</button>
									</span>
									<textarea class="form-control post-message" rows="2"></textarea>
								</div><!-- /input-group -->
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>

</div>
<!-- </div> -->

{!! Theme::asset()->container('footer')->usePath()->add('messages-js', 'js/messages.js') !!}