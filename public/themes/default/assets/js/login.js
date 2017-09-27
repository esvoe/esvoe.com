
$(function () {

    $('.login-form').ajaxForm({
        url: SP_source() + 'login',

        beforeSend: function() {
            login_form = $('.login-form');
            login_button = login_form.find('.btn-submit');
            login_button.attr('disabled', true);
            $('.login-progress').removeClass('hidden');
            $('.login-errors').html('');
        },

        success: function(responseText) {
          
          login_button.attr('disabled', false);
          $('.login-progress').addClass('hidden');
            if (responseText.status == 200) {
                window.location = SP_source();
            } else {
                $('.login-errors').html(responseText.message);

            }

        }
    });



    $('.signup-form').ajaxForm({
        url: SP_source() + 'register',

        beforeSend: function() {
            signup_form = $('.signup-form');
            signup_button = signup_form.find('.btn-submit');
            signup_button.attr('disabled', true).append(' <i class="fa fa-spinner fa-pulse "></i>');
        },

        success: function(responseText) {
          // console.log(jQuery.parseJSON(responseText));
          signup_button.attr('disabled', false).find('.fa-spinner').addClass('hidden');
            if (responseText.status == 200) {
                if(responseText.emailnotify == "on")
                {
                    window.location = SP_source() + 'login?echk=' + responseText.emailnotify;
                }
                else
                {
                    window.location = SP_source();    
                }
                
            } else {

                $('.signup-errors').html('');
                $.each(responseText.err_result, function(key, value) {
                    $('.signup-errors').append('<li>'+ value[0] + '</li>');
                });

            }

        }
    });


});
