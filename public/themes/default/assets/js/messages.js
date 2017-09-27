var vue = new Vue({
    el: '#messages-page',
    data: {
        conversations: [],
        searchConversion:{},
        group:{
            name:'',
            edit:false,
        },
        newConversation : false,
        editConversation : false,
        recipients : [],
        currentConversation: {
            conversationMessages : [],
            talk : []
        },
        messageBody : '',
        searchUserString: '',
        searching: false,
        loadThread:false,
        loadList:false,
        lastScrollTop:0
    },
    created : function() {
        //this.subscribeToPrivateMessageChannel(current_username);
        this.getConversations();


        $('.coversations-thread').bind('scroll',this.chk_scroll);
        $('.coversations-list').bind('scroll',this.chk_scroll);

        var vm=this;

        notifications.$on('pre-message', function (event) {
            if(event.message.thread_id==vm.currentConversation.id) {
                event.noty = false;
            }
        });

        notifications.$on('deleteMessage', function (event) {

            var conversationIndex = _.findIndex(vm.conversations.data, ['id', event.params.threadId]);
            if (conversationIndex === -1) {
                vm.getConversations();
                return;
            }

            if(event.params.threadId==vm.currentConversation.id){
                var messAll=vm.currentConversation.conversationMessages.data;
                var mess=_.find(messAll, ['id', event.message.id]);
                mess.deleted_at=event.message.deleted_at;
            }

        });

        notifications.$on('message', function (event) {
            if(event.action=='newMessage'){
                var conversationIndex = _.findIndex(vm.conversations.data, ['id', event.params.threadId]);
                var countMes=event.counters.unreadedMessagesCount;
                var conversation = _.pullAt(vm.conversations.data, conversationIndex)[0];

                if (conversationIndex === -1) {
                    vm.getConversations();
                    return;
                }

                if(event.message.thread_id==vm.currentConversation.id){

                    vm.currentConversation.conversationMessages.data.push(event.message);
                    vm.currentConversation.text=event.message.body;
                    vm.conversations.data.unshift(conversation);

                    setTimeout(function(){
                        //timeagoLng.timeSet("time.microtime");
                        vm.autoScroll('.coversations-thread');
                    },100)

                }else{
                    vm.conversations.data[conversationIndex].unreadedMessagesCount=countMes;
                    vm.conversations.data.unshift(conversation);
                }
            }
        });

    },
    methods : {
        notify: function(message,type,layout)
        {

            var n = noty({
                text: message,
                layout: 'bottomLeft',
                type : 'success',
                theme : 'relax',
                timeout:1,
                animation: {
                    open: 'animated fadeIn', // Animate.css class names
                    close: 'animated fadeOut', // Animate.css class names
                    easing: 'swing', // unavailable - no need
                    speed: 500 // unavailable - no need
                }
            });
        },
        afterRedirect:function(){
            var idLoc =localStorage.getItem('settingMes');
            if(!idLoc) return;

            if(this.currentConversation.id==idLoc){
                $('#dropdownSettingMes').addClass('open');
                localStorage.removeItem("settingMes")
            }
            else {
                console.log(this.conversations.data);
                var index = _.findIndex(this.conversations.data, function(el){
                    return el.id==idLoc;
                });

                this.showConversation(this.conversations.data[index]);

                if (conversationIndex === -1) {
                    localStorage.removeItem("settingMes");
                    this.getConversations();
                    return;
                }
            }

        },
        changetime:function(data,type){

            if(type=='threads'){
                $.each(data, function(i, mes) {
                    mes.updated_at=moment.utc(mes.updated_at).format('MMM Do');
                });
            }
            else {
                var data=this.currentConversation.conversationMessages.data;
                $.each(data, function(i, mes) {
                    var last = data[i-1];
                    Vue.set(mes, 'sep_at', false);
                    if(last){
                        if(moment.utc(mes.created_at).format('MDY')!=moment.utc(last.created_at).format('MDY')){
                            mes.sep_at=moment.utc(mes.created_at).format('dd, D MMMM YYYY');
                        }
                    }
                    else{
                        mes.sep_at=moment.utc(mes.created_at).format('dd, D MMMM YYYY');
                    }
                    mes.show_at=moment.utc(mes.created_at).format('LT');
                });
            }
        },

        subscribeToPrivateMessageChannel: function(receiverUsername)
        {
            var vm = this;
            // pusher configuration
            this.pusher = new Pusher(pusherConfig.PUSHER_KEY, {
                encrypted: true,
                cluster: 'eu',
            });

            this.MessageChannel = this.pusher.subscribe(receiverUsername + '-message-created');
            this.MessageChannel.bind('App\\Events\\MessagePublished', function(data) {

                data.message.user = data.sender;
                if(vm.currentConversation.id ==  data.message.thread_id)
                {
                    vm.currentConversation.conversationMessages.push(data.message);
                    setTimeout(function(){
                        timeagoLng.timeSet("time.microtime");
                        vm.autoScroll('.coversations-thread');
                    },100)
                }
                else
                {

                    indexes = $.map(vm.conversations.data, function(thread, key) {
                        if(thread.id == data.message.thread_id) {
                            return key;
                        }
                    });

                    if(indexes != '')
                    {
                        vm.conversations.data[indexes[0]].unread = true;
                        vm.conversations.data[indexes[0]].lastMessage = data.message;
                    }
                    else
                    {
                        vm.$http.post(base_url + 'ajax/get-message/' + data.message.thread_id).then( function(response) {
                            vm.conversations.data.unshift(response.data.data);
                        });
                    }
                }

            });
        },
        getConversations : function()
        {
            var vm =this;
            this.$http.get(base_url + 'ajax/get-threads').then( function(response) {
                this.conversations = JSON.parse(response.body);
                this.showConversation(this.conversations.data[0]);


                this.changetime(this.conversations.data,'threads');
                /*setTimeout(function(){
                 timeagoLng.timeSet("time.microtime");
                 },100)*/
            });

        },
        showConversation : function(conversation,search)
        {
            this.newConversation = false;
            this.searchUserString='';
            this.searchConversion={};


            if(conversation)
            {
                if(conversation.id != this.currentConversation.id)
                {
                    conversation.unread = false;
                    this.$http.post(base_url + 'ajax/get-conversation/' + conversation.id).then( function(response) {
                        var dataConversion= JSON.parse(response.body);
                        dataConversion.conversationMessages.data.reverse();

                        this.currentConversation = dataConversion;
                        this.currentConversation.talk = conversation;

                        this.changetime(this.currentConversation.conversationMessages.data);
                        this.afterRedirect();



                        vm = this;
                        setTimeout(function(){
                            vm.autoScroll('.coversations-thread');
                        },100);

                        if(this.statusRead(dataConversion,dataConversion.conversationMessages.data[0])){
                            this.getMoreConversationMessages();
                        };
                    });
                }
                else{
                    if(search) return false;
                    this.currentConversation.talk.users =this.conversations.data[0].users;
                }
            }

        },
        postMessage : function(conversation)
        {
            messageBody = this.messageBody;
            this.messageBody = '';
            this.$http.post(base_url + 'ajax/post-message/' + conversation.id,{message: messageBody}).then( function(response) {
                if(response.status)
                {
                    //this.currentConversation.conversationMessages.data.push(JSON.parse(response.body).data);
                    vm = this;
                    $('#messageReceipient').focus();
                    setTimeout(function(){
                        timeagoLng.timeSet("time.microtime");
                        vm.autoScroll('.coversations-thread');
                    },100)

                }
            });

        },
        postNewConversationDialog:function(conversations, event){
            this.searchUserString='';
            this.searchConversion={};

            if (event) event.stopPropagation();
            this.$http.post(base_url + 'ajax/thread/create-dialog',{user : conversations.id}).then( function(response) {
                if(response.status)
                {
                    this.getConversations();
                }
            });
        },
        postNewConversationGroup : function() {

            var id =this.recipients.split(',');
            if(this.recipients.length)
            {
                if(id.length==1){
                    this.postNewConversationDialog({id:id[0]});
                    return true;
                }

                this.$http.post(base_url + 'ajax/thread/create-group',{recipients : this.recipients, subject:this.group.name}).then( function(response) {
                    if(response.status)
                    {
                        this.getConversations();
                    }
                });
            }
        },
        postEditConversationGroup:function () {
            if(this.recipients.length)
            {

                this.$http.post(base_url + 'ajax/thread/edit-group/'+this.currentConversation.id,{recipients : this.recipients, subject:this.group.name}).then( function(response) {
                    if(response.status)
                    {
                        var data = JSON.parse(response.data);
                        this.group={name:'', edit:false};
                        this.currentConversation.talk.subject=data.subject;
                        this.getConversations();
                    }
                });
            }
        },
        postAddParticipants:function(){
            if(this.recipients.length)
            {
                this.$http.post(base_url + 'ajax/thread/add-participant/'+this.currentConversation.id,{recipients : this.recipients}).then( function(response) {
                    if(response.status)
                    {
                        this.group={name:'', edit:false};
                        this.clearConversation();
                        this.getConversations();
                    }
                });
            }
        },
        statusRead:function(currentConversation,message){
            var lastRead= currentConversation.participants.last_read;
            var createMes=message.created_at;
            return (new Date(lastRead).getTime()>=new Date(createMes).getTime())?false:true;
        },
        autoScroll : function(element) {
            $(element).animate({scrollTop: $(element)[0].scrollHeight + 600 }, 2000);

            vm = this;
            setTimeout(function(){
                vm.elementsOfVision();
            },2000);
        },
        elementsOfVision:function(findEl,parentEl){

            var parentEl = parentEl || '.coversations-thread';
            var findEl = findEl || '.wrap-other-mess-user';

            var scrollTop = $(parentEl).scrollTop();
            var windowHeight = $(parentEl).height();
            var currentEls = $(findEl);
            var result = [];
            currentEls.each(function(){
                var el = $(this);
                var offset = el.offset();
                var offsetTop = el[0].offsetTop;

                if(scrollTop <= offsetTop && ( offsetTop) < (scrollTop + windowHeight)){
                    result.push(this);
                }

            });

            console.log($(result));
        },
        switchLoader:function(type,event){
            switch (type) {
                case 'Thread':

                    if(event=='set'){
                        $('.coversations-thread span.date-mess').after("<div class='loader'></div>");
                    }
                    else{
                        $('.coversations-thread .loader').remove();
                    }
                    break;
                case 'List':

                    if(event=='set'){
                        $('.wrap-list-message .coversations-list').append("<div class='loader'></div>");
                    }
                    else{
                        $('.wrap-list-message .coversations-list .loader').remove();
                    }

                    break;

            }

        },
        chk_scroll : function(e) {
            var elem = $(e.currentTarget);

            if (elem.scrollTop() > this.lastScrollTop){
                //'scroll down'
                if(elem.data('type')=="threads")
                {
                    if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight()){
                        this.getMoreConversations();
                    }

                }
            } else {
                //'scroll up'
                if (elem.scrollTop() <= 0){
                    this.getMoreConversationMessages();
                }
            }
            this.lastScrollTop=elem.scrollTop();

        },
        getMoreConversationMessages : function() {
            if(this.loadThread || this.newConversation)return false;
            if(this.currentConversation.conversationMessages.data.length < this.currentConversation.conversationMessages.total)
            {

                this.loadThread=true;
                this.switchLoader('Thread','set');

                this.$http.post(this.currentConversation.conversationMessages.next_page_url).then( function(response) {
                    var latestConversations = JSON.parse(response.body);


                    this.currentConversation.conversationMessages.last_page =  latestConversations.conversationMessages.last_page;
                    this.currentConversation.conversationMessages.next_page_url =  latestConversations.conversationMessages.next_page_url;
                    this.currentConversation.conversationMessages.per_page =  latestConversations.conversationMessages.per_page;
                    this.currentConversation.conversationMessages.prev_page_url =  latestConversations.conversationMessages.prev_page_url;

                    this.switchLoader('Thread','remove');
                    var vm = this;



                    $.each(latestConversations.conversationMessages.data, function(i, latestConversation) {
                        vm.currentConversation.conversationMessages.data.unshift(latestConversation);
                    });

                    this.changetime();


                    setTimeout(function(){
                        $('.coversations-thread').animate({scrollTop: 40});
                        /*timeagoLng.timeSet("time.microtime");*/
                    },10);

                    this.loadThread=false;
                });
            }
        },
        getMoreConversations : function() {

            if(this.loadList)return false;
            if(this.conversations.data.length < this.conversations.total)
            {

                this.loadList=true;
                this.switchLoader('List','set');


                this.$http.get(this.conversations.next_page_url).then( function(response) {
                    var latestConversations = JSON.parse(response.body);

                    this.conversations.last_page =  latestConversations.last_page;
                    this.conversations.next_page_url =  latestConversations.next_page_url;
                    this.conversations.per_page =  latestConversations.per_page;
                    this.conversations.prev_page_url =  latestConversations.prev_page_url;



                    this.switchLoader('List','remove');
                    var vm = this;;
                    this.changetime(latestConversations.data,'threads');

                    $.each(latestConversations.data, function(i, latestConversation) {
                        vm.conversations.data.push(latestConversation);
                    });



                    /*setTimeout(function(){
                     timeagoLng.timeSet("time.microtime");
                     },10);*/

                    this.loadList=false;
                });
            }
        },
        clearConversation: function (clear) {
            if(!clear){
                this.newConversation = false;
                this.editConversation = false;
            }
            this.messageBody = "";
        },
        showNewConversation : function()
        {
            if(this.newConversation) return;
            this.newConversation = true;
            this.currentConversation = {
                conversationMessages : [],
                talk : []
            };

            $('#messageReceipient').focus();
            vm = this;
            setTimeout(function(){
                vm.toggleUsersSelectize();
            },10);

        },
        showEditConversation:function(){

            if(this.newConversation && this.editConversation) return;
            this.newConversation  = true;
            this.editConversation = true;
            this.group.name=this.currentConversation.subject;
            this.group.edit=true;

            vm = this;
            setTimeout(function(){
                vm.toggleUsersSelectize(true);
            },10);
        },
        renameGroup:function(conver){
            if(conver.type!="group") return false;
            var name = prompt("Пожалуйста введите имя",conver.subject);
            if(name===null ||  name==conver.subject) return false;

            this.$http.post(base_url + 'ajax/thread/rename-group/'+conver.id,{subject:name}).then( function(response) {
                var data = JSON.parse(response.data);
                conver.subject=data.thread.subject;
                this.getConversations();
            });


        },
        toggleUsersSelectize : function(editGroup)
        {
            vm = this;
            var selectizeUsers = $('#messageReceipient').selectize({
                plugins: ['remove_button'],
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                preload: true,
                render: {
                    option: function(item, escape) {
                        return '<div class="media big-search-dropdown">' +
                            '<a class="media-left" href="#">' +
                            '<img src="'+ item.avatar + '" alt="...">' +
                            '</a>' +
                            '<div class="media-body">' +
                            '<h4 class="media-heading">' + escape(item.name) + '</h4>' +
                            '<p>' +  item.username +  '</p>' +               '</div>' +
                            '</div>';
                    }

                },
                onDelete: function(values) {
                    //return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
                },
                onInitialize: function() {
                    this.clearOptions();
                    this.clear();
                    if(!editGroup) return;
                    try {
                        /**
                         * when we can edit already added users
                         * var users=vm.currentConversation.talk.users;
                         * */
                        var users={};

                        this.addOption(users);
                        for (var i = 0, n = users.length; i < n; i++) {
                            this.addItem(users[i].id);
                        }
                        this.refreshOptions();

                    }
                    catch(err) {
                        console.error(err);
                    }
                },
                onChange: function(value)
                {
                    $('[name="user_tags"]').val(value);
                    vm.recipients =this.items;

                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: base_url  + 'api/v1/users',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            search: query
                        },
                        error: function() {
                            callback();
                        },
                        success: function(res) {

                            callback(res.data);
                        }
                    });
                }
            });
        },
        search_thread:function () {

        },
        getThreads:function (search) {
            var vm =this;
            this.$http.get(base_url + 'ajax/messenger/filter'+ '?search=' + search).then( function(response) {

                var latestConversations = JSON.parse(response.body);

                this.conversations=[];

                /*this.conversations.last_page =  latestConversations.last_page;
                 this.conversations.next_page_url =  latestConversations.next_page_url;
                 this.conversations.per_page =  latestConversations.per_page;
                 this.conversations.prev_page_url =  latestConversations.prev_page_url;
                 this.conversations.data=latestConversations.data;*/

                vm.searchConversion={};

                $.each(latestConversations, function(i, mes) {
                    switch (mes.type) {
                        case 'group':
                            vm.searchConversion.group = vm.searchConversion.group || [];
                            vm.searchConversion.group.push(mes);
                            break;
                        case 'newuser':
                            vm.searchConversion.newuser = vm.searchConversion.newuser || [];
                            vm.searchConversion.newuser.push(mes);

                            break;
                        case 'dialog':
                            vm.searchConversion.dialog = vm.searchConversion.dialog || [];
                            vm.searchConversion.dialog.push(mes);
                            break;
                        case 'friend':
                            vm.searchConversion.friend = vm.searchConversion.friend || [];
                            vm.searchConversion.friend.push(mes);
                            break;
                    }
                });
                setTimeout(function(){
                    timeagoLng.timeSet("time.microtime");
                },10);

            });

        },
        removeMessage:function(mes){

            this.$http.post(base_url + 'ajax/delete-message/' + mes.id).then( function(response) {
                if(response.status)
                {
                    //console.log(response);
                }
            });

        }

    },
    watch: {
        searchUserString: function() {
            var search = this.searchUserString.trim();

            if(search.length>2){
                this.getThreads(search);
            }

            if(!search.length){
                this.searchConversion={};
                this.getConversations();
            }
        }
    }
});
