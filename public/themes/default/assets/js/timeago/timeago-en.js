// var socket = io('http://socialite.dev:3000');
var timeagoLng = new Vue({
    methods:{
        timeSet:function (dom){

            jQuery.timeago.settings.strings.suffixAgo = null;
            jQuery.timeago.settings.strings.suffixFromNow = null;
            jQuery.timeago.settings.strings.seconds = "%d sec ";
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
            jQuery(dom).timeago();
            
        }
    }
});