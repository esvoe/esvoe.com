$(function(){

    // RATING        
    if ( $('.ratingblock').length ) {
        createRating()
    }

    function createRating() {

        var rateLock = false;
        var ratingUri = $('[data-rating-uri]:first').data('rating-uri');

        function unpackRating(value) {
            var values = value.split('#');
            return {
                'app_id': values[0],
                'value': values[1],
                'total': values[2],
                'count': values[3].split('*'),
                'procs': values[4].split('*')
            }
        }

        function onBarRatingSelect(value, text, event) {
            if ( ! event ) return;
            if ( rateLock ) return;
            rateLock = true;

            var $container = $(event.target).parents('.ratingblock');
            if ( ! $container.length ) return;
            var data = unpackRating($container.data('rating-data'));
            $.ajax(ratingUri, {
                    method: "POST",
                    data: {
                        value: value,
                        id: data['app_id'],
                        _token: $('meta[name="csrf_token"]').attr('content')
                    },
                    dataType: 'JSON'
                }
            ).done(function(response) {
                if (response.status === "200") {
                    $container.data('rating-data', response.rating);
                }
                var data = unpackRating($container.data('rating-data'));
                $container.find('select.rating-block').barrating('set', data['value']);
                $container.find('.ratingblock-value').text(data['value']);
                $container.find('.ratingblock-total').text("(" + data['total'] + ")");

                if ( $container.hasClass('haspopover') ) {
                    createRatePopover($container);
                }

                rateLock = false;
            });

        }

        function createRatePopover(el, callback) {
            var data = unpackRating(el.data('rating-data'));

            var $popover = '<div class="ratingblock-popover">\
                    <div class="ratingblock-popover-in">\
                        <div class="ratingblock-line">\
                            <div class="ratingblock-line-title">1</div>\
                            <div class="ratingblock-line-bar" data-width="50">\
                                <div class="ratingblock-line-bar-fill" style="width: '+ data['procs'][0] +'%"></div>\
                                <span></span>\
                            </div>\
                            <div class="ratingblock-line-value">'+ data['count'][0] +'</div>\
                        </div>\
                        <div class="ratingblock-line">\
                            <div class="ratingblock-line-title">2</div>\
                            <div class="ratingblock-line-bar" data-width="50%">\
                                <div class="ratingblock-line-bar-fill" style="width: '+ data['procs'][1] +'%"></div>\
                                <span></span>\
                                <span></span>\
                            </div>\
                            <div class="ratingblock-line-value">'+ data['count'][1] +'</div>\
                        </div>\
                        <div class="ratingblock-line">\
                            <div class="ratingblock-line-title">3</div>\
                            <div class="ratingblock-line-bar">\
                                <div class="ratingblock-line-bar-fill" style="width: '+ data['procs'][2] +'%"></div>\
                                <span></span>\
                                <span></span>\
                                <span></span>\
                            </div>\
                            <div class="ratingblock-line-value">'+ data['count'][2] +'</div>\
                        </div>\
                        <div class="ratingblock-line">\
                            <div class="ratingblock-line-title">4</div>\
                            <div class="ratingblock-line-bar">\
                                <div class="ratingblock-line-bar-fill" style="width: '+ data['procs'][3] +'%"></div>\
                                <span></span>\
                                <span></span>\
                                <span></span>\
                                <span></span>\
                            </div>\
                            <div class="ratingblock-line-value">'+ data['count'][3] +'</div>\
                        </div>\
                        <div class="ratingblock-line">\
                            <div class="ratingblock-line-title">5</div>\
                            <div class="ratingblock-line-bar">\
                                <div class="ratingblock-line-bar-fill" style="width: '+ data['procs'][4] +'%"></div>\
                                <span></span>\
                                <span></span>\
                                <span></span>\
                                <span></span>\
                                <span></span>\
                            </div>\
                            <div class="ratingblock-line-value">'+ data['count'][4] +'</div>\
                        </div>\
                    </div>\
                </div>';

            el.find('.ratingblock-popover').remove();
            el.append( $popover );

            if (callback && typeof(callback) === "function") {
                callback();
            }

        }

        // apply rating to elements
        $.each($("select.rating-block"), function(index, value) {
            var $element = $(value);
            var $container = $element.parents('.ratingblock');
            if ( ! $container.length ) return;
            var data = unpackRating($container.data("rating-data"));
            $element.barrating({
                theme: 'fontawesome-stars-o',
                emptyValue: '0.0',
                silent: true,
                initialRating: Number(data['value']).toFixed(1),
                onSelect: onBarRatingSelect
            });
            $container.find('.ratingblock-value').text(data['value']);
            $container.find('.ratingblock-total').text("(" + data['total'] + ")");
        });

        $('body').on('mouseenter ', '.ratingblock.haspopover', function(){
            var $el = $(this);

            createRatePopover($el, function(){
                // show popover
                setTimeout(function(){
                    $el.addClass('hover');
                }, 50)
            });
 
        });

        $('body').on('mouseleave', '.ratingblock.haspopover', function(){
            var $el = $(this);

            // remove 
            $el.removeClass('hover');
            setTimeout(function(){
                $el.find('.ratingblock-popover').remove();
            }, 200)

        });

    } 


    // APP MODAL INFO POPUP
    var dataAppLinkLock = false;

    $('body').on('click', 'a[data-app-id]', function(){

        if ( !dataAppLinkLock ) {

            dataAppLinkLock = true;
            
            var $el = $(this);
            var link = $el.attr('href');
            var token  = $('meta[name="csrf_token"]').attr('content');

            $.ajax({
                method: 'POST',
                url: link,
                data: { 
                    _token: token
                }
            }).done(function(response) {
                //console.log("ajax request done:", response);
                if (response.status === "200") {
                    showAppModal(response.content);
                } else {
                    window.location.href = link;
                }
                dataAppLinkLock = false;
            }).fail(function( jqXHR, textStatus ) {
                console.log( "Request failed: " + textStatus );
                dataAppLinkLock = false;
            });

        }

        return false;
    });

    function showAppModal(content) {

        // set modal with content
        if ( $("#modal-app-info").length == 0 ) {
            $("body").append('<div class="modal fade modal-app-info" id="modal-app-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">\
                    <div class="modal-dialog" role="document">\
                        <div class="modal-content">\
                            <div class="modal-body">\
                                <div class="wrap-modal-game">\
                                    <span class="close-modal-game" data-dismiss="modal" aria-label="Close">\
                                        <i class="icon-zakrutu svoe-icon"></i>\
                                    </span>\
                                    <div id="modal-app-content">'+ content +'</div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>');
        }

        $('body').addClass('overlay-game-modal');

        // show modal
        $('#modal-app-info').modal('show')
            .on('shown.bs.modal', function (){

                // gallery
                setTimeout(function(){
                    $('#image-gallery-modal').lightSlider({
                        gallery:true,
                        item:1,
                        thumbItem:5,
                        slideMargin: 0,
                        speed:500,
                        auto:false,
                        loop:true,
                        onSliderLoad: function() {
                            $('#image-gallery-modal').removeClass('cS-hidden');
                        }
                    });                    
                }, 100);

                // rate
                $('#modal-app-info .rating-block').barrating({
                    theme: 'fontawesome-stars',
                    onSelect:function(value, text, event){
                        var arr = value.split('-');
                        var app_id = arr[1];
                        value = arr[0];
                        console.log(app_id,value);
                    }
                });
                $('#modal-app-info .rating-block').barrating('readonly', true);
                $('#modal-app-info .rating-block').barrating('set', 4);

            })
            .on('hidden.bs.modal', function(e) {
                $('#modal-app-info').remove();
                $('body').removeClass('overlay-game-modal');
            });
    }

    var sliderGame;
    //view game permiss
    $('.view-game').on('shown.bs.modal', function (event) {
        if(!sliderGame){
            sliderGame = $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:5,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }
            });
        }
        $('body').addClass('overlay-game-modal');
    });
    $('.view-game').on('hidden.bs.modal', function (event) {
        $('body').addClass('overlay-game-modal');
    });


    //open tab wallet
    $('.own-new-wallet').click(function(){
        var wallet = $(this).data('wallet');
        console.log($('.tab-pane#'+ wallet +' .ps-list li:first-child'));
        $('.wrap-wallet .radioButton').prop('checked',false);
        //$('.tab-pane#'+ wallet +' .ps-list li:first-child .radioButton').prop('checked',true);
        $('.tab-pane#'+ wallet +' .ps-list li').first().find('label').click();
    })

    //replace currency
    $('.own-new-wallet').click(function(){
        if(!$(this).hasClass('active-new-wallet')){
            //var content = $(this).detach();
            //content.appendTo('.wrap-own-new-wallet');
            $('.own-new-wallet').removeClass('active-new-wallet');
            $(this).addClass('active-new-wallet');
            var currency = $(this).data('wallet');
            $('#global_currency_selected').val(currency.toUpperCase());
        }
    })

    //hover btn event prof
    $('.show-action-hover').hover(function(){
        $(this).parents('.btn-hover-wrap').find('.btn-action-hover').addClass('hidden-action-hover');
        $(this).parents('.btn-hover-wrap').find('.btn-options').addClass('hidden-action-hover');
        $(this).removeClass('hidden-action-hover');
    },function(){
        $(this).parents('.btn-hover-wrap').find('.btn-action-hover').removeClass('hidden-action-hover');
        $(this).parents('.btn-hover-wrap').find('.btn-options').removeClass('hidden-action-hover');
        $(this).addClass('hidden-action-hover');
    });

    //search tab friend
    $('.search-friend-tab > i').click(function(){
        $(this).prev().fadeIn().focus();
    });
    $('.search-friend-tab input').blur(function(){
        $(this).fadeOut();
    })

    //sort grid friend
    $('.grid-col-friend span').click(function(){
        $('.grid-col-friend span').removeClass('active-col-friend');
        $(this).addClass('active-col-friend');
        if($(this).hasClass('sort-small')){
            $('.wrap-photo-tab .tab-pane.active .small-tab-friend').fadeOut(300,"linear",function(){
                $(this).removeClass('row-big-tab-friend').fadeIn();
            })
        }
        else{
            $('.wrap-photo-tab .tab-pane.active .small-tab-friend').fadeOut(300,"linear",function(){
                $(this).addClass('row-big-tab-friend').fadeIn();
            })
        }
    })

    //full screen game
    $('.single-game-container .balance>a').click(function () {
        $('#appMainFrame').fullscreen();
        //$.fullscreen.exit();
        return false;
    });

    $('#appMainFrame').load( function() {
        var appendStyle = "<style type='text/css'>  " +
            "body,html{margin:0 !important;height: 100% !important;}" +
            "#gameContainer canvas{width:100%;height: 100%}" +
            "#gameContainer{top:0!important;position: relative!important;transform: none!important;left:0 !important;margin: 0 auto!important;width: 100% !important;height: 100%!important;}" +
            "</style>";
        $('#appMainFrame').contents().find("head")
            .append(appendStyle);
    });

    //sort photo profile
    $('.switch-grid').on('shown.bs.tab',function(){
        if(!$('.tjpictures > div').length) {
            $('.tjpictures').tjGallery();
        }
        $('.tjpictures').addClass('scale-animate');
        $('.own-grid-mosaic').click();
        $('.grid-col').addClass('active-switch-grid');
    });
    $('.switch-grid').on('hidden.bs.tab',function(){
        $('.grid-col').removeClass('active-switch-grid');
    })

    $('.grid-col span').click(function(){
        $('.grid-col span').removeClass('active-grid');
        $(this).addClass('active-grid');
        if($(this).is('.own-grid-bootstrap')){
            $('.tjpictures').removeClass('scale-animate');
            $('.tjpictures').addClass('tj-bootstrap');
            setTimeout(function(){
                $('.tjpictures').addClass('scale-animate');
            },200)
        }
        else{
            $('.tjpictures').removeClass('scale-animate');
            $('.tjpictures').removeClass('tj-bootstrap');
            setTimeout(function(){
                $('.tjpictures').addClass('scale-animate');
            },200)
        }
    });


    //change theme modal photo
    $('.wrap-icon-action span:first-child').click(function(){
        $(this).parents('.wrap-content-modal-photo').toggleClass('modal-theme-white');
    });

    //hide modal all photo
    $(document).click(function(e){
        if($(e.target).is('.modal-show-photo')){
            $('.modal-show-photo').fadeOut();
        }
    });

    //responsive width frame game
    function widthFrame(){
        var width = $('.game-body').width();
        var height = width / 1.4;
        $('.game-body').height(height);
    }
    widthFrame();
    $(window).resize(function(){
        widthFrame();
    })

    //save sett modal
    // $('.save-sett-modal').click(function(){
    $('.save-sett-modal').on('click', function(){
        $('.sidebar > ul > li').show();
        $('.wrap-sett-menu input:not(:checked)').each(function(){
            var valueSett = $(this).data('sett-side');
            $('.sidebar > ul > li[data-li-setting="'+ valueSett +'"]').hide();
        });

        // var checked = {};
        var checked = [];
        $('.wrap-sett-menu input:checked').each(function(){
            var valueSett = $(this).data('sett-side');
            checked.push(valueSett);
        });

        var thisElement = this;
        $.post(SP_source() + 'ajax/save-set-left-sidebar', {checked: checked}, function(data) {
        // $.post(SP_source() + 'ajax/save-set-left-sidebar', checked, function(data) {
            if (data.status == 200) {

            }
        });
    });


    // check modal setting left side
    $('.wrap-checker-sett input,.wrap-group-find select.styler-select').styler();
    //,.wrap-group-find select
    //toggle border wallet panel
    $('.wrap-wallet .panel-heading h4 a').click(function(){
        if($(this).parents('.panel-default').hasClass('no-border-all')){
            $(this).parents('.panel-default').removeClass('no-border-all');
        }
        else{
            $(this).parents('.panel-group').find('.panel.panel-default').removeClass('no-border-all');
            $(this).parents('.panel-default').addClass('no-border-all');
        }
    })

    //height right sidebar
    $('.chat-list .left-sidebar.socialite').height($(window).height() - 60);
    $(window).resize(function(){
        $('.chat-list .left-sidebar.socialite').height($(window).height() - 60);
    });

    //wallet real money
    $('.wrap-wallet .tab-wallet li > a > p').click(function(){
        $('.wrap-wallet .tab-wallet li > a > p').removeClass('active-real-wallet');
        $(this).addClass('active-real-wallet');
        $('#real-money-currency').val($(this).data('currency'));
        $('#collapseSix').collapse('hide');
    })

    //wallet check
    $('.radioButton').change(function() {
        if (this.checked) {
            $('.ps-list').children().removeClass('active');
            $(this).parent().addClass('active');
            $('.own-currency-sum').removeClass('active-curr');
            $(this).parent().find('.first-currency-sum').addClass('active-curr');

            // $('#real-money-ps').val($(this).parent().find('.active-curr').data('ps'));
            $(this).closest('form').find('[name="real-money-ps"]').val($(this).parent().find('.active-curr').data('ps'));
        }
    });

    //change currency wallet ballnce
    $('.own-currency-sum').click(function(){
        $('.own-currency-sum').removeClass('active-curr');
        $(this).addClass('active-curr');

        // $('#real-money-ps').val($(this).data('ps'));
        $(this).closest('form').find('[name="real-money-ps"]').val($(this).data('ps'));
    });

    //login sex select
    $('.signup-form select').styler();

    //under
    $('.wrap-under').innerHeight($(window).height() - 80);
    $(window).resize(function(){
        $('.wrap-under').innerHeight($(window).height() - 80);
    });

    //change text svoe
    $('.sidebar > ul > li > a').hover(function(){
        var dataA = $(this).data('change-logo');
        $('.logo-text').hide();
        $('.logo-text[data-logo-text="'+ dataA +'"]').css('display','inline-block');
    },function(){
        $('.logo-text').hide();
        $('.logo-text').not('.other-logo').css('display','inline-block');
    })

    //scroll left right block to fixed
    $(window).scroll(function(){
        fixedBlock();
    });
    function fixedBlock(){
        var height = $(window).scrollTop() + $(window).height() - 80;
        $('.other-block-rekl,.sm-desc-prof').each(function(){
            if(($(window).innerHeight() - 80) > $(this).innerHeight()){
                $(this).addClass('fixed-top-block');
            }
            else{
                $(this).removeClass('fixed-top-block');
                if(height > $(this).innerHeight()){
                    $(this).addClass('fixed-both-block');
                }
                else{
                    $(this).removeClass('fixed-both-block');
                }
            }
        });
    }

    //close all dropdown
    $(document).click(function(event) {
        if ($(event.target).parents(".dropdown-link-menu").length) return;
        $('.dropdown-link-menu').removeClass('open-link-menu').removeClass('open');
    });

    //hover right sidebar
    $('.chat-list').hover(function(){
        $(this).toggleClass('hover-right-sidebar');
    },function(){
        $(this).toggleClass('hover-right-sidebar');
    });

    //hover left sidebar
    $('.sidebar').hover(function(){
        $(this).toggleClass('hover-left-sidebar');
    },function(){
        $(this).toggleClass('hover-left-sidebar');
    });

    //height blocks page news
    //$(window).resize(function(){
    //    $('.other-block-rekl .right-side-section,.sm-desc-prof .right-side-section').height($(window).height() - 70);
    //});
    //$('.other-block-rekl .right-side-section,.sm-desc-prof .right-side-section').height($(window).height() - 70);



    //dropdown header
    $('.dropdown-link-menu > a').click(function(){
        if($(this).parent().hasClass('open-link-menu')){
            $('.dropdown-link-menu').removeClass('open-link-menu');
        }
        else{
            $('.dropdown-link-menu').removeClass('open-link-menu');
            $(this).parent().addClass('open-link-menu');
        }

    });

//my music
    var playList = [
        {
            title:"nickelback",
            song:'dsdsdsdsd',
            time: "03:49",
            img:"images/post-user-photo.png",
            mp3:"https://radio.esvoe.com/oboz1/",
            oga:"https://radio.esvoe.com/oboz1/"
            // oga:"http://radio.obozrevatel.com/audiofiles/RockMusic/ZarRock%20New/Nickelback%20-%20Everytime%20Were%20Together.mp3"
        },
        {
            title:"nickelback",
            song:'dsdsdsdsd',
            time: "03:49",
            img:"images/post-user-photo.png",
            mp3:"https://radio.esvoe.com/oboz1/",
            oga:"https://radio.esvoe.com/oboz1/"
            // oga:"http://radio.obozrevatel.com/audiofiles/RockMusic/ZarRock%20New/Nickelback%20-%20Everytime%20Were%20Together.mp3"
        },
        {
            title:"nickelback",
            song:'dsdsdsdsd',
            time: "03:49",
            img:"images/post-user-photo.png",
            mp3:"https://radio.esvoe.com/oboz1/",
            oga:"https://radio.esvoe.com/oboz1/"
            // oga:"http://radio.obozrevatel.com/audiofiles/RockMusic/ZarRock%20New/Nickelback%20-%20Everytime%20Were%20Together.mp3"
        },
        // {
        //     title:"rammstein",
        //     song:'dsdsdsdsd',
        //     time: "03:49",
        //     img:"images/post-user-photo.png",
        //     mp3:"https://radio.esvoe.com/oboz2/",
        //     oga:"https://radio.esvoe.com/oboz2/"
        //     // oga:"http://radio.obozrevatel.com/files/audio/3056/a3f249723c51e7afd9b496e8e5a414b4.mp3"
        // }
    ]
    new jPlayerPlaylist({
        jPlayer: "#jquery_jplayer_2",
        cssSelectorAncestor: "#jp_container_2"
    }, playList, {
        swfPath: "../../dist/jplayer",
        supplied: "oga, mp3",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: false,
        smoothPlayBar: true,
        keyEnabled: true,
        loadeddata: function(event){ // calls after setting the song duration
            songDuration = event.jPlayer.status.duration;

            var time = songDuration / 60;
            var timeTransfer = (time - Math.floor(time)) * 0.6;
            var actualTime = Math.floor(time) + timeTransfer;


        }
    });

    // radio
    var cssSelector = { jPlayer: ".jquery_jplayer_radio", cssSelectorAncestor: ".jp_container_radio" };
    var options = {
        playlistOptions: {
            autoPlay: false,
            loopOnPrevious: false,
            shuffleOnLoop: true,
            enableRemoveControls: true,
            displayTime: 'slow',
            addTime: 'fast',
            removeTime: 'fast',
            shuffleTime: 'slow'
        },
        swfPath: "/js",
        supplied: "m4a, oga",
        useStateClassSkin: true,
        autoBlur: false,
        loop:true,
        smoothPlayBar: true,
        keyEnabled: true,
        remainingDuration: true,
        toggleDuration: true
    }
    var playlist = [
        {
            title: "Хіт FM",
            img: "images/icon-radio-1.png",
            m4a: "https://radio.esvoe.com/hitfm/",
            oga: "https://radio.esvoe.com/hitfm/"
            // oga: "http://online-hitfm2.tavrmedia.ua/HitFM"
        },
        {
            title: "KISS FM",
            img:"images/icon-radio-2.png",
            m4a: "https://radio.esvoe.com/kissfm/",
            oga: "https://radio.esvoe.com/kissfm/"
            // oga: "http://online-kissfm.tavrmedia.ua/KissFM"
        },
        {
            title: "Русское радио",
            m4a: "https://radio.esvoe.com/rusradio/",
            oga: "https://radio.esvoe.com/rusradio/"
            // oga: "http://online-rusradio.tavrmedia.ua/RusRadio"
        },
        {
            title: "Люкс ФМ",
            m4a: "https://radio.esvoe.com/lux/",
            oga: "https://radio.esvoe.com/lux/"
            // oga: "http://icecastlv.luxnet.ua/lux"
        },
        {
            title: "Radio ROKS",
            m4a: "https://radio.esvoe.com/radioroks/",
            oga: "https://radio.esvoe.com/radioroks/"
            // oga: "http://online-radioroks.tavrmedia.ua:8000/RadioROKS"
        },
        {
            title: "Радіо Львівська хвиля",
            m4a: "https://radio.esvoe.com/lviv/",
            oga: "https://radio.esvoe.com/lviv/"
            // oga: "http://onair.lviv.fm:8000/lviv.fm"
        },
        {
            title: "Радіо-Ера",
            m4a: "https://radio.esvoe.com/era/",
            oga: "https://radio.esvoe.com/era/"
            // oga: "http://212.26.129.2:8000/era96"
        }
    ];
    // var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
    if (window == top) window.onlineRadio = new jPlayerPlaylist(cssSelector, playlist, options);

    // play/stop block music radio
    $('.block-own-radio').click(function(){
        $('.block-own-radio').removeClass('active-radio');
        $(this).addClass('active-radio');
        var play = $(this).data('play');
        var title = playlist[play].title;
        var path = $(this).find('img').attr('src');

        // myPlaylist.play(play);
        window.onlineRadio.play(play);
        $('.block-played-radio h5').html(title);
        $('.played-radio-widget > h6').html(title);
        $('.active-radio-img img').attr('src',path);

        $('.widget-li').fadeIn();
        $('.played-radio-widget').addClass('ekva-active');

    });

    //hover desc/player
    $('.played-radio-widget').mouseenter(function(){
        $(this).fadeOut('fast','linear',function(){
            $('.radio-widget').fadeIn('fast');
        })
    })
    $('.radio-widget').mouseleave(function(){
        $(this).fadeOut('fast','linear',function(){
            $('.played-radio-widget').fadeIn('fast');
        });
    })

    //change widget drag
    $('.jp-change-widget').click(function(){
        if($('.widget-li').hasClass("ui-draggable")){
            $('.widget-li').addClass('static-widget').removeClass('draggable-widget').draggable('destroy');
        }
        else{
            $('.widget-li').removeClass('static-widget').addClass('draggable-widget').draggable({
                zIndex: 100
            });
        }
    });




    //toggle right block friend
    $('.header-friends a').click(function(){
        // $('.wrapper').toggleClass('active-right-side');
        // $('.wrap-friends-side').toggleClass('active-right-side');
        $('.wrap-friends-side .chat-list').toggleClass('chat-list-mini');
    });

    // Hover on .profheader-ctrl-btn
    $('.profheader-ctrl-btn.profheader-ctrl-message').hover(
        function() {
            $(this).parents('.profheader-ctrl').find('.profheader-ctrl-btn.profheader-ctrl-togglewidth').css('width', '39px');
            $(this).css('width', '172px');
        }, function() {
            $(this).parents('.profheader-ctrl').find('.profheader-ctrl-btn.profheader-ctrl-togglewidth').css('width', '');
            $(this).css('width', '');
        }
    );

    //shown tab photo
    $('.photo-shown-tab').on('shown.bs.tab',function(){
        $('.photo-album-tab-border').parent().addClass('scale-animate');
    })
    //shown tab life
    $('.life-line').on('shown.bs.tab',function(){
        $('.photo-album-tab-border').parent().addClass('scale-animate');
    })


    //get history transaction
    $('#collapseSix, #collapseSix-usd, #collapseSix-eur, #collapseSix-etk').on('shown.bs.collapse', function () {
        console.log($(this));
        $(this).find('.payment-history tbody').html('');
        $(this).find('.next-page-real-money').data('next-page', 1);
        getHistoryCurrencyTransactions(this);
    })

    //get history transaction on click on next
    $('.next-page-real-money').on('click', function () {
        console.log($(this).collapse('[id^="collapseSix"]'));
        getHistoryCurrencyTransactions($(this).collapse('[id^="collapseSix"]').get());
    })

    //get history transaction on chang data period
    $('.real-money-new-period').on('click', function () {
        console.log($(this).collapse('[id^="collapseSix"]'));
        $(this).collapse('[id^="collapseSix"]').find('.payment-history tbody').html('');
        $(this).collapse('[id^="collapseSix"]').find('.next-page-real-money').data('next-page', 1);
        getHistoryCurrencyTransactions($(this).collapse('[id^="collapseSix"]').get());
        return false;
    })

    function getHistoryCurrencyTransactions(element)
    {
        data = {
            currency: $(element).find('.real-money-currency').val(),
            num_page: $(element).find('#next-page-real-money').data('next-page'),
            from_data: $(element).find('#date-from-real-money').val(),
            to_data: $(element).find('#date-to-real-money').val(),
        };

        console.log(data);

        $.post(SP_source() + 'ajax/get-currency-transactions', data, function(responseText) {
            console.log(responseText);
            if (responseText.status == 200) {
                $(element).find('#next-page-real-money').show();
                if (responseText.next_page == 0){
                    $(element).find('#next-page-real-money').hide();
                }

                $(element).find('#next-page-real-money').data('next-page', (responseText.next_page==0?1:responseText.next_page));
                console.log( $(element).find('#next-page-real-money').data('next-page'));
                $(element).find('.payment-history tbody').append(responseText.data.original);
            }
        });
    }

    //get history transaction
    $('#bay_ticket_button').on('click', function () {
        $('#bay_ticket_form').submit();
    })

    $('.transfer-user-by-id').on('click', function (e) {
        var data = {
            currency: $('#global_currency_selected').val(),
            to_user_id: $(this).closest('.panel-body').find('#send_to').val(),
            sum: $(this).closest('.panel-body').find('#send_summ').val(),
        };

        var panel_body = $(this).closest('.panel-body');
        $.post(SP_source() + 'ajax/payment/transfer-to-another-user-by-id', data, function(responseText) {
            console.log(responseText);
            if (responseText.status == 200) {
                
            }
            if (responseText.status == 210) {
                $(panel_body).find('.start_form').hide();
                $(panel_body).find('.confirmation_form').show();
                $(panel_body).find('#transaction_id').val(responseText.transaction_id);
            }
        });

        return false;
    })

    $('.confirm-transfer-user-by-id').on('click', function (e) {
        var data = {
            transaction_id: $(this).closest('.panel-body').find('#transaction_id').val(),
            confirm: $(this).closest('.panel-body').find('#confirm_code').val(),
        };

        var panel_body = $(this).closest('.panel-body');
        $.post(SP_source() + 'ajax/payment/confirm-transfer-to-another-user-by-id', data, function(responseText) {
            console.log(responseText);
            if (responseText.status == 200) {
                $(panel_body).find('.confirmation_form').html(responseText.message)
            }
        });

        return false;
    })


});


// functions

//next audio radio
function nextRadio(){
    var idRadio = $('.block-own-radio.active-radio').data('play');
    var nextId = idRadio + 1;
    if($('.block-own-radio[data-play="'+ nextId +'"]').length){
        $('.block-own-radio.active-radio').removeClass('active-radio');
        $('.block-own-radio[data-play="'+ nextId +'"]').click();
    }
    else{
        $('.block-own-radio[data-play="'+ 0 +'"]').click();
    }
}
//previous audio radio
function previousRadio(){
    var idRadio = $('.block-own-radio.active-radio').data('play');
    var prevId = idRadio - 1;
    var lengthBlock = $('.block-own-radio').length - 1;
    if($('.block-own-radio[data-play="'+ prevId +'"]').length){
        $('.block-own-radio.active-radio').removeClass('active-radio');
        $('.block-own-radio[data-play="'+ prevId +'"]').click();
    }
    else{
        $('.block-own-radio[data-play="'+ lengthBlock +'"]').click();
    }
}

//play pause ekva
function playPause(self){
    if(!$('.radio-widget').hasClass('jp-state-playing')){
        console.log(1);
        if($(self).hasClass('tab-jp-play')){
            $('.block-own-radio[data-play="0"]').click();
        }
    }
    setTimeout(function(){
        if($('.radio-widget').hasClass('jp-state-playing')){
            $('.played-radio-widget').addClass('ekva-active');
        }
        else{
            $('.played-radio-widget').removeClass('ekva-active');
        }
    },200);
}
