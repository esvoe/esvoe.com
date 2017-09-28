window.kalturaLoaded = false;
(function($) {
  $.fn.embedVideo = function(options) {
    $(this).each(function() {
      var settings = $.extend({
            uiconf : '11601208',
            wid : '102',
            maxWidth : ($(this).data('max-width')) ? $(this).data('max-width') : '1200px',
            video_id : $(this).data('video-id'),
            video_url : ($(this).data('video-url')) ? $(this).data('video-url') : null,
            html5 : false,
            autoplay: ($(this).data('autoplay')) ? $(this).data('autoplay') : false,
            thumbnail : ($(this).data('thumbnail')) ? $(this).data('thumbnail') : false,
            width : ($(this).data('width')) ? $(this).data('width') : '100%',
            height : ($(this).data('height')) ? $(this).data('height') : '100%',
            container : $(this).attr('id'),
            video_src: ($(this).data('source')) ? $(this).data('source') : 'kaltura',
            play : ($(this).data('icon')) ? $(this).data('icon') : '<div class="btn-play-video"><img src="https://sand.esvoe.com/themes/default/assets/images/icon-play-video.png"></div>'
          }, options);

      var video_cont = $(this);

      if (settings.video_src == 'kaltura') {
        if (!window.kalturaLoaded) {
          var script = document.createElement('script');
          script.type = 'text/javascript';
          script.src = 'http://cloudvideo.cdn.net.co/p/' + settings.wid + '/sp/' + settings.wid + '00/embedIframeJs/uiconf_id/' + settings.uiconf + '/partner_id/' + settings.wid;
          document.getElementsByTagName('head')[0].appendChild(script);

          window.kalturaLoaded = true;
        }
      } else if (settings.video_src == 'youtube') {
        var videoid = settings.video_url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
        if(videoid != null) {
          settings.video_id = videoid[1];
        }
      } else if (settings.video_src == 'vimeo') {
        settings.video_id = settings.video_url.split(/video\/|https?:\/\/vimeo\.com\//)[1].split(/[?&]/)[0];
      }
      var video_styles = function() {
        video_cont.css({
          width : settings.width,
          height : settings.height,
          position : 'absolute',
          top : 0,
          left : 0,
          'background-repeat' : 'no-repeat',
          'background-size' : 'cover',
          'background-position' : '50% 50%',
          'background-image': 'url("' + settings.thumbnail + '")'
        });
      }

      if (!settings.thumbnail) {
        if (settings.video_src == 'kaltura') {
          settings.thumbnail = 'http://cloudvideo.cdn.net.co/p/' + settings.wid + '/thumbnail/entry_id/' + settings.video_id;
          video_styles();
        } else if (settings.video_src == 'youtube') {
          settings.thumbnail = 'https://img.youtube.com/vi/' + settings.video_id + '/maxresdefault.jpg';
          video_styles();
        } else if (settings.video_src == 'vimeo') {
          $.getJSON('http://www.vimeo.com/api/v2/video/' + settings.video_id + '.json?callback=?', {format: "json"}, function(data) {
            settings.thumbnail = data[0].thumbnail_large;
            video_styles();
          });
        }
      } else {
        video_styles();
      }

      var videoContainer = $('<div>').attr({
        'style' : 'width: 100%; margin: 0 auto; max-width: ' + settings.maxWidth + ';',
        'class' : 'videoContainer'
      });
      var frameVideoContainer = $('<div>').attr({
        'style' : 'position: relative; height: 0; width: 100%; padding-bottom: 56.25%;',
        'class' : 'framePlayerContainer'
      });
      var playIcon = $(settings.play);
      playIcon.attr({
        width : '100%',
        height : '100%'
      });

      var playButton = $('<a>').attr({
        'style' : 'position: absolute; cursor: pointer; width: 50px; height: 50px; top: 50%; margin-top: -25px; left: 50%; margin-left: -25px; text-decoration: none; border: none; border-radius: 50%; box-shadow: 0 0 100px rgba(0, 0, 0, 0.7); opacity: 0.7;'
      }).append(playIcon);
      var parent = $(this).parent();

      playButton.appendTo($(this));

      $(this).wrap(frameVideoContainer);

      frameVideoContainer.wrap(videoContainer);

      //videoContainer.appendTo(parent);

      var videoAutoPlay = (settings.autoplay == 'true') ? 1 : 1;

      playButton.click(function() {
        playButton.fadeOut(function() {
          $(this).remove();
          if (settings.video_src == 'kaltura' && window.kalturaLoaded) {
            kWidget.embed({
              'targetId' : settings.container,
              'wid' : '_' + settings.wid,
              'uiconf_id' : settings.uiconf,
              'entry_id' : settings.video_id,
              'flashvars' : {
                'autoPlay' : true
              }
            });
          } else if (settings.video_src == 'youtube') {
            var video_player = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + settings.video_id + '?autoplay=' + videoAutoPlay + '" frameborder="0" allowfullscreen autoplay></iframe>';
            video_cont.append(video_player);
          } else if (settings.video_src == 'vimeo') {
            var video_player = '<iframe src="https://player.vimeo.com/video/' + settings.video_id + '?autoplay=' + videoAutoPlay + '" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            video_cont.append(video_player);
          }
        });
      });

    });
  }
})(jQuery);