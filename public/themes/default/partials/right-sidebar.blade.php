<!-- right-sidebar -->
<div id="chatBoxes" v-cloak> 
	<div class="chat-list">
		<div class="left-sidebar socialite">
			<ul class="list-group following-group scrollable smooth-scroll">
				<li class="list-group-item group-heading">{{ trans('common.following') }}
					<div class="dropdown btn-setting">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>
					</li>
					<li class="list-group-item" v-for="conversation in conversations.data">
						<a href="#" @click.prevent="showChatBox(conversation)">
							<div class="media">
								<div class="media-left" v-bind:style="{ backgroundImage: 'url(' + conversation.user.avatar + ')' }">
	
								</div>
								<div class="media-body">
									<h4 class="media-heading">@{{ conversation.subject }}</h4>
									<span class="pull-right active-ago" v-if="message">
										<time class="microtime" datetime="@{{ message.created_at }}" title="@{{ message.created_at }}">
                                            @{{ message.created_at }}
                                        </time>
									</span>
								</div>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!--/right-sidebar-->
		<div class="chatters chatters-right" id="chatters">
			{{-- start of chat box --}}
			<div class="chat-box" v-bind:class="[chatBox.minimised ? 'chat-box-small' : '',  ]" v-for="chatBox in chatBoxes">
				<div class="chat-box-header">
					<span class="side-left">
						<a href="@{{ chatBox.user.username }}" target="_blank">@{{ chatBox.subject }}</a>
					</span>
					<ul class="list-inline side-right">
						<li class="minimize-chatbox"><a href="#"><i class="fa fa-minus" @click.prevent="chatBox.minimised ? chatBox.minimised=false : chatBox.minimised=true" aria-hidden="true"></i></a></li>
						<li class="close-chatbox"><a href="#" @click.prevent="chatBoxes.$remove(chatBox)" ><i class="fa fa-times" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="chat-conversation scrollable smooth-scroll">
					<ul class="list-unstyled chat-conversation-list">
						<li class="message-conversation" v-bind:class="[({{ Auth::id() }}==message.user.id) ? 'current-user' : '',  ]" v-for="message in chatBox.conversationMessages.data">
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img v-bind:src="message.user.avatar" alt="imagessss">
									</a>
								</div>
								<div class="media-body ">
									<p class="post-text">
										@{{ message.body }}
									</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="message-input">
					<fieldset class="form-group">
						<input class="form-control" v-model="chatBox.newMessage" v-on:keyup.enter="postMessage(chatBox)" id="exampleTextarea" >
					</fieldset>
					<!-- <ul class="list-inline">this fields are hidden because in dev 1.0 we dont use this fuctionality ,if we enable this the height of chat list to be increased
						<li><a href="#"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i></a></li>
					</ul> -->
				</div>
			</div>
			{{-- end of chat box --}}
		</div>
	</div>

	{!! Theme::asset()->container('footer')->usePath()->add('chatboxes-js', 'js/chatboxes.js') !!}