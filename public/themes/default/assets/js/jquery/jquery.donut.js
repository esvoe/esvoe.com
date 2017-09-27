(function ($) {
    $.fn.donut = function(options) {
        var settings = $.extend({
            colors: [
                '#40557D',
                '#FAC942',
                '#1AA6D6',
                '#F0B499',
                '#72C4B9',
                '#289DF5',
                
            ],
        }, options );

        
        return this.each(function() {
            var ctx = this.getContext('2d');
            var segments = [];
            var labels = [];

            $(this).children().map(function () {
                var v = $(this).data('value');
                var f = parseFloat(v);

                if (!isNaN(f)) {
                    segments.push(f);
                    labels.push($(this).text());
                } else {
                    console.log("Chart value '" + v + "' is invalid");
                }
            });

            var canvasWidth = $(this).width();
            var canvasHeight = $(this).height();
            var xCenter = Math.floor(canvasWidth / 2);
            var yCenter = Math.floor(canvasHeight / 2);
            var radius = Math.ceil(0.8 * Math.min(xCenter, yCenter));
            var innerRadius = Math.ceil(radius / 1.2);

            //Reset the canvas
            ctx.clearRect(0, 0, canvasWidth, canvasHeight);
            ctx.restore();
            ctx.save();

            var chartTitle = '';

            function addText(text, x, y) {
                ctx.lineWidth = 1;
                ctx.fillStyle = "#ffffff";
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.textTransform = 'uppercase';
                ctx.fillText(chartTitle, xCenter, yCenter);
            }

            if ($(this).data('title')) {
                chartTitle = $(this).data('title');
                addText(chartTitle, xCenter, yCenter);
            }

            var i, 
                total = 0;

            for (i = 0; i < segments.length; i++) {
                total = total + parseFloat(segments[i]);
            }

            var percentByDegree = 360 / total,
                degToRad = Math.PI / 180,
                currentAngle = 0,
                startAngle = 0,
                endAngle,
                innerStart,
                innerEnd;

            ctx.translate(xCenter, yCenter);
            //Turn the chart around so the segments start from 12 o'clock
            ctx.rotate(270 * degToRad);

            for (i = 0; i < segments.length; i++) {
                startAngle = currentAngle * degToRad;
                endAngle = (currentAngle + (segments[i] * percentByDegree)) * degToRad;

                //Draw the segments
                ctx.fillStyle = settings.colors[i % settings.colors.length];
               
                ctx.beginPath();
                ctx.arc(0, 0, radius, startAngle, endAngle, false);
                ctx.arc(0, 0, innerRadius, endAngle, startAngle, true);
                ctx.closePath();

                ctx.fill();

                currentAngle = currentAngle + (segments[i] * percentByDegree);
            }
        });
    };
} (jQuery));


















