/*
* This is a custom script by Thomas KIM
* MIT License
*/

function justifiedGrid(parameters) {
  
  var $hgrid_container = $(parameters.gridContainer);
  var $hgrid_items = $(parameters.gridItems);
  var imagesLoadedEnabled = parameters.enableImagesLoaded;
	var gutter = parameters.gutter;
  
  function hgrid_get_orientation(element) {
    if(element.width() >= element.height()) {
      return "l";
    } else {
      return "p";
    }
  }
  
  function grid_initialisation($hgrid_items) {
    // Step 0 : Index the hgrid-items, reinit datas
    $hgrid_items.each(function(index) {
			$(this).css('padding', gutter+"px");
      $(this).attr('data-index', index); 
      $(this).addClass('hgrid-item loaded');
      $(this).removeClass('resized');
    });

    // Step 1 : Size the div
    $hgrid_items.each(function() {
      $(this).css('width', $(this).find('img').width()); 
      $(this).css('height', $(this).find('img').height()); 
      $(this).addClass('resized');
    });

    // Step 2 : Get orientations array
    orientations = new Array;
    $hgrid_items.each(function() {
      orientations.push(hgrid_get_orientation($(this)));
    });
    // Orientations : Array['l', 'l', 'p', ..., 'l']
  }
  
  function construct_lines() {
    if($(window).width() >= 960) {
      max_line_score = 8;   
    }
    if($(window).width() >= 660 && $(window).width() <= 960) {
      max_line_score = 6;
    }
    if($(window).width() <= 660) {
      max_line_score = 4;
    }
    var current_score = 0;
    var number_of_images = orientations.length;
    lines = new Array;
    var line = new Array;
    line_score = new Array;
    orientations.forEach(function(orientation, index){
      if(orientation == 'l') {
        // If image still in current line
        if(current_score + 2 <= max_line_score) {
          if(index != number_of_images - 1) {
            current_score += 2;
            line.push($('.hgrid-item[data-index='+index+']'));   
          } 
          else {
            current_score += 2;
            line_score.push(current_score);
            line.push($('.hgrid-item[data-index='+index+']')); 
            lines.push(line);
          }
        }
        // If image is the first of next line
        else {
          if(index != number_of_images - 1) {
            line_score.push(current_score);
            current_score = 2;
            // We push the previous line
            lines.push(line);
            // We init it again
            line = new Array;
            line.push($('.hgrid-item[data-index='+index+']'));
          }
          else {
            line_score.push(current_score);
            current_score = 2;
            line_score.push(current_score);
            // We push the previous line
            lines.push(line);
            // We init it again
            line = new Array;
            line.push($('.hgrid-item[data-index='+index+']'));
            lines.push(line);
          }
        }
      }
      else {
        // If image still in current line
        if(current_score + 1 <= max_line_score) {
          if(index != number_of_images - 1) {
            current_score += 1;
            line.push($('.hgrid-item[data-index='+index+']'));
          }
          else {
            current_score += 1;
            line_score.push(current_score);
            line.push($('.hgrid-item[data-index='+index+']')); 
            lines.push(line);
          }
        }
        // If image is the first of next line
        else {
          if(index != number_of_images - 1) {
            line_score.push(current_score);
            current_score = 1;
            // We push the previous line
            lines.push(line);
            // We init it again
            line = new Array;
            line.push($('.hgrid-item[data-index='+index+']'));
          }
          else {
            line_score.push(current_score);
            current_score = 1;
            line_score.push(current_score);
            // We push the previous line
            lines.push(line);
            // We init it again
            line = new Array;
            line.push($('.hgrid-item[data-index='+index+']'));
            lines.push(line);
          }
        }
      }
    });
    // Lines : Array[[n,n,n,n,n], [n,n,n,n],..., [n,n,n,n]]
  }
  
  function magic() {
    lines.forEach(function(line, line_index){
      if(line_score[line_index] >= max_line_score - 1) {
        var images_in_line = line.length; 

        $theContainer = $hgrid_container;
        // L = Width of the Container
        var L = $theContainer.width()-2;
        // m = margin
        var m = 0;

        // oH = originalHeight :: oW = originalWidth :: r = ratio
        var oW = [];
        var oH = [];
        var r = [];
        var count = 0;

        line.forEach(function(hgrid_item, index) {
          var imgWidth = hgrid_item.width();
          var imgHeight = hgrid_item.height();

          oW.push(imgWidth);
          oH.push(imgHeight);
          r.push(imgWidth/imgHeight);
          count += 1;   
        });

        // rW = reduced Width
        var rW = [];
        var sum = 0;
        for (i = 0; i <= count-1; i++) {
          for(j = 0; j <= count-1; j++) {
            sum += r[j] / r[i];
          }
          var rWi = ( L - (count-1)*m ) / sum;
          rW.push(rWi);
          sum = 0;
        }

        var lineHeight = rW[0]/r[0];

        var i=0;
        line.forEach(function(hgrid_item, index) {
          hgrid_item.css({'height': lineHeight, 'width': rW[i]});
          hgrid_item.animate({'opacity': 1}, 500);
          i += 1;
        });
      }
      else {
        var images_in_line = line.length; 

        $theContainer = $hgrid_container;
        // L = Width of the Container
        if(line_score[line_index] <= max_line_score / 2) {
          var L = $theContainer.width()/2-2;   
        }
        else {
          var L = $theContainer.width()-$theContainer.width()/3-2;
        }
        // m = margin
        var m = 0;

        // oH = originalHeight :: oW = originalWidth :: r = ratio
        var oW = [];
        var oH = [];
        var r = [];
        var count = 0;

        line.forEach(function(hgrid_item, index) {
          var imgWidth = hgrid_item.width();
          var imgHeight = hgrid_item.height();

          oW.push(imgWidth);
          oH.push(imgHeight);
          r.push(imgWidth/imgHeight);
          count += 1;   
        });

        // rW = reduced Width
        var rW = [];
        var sum = 0;
        for (i = 0; i <= count-1; i++) {
          for(j = 0; j <= count-1; j++) {
            sum += r[j] / r[i];
          }
          var rWi = ( L - (count-1)*m ) / sum;
          rW.push(rWi);
          sum = 0;
        }

        var lineHeight = rW[0]/r[0];

        var i=0;
        line.forEach(function(hgrid_item, index) {
          hgrid_item.css({'height': lineHeight, 'width': rW[i]});
          hgrid_item.animate({'opacity': 1}, 500);
          i += 1;
        });
      }
    });
  }
  
  this.reInitGrid = function() {
    $hgrid_items.each(function() {
      $(this).attr('style', '');
    });
    grid_initialisation($hgrid_items);
    construct_lines();
    magic();
  }

  this.initGrid = function () { 
    
    var grid = this;
    
    if(imagesLoadedEnabled) {
      $hgrid_container.imagesLoaded(function() {

        // Step 1 : init and get orientations array
        grid_initialisation($hgrid_items);

        // Step 2 : Construct the lines array
        construct_lines();

        // Step 4 : Let's size the images according to the Lines array
        magic();

      }); 
    } 
    else {
      // get all images and iframes
      var $elems = $('#div').find('img, iframe');

      // count them
      var elemsCount = $elems.length;

      // the loaded elements flag
      var loadedCount = 0;

      // attach the load event to elements
      $elems.on('load', function () {
          // increase the loaded count 
          loadedCount++;

          // if loaded count flag is equal to elements count
          if (loadedCount == elemsCount) {
            // Step 1 : init and get orientations array
            grid_initialisation($hgrid_items);

            // Step 2 : Construct the lines array
            construct_lines();

            // Step 4 : Let's size the images according to the Lines array
            magic();
          }
      });
      
      grid.reInitGrid();
    }
    
    $(window).on('resize', function() {
      grid.reInitGrid();
    });
  }
}