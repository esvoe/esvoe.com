<!-- right-sidebar -->
<div class="wrap-friends-side">
<div id="chatBoxes" v-cloak>
    <div class="chat-list" style="top: 70px; z-index: auto;">
        <div class="left-sidebar socialite" style="background: #fafbfc; position: relative;">
            <ul class="list-group following-group scrollable smooth-scroll">
                <li class="list-group-item group-heading">{{ trans('common.following') }}
                    <div class="dropdown btn-setting">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                    </div>
                </li>
                <li class="list-group-item" v-for="conversation in conversations.data">
                    <a href="#" @click.prevent="showChatBox(conversation.id)">
                        <div class="media">
                            <div class="status-user-friend" v-bind:class="[conversation.online ? 'online-friend-right' : '']"></div>
                            <div class="send-mess-right">
                                <img src="{!! Theme::asset()->url('images/envelope-message.png') !!}" alt="">
                                <span v-if="conversation.unreadedMessagesCount">@{{conversation.unreadedMessagesCount}}</span>
                            </div>
                            <div class="media-left" onClick="event.stopPropagation(),window.location.href = '/@{{ conversation.username }}';" v-bind:style="{ backgroundImage: 'url(' + conversation.avatar + ')' }" ></div>
                            <div class="media-body" >
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
    <div class="chatters chatters-friends" id="chatters">
        {{-- start of chat box --}}
        <div class="chat-box" v-bind:class="[chatBox.minimised ? 'chat-box-small' : '',  ]" v-for="chatBox in chatBoxes">
            <div class="chat-box-header">
                <span class="side-left">
                    <!-- fix check online -->
                    <a href="#" @click.prevent="toMessages(chatBox)" class="chat-box-ico user-ico" v-bind:class="[conversation.online ? 'online' : '']">
                        <i class="icon-korystuvach svoe-icon"></i>
                    </a>
                    <a href="@{{ chatBox.username }}" v-if="chatBox.type === 'dialog'">@{{ chatBox.subject }}</a>
                    <a v-if="chatBox.type === 'group'">@{{ chatBox.subject }}</a>
                </span>
                <ul class="list-inline side-right">
                    <li class="minimize-chatbox chat-box-ico">
                        <a href="#" @click.prevent="toMessages(chatBox)">
                            <span class="svg-ico">
                                <svg x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                    <path class="st0" d="M9,16V9h7v7H9z M15,10h-5v5h5V10z M15,1H1v14h6v1H0V0h16v7h-1V1z"/>
                                    <path class="st0" d="M8.3,9L4,4.6V7H3V3h4v1H4.8l4.3,4.3L8.3,9z"/>
                                </svg>
                            </span>
                        </a>
                    </li>
                    <li class="minimize-chatbox chat-box-ico">
                        <a href="#" @click.prevent="chatBox.minimised ? chatBox.minimised=false : chatBox.minimised=true">
                            <span class="svg-ico import-hide">
                                <svg x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                    <path d="M0,16V0h16v16H0z M15,1H1v14h14V1z"/>
                                    <path d="M3,12h10v1H3V12z"/>
                                    <path d="M5.1,7.8l3.5,3.5L7.9,12L4.4,8.5L5.1,7.8z"/>
                                    <path d="M10.9,7.8l-3.5,3.5L8.1,12l3.5-3.5L10.9,7.8z"/>
                                </svg>
                            </span>
                            <span class="svg-ico import-show">
                                <svg x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                    <path d="M0,16V0h16v16H0z M15,1H1v14h14V1z"/>
                                    <path d="M3,12h10v1H3V12z"/>
                                    <path d="M5.1,7.8l3.5,3.5L7.9,12L4.4,8.5L5.1,7.8z"/>
                                    <path d="M10.9,7.8l-3.5,3.5L8.1,12l3.5-3.5L10.9,7.8z"/>
                                </svg>
                            </span>
                        </a>
                    </li>
                    <li class="close-chatbox chat-box-ico">
                        <a href="#" @click.prevent="chatBoxes.$remove(chatBox)" >
                            <span class="svg-ico">
                                <svg x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                    <path d="M0,16V0h16v16H0z M15,1H1v14h14V1z"/>
                                    <path d="M4.1,4.6L4.7,4l7.4,7.4L11.5,12L4.1,4.6z"/>
                                    <path d="M4.1,11.4L11.5,4L12,4.6L4.6,12L4.1,11.4z"/>
                                </svg>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="chat-conversation scrollable smooth-scroll">
                <ul class="list-unstyled chat-conversation-list">
                    <li class="message-conversation" v-bind:class="[({{ Auth::id() }}==message.user.id) ? 'current-user' : '',  ]" v-for="message in chatBox.conversationMessages.data">
                        <div class="media">

                            <div v-if="!message.deleted_at">
                                <div class="media-left">
                                    <a href="#">
                                        <img v-bind:src="message.user.avatar" alt="images">
                                    </a>
                                </div>
                                <div class="media-body ">
                                    <p class="post-text">
                                        @{{ message.body }}
                                    </p>
                                </div>
                            </div>

                            <div v-if="message.deleted_at">

                                <div class="mess-delete" v-bind:class="[({{ Auth::id() }}==message.user.id) ? 'my-message-user' : 'own-message-user ',  ]">
                                    <p><i class="icon-vydalyty svoe-icon"></i>{{ trans('messages.announcement_deleted_success') }}</p>
                                </div>

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
</div>
{!! Theme::asset()->container('footer')->usePath()->add('chatboxes-js', 'js/chatboxes.js') !!}