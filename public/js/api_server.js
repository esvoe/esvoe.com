/**
 * Created by zeratul on 15.08.2017.
 */

var ESAPIServer = {

    _initialized: false,
    _autoChannels: true,
    _channels: {},

    channelGet: function(channel) {
        return ESAPIServer._channels[channel] || null;
    },
    channelAttach: function(channel, origin, params) {
        if (ESAPIServer._channels[channel]) return;
        ESAPIServer._channels[channel] = params || {};
        ESAPIServer._channels[channel].name = channel;
        ESAPIServer._channels[channel].origin = origin;
        ESAPIServer._channels[channel].initialized = false;
        ESAPIServer._channels[channel].sendMessage = function(payload) {
            ESAPIServer.channelSendMessage(channel, payload);
        }
    },
    channelRemove: function(channel) {
        if (ESAPIServer._channels[channel]) {
            ESAPIServer._channels[channel] = null;
            try {
                delete(ESAPIServer._channels[channel]);
            } catch (error) {
            }
        }
    },
    channelSendMessage: function(channel, payload) {
        if (window.frames[channel]) {
            try {
                window.frames[channel].postMessage('__ESAPI__' + JSON.stringify(payload), ESAPIServer._channels[channel].origin);
            } catch (error){}
        }
    },
    onMessageEventHandler: function(event) {
        if (ESAPIServer.Utils.isString(event.data) === false) return; // message body is not string
        if (/^__ESAPI__/.test(event.data) === false) return; // message header not found
        var payload = undefined;
        try {
            payload = JSON.parse(event.data.substr(9));
        } catch (error) {
            console.log("ESAPIServer.onMessageEventHandler() > Error:", error.toString());
        }
        if (!payload || !payload.hasOwnProperty('channel') || !payload.hasOwnProperty('method')) {
            console.log("ESAPIServer.onMessageEventHandler() > Error:", "payload error");
        }

        var channel = payload['channel'];
        var method = payload['method'];
        // search for channel OR create new one (if method init)

        console.log("ESAPIServer.onMessageEventHandler("+method+")");


        if (ESAPIServer._autoChannels) {
            if (method === 'attach') {
                ESAPIServer.channelAttach(channel, event.origin);
            }
        }

        // common security check
        var _channel = ESAPIServer.channelGet(channel);
        if (!_channel) return; // channel not found!
        if (event.origin !== _channel.origin) return; // message origin mismatch app_server

        // process packets based on auth level
        if (method === 'attach') {
            _channel.initialized = true;
            _channel.sendMessage({ method: 'attach'});
            return;
        }

        if (ESAPIServer.Utils.isFunction(ESAPIServer.Methods[method])) {
            ESAPIServer.Methods[method](_channel, payload);
        }
        else {
            console.log("ESAPIServer > unhandled method:", method);
        }
    },
    init: function() {
        console.log("ESAPIServer.init()");
        if (ESAPIServer.Utils.isFunction(window.addEventListener)) {
            window.removeEventListener("message", ESAPIServer.onMessageEventHandler, false);
            window.addEventListener("message", ESAPIServer.onMessageEventHandler, false);
        }
        else {
            window.detachEvent("onmessage", ESAPIServer.onMessageEventHandler);
            window.attachEvent("onmessage", ESAPIServer.onMessageEventHandler);
        }
        ESAPIServer.initialized = true;
    },
    Utils: {
        isString: function(target) {
            return Object.prototype.toString.call(target) === "[object String]";
        },
        isFunction: function(target) {
            return Object.prototype.toString.call(target) === "[object Function]";
        }
    },
    Methods: {}
};

ESAPIServer.init();

// UI METHODS
ESAPIServer.Methods['UI.setWindowSize'] = function (channel, payload) {
    console.log("RUN ui.window_resize!", payload.width, payload.height);

    if (!payload.params || !payload.params.width || !payload.params.height) {
        channel.sendMessage({
            type: 'response',
            method: payload.method,
            callback: payload.callback,
            status: false,
            result: {
                error_code: 1,
                error_message: 'Missing required parameters'
            }
        });
        return;
    }

    // method body
    $('iframe[name="'+channel.name+'"').width(payload.params.width);
    $('iframe[name="'+channel.name+'"').height(payload.params.height);
    $('iframe[name="'+channel.name+'"').css('width', payload.params.width);
    $('iframe[name="'+channel.name+'"').css('height', payload.params.height);

    // send response
    channel.sendMessage({
        type: 'response',
        method: payload.method,
        callback: payload.callback,
        status: true,
        result: {}
    });

};

ESAPIServer.Methods['UI.getPageInfo'] = function (channel, payload) {

    var result = {};
    var $iframe = $('iframe[name="'+channel.name+'"]');

    result.clientHeight = $(document).height(); //Высота страницы (не путать с разрешением экрана, если данная величина больше разрешения экрана, появляется полоса прокрутки)
    result.clientWidth = $(document).width(); //Ширина страницы (не путать с разрешением экрана, если данная величина больше разрешения экрана, появляется полоса прокрутки)

    result.offsetTop = $iframe.offset().top - $(window).scrollTop(); //Расстояние между верхним краем страницы и верхним краем iframe приложения
    result.offsetLeft = $iframe.offset().left - $(window).scrollLeft(); //Расстояние между левым краем страницы и левым краем iframe приложения

    result.innerWidth = $(window).innerWidth; //Ширина окна браузера пользователя (window.innerWidth)
    result.innerHeight = $(window).innerHeight; //Высота окна браузера пользователя (window.innerHeigth)

    result.scrollTop = $(window).scrollTop(); //Вертикальная позиция прокрутки
    result.sctollLeft = $(window).scrollLeft(); //Горизонтальная позиция прокрутки

    // send response
    channel.sendMessage({
        type: 'response',
        method: payload.method,
        callback: payload.callback,
        status: true,
        result: result
    });

};

ESAPIServer.Methods['UI.setWindowFormat'] = function (channel, payload) {

    channel.sendMessage({
        type: 'response',
        method: payload.method,
        callback: payload.callback,
        status: false,
        result: {
            error_code: 500,
            error_message: 'not_implemented'
        }
    });

};

ESAPIServer.Methods['UI.scrollToTop'] = function (channel, payload) {

    window.scrollTo(0,0);

    channel.sendMessage({
        type: 'response',
        method: payload.method,
        callback: payload.callback,
        status: true,
        result: {
            error_code: 0,
            error_message: '0'
        }
    });

};

ESAPIServer.Methods['UI.showPaymentDialog'] = function (channel, payload) {
    // open binacoin payment dialog.

    var closeCallback = function () {
        channel.sendMessage({
            type:'response',
            method: payload.method,
            callback: payload.callback,
            result_status: true,
            result_payload: {
                error_code: 2001,
                error_message: 'USER_CANCEL_PAYMENT',
                attributes: payload.params.attributes
            }
        })
    };

    var params = payload.params;
    params.order_nr = 214124;

    window.showPaymentDialog(payload.params, function () {
        console.log("callback received!");
    });

    /*
    channel.sendMessage({
        type: 'response',
        method: payload.method,
        callback: payload.callback,
        status: false,
        result: {
            error_code: 500,
            error_message: 'not_implemented'
        }
    });
    */
};

ESAPIServer.Methods['UI.showPortalPayment'] = function (channel, payload) {
    channel.sendMessage({
        type: 'response',
        method: payload.method,
        callback: payload.callback,
        status: false,
        result: {
            error_code: 500,
            error_message: 'not_implemented'
        }
    });
};

ESAPIServer.Methods['UI.showPortalPermissions'] = function (channel, payload) {
    channel.sendMessage({
        type: 'response',
        method: payload.method,
        callback: payload.callback,
        status: false,
        result: {
            error_code: 500,
            error_message: 'not_implemented'
        }
    });
};

