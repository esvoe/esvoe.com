var chatBoxes = new Vue({
    el: '#chatBoxes,#chatBoxesMes',
    data: {
        chatBoxes: [],
        messageBody : '',
        conversations : []
    },
    created: function() {
        this.getConversations();

        $('.chat-conversation-list').bind('scroll', this.chk_scroll);
        $('.following-group').bind('scroll', this.chk_scroll_bottom);

    },
    ready: function() {
        var vm = this;

        notifications.$on('pre-message', function (event) {
            event.chatBox = _.find(vm.chatBoxes, ['id', event.params.threadId]);
            if (event.chatBox !== undefined) event.noty = false;
        });

        notifications.$on('message', function (event) {
            var conversationIndex = _.findIndex(vm.conversations.data, ['id', event.params.threadId]);

            // chatbox
            if (event.chatBox !== undefined) {
                event.chatBox.conversationMessages.data.push(event.message);
            }

            // conversations in right-bar
            if (conversationIndex === -1) {
                vm.getConversations();
            } else {
                var conversation = _.pullAt(vm.conversations.data, conversationIndex)[0];
                conversation.unreadedMessagesCount = event.counters.unreadedMessagesCount;
                vm.conversations.data.unshift(conversation);
            }
        });

        notifications.$on('deleteMessage', function (event) {
            var chat = _.find(vm.chatBoxes, ['id', event.params.threadId]);
            if (chat !== undefined) {
                var message = _.find(chat.conversationMessages.data, ['id', event.message.id]);
                if (message !== undefined){
                    message.deleted_at=event.message.deleted_at;
                }
            }
        });
    },
    methods: {
        timeago: function() {

            jQuery.timeago.settings.strings.suffixAgo = "";
            jQuery.timeago.settings.strings.suffixFromNow = "from now";
            jQuery.timeago.settings.strings.inPast = "any moment now";
            jQuery.timeago.settings.strings.seconds = "less than 1m";
            jQuery.timeago.settings.strings.minute = "1m";
            jQuery.timeago.settings.strings.minutes = "%dm";
            jQuery.timeago.settings.strings.hour = "1h";
            jQuery.timeago.settings.strings.hours = "%dh";
            jQuery.timeago.settings.strings.day = "1d";
            jQuery.timeago.settings.strings.days = "%dd";
            jQuery.timeago.settings.strings.month = "1m";
            jQuery.timeago.settings.strings.months = "%dm";
            jQuery.timeago.settings.strings.year = "1y";
            jQuery.timeago.settings.strings.years = "%dy";
            jQuery("time.microtime").timeago();

        },
        autoScroll: function(element)
        {
            $(element).animate({scrollTop: $(element)[0].scrollHeight + 600}, 2000);
        },
        getConversations: function()
        {
            this.$http.get(base_url + 'ajax/get-contacts').then(function(response) {
                this.conversations = JSON.parse(response.body);
            });
        },
        postMessage: function(conversation)
        {
            vm = this;
            if(conversation.newMessage.trim() !== '')
            {
                vm.$http.post(base_url + 'ajax/post-message/' + conversation.id, {message: conversation.newMessage});
                conversation.newMessage="";
                setTimeout(function() {
                    vm.autoScroll('.chat-conversation');
                }, 100);
            }
        },
        showChatBox: function(conversationId, userId)
        {
            var vm = this;

            if (!conversationId) {
                this.postNewConversationDialog(userId);
                return;
            }

            indexes = $.map(vm.chatBoxes, function(thread, key) {
                if(thread.id === conversationId) return key;
            });

            if(indexes[0] >= 0) {
                console.log('prevented second opening of chat box');
            } else {
                vm.$http.post(base_url + 'ajax/get-conversation/' + conversationId).then(function(response) {
                    if(response.status)
                    {
                        var chatBox = JSON.parse(response.body);
                        chatBox.conversationMessages.data.reverse();
                        chatBox.newMessage = "";
                        chatBox.minimised = false;
                        vm.chatBoxes.push(chatBox);
                        setTimeout(function() {
                            vm.autoScroll('.chat-conversation');
                        }, 100);
                    }
                });
            }
        },
        postNewConversationDialog:function(userId){
            this.$http.post(base_url + 'ajax/thread/create-dialog',{user: userId}).then( function(response) {
                if(response.status)
                {
                    this.getConversations();
                    this.showChatBox(JSON.parse(response.body).id);
                }
            });
        },
        chk_scroll: function(e)
        {
            var elem = $(e.currentTarget);
            if (elem.scrollTop() == 0) this.getMoreConversationMessages();
        },
        getMoreConversationMessages : function()
        {
            var vm = this;

            if(vm.currentConversation.conversationMessages.data.length < vm.currentConversation.conversationMessages.total)
            {
                vm.$http.post(vm.currentConversation.conversationMessages.next_page_url).then( function(response) {
                    var latestConversations = JSON.parse(response.body).data;

                    vm.currentConversation.conversationMessages.last_page =  latestConversations.conversationMessages.last_page;
                    vm.currentConversation.conversationMessages.next_page_url =  latestConversations.conversationMessages.next_page_url;
                    vm.currentConversation.conversationMessages.per_page =  latestConversations.conversationMessages.per_page;
                    vm.currentConversation.conversationMessages.prev_page_url =  latestConversations.conversationMessages.prev_page_url;

                    $.each(latestConversations.conversationMessages.data, function(i, latestConversation) {
                        vm.currentConversation.conversationMessages.data.unshift(latestConversation);
                    });

                    setTimeout(function(){
                        vm.timeago();
                    },10);
                });
            }
        },
        chk_scroll_bottom: function(e)
        {
            var elem = $(e.currentTarget);

            if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight()) {
                this.getMoreConversations();
            }
        },
        getMoreConversations: function()
        {
            var vm = this;
            if (vm.conversations.data.length < vm.conversations.total)
            {
                vm.$http.post(vm.conversations.next_page_url).then(function(response) {
                    var latestConversations = JSON.parse(response.body);

                    vm.conversations.last_page = latestConversations.last_page;
                    vm.conversations.next_page_url = latestConversations.next_page_url;
                    vm.conversations.per_page = latestConversations.per_page;
                    vm.conversations.prev_page_url = latestConversations.prev_page_url;
                    
                    $.each(latestConversations.data, function(i, latestConversation) {
                        vm.conversations.data.push(latestConversation);
                    });

                    setTimeout(function(){
                        vm.timeago();
                    }, 10);
                });                      
            }
        },
        toMessages:function(chatBox)
        {
            try {
                localStorage.setItem('settingMes',chatBox.id);
                window.location.href='/messages'
            } catch (e) {
                if (e == QUOTA_EXCEEDED_ERR) {
                    console.error('Превышен лимит LocalStorage');
                    return false;
                }
                console.error(e)
            }


        }
    }    
});