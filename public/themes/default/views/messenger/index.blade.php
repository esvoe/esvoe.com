<div class="content-main content-main_messenger">
    <div class="container container-grid">

        <div class="panel panel-default">

            <div id="messages-page" v-cloak class="wrap-messenger">

                <div class="wrap-list-message">
                    <div class="search-friend-mess">
                        <div class="form-group">
                            <i class="icon-shukaty svoe-icon seach-mess-icon"></i>
                            <i @click.prevent="showNewConversation" class="icon-nove-povidomlennya svoe-icon seach-mess-new" title="новое сообщение"></i>
                            {{--<input id="searchUserString"  type="text" class="form-control" placeholder="{{ trans('common.to_find') }}" v-model="searchUserString">--}}
                            <input   type="text" class="form-control" placeholder="{{ trans('common.to_find') }}" v-model="searchUserString">
                        </div>
                    </div>
                    <div @wait-for="getConversations" class="coversations-list"  data-type="threads" >
                        <div class="coversations-list-scroll">

                            
                            
                            <!-- MARKUP: new message template -->
                            <div v-if="newConversation" class="wrap-own-user-mess wrap-create-mess active-message-user">
                                <div class="wrap-mess-content">
                                    <div class="photo-user-mess-list" style="background-image: url({!! Theme::asset()->url('images/_new/create-msg-logo.png') !!});"></div>
                                    <div class="name-text-user-list">
                                        <p>{{ trans('messages.create_a_new_message') }}</p>
                                    </div>
                                    <div class="user-mess-close" v-on:click="clearConversation()">
                                        <i class="icon-zakrutu svoe-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- / MARKUP: new message template -->


                            <!-- MARKUP: group message template -->
                           {{-- <div class="wrap-own-user-mess wrap-group-mess active-message-user">
                                <div class="wrap-mess-content">
                                <div class="photo-user-mess-list">
                                    <span style="background-image: url(group/avatar/default-group-avatar.png);"></span>
                                    <span style="background-image: url(group/avatar/default-group-avatar.png);"></span>
                                    <span class="default"><i class="icon-grupy svoe-icon"></i></span>
                                    <span style="background-image: url(group/avatar/default-group-avatar.png);"></span>
                                </div>

                                <div class="name-text-user-list">
                                    <a href="#">Катя Самбука, Роман Гонтар, Антон Антонов, Иван Иванов, Петр Петров</a>
                                    <p><a href="#">Васьок:</a> Всім надобраніч!</p>
                                    <span class="date-text-user-list">
                                        <time class="microtime" datetime="2017-09-07 17:48:51" title="2017-09-07 17:48:51">4 дні тому</time>
                                    </span>
                                </div>
                                </div>

                                <div class="dropdown mess-dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenu-mess" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="icon-menyu svoe-icon"></i>
                                    </button>
                                    <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-mess">
                                        <li>
                                            <a href="#" class="">
                                                <i class="icon-bachymo svoe-icon"></i>Все прочитанные
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" class="">
                                                <i class="icon-vydalyty svoe-icon"></i>Удалить чат
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" class="">
                                                <i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>--}}
                            <!-- / MARKUP: group message template -->


                            <!-- MARKUP: search result template -->

                            <!-- Друзья -->
                            <div  v-if="searchConversion.friend">
                                <div class="usersearch-categories">
                                    <div class="usersearch-categories_ico">
                                        <i class="icon-druzi svoe-icon"></i>
                                    </div>
                                    <div class="usersearch-categories_title">{{ trans('messages.friends') }}</div>
                                </div>
                                <div v-for="data in searchConversion.friend">
                                    <a class="usersearch-item" href="#" @click.prevent="postNewConversationDialog(data,$event)">
                                        <span class="usersearch-item_in">
                                            <span class="usersearch-item_pic">
                                                <img  v-bind:src="data.avatar" alt="...">
                                            </span>
                                            <span class="usersearch-item_title">
                                                @{{ data.subject }}
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <div v-if="searchConversion.dialog">
                                <div class="usersearch-categories">
                                    <div class="usersearch-categories_ico">
                                        <i class="icon-grupy svoe-icon"></i>
                                    </div>
                                    <div class="usersearch-categories_title">{{ trans('messages.people') }}</div>
                                </div>
                                <div v-for="data in searchConversion.dialog">
                                    <a class="usersearch-item" href="#" @click.prevent="showConversation(data,true)">
                                    <span class="usersearch-item_in">
                                        <span class="usersearch-item_pic">
                                            <img  v-bind:src="data.avatar" alt="...">
                                        </span>
                                        <span class="usersearch-item_title">
                                            @{{ data.subject }}
                                        </span>
                                    </span>
                                    </a>
                                </div>
                            </div>

                            <div v-if="searchConversion.group">
                                <div class="usersearch-categories">
                                    <div class="usersearch-categories_ico">
                                        <i class="icon-grupy svoe-icon"></i>
                                    </div>
                                    <div class="usersearch-categories_title">{{ trans('messages.group') }}</div>
                                </div>
                                <div v-for="data in searchConversion.group">
                                    <a class="usersearch-item" href="#" @click.prevent="showConversation(data,true)">
                                    <span class="usersearch-item_in">
                                        <span class="usersearch-item_pic">
                                            <img  v-bind:src="data.avatar[0]" alt="...">
                                        </span>
                                        <span class="usersearch-item_title">
                                            @{{ data.subject }}
                                        </span>
                                    </span>
                                    </a>
                                </div>
                            </div>
                            <div v-if="searchConversion.newuser">
                                <div class="usersearch-categories">
                                    <div class="usersearch-categories_ico">
                                        <i class="icon-grupy svoe-icon"></i>
                                    </div>
                                    <div class="usersearch-categories_title">{{ trans('messages.dialog') }}</div>
                                </div>
                                <div v-for="data in searchConversion.newuser">
                                    <a class="usersearch-item" href="#" @click.prevent="postNewConversationDialog(data,$event)">
                                        <span class="usersearch-item_in">
                                            <span class="usersearch-item_pic">
                                                <img  v-bind:src="data.avatar" alt="...">
                                            </span>
                                            <span class="usersearch-item_title">
                                                @{{ data.subject }}
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <!-- Страницы -->
                            {{--<div class="usersearch-categories">
                                <div class="usersearch-categories_ico">
                                    <i class="icon-storinky svoe-icon"></i>
                                </div>
                                <div class="usersearch-categories_title">{{ trans('sidebar.pages') }}</div>
                            </div>
                            <a class="usersearch-item" href="#">
                                <span class="usersearch-item_in">
                                    <span class="usersearch-item_pic">
                                        <img src="/user/avatar/2017-09-06-15-06-01stale_thumb_99d.jpg" alt="...">
                                    </span>
                                    <span class="usersearch-item_title">
                                        Vasok
                                    </span>
                                </span>
                            </a>
                            <a class="usersearch-item" href="#">
                                <span class="usersearch-item_in">
                                    <span class="usersearch-item_pic">
                                        <img src="/user/avatar/2017-09-06-15-06-01stale_thumb_99d.jpg" alt="...">
                                    </span>
                                    <span class="usersearch-item_title">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum alias ullam illo voluptates, sit aliquid ipsam aut molestias, ab possimus provident odit doloremque, illum aspernatur consequuntur, itaque incidunt tempora ex!
                                    </span>
                                </span>
                            </a>--}}
                            <!-- / MARKUP: search result template -->


                            <div v-for="conversation in conversations.data">

                                <div  v-if="conversation.type=='dialog'" v-bind:class="[ conversation.unread ? 'unseen-message' : '', (conversation.id==currentConversation.id) ? 'active-message-user' : '',  ]"
                                     class="wrap-own-user-mess">

                                    <div   class="wrap-mess-content" @click.prevent=" showConversation(conversation)">

                                        <div class="photo-user-mess-list" v-bind:style="{ 'background-image': 'url(' + conversation.avatar + ')' }">
                                            <div v-if="!conversation.online" class="status-mess-user"></div>
                                            <div v-if="conversation.online" class="status-mess-user online"></div>
                                        </div>

                                        <div v-if="conversation.unreadedMessagesCount"  class="count-mess-new">
                                            @{{ conversation.unreadedMessagesCount }}
                                        </div>

                                        <div v-bind:class="[conversation.unreadedMessagesCount ? 'has-counter' : '']"
                                             class="name-text-user-list">
                                            <a href="#">@{{ conversation.subject }}
                                            </a>
                                            <p>@{{ conversation.text }}</p>
                                            <span class="date-text-user-list">
                                                <time class="microtime" datetime="@{{ conversation.updated_at }}" title="@{{conversation.updated_at }}">
                                                    @{{ conversation.updated_at }}
                                                </time>
                                            </span>
                                        </div>

                                    </div>
                                <!---Return------>
                                    {{--<div class="dropdown mess-dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenu-mess" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icon-menyu svoe-icon"></i>
                                        </button>
                                        <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-mess">
                                            <li>
                                                <a  href="#" class="">
                                                    <i class="icon-bachymo svoe-icon"></i>{{ trans('common.all_read') }}
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-vydalyty svoe-icon"></i>{{ trans('common.delete_chat') }}
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-zablokuvaty svoe-icon"></i>{{ trans('common.block') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>--}}

                                </div>

                                <div  v-if="conversation.type=='group'"  v-bind:class="[ conversation.unread ? 'unseen-message' : '', (conversation.id==currentConversation.id) ? 'active-message-user' : '',  ]"  class="wrap-own-user-mess wrap-group-mess">
                                    <div class="wrap-mess-content" @click.prevent="showConversation(conversation)">
                                        <div class="photo-user-mess-list">

                                            <span v-bind:style="{ 'background-image': 'url(' + conversation.avatar[0] + ')' }"></span>
                                            <span v-bind:style="{ 'background-image': 'url(' + conversation.avatar[1] + ')' }"></span>
                                            <span class="default"><i class="icon-grupy svoe-icon"></i></span>
                                            <span v-bind:style="{ 'background-image': 'url(' + conversation.avatar[2] + ')' }"></span>
                                        </div>

                                        <div v-if="conversation.unreadedMessagesCount"  class="count-mess-new">
                                            @{{ conversation.unreadedMessagesCount }}
                                        </div>
                                        <div class="name-text-user-list">
                                            <a href="#">@{{ conversation.subject }}</a>
                                            <p><a href="#">Васьок:</a> @{{ conversation.text }}</p>
                                        <span class="date-text-user-list">
                                            <time class="microtime" datetime="@{{ conversation.updated_at }}" title="@{{conversation.updated_at }}">
                                                    @{{ conversation.updated_at }}
                                                </time>
                                        </span>
                                        </div>
                                    </div>

                                    <!---Return------>
                                    {{--<div class="dropdown mess-dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenu-mess" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icon-menyu svoe-icon"></i>
                                        </button>
                                        <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-mess">
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-bachymo svoe-icon"></i>Все прочитанные
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-vydalyty svoe-icon"></i>Удалить чат
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-zablokuvaty svoe-icon"></i>Заблокировать
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li  @click.prevent="renameGroup(conversation)">
                                                <a href="#">
                                                    <i class="fa fa-flag" aria-hidden="true"></i>Переименовать
                                                </a>
                                            </li>
                                        </ul>
                                    </div>--}}

                                </div>
                            </div>





                        </div>
                    </div>
                </div>


                <div class="wrap-content-messenger">
                    <div class="wrap-what-new wrap-mess-send">
                        <div class="block-what-new open-what-new">
                            {{--<div class="photo-what-new" style="background-image: url(&#39;images/user-what-new.png&#39;);"></div>--}}
                            <div class="form-group">


                                <textarea :disabled=newConversation class="form-control post-message"  placeholder="{{ trans('messages.enterText') }}" autocomplete="off" name="message" v-on:keyup.enter="postMessage(currentConversation)" v-model="messageBody" ></textarea>

                                <div class="what-new-add">
                                    <span data-add-new="smile" class="svoe-icon icon-emotsiyi"></span>
                                    <span data-add-new="photo" class="svoe-icon icon-photo"></span>
                                    <span data-add-new="attach" class="svoe-icon icon-prykripyty"></span>                                    
                                </div>


                                <button :disabled=newConversation class="button-post-new" type="button" v-on:click="postMessage(currentConversation)">{{ trans('messages.publish') }}</button>

                            </div>
                        </div>
                    </div>

                    <div class="header-dialog" v-if="!newConversation" >

                        <div class="header-dialog-title">                                
                            <div class="header-dialog-title-wrapper" title="@{{ currentConversation.subject}}">
                                
                                <span class="header-dialog-ico" v-if="currentConversation.type=='dialog'">
                                    <i class="icon-korystuvach svoe-icon"></i> &mdash;
                                </span>
                                <span class="header-dialog-ico" v-if="currentConversation.type=='group'">
                                    <i class="icon-grupy svoe-icon"></i> &mdash;
                                </span>
                                <span class="header-dialog-ico" v-if="currentConversation.type=='newuser'">
                                    <i class="icon-korystuvach svoe-icon"></i> &mdash;
                                </span>

                                @{{ currentConversation.subject }}

                                <a href="#" class="add-more-users" v-on:click="showEditConversation()" v-if="currentConversation.type=='group'">
                                    <i class="icon-plyus svoe-icon"></i>
                                    <!-- <i class="plyus-chornyy svoe-icon"></i> -->
                                </a>

                            </div>                            
                        </div>                            

                            <div class="messenger-open-extra">
                                <i class="icon-filtr svoe-icon"></i>
                                <i class="icon-filtr-a svoe-icon"></i>
                            </div>

                            <div  class="header-dialog-btn dropdown" id="dropdownSettingMes">
                                <button class="dropdown-toggle mess-dialog-menu" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="icon-menyu svoe-icon"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    {{--<li><a href="http://proto.esvoe.com/messenger.html#"><i class="fa fa-eye-slash" aria-hidden="true"></i>Приховати</a></li>
                                    <li><a href="http://proto.esvoe.com/messenger.html#"><i class="fa fa-flag" aria-hidden="true"></i>Поскаржитись</a></li>--}}
                                    <li v-if="currentConversation.type=='group'" v-on:click="renameGroup(currentConversation)"><a href="#"><i class="fa fa-flag" aria-hidden="true"></i>{{ trans('messages.rename') }}</a></li>
                                </ul>
                            </div>
                            
                    </div>

                    <div class="create-conversation" v-if="newConversation">
                        <div class="create-conversation-content">
                            <div class="create-conversation-label">
                                {{ trans('common.transaction_to') }}
                            </div>
                            <input  type="text" v-model="recipients" name="recipients[]" class="form-control" id="messageReceipient" placeholder="{{ trans('messages.search_people_placeholder') }}">
                        </div>
                        <div class="create-conversation-btns">
                            <a v-if="newConversation && !editConversation" v-on:click="postNewConversationGroup()" href="#" class="btn btn-success pull-right create-album-btn">
                                {{ trans('messages.create') }}
                            </a>
                            <!--when we can edit already added users----->
                            {{--<a v-if="newConversation && editConversation" v-on:click="postEditConversationGroup()" href="#" class="btn btn-success pull-right create-album-btn">
                                Обновить Группу
                            </a>--}}


                            <a v-if="newConversation && editConversation" v-on:click="postAddParticipants()" href="#" class="btn btn-success pull-right create-album-btn">
                                {{ trans('messages.add') }}
                            </a>


                            <a v-on:click="clearConversation()" href="#" class="btn btn-success pull-right create-album-btn">
                                {{ trans('messages.close') }}
                            </a>
                        </div>
                    </div>

                    
                    <div class="clip-date-mess"><span></span></div>

                    <div class="own-content-mess-id coversations-thread">

                        <!-- for TEST clipping date title -->
                        <!-- <span class="date-mess">17 чер 2014 23:08</span> -->

                        <div v-show="showMessages" class="wrap-block-mess" v-for="message in currentConversation.conversationMessages.data">

                            <!-- for TEST clipping date title -->
                            {{--<span class="date-mess">@{{ message.sep_at }}</span>--}}

                            <span v-if="message.sep_at" class="date-mess">@{{ message.sep_at }}</span>

                            <div v-if="{{ Auth::user()->id}}!== message.user.id" id="@{{message.id}}"  class="wrap-other-mess-user">

                                <div class="photo-user-mess"  v-bind:style="{ 'background-image': 'url(' + message.user.avatar + ')' }"></div>

                                <div class="mess-wrapper">
                                    <div v-if="!message.deleted_at">
                                        <div class="own-message-user" >
                                            <p>@{{ message.body }}</p>
                                        </div>
                                    </div>
                                    <!-- TEMP START -->
                                    <div v-if="message.deleted_at">
                                    <div class="own-message-user mess-delete">
                                        <p><i class="icon-vydalyty svoe-icon"></i>{{ trans('messages.announcement_deleted_success') }}</p>
                                    </div>
                                    </div>
                                    <!-- TEMP END -->
                                    <span class="time-mess-user">
                                        <time class="microtime" datetime="@{{ message.show_at }}" title="@{{ message.show_at }}">
                                            @{{ message.show_at }}
                                        </time>
                                    </span>
                                </div>
                                <div class="noReadParticipants mess-status" v-if="!message.read_participants">
                                    <i class="icon-nebachymo svoe-icon"></i>{{ trans('messages.not_read') }}
                                </div>

                                {{--<div v-if="!message.deleted_at">
                                    <div class="dropdown mess-dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenu-mess" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icon-menyu svoe-icon"></i>
                                        </button>
                                        <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-mess">
                                            <li>
                                                <a  href="#" class="">
                                                    <i class="icon-vydalyty svoe-icon"></i>{{ trans('common.delete') }}
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-zablokuvaty svoe-icon"></i>{{ trans('common.block') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div v-if="message.deleted_at">
                                    <div class="dropdown mess-dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenu-mess" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icon-menyu svoe-icon"></i>
                                        </button>
                                        <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-mess">
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-zablokuvaty svoe-icon"></i>{{ trans('common.block') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>--}}

                            </div>

                            <div v-if="{{ Auth::user()->id}} == message.user.id" class="my-own-mess">

                                <div class="mess-wrapper">
                                    <span class="time-mess-user">
                                        <time class="microtime" datetime="@{{ message.show_at }}" title="@{{ message.show_at }}">
                                            @{{ message.show_at }}
                                        </time>
                                    </span>

                                    <div v-if="!message.deleted_at">
                                        <div class="my-mess-content">
                                            <p>@{{ message.body }}</p>
                                        </div>
                                    </div>

                                    <!-- TEMP START -->
                                    <div v-if="message.deleted_at">
                                        <div class="my-mess-content mess-delete">
                                            <p><i class="icon-vydalyty svoe-icon"></i>{{ trans('messages.announcement_deleted_success') }}</p>
                                        </div>
                                    </div>
                                    <!-- TEMP END -->

                                </div><!-- /mess-wrapper -->

                                    

                                <div v-if="!message.deleted_at">
                                    {{--<p style="color: red">@{{ message.created_at }}</p>--}}
                                    <span class="photo-my-mess"  v-bind:style="{ 'background-image': 'url(' + message.user.avatar + ')' }"></span>

                                    <div class="dropdown mess-dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenu-mess" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icon-menyu svoe-icon"></i>
                                        </button>
                                        <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-mess">
                                            <li>
                                                <a v-on:click="removeMessage(message)" href="#" class="">
                                                    <i class="icon-vydalyty svoe-icon"></i>{{ trans('common.delete') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- TEMP START -->
                                <div v-if="message.deleted_at">
                                    <span class="photo-my-mess"  v-bind:style="{ 'background-image': 'url(' + message.user.avatar + ')' }"></span>

                                    <div class="dropdown mess-dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenu-mess" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icon-menyu svoe-icon"></i>
                                        </button>
                                        <ul class="dropdown-menu profheader-ctrl-dropdown" aria-labelledby="dropdownMenu-mess">
                                            <li>
                                                <a href="#" class="">
                                                    <i class="icon-zablokuvaty svoe-icon"></i>{{ trans('common.block') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- TEMP END -->

                                <div  v-if="!message.deleted_at" class="mess-status">
                                    <span v-if="message.read_at">{{ trans('messages.readed') }}<i class="icon-bachymo svoe-icon"></i></span>
                                    <span v-if="!message.read_at">{{ trans('messages.sent') }}<i class="icon-prinyat svoe-icon"></i></span>
                                    <span style="display: none">{{ trans('messages.notsent') }}<i class="icon-poskarzhytysya svoe-icon"></i></span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="wrap-extra-messenger">
                    <div class="extra-messenger-sidebar">
                        <div class="sidebar-list-scroll">
                            
                            <div class="collapsebox">
                                <div class="collapsebox-title collapsed" data-toggle="collapse" data-target="#collapse-box-1" aria-expanded="false" aria-controls="collapse-box-1">
                                  <i class="icon-korystuvach svoe-icon collapsebox-title-ico"></i>{{ trans('common.group_members') }}
                                  <i class="icon-strilka svoe-icon collapsebox-title-bul"></i>
                                </div>
                                <div class="collapsebox-content collapse" id="collapse-box-1">
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi voluptatibus sapiente temporibus esse corrupti incidunt dicta id distinctio eum molestias ratione et harum eligendi impedit veniam tenetur, a obcaecati accusantium!
                                </div>
                            </div>

                            <div class="collapsebox">
                                <div class="collapsebox-title" data-toggle="collapse" data-target="#collapse-box-2" aria-expanded="true" aria-controls="collapse-box-2">
                                  <i class="icon-nastroyky svoe-icon collapsebox-title-ico"></i>{{ trans('common.chat_settings') }}
                                  <i class="icon-strilka svoe-icon collapsebox-title-bul"></i>
                                </div>
                                <div class="collapsebox-content collapse in" id="collapse-box-2">
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi voluptatibus sapiente temporibus esse corrupti incidunt dicta id distinctio eum molestias ratione et harum eligendi impedit veniam tenetur, a obcaecati accusantium!
                                </div>
                            </div>

                            <div class="collapsebox">
                                <div class="collapsebox-title collapsed" data-toggle="collapse" data-target="#collapse-box-3" aria-expanded="false" aria-controls="collapse-box-3">
                                  <i class="icon-papka svoe-icon collapsebox-title-ico"></i>{{ trans('common.file_sharing') }}
                                  <i class="icon-strilka svoe-icon collapsebox-title-bul"></i>
                                </div>
                                <div class="collapsebox-content collapse" id="collapse-box-3">
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi voluptatibus sapiente temporibus esse corrupti incidunt dicta id distinctio eum molestias ratione et harum eligendi impedit veniam tenetur, a obcaecati accusantium!
                                </div>
                            </div>

                            <div class="collapsebox">
                                <div class="collapsebox-title collapsed" data-toggle="collapse" data-target="#collapse-box-4" aria-expanded="false" aria-controls="collapse-box-4">
                                  <i class="icon-photoalbomy svoe-icon collapsebox-title-ico"></i>{{ trans('common.photos_sharing') }}
                                  <i class="icon-strilka svoe-icon collapsebox-title-bul"></i>
                                </div>
                                <div class="collapsebox-content collapse" id="collapse-box-4">
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi voluptatibus sapiente temporibus esse corrupti incidunt dicta id distinctio eum molestias ratione et harum eligendi impedit veniam tenetur, a obcaecati accusantium!
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            
        </div> <!-- panel panel-default -->
    </div> <!-- /container container-grid -->
</div><!-- /content-main_messenger -->


{{-- start of  mini chat box --}}

<div v-cloak class="chatters chatters-friends" id="chatBoxesMes">
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
{{-- end of mini chat box --}}
{!! Theme::partial('footer') !!}





{!! Theme::asset()->container('footer')->usePath()->add('notifications', 'js/notifications.js') !!}

{!! Theme::asset()->container('footer')->usePath()->add('timeagoMes', 'js/timeago/timeago-'.App::getLocale().'.js') !!}

{!! Theme::asset()->container('footer')->usePath()->add('moments', 'js/moment/moment.js') !!}
{!! Theme::asset()->container('footer')->usePath()->add('moments', 'js/moment/locale/'.App::getLocale().'.js') !!}


{!! Theme::asset()->container('footer')->usePath()->add('messages-js', 'js/messages.js') !!}
{!! Theme::asset()->container('footer')->usePath()->add('chatboxes', 'js/chatboxes.js') !!}
<script type="text/javascript">
    $(function(){

        var $messenger = $('#messages-page');

        // close dropdown on leave message holder
        $messenger.on('mouseleave', '.wrap-block-mess, .wrap-own-user-mess', function(){
            $(this).find('.dropdown').removeClass('open');
        });

        // Clip day date on top
        var $dateTitle = $messenger.find('.clip-date-mess');
        var $dateText = $messenger.find('.clip-date-mess span');

        $('#messages-page .coversations-thread').on('scroll', function(e){

            // date-mess - each check top offset - append content
            $('#messages-page').find('.date-mess').each(function(){
                var el = $(this);
                
                if ( $dateTitle.offset().top >= el.offset().top ) {
                    el.addClass('disactive');
                } else {
                    el.removeClass('disactive');
                }

            });

            if ( $('#messages-page').find('.date-mess.disactive').length ) {
                $dateText.text( $('#messages-page').find('.date-mess.disactive:last').text() );
                $dateTitle.show();
            } else {
                $dateTitle.hide();
            }

        }); // end Clip day date on top

        // Open extra sidebar
        $messenger.on('click', '.messenger-open-extra', function(){
            $messenger.toggleClass('open-extra');
        });

    });
</script>