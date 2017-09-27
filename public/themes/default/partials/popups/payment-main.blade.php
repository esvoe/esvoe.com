<!-- Modal Payment -->
<div class="modal payment-modal fade" id="payment-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="title-setting-side">
                Заголовок <!-- {{ trans('auth.terms_modal_title') }} -->
                <span class="payment-modal-close">
                    <img src="{!! Theme::asset()->url('images/_new/icon-close-modal-sett.png') !!}" alt="">
                </span>
            </div>
            <div class="modal-body">

                <input type="hidden" name="game_name" value="poker" />

                <div class="payment-modal-wrapper">

                    <div class="payment-modal-descr">
                        <div class="payment-modal-descr-pic"></div>
                        <div class="payment-modal-descr-title"></div>
                        <p class="payment-modal-descr-text"></p>
                        <p class="payment-modal-descr-price"></p>
                        <div class="clearfix"></div>
                    </div>
                   
                    <div class="payment-modal-loading">
                        <i class="fa fa-spinner fa-spin"></i> Loading ...
                    </div>

                    <div data-payment-options style="display: none;"></div>
                    <div data-payment-confirm style="display: none;"></div>

                </div>
                
                <div class="wrap-btn-set-modal">
                    <div class="btn-set-modal payment-modal-paybtn">
                        {{ trans('common.wallet_pay_button') }}
                    </div>
                    <div class="btn-set-modal payment-modal-confirmbtn" style="display: none">
                        {{ trans('common.confirm') }}
                    </div>
                    <div class="btn-set-modal payment-modal-close" aria-label="Close">
                        {{ trans('common.close') }}
                    </div>
                </div>                 

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">



    // ### EXAMPLE OF FIRING GLOBAL FUNC 
    $('.link-home-footer .copy').on('click', function(){

        showPaymentDialog(
            {
                price: '111',
                order_nr: 'order_nr-12345',
                title: 'Заголовок',
                descr: 'В 180 году до н. э. Тиберий Семпроний стал претором и получил в управление Ближнюю Испанию. За два года (180—178 годы до н. э.) он нанёс ряд поражений кельтиберам, а потом заключил мир на сравнительно мягких условиях. В 177 году стал консулом и к началу 175 года подавил восстание на Сардинии.',
                pic: "{!! Theme::asset()->url('images/sambuka.png') !!}",
            }, 
            function(status, result, inParams){
                console.log('--- callback ---');
                console.log('status: ', status);
                console.log('result: ', result);
                console.log('inParams: ', inParams);
            },
            1 // ### DEBUG MODE ON -> FAKE DATA
        );

        return false;
    });



    var paymentDialogDev;
    var $paymentDialogModal = $('#payment-modal');
    var $paymentDialogModalSubmitBtn = $paymentDialogModal.find('.payment-modal-paybtn');
    var $paymentDialogModalConfirmBtn = $paymentDialogModal.find('.payment-modal-confirmbtn');

    var paymentDialogAjax;

    var finalDialog = false;


    var image_main1 = "{{static_uploads($application->image_main)}}";

    var gameName, token;

    function showPaymentDialog(inParams, callback, dev) {
        console.log('showPaymentDialog', inParams, callback, dev);

        inParams.pic = image_main1;

        paymentDialogDev = dev;

        gameName = $('input[name="game_name"]').val();
        token = $('meta[name="csrf_token"]').attr('content');

        // save data
        window['$paymentDialogData'] = {
            status: false,
            result: {},
            inputParams: inParams,
            callback: callback
        }; 

        // add descr
        if ( inParams.price ) $paymentDialogModal.find('.payment-modal-descr-price').text( (inParams.price / 1000).toFixed(2) );
        if ( inParams.title ) $paymentDialogModal.find('.payment-modal-descr-title').text( inParams.title );
        if ( inParams.descr ) $paymentDialogModal.find('.payment-modal-descr-text').text( inParams.descr );
        if ( inParams.pic ) $paymentDialogModal.find('.payment-modal-descr-pic').html('<img src="'+inParams.pic+'" alt="" />');
        $paymentDialogModal.find('.payment-modal-descr').show();

        // 1st modal
        var j_url = "{!! route('applications.ajax.payment_prepare', array('gamename'=>$application->name)) !!}";

        $paymentDialogModalSubmitBtn.show();
        $paymentDialogModalConfirmBtn.hide();
        $paymentDialogModal.find('div[data-payment-confirm]').hide();

        // show modal, set data
        paymentDialogAjax = $.ajax(
            j_url,
            {
                method: "POST",
                data: {
                    price: inParams.price,
                    _token: token
                },
                dataType: 'JSON',
            }
        ).done(function(response) {
            // request completed!

            if (typeof paymentDialogDev != 'undefined') {
                response = {"status":"200","data":{"ETK":{"name":"ETK","price":111,"balance":0,"allow":true},"EUR":{"name":"EUR","price":3403,"balance":0,"allow":true},"USD":{"name":"USD","price":2824,"balance":0,"allow":true},"UAH":{"name":"UAH","price":111,"balance":0,"allow":false}}}
            }

            console.log("ajax request done:", response);

            window['$paymentDialogData'].result = response;

            if (response.status === "200") {

                $paymentDialogModal.modal({
                    show: true,
                    backdrop: 'static'
                });

                finalDialog = false;

                // set data
                $paymentDialogModal.find('div[data-payment-options]').html('');

                $.each(response.data, function( title, value ) {

                    var isDisabled = (value.allow) ? '' : 'disabled';
                    var item = `
                        <label class="data-payment">
                            <span class="data-payment-title">${title}: ${value.price_text}</span>
                            <span class="data-payment-value"><input type="radio" name="currency" value="${title}" ${isDisabled} /></span>
                        </label>
                    `;
                    $paymentDialogModal.find('div[data-payment-options]').append(item);

                });

                if ( $paymentDialogModal.find('.data-payment input:radio:checked').length > 0 ) {
                    $paymentDialogModalSubmitBtn.removeClass('btn-disabled');
                } else {
                    $paymentDialogModalSubmitBtn.addClass('btn-disabled');
                }

                $paymentDialogModal.find('input').styler();

                // show data
                $paymentDialogModal.find('.payment-modal-loading').fadeOut(function(){
                    $paymentDialogModal.find('div[data-payment-options]').show();
                });

            } else {
                console.log('error...')
            }

        });        

    } // showPaymentDialog


    var once = true; // ###DEBUG

    function paymentRequest(j_url, params) {
        console.log('paymentRequest - params: ', params);

        if (typeof paymentDialogDev != 'undefined') {
            console.log('paymentDialogDev - ON');
            j_url = "{!! route('applications.ajax.payment_prepare', array('gamename'=>$application->name)) !!}";
        } else {
            console.log('paymentDialogDev - OFF');
        }

        $paymentDialogModalSubmitBtn.addClass('btn-disabled');
        $paymentDialogModalConfirmBtn.addClass('btn-disabled');


        paymentDialogAjax = $.ajax(
            j_url,
            {
                method: "POST",
                data: params,
                dataType: 'JSON',
            }
        ).done(function(response) {

            if (typeof paymentDialogDev != 'undefined') {
                // ### DEBUG

                // ### 5.1
                /*response = {
                    'status': '500',
                    'error_code': '2005',
                    'error_message':'some shit happens'
                }*/
                
                // ### 5.2
                /*response = {
                    'status': '200',
                    'transaction_state': 'verification',
                    'transaction_hash':'13658913659236912349284912',
                    'message': 'Введите код подтверждения'
                }*/

                // ### 5.3
                response = {
                    'status': '200',
                    'transaction_state': 'complete',
                    'transaction_hash':'13658913659236912349284912',
                    'message': 'Все прошло отлично, Йухууу !!!!11'
                }



                // ### SIMULATE DIFF RESPONSE 5.2 - > 5.3
                if ( once ) {
                    once = false;

                    // ### 5.2
                    response = {
                        'status': '200',
                        'transaction_state': 'verification',
                        'transaction_hash':'13658913659236912349284912',
                        'message': 'Введите код подтверждения'
                    }

                } else {

                    // ### 5.3
                    response = {
                        'status': '200',
                        'transaction_state': 'complete',
                        'transaction_hash':'13658913659236912349284912',
                        'message': 'Все прошло отлично, Йухууу !!!!11'
                    }

                }
            }

            console.log("ajax request done:", response);

            window['$paymentDialogData'].result = response;

            $paymentDialogModalSubmitBtn.removeClass('btn-disabled');
            $paymentDialogModalConfirmBtn.removeClass('btn-disabled');

            if (response.status === "200") {
                if (response.transaction_state === "verification") {
                    // show confirm modal
                    console.log('5.2');

                    $paymentDialogModal.find('div[data-payment-confirm]').html(`
                        <label class="data-payment-confirm">
                            Input confirmation code:<br /> <input type="text" name="confirm_code" /><input type="hidden" name="payment_hash" value="${response.transaction_hash}"/>
                        </label>
                    `);

                    $paymentDialogModal.find('.payment-modal-loading').fadeOut(function(){

                        $paymentDialogModal.find('div[data-payment-options]').hide();
                        $paymentDialogModal.find('div[data-payment-confirm]').show();

                        $paymentDialogModalSubmitBtn.hide();
                        $paymentDialogModalConfirmBtn.show();

                    });

                } else if (response.transaction_state === "complete") {
                    // show message - COMPLETE, hide btn
                    console.log('5.3');

                    $paymentDialogModal.find('div[data-payment-options]').html(`<div class="payment-modal-message">Transaction complete</div>`);

                    $paymentDialogModal.find('.payment-modal-loading').fadeOut(function(){
                        $paymentDialogModal.find('div[data-payment-options]').show();
                        $paymentDialogModalSubmitBtn.hide();
                        $paymentDialogModalConfirmBtn.hide();
                    });

                    finalDialog = true;

                    // fire callback
                    window['$paymentDialogData'].status = true;
                    window['$paymentDialogData'].result = response;
                    window['$paymentDialogData'].callback( window['$paymentDialogData'].status, window['$paymentDialogData'].result, window['$paymentDialogData'].inputParams );

                }
            } else if ( response.status === "500" ) {
                // show message - ERROR, hide btn
                console.log('5.1');

                $paymentDialogModal.find('div[data-payment-options]').html(`<div class="payment-modal-message">${response.error_code}: ${response.error_message}</div>`);

                $paymentDialogModal.find('.payment-modal-loading').fadeOut(function(){
                    $paymentDialogModal.find('div[data-payment-options]').show();
                    $paymentDialogModalSubmitBtn.hide();
                    $paymentDialogModalConfirmBtn.hide();
                });

                finalDialog = true;

                // fire callback
                window['$paymentDialogData'].status = false;
                window['$paymentDialogData'].result = response;
                window['$paymentDialogData'].callback( window['$paymentDialogData'].status, window['$paymentDialogData'].result, window['$paymentDialogData'].inputParams );

            }

        });
    } // paymentRequest

    // disabled / undisabled submit btn by radio
    $paymentDialogModal.on('change', '.data-payment input:radio', function() {
        if ( $paymentDialogModal.find('.data-payment input:radio:checked').length > 0 ) {
            $paymentDialogModalSubmitBtn.removeClass('btn-disabled');
        } else {
            $paymentDialogModalSubmitBtn.addClass('btn-disabled');
        }
    });

    // 2nd modal
    $paymentDialogModalSubmitBtn.on('click', function(e) {
        console.log('run 2nd modal - make selected payment');

        e.preventDefault();



        $paymentDialogModal.find('div[data-payment-options]').fadeOut(function(){
            $paymentDialogModal.find('.payment-modal-descr').hide();
            $paymentDialogModal.find('.payment-modal-loading').show();

            j_url = "{!! route('applications.ajax.payment_submit', array('gamename'=>$application->name)) !!}";
            //price, currency, order_nr

            var params = {
                price: window['$paymentDialogData'].inputParams.price,
                currency: $paymentDialogModal.find('.data-payment input:checked').val(),
                order_nr: window['$paymentDialogData'].inputParams.order_nr,
                _token: token
            }

            paymentRequest(j_url, params);

        });

    }); // 2nd modal - paymentDialogModalSubmitBtn

    
    // 3d modal
    $paymentDialogModalConfirmBtn.on('click', function(e) {
        console.log('run 3d modal - confirm');

        e.preventDefault();

        $paymentDialogModal.find('div[data-payment-confirm]').hide();

        $paymentDialogModal.find('div[data-payment-options]').fadeOut(function(){
            $paymentDialogModal.find('.payment-modal-descr').hide();
            $paymentDialogModal.find('.payment-modal-loading').show();

            j_url = "{!! route('applications.ajax.payment_confirm', array('gamename'=>$application->name)) !!}";
            //price, currency, order_nr

            var params = {
                price: window['$paymentDialogData'].inputParams.price,
                currency: $paymentDialogModal.find('.data-payment input:checked').val(),
                order_nr: window['$paymentDialogData'].inputParams.order_nr,
                _token: token,
                payment_code: $paymentDialogModal.find('input[name="confirm_code"]').val(),
                payment_hash: $paymentDialogModal.find('input[name="payment_hash"]').val()
            }

            paymentRequest(j_url, params);

        });

    }); // 3d modal - paymentDialogModalConfirmBtn
   

    window.confirm = function(message, title, yes_label, callback) {
        $("#bootstrap-confirm-box-modal").data('confirm-yes', false);
        if($("#bootstrap-confirm-box-modal").length == 0) {
            $("body").append('<div id="bootstrap-confirm-box-modal" class="modal payment-modal fade">\
                <div class="modal-dialog">\
                    <div class="modal-content">\
                        <div class="title-setting-side">\
                            <div class="title"></div>\
                            <span class="close" data-dismiss="modal" aria-label="Close"><img src="{!! Theme::asset()->url("images/_new/icon-close-modal-sett.png") !!}" alt=""></span>\
                        </div>\
                        <div class="modal-body">\
                            <div class="payment-modal-wrapper">\
                                <div class="payment-modal-message"></div>\
                            </div>\
                            <div class="wrap-btn-set-modal">\
                                <div data-dismiss="modal" class="btn-set-modal">Отмена</div>\
                                <div class="btn-set-modal btn-yes">' + (yes_label || 'OK') + '</div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>');
            $("#bootstrap-confirm-box-modal .btn-yes").on('click', function () {
                $("#bootstrap-confirm-box-modal").data('confirm-yes', true);
                $("#bootstrap-confirm-box-modal").modal('hide');
                return false;
            });
            $("#bootstrap-confirm-box-modal").on('hide.bs.modal', function () {
                if(callback) callback($("#bootstrap-confirm-box-modal").data('confirm-yes'));
            });

            $("#bootstrap-confirm-box-modal").on('show.bs.modal', function (e) {
                $("body").addClass('open-confirm-modal');
            });

            $("#bootstrap-confirm-box-modal").on('hidden.bs.modal', function (e) {
                $("body.open-confirm-modal").removeClass('open-confirm-modal');
            });
        }

        $("#bootstrap-confirm-box-modal .title-setting-side div.title").text(title || "");
        $("#bootstrap-confirm-box-modal .payment-modal-wrapper .payment-modal-message").text(message || "");
        $("#bootstrap-confirm-box-modal").modal('show');
    };

        
    // Confirm close
    $paymentDialogModal.on('click', '.payment-modal-close', function(e){
        e.preventDefault();

        if ( finalDialog ) {

            $paymentDialogModal.modal('hide');

        } else {

            confirm("Вы хотите прервать диалог оплаты?", "Закрыть диалог оплаты", "Да", function(e){
                if (e) {

                    // abort ajax
                    if ( paymentDialogAjax ) paymentDialogAjax.abort();

                    // close dialog
                    $paymentDialogModal.modal('hide');

                    // fire callback
                    window['$paymentDialogData'].status = false; // close dialog
                    window['$paymentDialogData'].callback( window['$paymentDialogData'].status, window['$paymentDialogData'].result, window['$paymentDialogData'].inputParams );
                }

            });

        }

    });
            

</script>