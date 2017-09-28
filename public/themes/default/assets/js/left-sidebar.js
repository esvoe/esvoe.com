var leftSidebar = new Vue({
    el: '#leftSidebar',
    data: {
        unreadedThreadsCount: 0
    },
    created: function () {
        this.getUnreadConversationsCounter();
    },
    ready: function() {
        var vm = this;

        notifications.$on('message', function (event) {
            vm.unreadedThreadsCount = event.counters.unreadedThreadsCount;
        });

        notifications.$on('read', function (event) {
            vm.unreadedThreadsCount = event.counters.unreadedThreadsCount;
        });

        notifications.$on('deleteMessage', function (event) {
            vm.unreadedThreadsCount = event.counters.unreadedThreadsCount;
        });
    },
    methods: {
        getUnreadConversationsCounter: function()
        {
            // Lets get the unread conversations once the Vue instance is ready
            this.$http.get(base_url + 'ajax/get-unread-threads?type=threads').then(function(response)  {
                this.unreadedThreadsCount = JSON.parse(response.body).unreadedThreadsCount;
            });
        }
    }
});