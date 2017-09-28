// var socket = io('http://socialite.dev:3000');
var timeagoLng = new Vue({
    methods:{
        timeSet:function (dom){

            function numpf(n, f, s, t) {
                // f - 1, 21, 31, ...
                // s - 2-4, 22-24, 32-34 ...
                // t - 5-20, 25-30, ...
                var n10 = n % 10;
                if ( (n10 == 1) && ( (n == 1) || (n > 20) ) ) {
                    return f;
                } else if ( (n10 > 1) && (n10 < 5) && ( (n > 20) || (n < 10) ) ) {
                    return s;
                } else {
                    return t;
                }
            }

            jQuery.timeago.settings.strings = {
                prefixAgo: null,
                prefixFromNow: null,
                suffixAgo: null,
                suffixFromNow: null,
                seconds: "%d сек",
                minute: null,
                minutes: function(value) { return numpf(value, "%d мин", "%d мин", "%d мин"); },
                hour: "%d час",
                hours: function(value) { return numpf(value, "%d час", "%d часа", "%d часов"); },
                day: "вчера",
                days: function(value) { return numpf(value, "%d день", "%d дня", "%d дней"); },
                month: "%d мес",
                months: function(value) { return numpf(value, "%d мес", "%d мес", "%d мес"); },
                year: "%d год",
                years: function(value) { return numpf(value, "%d год", "%d года", "%d лет"); }
            };
            jQuery(dom).timeago();
            
        }
    }
});