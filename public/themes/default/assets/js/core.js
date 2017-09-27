// src/js/core.js


$(function(){

	$('.has-submenu a').on('click',function(e){
		e.preventDefault();
		$(this).parent().find('ul').slideToggle();
	});

    $('.btn-up').on('click',function(){
        $(this).parent().find('.btn-counter').text(parseInt($(this).parent().find('.btn-counter').text())+1);
    });

    $('.btn-down').on('click',function(){
        $(this).parent().find('.btn-counter').text(parseInt($(this).parent().find('.btn-counter').text()) > 0 ? parseInt($(this).parent().find('.btn-counter').text())-1 : 0);
    });
     $('.datepicker').on('click',function(){
        $(this).datepicker({
            format: 'M dd, yy',
        });
      });
    $('.btn-group-justified .btn-grp').on('click',function(e){
    	e.preventDefault();	
    	$('.btn-group-justified .btn-grp').removeClass('active');
        $(this).addClass('active');
    });
    $('.rotate .potrait').on('click',function(e){
        e.preventDefault(); 
        $('.rotate .potrait').removeClass('active');
        $(this).addClass('active');
    });
    $('.activities-list li').on('click',function(e){
        e.preventDefault(); 
        $('.activities-list li').removeClass('active');
        $(this).addClass('active');
    });
    
	$('#selectlayoutModal').modal('show');
     

    	$(function () {

        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker();
        $('#datetimepicker8').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });

    });

        $('#chart').donut();
         $('#char').donut();
         
         //slider-in Image-detail pge
        $('.nstSlider').nstSlider({
    	    "left_grip_selector": ".leftGrip",
    	    "value_changed_callback": function(cause, leftValue, rightValue) {
    	        $(this).parent().find('.leftLabel').text(leftValue);
    	    	}
	   });

        var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
                                  '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';

        var formatName = function(item) {
            return $.trim((item.first_name || '') + ' ' + (item.last_name || ''));
        };

        jQuery('.numbersOnly').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

       
        $('#select-to').selectize({
            persist: false,
            maxItems: null,
            valueField: 'email',
            labelField: 'name',
            searchField: ['first_name', 'last_name', 'email'],
            sortField: [
                {field: 'first_name', direction: 'asc'},
                {field: 'last_name', direction: 'asc'}
            ],
            
            render: {
                item: function(item, escape) {
                    var name = formatName(item);
                    return '<div>' +
                        (name ? '<span class="name">' + escape(name) + '</span>' : '') +
                        (item.email ? '<span class="email">' + escape(item.email) + '</span>' : '') +
                    '</div>';
                },
                option: function(item, escape) {
                    var name = formatName(item);
                    var label = name || item.email;
                    var caption = name ? item.email : false;
                    return '<div>' +
                        '<span class="label">' + escape(label) + '</span>' +
                        (caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
                    '</div>';
                }
            },

            createFilter: function(input) {
                var regexpA = new RegExp('^' + REGEX_EMAIL + '$', 'i');
                var regexpB = new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i');
                return regexpA.test(input) || regexpB.test(input);
            },
            create: function(input) {
                if ((new RegExp('^' + REGEX_EMAIL + '$', 'i')).test(input)) {
                    return {email: input};
                }
                var match = input.match(new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i'));
                if (match) {
                    var name       = $.trim(match[1]);
                    var pos_space  = name.indexOf(' ');
                    var first_name = name.substring(0, pos_space);
                    var last_name  = name.substring(pos_space + 1);

                    return {
                        email: match[2],
                        first_name: first_name,
                        last_name: last_name
                    };
                }
                
                return false;
            }
        });
        
        $(document).ready(function () {
            //WYSIWYG EDITOR(TinyMCE)
            tinymce.init({
            selector: '.mytextarea',
            theme: 'modern',
            height : 84,
            max_width: 884.25,
            plugins: [
              'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
              'searchreplace wordcount visualblocks visualchars  code fullscreen insertdatetime media nonbreaking',
              'save table contextmenu directionality emoticons template paste textcolor'
            ],
            toolbar: 'bold italic underline strikethrough | link blockquote image code | bullist  numlist alignjustify aligncenter alignleft alignright', 
            menubar: false,
            statusbar: false,
            resize: false,

            });    

            //date-picker
            $('#example1').datepicker({
                format: "dd/mm/yyyy"
            });  

            //caret rotation in invoice-list
            $('.invoice-panel .btn-collapsable').on("click",function(){
                if($(this).find('.caret-rotate').hasClass('fa-caret-down')) {
                    $(this).find('.caret-rotate').removeClass('fa-caret-down').addClass('fa-caret-up');
                }
                else{
                    $(this).find('.caret-rotate').removeClass('fa-caret-up').addClass('fa-caret-down');
                }
            });
            
            // //for count increment in forum page
            //  $(function(){

            //     var z = $('#btn-middle1').text();
            //     $('.btn-inc').on("click",function(){
            //         z++;
            //         $(this).parent().find('#btn-middle1').text(z);
            //     }) ;
            //     $('.btn-dec').on("click",function(){
            //         if(z <= 0){
            //             $(this).parent().find('#btn-middle1').text(0);
            //         }
            //         else
            //         {    
            //              z--;
            //             $(this).parent().find('#btn-middle1').text(z);
            //         }
            //     });
            //  }) ;

            //   $(function(){

            //     var z = $('#btn-middle2').text();
            //     $('.btn-inc').on("click",function(){
            //         z++;
            //         $(this).parent().find('#btn-middle2').text(z);
            //     }) ;
            //     $('.btn-dec').on("click",function(){
            //         if(z <= 0){
            //             $(this).parent().find('#btn-middle2').text(0);
            //         }
            //         else
            //         {    
            //              z--;
            //             $(this).parent().find('#btn-middle2').text(z);
            //         }
            //     });
            //  }) ;

             // For Show and hide the password
                function showPassword() {
                    var target = $("#showHide");
                    target.click(function() {
                        if ($("#password").attr("type")==="password") {
                            $("#password").attr("type", "text");
                            $('#showHide .fa').removeClass('fa-eye').addClass('fa-eye-slash');
                        } else {
                            $("#password").attr("type", "password");
                           $('#showHide .fa').addClass('fa-eye').removeClass('fa-eye-slash');
                        }
                    });
                }
                $(document).ready(function () {
                    "use strict";
                    showPassword();
                });


            //pagination
            // $(function() {
            //     $('.fa-caret-right').pagination('nextPage');
            // });

            //tool-tip for widget-card

            $('[data-toggle="tooltip"]').tooltip();
            //$('[data-toggle="tooltip"]').tooltip('show');

            //upload image
            $("#upfile1").click(function(e) {
                e.preventDefault();
                $("#file1").trigger('click');
            });
            
            $("#upfile2").click(function(e) {
                e.preventDefault();
                $("#file2").trigger('click');
            });
           

            // //upload file 
            // $("#get_file").on("click",function(e){
            //     e.preventDefault();
            //     $("#my_file").trigger('click');
            // });

            // //upload project
            // $("#get_project").on("click",function(e){
            //     e.preventDefault();
            //     $("#my_project").trigger('click');
            // });

        });

        $(document).ready(function () {
          //called when key is pressed in textbox
          $(".numbersOnly").keypress(function (e) {
             //if the letter is not digit then display error and don't type anything
             if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                
                       return false;
            }
           });
        });

        $(document).ready(function() {
            $('#select_all').click(function() {  //on click 
                if(this.checked) { // check select status
                    $('.checkbox1').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"               
                    });
                }else{
                    $('.checkbox1').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                    });         
                }
            });
           

            $('#check_all').click(function() {  //on click 
                if(this.checked) { // check select status
                    $('.check-box1').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"               
                    });
                }else{
                    $('.check-box1').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                    });         
                }
            });

            $('.team-members-table tr').click(function(event) {
                if (event.target.type !== 'checkbox') {
                    $(':checkbox', this).trigger('click');
                }
            });

            
        });

        $(document).ready(function(){
            $("#avatar").click(function(e) {
                 e.preventDefault();
                $("#avatar-input").trigger('click');
            });

            // $(".calendar-switch").click(function(){
            //    $(this).parents(".notification").find(".notification-text").css("color",$(this).parents(".notification").find('.calendar-switch').checked ? "rgba(53, 64, 82, 0.25)" : "red");
            // });
            $("#cmn-toggle-101").change(function(){
               $("#101").css("color",this.checked ? "rgba(53, 64, 82, 0.25)" : "#354052");
            });
            $("#cmn-toggle-102").change(function(){
               $("#102").css("color",this.checked ? "rgba(53, 64, 82, 0.25)" : "#354052");
            });
            $("#cmn-toggle-103").change(function(){
               $("#103").css("color",this.checked ? "rgba(53, 64, 82, 0.25)" : "#354052");
            });
             // if($('input.cmn-toggle').attr('checked')) 
             //   {
             //        $('.cmn-toggle').parent().siblings(".text-toggle").css("opacity","1");
             //   }
             //    else
             //   {
             //        $('.cmn-toggle').parent().siblings(".text-toggle").css("opacity","0.6");
             //   }

            $(".switch").click(function(){
              $(this).parent().find(".text-toggle").css("opacity",this.checked ? "0.6" : "1");
            });

            $(".btn-cross").click(function(e){
                e.preventDefault();
                $(this).parent().find(".mail,.btn-cross").hide();
                $(this).parent().find(".btn-connect").show();
            });


            $(".search-list li a .cross-icon").click(function(e){
                e.preventDefault();
                $(this).parents("li").fadeOut(500);
              });  
            
            $('.layout-img').click(function(e){
                e.preventDefault();
                $(this).children('.gray-image').toggle();
                $(this).children('.green-image').toggleClass('hide');
                $(this).children('.selected').toggleClass('hide');
            });

            $('.add_selectize').selectize({
        plugins: ['drag_drop'],
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });

            
        // for magnify image jquery

        // $(document).ready(function() {
        //     var scaleNum = 2;
        //     $(".magnify").jfMagnify();
        //     $('.plus').click(function(){
        //         scaleNum += 1;
        //         if (scaleNum >=10) {
        //             scaleNum = 10;
        //         }
        //         $(".magnify").data("jfMagnify").scaleMe(scaleNum);
        //     });
        //     $('.minus').click(function(){
        //         scaleNum -= 1;
        //         if (scaleNum <=2) {
        //             scaleNum = 2;
        //         }
        //         $(".magnify").data("jfMagnify").scaleMe(scaleNum);
        //     });
        //     $('.magnify_glass').animate({
        //         'top':'60%',
        //         'left':'60%'
        //         },{
        //         duration: 2000, 
        //         progress: function(){
        //             $(".magnify").data("jfMagnify").update();
        //         }, 
        //         easing: "easeOutElastic"
        //     });
        // });
        
});

    // document.getElementById('get_file').onclick = function() {
    // document.getElementById('my_file').click();
    // };

    // document.getElementById('get_project').onclick = function() {
    // document.getElementById('my_project').click();
    // };

});


