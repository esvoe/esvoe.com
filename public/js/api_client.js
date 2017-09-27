/**
 * Created by zeratul on 14.08.2017.
 */

/*
1. collect parameters
2. init api channel
 */


var ESAPI = {
    initialized: false, // fully initialized!
    _initCallback: null,
    _defaultCallback: null,
    web_server: null, // belongs ui

    api_channel: null, // belongs ui
    api_session: null, // used for api server communication

    _callbackCounter: 0,

    init: function () {
        var params = {};
        var callback = null;
        if (arguments.length > 0) {
            if (ESAPI.Utils.isFunction(arguments[0])) {
                callback = arguments[0];
            }
            else {
                params = arguments[0] || {};
                if (arguments.length > 1 && ESAPI.Utils.isFunction(arguments[1])) {
                    callback = arguments[1];
                }
            }
        }

        this._initCallback = callback;

        // write parameters
        //ESAPI.API.init(params);

        // Connect UI methods (Call this one only if window exists! AND has parent (for no parent -> flashProxyLocalConnection)
        if (typeof window !== 'undefined') {
            ESAPI.HTML5.init(params, this._initCallback);
        }
        else {
            // invoke api initialized !
            this.initialized = true;
            if (ESAPI.Utils.isFunction(this._initCallback)) {
                this._initCallback(true, {
                    error_code: 0,
                    error_message: ""
                });
            }
        }
    },
    setDefaultCallback: function (value) {
        ESAPI._defaultCallback = value;
    },
    UI: {
        defaultCallbackHandler: null,
        setWindowSize: function(params, callback) {
            ESAPI.HTML5.invokeUIMethod("UI.setWindowSize", params, callback);
        },
        setWindowFormat: function (params, callback) {
            ESAPI.HTML5.invokeUIMethod("UI.setWindowFormat", params, callback);
        },
        getPageInfo: function (callback) {
            ESAPI.HTML5.invokeUIMethod('UI.getPageInfo', callback);
        },
        scrollToTop: function () {
            ESAPI.HTML5.invokeUIMethod('UI.scrollToTop');
        },
        showInvite: function (params, callback) {
            // params text, custom_args, selected_uids
            ESAPI.HTML5.invokeUIMethod('ui.show_invite', {
                text: "invite message",
                custom_args: {
                    "param1":"value1"
                },
                selected_uids: []
            });
        },
        showNotification: function (params, callback) {
            // params: text, custom_args, selected_uids
            ESAPI.HTML5.invokeUIMethod('ui.showNotification', {
                text: "notification text",
                custom_args: {
                    "param1":"value1"
                },
                selected_uids: []
            });
        },
        showPortalPayment: function (params, callback) {
            // Etoken topup ask
            ESAPI.HTML5.invokeUIMethod('UI.showPortalPayment', params, callback);
            /*
            amount - минимальное количество пополняемых etoken
             */
        },
        showPermissions: function (params, callback) {
            ESAPI.HTML5.invokeUIMethod('UI.showPortalPermissions', params, callback);
        },
        /**
         *
         * @param params
         * {
         * name, название покупаемого продукта
         * description, - описание
         * price - цена в выбранной валюте
         * currency (binacoins|etoken) - валюта
         * attributes- Объект параметров возвращаемых при завершении операции.
         * }
         * @param callback
         */
        showPaymentDialog: function (params, callback) {
            ESAPI.HTML5.invokeUIMethod('UI.showPaymentDialog', params, callback);
        }
    },
    HTML5: {
        _callbackStore: {},
        _initCallback: null,
        attemptCounter: 0,
        app_server: null,
        web_server: null,
        web_channel: null,

        init: function (params, callback) {
            this._initCallback = callback || function () {}; // todo: remove alt value - make function checks on dispatch callback
            var sParams = ESAPI.Utils.getRequestParameters();
            this.web_channel = params.web_channel || sParams.web_channel || window.name;
            if (!this.web_channel) {
                if (ESAPI.Utils.isFunction(ESAPI.HTML5._initCallback)) {
                    ESAPI.HTML5._initCallback(false, {
                        error_code: 101,
                        error_message: 'Unable to find parameter "web_channel".'
                    });
                }
                return;
            }
            this.web_server = params.web_server || sParams.web_server || false;
            if (!this.web_server) {
                if (ESAPI.Utils.isFunction(ESAPI.HTML5._initCallback)) {
                    ESAPI.HTML5._initCallback(false, {
                        error_code: 101,
                        error_message: 'Unable to find parameter "web_server".'
                    });
                }
                return;
            }
            if (this.web_server.indexOf("://") === -1) {
                this.web_server = "http://" + this.web_server;
            }
            this.app_server = ESAPI.Utils.getSelfOrigin();
            // listen for functions
            if (ESAPI.Utils.isFunction(window.addEventListener)) {
                window.removeEventListener('message', this.onMessageEventHandler, false);
                window.addEventListener("message", this.onMessageEventHandler, false);
            } else {
                window.detachEvent("onmessage", this.onMessageEventHandler);
                window.attachEvent("onmessage", this.onMessageEventHandler);
            }
            this.attemptCounter = 10;
            setTimeout(ESAPI.HTML5.initAttempt, 100);
        },
        initAttempt: function () {
            if (!ESAPI.initialized) {
                if (ESAPI.HTML5.attemptCounter > 0) {
                    ESAPI.HTML5.attemptCounter--;
                    ESAPI.HTML5.sendMessage({
                        method: 'attach',
                        app_server: ESAPI.HTML5.app_server // todo: remove -> make it deprecated (channel must be registered from social page)
                    });
                    setTimeout(ESAPI.HTML5.initAttempt, 500);
                } else {
                    // End of attempts
                    if (ESAPI.Utils.isFunction(ESAPI.HTML5._initCallback)) {
                        ESAPI.HTML5._initCallback(false, {
                            error_code: 100,
                            error_message: 'Init UI Timeout.'
                        });
                    }
                }
            }
        },
        onMessageEventHandler: function (event) {
            if (event.origin !== ESAPI.HTML5.web_server) return;

            if (/^__ESAPI__/.test(event.data) === false) return; // message header not found
            var payload = undefined;
            try {
                payload = JSON.parse(event.data.substr(9));
            } catch (error) {}
            if (!payload) return; // payload not found, skip.

            if (!ESAPI.initialized) {
                // possible init message result
                if (ESAPI.HTML5.attemptCounter > 0) {
                    if (payload['method'] === 'attach') {
                        ESAPI.HTML5.attemptCounter = 0;
                        ESAPI.initialized = true;
                        if (ESAPI.Utils.isFunction(ESAPI.HTML5._initCallback)) {
                            ESAPI.HTML5._initCallback(true, {
                                error_code: 0,
                                error_message: ""
                            });
                        }
                    }
                }
                return;
            }
            // normal UI Messges

            if (payload['callback']) {

                var callbackUI = ESAPI.HTML5._callbackStore[payload['callback']];
                if (ESAPI.Utils.isFunction(callbackUI)) {
                    // Call user callback handler
                    callbackUI(payload['status'], payload['result'] || {});
                    // Cleanup
                    ESAPI.HTML5._callbackStore[payload['callback']] = null;
                    try {
                        delete ESAPI.HTML5._callbackStore[payload['callback']];
                    } catch (error){}
                }
                else {
                    // Call default UI callback handler
                    if (ESAPI.Utils.isFunction(ESAPI.UI.defaultCallbackHandler)) {
                        callbackUI = ESAPI.UI.defaultCallbackHandler;

                        // Can be methods enumerator

                        callbackUI(payload['method'], payload['status'], payload['result'] || {});
                    }
                }

            }

        },
        sendMessage: function (params) {
            console.log("send!");
            try {
                params.channel = ESAPI.HTML5.web_channel;
                window.parent.postMessage('__ESAPI__' + JSON.stringify(params), ESAPI.HTML5.web_server); // use web_server from environment ?
            } catch (error) {
                console.log("ESAPI.HTML5.postMessageError:", error.toString());
            }
        },
        invokeUIMethod: function(method, params, callback) {
            console.log("invokeUIMethod!", method);
            // todo: register callback method handler!
            var _callback = null;
            if (ESAPI.Utils.isFunction(callback)) {
                _callback = "ui_callback_" + ESAPI._callbackCounter;
                ESAPI._callbackCounter++;
                ESAPI.HTML5._callbackStore[_callback] = callback;
            }
            // todo: send message!
            ESAPI.HTML5.sendMessage({
                method : method,
                callback: _callback,
                params: params
            });
        }
    },
    Client: {
        _initialized: false,

        web_server: null,
        user_id: 0,
        user_lang: null,

        api_server: null,
        api_server_url: null,
        api_access_token: null,
        api_session_token: null,

        app_id: null,
        app_server: null,
        app_secret_key: null,

        init: function (params) {
            console.log("ESAPI.Client.init()");
            var searchParams = ESAPI.Utils.getRequestParameters(); // location search
            var hashParams = ESAPI.Utils.getRequestParameters(window.location.hash);
            this.web_user_id = searchParams.web_uid; // url
            this.web_language = hashParams.web_lang || params.lang || searchParams.web_lang;
            this.api_channel = params.api_channel || searchParams.api_channel || window.name;
            this.api_session = searchParams.api_session || params.api_session; // url (api_session_o
            this.api_server = params.api_server || searchParams.api_server || 'http://sand.esvoe.com:5501'; // params, seach, const
            this.api_server_url = this.api_server + "/api/get/";

            this.app_server = ESAPI.Utils.selfOrigin() || params.app_server; // self Origin

            this._initialized = true;
        }
    },
    Utils: {
        isFunction: function (value) {
            return Object.prototype.toString.call(value) === "[object Function]";
        },
        isString: function (value) {
            return Object.prototype.toString.call(value) === "[object String]";
        },
        isObject: function (value) {
            if (value === null) {
                return false;
            }
            return ( (typeof value === 'function') || (typeof value === 'object') );
        },
        getRequestParameters: function(query) {
            var params = {};
            query = query || window.location.search;
            if (query.indexOf('?') === 0) {
                query = query.substr(1);
            }
            if (query.indexOf('#') === 0) {
                query = query.substr(1)
            }
            if (query) {
                //query = query.substr(1);
                var pairs = query.split("&");
                for (var i = 0; i < pairs.length; i++) {
                    var pair = pairs[i].split("=");
                    var name = pair[0];
                    var value = pair[1];
                    value = decodeURIComponent(value.replace(/\+/g, " "));
                    params[name] = value;
                }
            }
            return params;
        },
        getSelfOrigin: function () {
            return window.location.protocol + '//' + window.location.hostname; // if port needed then use host instead of hostname.
        }
    }
};