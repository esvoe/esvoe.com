// var socket = io('http://socialite.dev:3000');

var notifications = new Vue({
    el: '#navbar-right, #navbar-right1',
    data: {
        notifications: [],
        unreadNotifications: 0,
        notificationsLoaded: false,
        notificationsLoading: false,
        posts: [],
        unreadedDialogsCount: 0,
        pusher: []
    },
    created: function() {
        var vm = this;

        $('.dropdown-messages-list').bind('scroll', vm.chk_scroll);

        // Get if there are any unread notifications or conversations
        vm.getNotificationsCounter();
        vm.getUnreadConversationsCounter();

        // init the pusher
        vm.subscribeToNotificationsChannel();
        vm.subscribeToMessagesChannel();

        vm.$on('pre-message', function (event) {
            if (event.sender.id === event.receiver.id) event.noty = false;
        });

        // subscribe on message-event
        vm.$on('message', function (event) {
            vm.unreadedDialogsCount = event.counters.unreadedDialogCount;
            if (event.noty === true) {
                vm.notify(
                    '<i class="icon-povidomlennia svoe-lg svoe-icon"></i> ' + event.params.subject,
                    function () {chatBoxes.showChatBox(event.params.threadId);}
                );
            }
        });

        vm.$on('read', function (event) {
            vm.unreadedDialogsCount = event.counters.unreadedDialogCount;
        });
    },
    methods: {
        subscribeToNotificationsChannel: function()
        {
            var vm = this;
            // pusher configuration
            vm.pusher = new Pusher(pusherConfig.PUSHER_KEY, {
                encrypted: true,
                cluster: 'eu'
            });

            // socket.on(current_username + '-notification-created',function(data){
            //     var data = data.data;
            //     vm.unreadNotifications = vm.unreadNotifications + 1;
            //     data.notification.notified_from = data.notified_from
            //     if(vm.notifications.data != null)
            //     {
            //         vm.notifications.data.unshift(data.notification);
            //     }
            //     vm.notify(data.notification.description);
            //     $.playSound(theme_url + '/sounds/notification');
            //     jQuery("time.timeago").timeago();
            // })

            vm.NotificationChannel = this.pusher.subscribe(current_username + '-notification-created');
            vm.NotificationChannel.bind('App\\Events\\NotificationPublished', function(data) {
                vm.unreadNotifications = vm.unreadNotifications + 1;
                data.notification.notified_from = data.notified_from;
                if (vm.notifications.data != null) vm.notifications.data.unshift(data.notification);
                vm.notify(data.notification.description);
                $.playSound(theme_url + '/sounds/notification');
                jQuery("time.timeago").timeago();
            });
        },
        subscribeToMessagesChannel: function()
        {
            var vm = this;
            // pusher configuration
            vm.pusher = new Pusher(pusherConfig.PUSHER_KEY, {
                encrypted: true,
                cluster: 'eu'
            });

            vm.MessageChannel = vm.pusher.subscribe(current_username + '-messenger');
            vm.MessageChannel.bind('App\\Events\\MessagePublished', function (data) {
                vm.event(data);
            });
        },
        getNotificationsCounter: function()
        {
            // Lets get the unread notifications once the Vue instance is ready
            this.$http.post(base_url + 'ajax/get-unread-notifications').then(function(response) {
                this.unreadNotifications = JSON.parse(response.body).unread_notifications;
            });
        },
        showNotifications: function()
        {
            var vm = this;
            if(!vm.notificationsLoaded)
            {
                vm.notificationsLoading = true;
                vm.$http.post(base_url + 'ajax/get-notifications').then(function(response) {
                    vm.notifications = JSON.parse(response.body).notifications;
                    setTimeout(function() {
                        jQuery("time.timeago").timeago();
                    }, 10);
                    vm.notificationsLoading = false;
                });
                vm.notificationsLoaded = true;
            }
        },
        getMoreNotifications: function()
        {
            var vm = this;
            if(vm.notifications.data.length < vm.notifications.total)
            {
                vm.notificationsLoading = true;
                vm.$http.post(vm.notifications.next_page_url).then(function(response) {
                    var latestNotifications = JSON.parse(response.body).notifications;

                    vm.notifications.last_page = latestNotifications.last_page;
                    vm.notifications.next_page_url = latestNotifications.next_page_url;
                    vm.notifications.per_page = latestNotifications.per_page;
                    vm.notifications.prev_page_url = latestNotifications.prev_page_url;

                    $.each(latestNotifications.data, function(i, latestNotification) {
                        vm.notifications.data.push(latestNotification);
                    });
                    vm.notificationsLoading = false;
                    setTimeout(function() {
                        jQuery("time.timeago").timeago();
                    }, 10);
                });
            }
        },
        markNotificationsRead: function()
        {
            var vm = this;
            vm.$http.post(base_url + 'ajax/mark-all-notifications').then(function(response)  {
                vm.unreadNotifications = 0;
                $.map(vm.notifications, function(notification, key) {
                    vm.notifications[key].seen = true;
                });
            });
        },
        getUnreadConversationsCounter: function()
        {
            // Lets get the unread conversations once the Vue instance is ready
            this.$http.get(base_url + 'ajax/get-unread-threads?type=dialog').then(function(response)  {
                this.unreadedDialogsCount = JSON.parse(response.body).unreadedDialogCount;
            });
        },
        chk_scroll: function(e)
        {
            var elem = $(e.currentTarget);
            if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())
            {
                if(elem.data('type') == "notifications") {
                    this.getMoreNotifications();
                } else {
                    this.getMoreConversations();
                }
            }
        },
        notify: function(message, onCloseCallback)
        {
            noty({
                text: message,
                layout: 'bottomLeft',
                type: 'success',
                theme: 'relax',
                timeout: 10000,
                animation: {
                   open: 'animated fadeIn', // Animate.css class names
                   close: 'animated fadeOut', // Animate.css class names
                   easing: 'swing', // unavailable - no need
                   speed: 500 // unavailable - no need
                },
                callback: {
                    onCloseClick: onCloseCallback
                }
           });
        },
        event: function (event) {
            var vm = this;
            event.message.user = event.sender;
            if (event.action === 'newMessage') {
                event.noty = true;
                vm.$emit('pre-message', event);
                vm.$emit('message', event);
            }
            if (event.action === 'readMessage') {
                vm.$emit('read', event);
            }
        }
    }
});