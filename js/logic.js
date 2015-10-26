/*
 ROSK HOME
 Odroid Startscreen
 */

var logger, pagename, introblocks, introblock, aufgaben;
var g1, g2, g3, grad, wind, feuchte;
navbar = "#navbar";
bar = "#bar";
logger = "#log";
logger2 = "#log2";
logger3 = "#log3";
introblock = ".introBlock";
pagename = "GartenHelfer";
aufgaben = $('.termin').length;
brand = "#topbrand";

// -----------------------------------------------------------------------------------------------------------------

$.fn.slideFadeToggle = function (speed, easing, callback) {
    return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
};

$.fn.slideBlockToggle = function (speed, easing, callback) {
    this.toggleClass('active');
};

$.fn.activate = function(speed, easing, callback){
    this.addClass('active');
    return this.animate({opacity: 1}, speed, easing, callback);
};

$.fn.deactivate = function(speed, easing, callback){
    this.removeClass('active');
    return this.animate({opacity: 0}, speed, easing, callback);
};

// -----------------------------------------------------------------------------------------------------------------

// Initialize the page
function init() {
    introblocks = 0;
    $(introblock).each(function () {
        introblocks += 1;
    });

    var datas = $("#plantsRaw").text();

    $('#table').bootstrapTable({
        pagination: true,
        pageSize: 5,
        smartDisplay: true,
        search: true,
        showFooter: false,
        idField: 'id',
        striped: true,
        location: 'DE',
        sortName: 'Namekurz',
        columns: [{
            field: 'id',
            title: 'ID'
        }, {
            field: 'namekurz',
            title: 'Pflanze'
        }, {
            field: 'namelang',
            title: 'Name Lang'
        },
        {
            field: 'standort',
            title: 'Standort'
        },
            {
                field: 'giessen',
                title: 'Giessen'
            },
            {
                field: 'saatmonat',
                title: 'Saatmonat'
            },
            {
                field: 'erntemonat',
                title: 'Erntemonat'
            },
            {
                field: 'frostsicher',
                title: 'Frostsicher'
            }],
        data: [{
            id: 1,
            namekurz: 'Item 1',
            standort: '$1'
        }, {
            id: 2,
            namekurz: 'Item 2',
            standort: '$2'
        }]
    });

    $(logger).append("<hr><h6>" + pagename + " --> initialisiert</h6><hr>");
}


// Notify Bar
/*
 * Notify Bar - jQuery plugin
 *
 * Copyright (c) 2009-2015 Dmitri Smirnov
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 * http://www.whoop.ee/posts/2013/04/05/the-resurrection-of-jquery-notify-bar.html
 */
(function ($) {

    "use strict";

    $.notifyBar = function (options) {
        var rand = parseInt(Math.random() * 100000, 0),
            text_wrapper, asTime,
            bar = {},
            settings = {};

        settings = $.extend({
            html           : 'Your message here',
            delay          : 3000,
            animationSpeed : 200,
            cssClass       : '',
            jqObject       : '',
            close          : false,
            closeText      : '&times;',
            closeOnClick   : true,
            closeOnOver    : false,
            onBeforeShow   : null,
            onShow         : null,
            onBeforeHide   : null,
            onHide         : null,
            position       : 'top'
        }, options);

        // Use these methods as private.
        this.fn.showNB = function () {
            if (typeof settings.onBeforeShow === 'function') {
                settings.onBeforeShow.call();
            }
            $(this).stop().slideDown(asTime, function () {
                if (typeof settings.onShow === 'function') {
                    settings.onShow.call();
                }
            });
        };

        this.fn.hideNB = function () {
            if (typeof settings.onBeforeHide === 'function') {
                settings.onBeforeHide.call();
            }
            $(this).stop().slideUp(asTime, function () {
                if (bar.attr("id") === "__notifyBar" + rand) {
                    $(this).slideUp(asTime, function () {
                        $(this).remove();
                        if (typeof settings.onHide === 'function') {
                            settings.onHide.call();
                        }
                    });
                } else {
                    $(this).slideUp(asTime, function () {
                        if (typeof settings.onHide === 'function') {
                            settings.onHide.call();
                        }
                    });
                }
            });
        };

        if (settings.jqObject) {
            bar = settings.jqObject;
            settings.html = bar.html();
        } else {
            bar = $("<div></div>")
                .addClass("jquery-notify-bar")
                .addClass(settings.cssClass)
                .attr("id", "__notifyBar" + rand);
        }
        text_wrapper = $("<span></span>")
            .addClass("notify-bar-text-wrapper")
            .html(settings.html);

        bar.html(text_wrapper).hide();

        var id = bar.attr("id");
        switch (settings.animationSpeed) {
            case "slow":
                asTime = 600;
                break;
            case "default":
            case "normal":
                asTime = 400;
                break;
            case "fast":
                asTime = 200;
                break;
            default:
                asTime = settings.animationSpeed;
        }
        $("body").prepend(bar);

        // Style close button in CSS file
        if (settings.close) {
            // If close settings is true. Set delay to one billion seconds.
            // It'a about 31 years - mre than enough for cases when notify bar is used :-)
            settings.delay = Math.pow(10, 9);
            bar.append($("<a href='#' class='notify-bar-close'>" + settings.closeText + "</a>"));
            $(".notify-bar-close").click(function (event) {
                event.preventDefault();
                bar.hideNB();
            });
        }

        // Check if we've got any visible bars and if we have,
        // slide them up before showing the new one
        if ($('.jquery-notify-bar:visible').length > 0) {
            $('.jquery-notify-bar:visible').stop().slideUp(asTime, function () {
                bar.showNB();
            });
        } else {
            bar.showNB();
        }

        // Allow the user to click on the bar to close it
        if (settings.closeOnClick) {
            bar.click(function () {
                bar.hideNB();
            });
        }

        // Allow the user to move mouse on the bar to close it
        if (settings.closeOnOver) {
            bar.mouseover(function () {
                bar.hideNB();
            });
        }

        setTimeout(function () {
            bar.hideNB(settings.delay);
        }, settings.delay + asTime);

        if (settings.position === 'bottom') {
            bar.addClass('bottom');
        } else if (settings.position === 'top') {
            bar.addClass('top');
        }

        return bar;
    };
})(jQuery);


// Textdaten via json in einen Container laden
$(".showJson").on('click',function () {
    $(logger).load("ReadMe.txt", function (responseTxt, statusTxt, xhr) {
        // bei erfolg
        if (statusTxt === "success") {
            // alert("Der Inhalt wurde erfolgreich geladen!");
            $(".navbar-brand").animate({
                color: "#ffffff",
                left: "100px"
            });
            $(logger).html(responseTxt);
        }
        // bei fehler
        if (statusTxt === "error") {
            $(logger).html("FUCK! Error: " + xhr.status + " : " + xhr.statusText);
        }
    });
});




// FlipClock
function initClock(time){
    var clock = $('.flipclock').FlipClock({
        clockFace: 'TwentyFourHourClock'
    });
}

// Scroll Animation on Click
$(function () {
    $('a[href*=#]:not([href=#]):not([href=#tab-sensor]):not([href=#tab-wetter]):not([href=#tab-aktuell]):not([href=#tab-innen]):not([href=#tab-brunnen]):not([href=#tab-aussen])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            var barheight = $('#navbar').height();
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - barheight - 20
                }, 1000);
                return false;
            }
        }
    });
});


// send a command to Arduino via Ajax, prompt the return
function sendAjax(befehl){
    $.ajax({
        url: "ajax_sendArduino.php",
        type: "POST",
        data: {cmd:befehl,port:1},
        success: function(msg){
            if(msg){
                $(".led1").removeClass('led-red').addClass('led-green');
                sayit(msg);
            }
            if(msg == "Error"){
                sayit("Es wurde kein Arduino entdeckt. Schliessen Sie eins an!");
            }
        },
        error: function(){
            sayit("kein Arduino gefunden");
        }
    });
}


// send a "Licht" command to Arduino via Ajax with the relais portnr, prompt the return
function triggerLight(port)
{
    $.ajax({
        url: "ajax_sendArduino.php",
        type: "POST",
        data: {cmd:"Licht",port:port},
        success: function(msg){
            if(msg){
                sayit(msg);
            }
        },
        error: function(){
            sayit("kein Arduino gefunden");
        }
    });
}


// how big is the screen?
function getSize() {
// window Size
    var screenxs, screensm, screenmd, screenlg, winHeight, winWidth, docHeight, docWidth, screenMode, logHeight;

    // Bootstrap Dimmensions

    // Extra small screen / phone
    screenxs = 480;
    // Small screen / tablet
    screensm = 768;
    // Medium screen / desktop
    screenmd = 992;
    // Large screen / wide desktop
    screenlg = 1200;

    // get size of window
    winHeight = $(window).height();
    winWidth = $(window).width();
    var switchWidth = $(".col-md-3").width() - 50;
    var clockHeight = $(".fancyC").height();
    docHeight = $(document).height();
    docWidth = $(document).width();
    screenMode = "";
    logHeight = "";
    screenText = winHeight+"px x "+winWidth+"px";

    // Log Sizes
    $(logger).append("Fenster Höhe:" + winHeight + "<span class='badge pull-right'>READY</span>").append("<hr>Fenster Breite:" + winWidth + "  <span class='badge pull-right'>READY</span>").append("<hr>Dokument Höhe:" + docHeight + "<span class='badge pull-right'>READY</span>").append("<hr>Dokument Breite:" + docWidth + "<span class='badge pull-right'>READY</span><hr>");

    if(docWidth <= 720){
        $(logger).append("<div>MOBIL</div>");
    }

    if(docWidth <= 520){
        $(logger).append("<div>PHONE</div>");
    }

    // Bootstrap Mediaqueries
    if (winWidth < screenxs) {
        screenMode = "MobileScreen";
        logHeight = winHeight;
        // resize log
        $("#log").delay(5).animate({
            height: logHeight + "px"
        }, 50);
    }
    if (winWidth > screenxs && winWidth < screensm) {
        screenMode = "TabletScreen";
        logHeight = winHeight / 2;
        // resize log
        $("#log").delay(5).animate({
            height: logHeight
        }, 50);
    }
    if (winWidth > screensm && winWidth < screenmd) {
        screenMode = "DesktopScreen";
        logHeight = winHeight / 2;
        // resize log
        $("#log").delay(5).animate({
            height: logHeight
        }, 50);
    }
    if (winWidth > screenmd && winWidth < screenlg) {
        screenMode = "WideScreen";
        logHeight = 200;
        // resize log
        $("#log").delay(5).animate({
            height: logHeight
        }, 50);
    }
    if (winWidth > screenlg) {
        screenMode = "BigScreen";
        logHeight = 200;
        // resize log
        $("#log").delay(5).animate({
            height: logHeight
        }, 50);
    }

    $.fn.bootstrapSwitch.defaults.onColor = 'success';
    $.fn.bootstrapSwitch.defaults.size = 'small';
    $.fn.bootstrapSwitch.defaults.handleWidth = (switchWidth + 'px');
    $.fn.bootstrapSwitch.defaults.lableWidth = (switchWidth + 'px');

    $(".well.tonneToday").css("height", (clockHeight + 20) + "px");

    return screenMode;
}


/** Methode zum eintragen der Tagesdaten mit ajax*/

function insertTagesdaten(did,wind,lf,grad){
    $.ajax({
            url: "ajax_insertTagesdaten.php",
            type: "POST",
            data: {id: did, wind: wind, lf: lf, grad: grad},
            success: function(msg){
                sayit(msg);
            },
            error: function(){
                sayit("Fehler - Tagedaten konnten nicht eingetragen werden");
            }
    });
}


/** Methode für einen neuen Spruch **/
function neuerSpruch(m){
    $.ajax({
        url: "ajax_neuerSpruch.php",
        type: "POST",
        data: {mode: m},
        success: function(msg){
            // sayit(msg);
            $('h1.alert').html(msg);
        },
        error: function(){
            sayit("Fehler - kein neuer Spruch vorhanden");
        }
    });
}

// -----------------------------------------------------------------------------------------------------------------


/**
 * This is a complex demo of how to set up a Highcharts chart, coupled to a
 * dynamic source and extended by drawing image sprites, wind arrow paths
 * and a second grid on top of the chart. The purpose of the demo is to inpire
 * developers to go beyond the basic chart types and show how the library can
 * be extended programmatically. This is what the demo does:
 *
 * - Loads weather forecast from www.yr.no in form of an XML service. The XML
 *   is translated on the Higcharts website into JSONP for the sake of the demo
 *   being shown on both our website and JSFiddle.
 * - When the data arrives async, a Meteogram instance is created. We have
 *   created the Meteogram prototype to provide an organized structure of the different
 *   methods and subroutines associated with the demo.
 * - The parseYrData method parses the data from www.yr.no into several parallel arrays. These
 *   arrays are used directly as the data option for temperature, precipitation
 *   and air pressure. As the temperature data gives only full degrees, we apply
 *   some smoothing on the graph, but keep the original data in the tooltip.
 * - After this, the options structure is build, and the chart generated with the
 *   parsed data.
 * - In the callback (on chart load), we weather icons on top of the temperature series.
 *   The icons are sprites from a single PNG image, placed inside a clipped 30x30
 *   SVG <g> element. VML interprets this as HTML images inside a clipped div.
 * - Lastly, the wind arrows are built and added below the plot area, and a grid is
 *   drawn around them. The wind arrows are basically drawn north-south, then rotated
 *   as per the wind direction.
 */

function Meteogram(xml, container) {
    // Parallel arrays for the chart data, these are populated as the XML/JSON file
    // is loaded
    this.symbols = [];
    this.symbolNames = [];
    this.precipitations = [];
    this.windDirections = [];
    this.windDirectionNames = [];
    this.windSpeeds = [];
    this.windSpeedNames = [];
    this.temperatures = [];
    this.pressures = [];

    // Initialize
    this.xml = xml;
    this.container = container;

    // Run
    this.parseYrData();
}
/**
 * Return weather symbol sprites as laid out at http://om.yr.no/forklaring/symbol/
 */
Meteogram.prototype.getSymbolSprites = function (symbolSize) {
    return {
        '01d': {
            x: 0,
            y: 0
        },
        '01n': {
            x: symbolSize,
            y: 0
        },
        '16': {
            x: 2 * symbolSize,
            y: 0
        },
        '02d': {
            x: 0,
            y: symbolSize
        },
        '02n': {
            x: symbolSize,
            y: symbolSize
        },
        '03d': {
            x: 0,
            y: 2 * symbolSize
        },
        '03n': {
            x: symbolSize,
            y: 2 * symbolSize
        },
        '17': {
            x: 2 * symbolSize,
            y: 2 * symbolSize
        },
        '04': {
            x: 0,
            y: 3 * symbolSize
        },
        '05d': {
            x: 0,
            y: 4 * symbolSize
        },
        '05n': {
            x: symbolSize,
            y: 4 * symbolSize
        },
        '18': {
            x: 2 * symbolSize,
            y: 4 * symbolSize
        },
        '06d': {
            x: 0,
            y: 5 * symbolSize
        },
        '06n': {
            x: symbolSize,
            y: 5 * symbolSize
        },
        '07d': {
            x: 0,
            y: 6 * symbolSize
        },
        '07n': {
            x: symbolSize,
            y: 6 * symbolSize
        },
        '08d': {
            x: 0,
            y: 7 * symbolSize
        },
        '08n': {
            x: symbolSize,
            y: 7 * symbolSize
        },
        '19': {
            x: 2 * symbolSize,
            y: 7 * symbolSize
        },
        '09': {
            x: 0,
            y: 8 * symbolSize
        },
        '10': {
            x: 0,
            y: 9 * symbolSize
        },
        '11': {
            x: 0,
            y: 10 * symbolSize
        },
        '12': {
            x: 0,
            y: 11 * symbolSize
        },
        '13': {
            x: 0,
            y: 12 * symbolSize
        },
        '14': {
            x: 0,
            y: 13 * symbolSize
        },
        '15': {
            x: 0,
            y: 14 * symbolSize
        },
        '20d': {
            x: 0,
            y: 15 * symbolSize
        },
        '20n': {
            x: symbolSize,
            y: 15 * symbolSize
        },
        '20m': {
            x: 2 * symbolSize,
            y: 15 * symbolSize
        },
        '21d': {
            x: 0,
            y: 16 * symbolSize
        },
        '21n': {
            x: symbolSize,
            y: 16 * symbolSize
        },
        '21m': {
            x: 2 * symbolSize,
            y: 16 * symbolSize
        },
        '22': {
            x: 0,
            y: 17 * symbolSize
        },
        '23': {
            x: 0,
            y: 18 * symbolSize
        }
    };
};

/**
 * Function to smooth the temperature line. The original data provides only whole degrees,
 * which makes the line graph look jagged. So we apply a running mean on it, but preserve
 * the unaltered value in the tooltip.
 */
Meteogram.prototype.smoothLine = function (data) {
    var i = data.length,
        sum,
        value;

    while (i--) {
        data[i].value = value = data[i].y; // preserve value for tooltip

        // Set the smoothed value to the average of the closest points, but don't allow
        // it to differ more than 0.5 degrees from the given value
        sum = (data[i - 1] || data[i]).y + value + (data[i + 1] || data[i]).y;
        data[i].y = Math.max(value - 0.5, Math.min(sum / 3, value + 2.5));
    }
};

/**
 * Callback function that is called from Highcharts on hovering each point and returns
 * HTML for the tooltip.
 */
Meteogram.prototype.tooltipFormatter = function (tooltip) {

    // Create the header with reference to the time interval
    var index = tooltip.points[0].point.index,
        ret = '<b>' + Highcharts.dateFormat('%A, %b %e', tooltip.x) + '-' +
            Highcharts.dateFormat('%H:%M', tooltip.points[0].point.to) + '</b><br>';

    // Symbol text
    ret += '<b>' + this.symbolNames[index] + '</b>';

    ret += '<table>';

    // Add all series
    Highcharts.each(tooltip.points, function (point) {
        var series = point.series;
        ret += '<tr><td><span style="color:' + series.color + '">\u25CF</span> ' + series.name +
            ': </td><td style="white-space:nowrap">' + Highcharts.pick(point.point.value, point.y) +
            series.options.tooltip.valueSuffix + '</td></tr>';
    });

    // Add wind
    ret += '<tr><td style="vertical-align: top">\u25CF Wind</td><td style="white-space:nowrap">' + this.windDirectionNames[index] +
        '<br>' + this.windSpeedNames[index] + ' (' +
        Highcharts.numberFormat(this.windSpeeds[index], 1) + ' m/s)</td></tr>';

    // Close
    ret += '</table>';


    return ret;
};

/**
 * Draw the weather symbols on top of the temperature series. The symbols are sprites of a single
 * file, defined in the getSymbolSprites function above.
 */
Meteogram.prototype.drawWeatherSymbols = function (chart) {
    var meteogram = this,
        symbolSprites = this.getSymbolSprites(30);

    $.each(chart.series[0].data, function (i, point) {
        var sprite,
            group;

        if (meteogram.resolution > 36e5 || i % 2 === 0) {

            sprite = symbolSprites[meteogram.symbols[i]];
            if (sprite) {

                // Create a group element that is positioned and clipped at 30 pixels width and height
                group = chart.renderer.g()
                    .attr({
                        translateX: point.plotX + chart.plotLeft - 15,
                        translateY: point.plotY + chart.plotTop - 30,
                        zIndex: 5
                    })
                    .clip(chart.renderer.clipRect(0, 0, 30, 30))
                    .add();

                // Position the image inside it at the sprite position
                chart.renderer.image(
                        'http://www.highcharts.com/samples/graphics/meteogram-symbols-30px.png',
                        -sprite.x,
                        -sprite.y,
                        90,
                        570
                    )
                    .add(group);
            }
        }
    });
};

/**
 * Create wind speed symbols for the Beaufort wind scale. The symbols are rotated
 * around the zero centerpoint.
 */
Meteogram.prototype.windArrow = function (name) {
    var level,
        path;

    // The stem and the arrow head
    path = [
        'M', 0, 7, // base of arrow
        'L', -1.5, 7,
        0, 10,
        1.5, 7,
        0, 7,
        0, -10 // top
    ];

    level = $.inArray(name, ['Calm', 'Light air', 'Light breeze', 'Gentle breeze', 'Moderate breeze',
        'Fresh breeze', 'Strong breeze', 'Near gale', 'Gale', 'Strong gale', 'Storm',
        'Violent storm', 'Hurricane']);

    if (level === 0) {
        path = [];
    }

    if (level === 2) {
        path.push('M', 0, -8, 'L', 4, -8); // short line
    } else if (level >= 3) {
        path.push(0, -10, 7, -10); // long line
    }

    if (level === 4) {
        path.push('M', 0, -7, 'L', 4, -7);
    } else if (level >= 5) {
        path.push('M', 0, -7, 'L', 7, -7);
    }

    if (level === 5) {
        path.push('M', 0, -4, 'L', 4, -4);
    } else if (level >= 6) {
        path.push('M', 0, -4, 'L', 7, -4);
    }

    if (level === 7) {
        path.push('M', 0, -1, 'L', 4, -1);
    } else if (level >= 8) {
        path.push('M', 0, -1, 'L', 7, -1);
    }

    return path;
};

/**
 * Draw blocks around wind arrows, below the plot area
 */
Meteogram.prototype.drawBlocksForWindArrows = function (chart) {
    var xAxis = chart.xAxis[0],
        x,
        pos,
        max,
        isLong,
        isLast,
        i;

    for (pos = xAxis.min, max = xAxis.max, i = 0; pos <= max + 36e5; pos += 36e5, i += 1) {

        // Get the X position
        isLast = pos === max + 36e5;
        x = Math.round(xAxis.toPixels(pos)) + (isLast ? 0.5 : -0.5);

        // Draw the vertical dividers and ticks
        if (this.resolution > 36e5) {
            isLong = pos % this.resolution === 0;
        } else {
            isLong = i % 2 === 0;
        }
        chart.renderer.path(['M', x, chart.plotTop + chart.plotHeight + (isLong ? 0 : 28),
                'L', x, chart.plotTop + chart.plotHeight + 32, 'Z'])
            .attr({
                'stroke': chart.options.chart.plotBorderColor,
                'stroke-width': 1
            })
            .add();
    }
};

/**
 * Get the title based on the XML data
 */
Meteogram.prototype.getTitle = function () {
    return '<h3>Das Wetter in ' + this.xml.location.name + '</h3>';
};

/**
 * Build and return the Highcharts options structure
 */
Meteogram.prototype.getChartOptions = function () {
    var meteogram = this;

    return {
        chart: {
            renderTo: this.container,
            marginBottom: 100,
            marginRight: 40,
            marginTop: 80,
            plotBorderWidth: 5,
            width: 1080,
            height: 500
        },

        title: {
            text: this.getTitle(),
            align: 'center'
        },

        credits: {
            text: 'ROSK Wetterdaten bereitgestellt von yr.no',
            href: this.xml.credit.link['@attributes'].url,
            position: {
                x: -40
            }
        },

        tooltip: {
            shared: true,
            useHTML: true,
            formatter: function () {
                return meteogram.tooltipFormatter(this);
            }
        },

        xAxis: [
            { // Bottom X axis
                type: 'datetime',
                tickInterval: 2 * 36e5, // two hours
                minorTickInterval: 36e5, // one hour
                tickLength: 0,
                gridLineWidth: 1,
                gridLineColor: (Highcharts.theme && Highcharts.theme.background2) || '#F0F0F0',
                startOnTick: false,
                endOnTick: false,
                minPadding: 0,
                maxPadding: 0,
                offset: 30,
                showLastLabel: true,
                labels: {
                    format: '{value:%H}'
                }
            },
            { // Top X axis
                linkedTo: 0,
                type: 'datetime',
                tickInterval: 24 * 3600 * 1000,
                labels: {
                    format: '{value:<span style="font-size: 12px; font-weight: bold">%a</span> %b %e}',
                    align: 'left',
                    x: 3,
                    y: -5
                },
                opposite: true,
                tickLength: 20,
                gridLineWidth: 1
            }
        ],

        yAxis: [
            { // temperature axis
                title: {
                    text: null
                },
                labels: {
                    format: '{value}°',
                    style: {
                        fontSize: '12px'
                    },
                    x: -3
                },
                plotLines: [
                    { // zero plane
                        value: 0,
                        color: '#BBBBBB',
                        width: 1,
                        zIndex: 2
                    }
                ],
                // Custom positioner to provide even temperature ticks from top down
                tickPositioner: function () {
                    var max = Math.ceil(this.max) + 1,
                        pos = max - 12, // start
                        ret;

                    if (pos < this.min) {
                        ret = [];
                        while (pos <= max) {
                            ret.push(pos += 1);
                        }
                    } // else return undefined and go auto

                    return ret;

                },
                maxPadding: 0.3,
                tickInterval: 1,
                gridLineColor: (Highcharts.theme && Highcharts.theme.background2) || '#F0F0F0'

            },
            { // precipitation axis
                title: {
                    text: null
                },
                labels: {
                    enabled: false
                },
                gridLineWidth: 0,
                tickLength: 0

            },
            { // Air pressure
                allowDecimals: false,
                title: { // Title on top of axis
                    text: 'hPa',
                    offset: 0,
                    align: 'high',
                    rotation: 0,
                    style: {
                        fontSize: '12px',
                        color: Highcharts.getOptions().colors[2]
                    },
                    textAlign: 'left',
                    x: 3
                },
                labels: {
                    style: {
                        fontSize: '14px',
                        color: '#008cd3'
                    },
                    y: 2,
                    x: 3
                },
                gridLineWidth: 0,
                opposite: true,
                showLastLabel: false
            }
        ],

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                pointPlacement: 'between'
            }
        },


        series: [
            {
                name: 'Temperatur',
                data: this.temperatures,
                type: 'spline',
                marker: {
                    enabled: false,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                },
                tooltip: {
                    valueSuffix: '°C'
                },
                zIndex: 1,
                color: '#FF3333',
                negativeColor: '#48AFE8'
            },
            {
                name: 'Niederschlag',
                data: this.precipitations,
                type: 'column',
                color: '#008cd3',
                yAxis: 1,
                groupPadding: 0,
                pointPadding: 0,
                borderWidth: 0,
                shadow: false,
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                        if (this.y > 0) {
                            return this.y;
                        }
                    },
                    style: {
                        fontSize: '14px'
                    }
                },
                tooltip: {
                    valueSuffix: 'mm'
                }
            },
            {
                name: 'Luftdruck',
                color: Highcharts.getOptions().colors[2],
                data: this.pressures,
                marker: {
                    enabled: false
                },
                shadow: false,
                tooltip: {
                    valueSuffix: ' hPa'
                },
                dashStyle: 'shortdot',
                yAxis: 2
            }
        ]
    }
};

/**
 * Post-process the chart from the callback function, the second argument to Highcharts.Chart.
 */
Meteogram.prototype.onChartLoad = function (chart) {

    this.drawWeatherSymbols(chart);
    this.drawWindArrows(chart);
    this.drawBlocksForWindArrows(chart);

};

/**
 * Create the chart. This function is called async when the data file is loaded and parsed.
 */
Meteogram.prototype.createChart = function () {
    var meteogram = this;
    this.chart = new Highcharts.Chart(this.getChartOptions(), function (chart) {
        meteogram.onChartLoad(chart);
    });
};

/**
 * Handle the data. This part of the code is not Highcharts specific, but deals with yr.no's
 * specific data format
 */
Meteogram.prototype.parseYrData = function () {

    var meteogram = this,
        xml = this.xml,
        pointStart;

    if (!xml || !xml.forecast) {
        $('#loading').html('<i class="fa fa-frown-o"></i> Failed loading data, please try again later');
        return;
    }

    // The returned xml variable is a JavaScript representation of the provided XML,
    // generated on the server by running PHP simple_load_xml and converting it to
    // JavaScript by json_encode.
    $.each(xml.forecast.tabular.time, function (i, time) {
        // Get the times - only Safari can't parse ISO8601 so we need to do some replacements
        var from = time['@attributes'].from + ' UTC',
            to = time['@attributes'].to + ' UTC';

        from = from.replace(/-/g, '/').replace('T', ' ');
        from = Date.parse(from);
        to = to.replace(/-/g, '/').replace('T', ' ');
        to = Date.parse(to);

        if (to > pointStart + 4 * 24 * 36e5) {
            return;
        }

        // If it is more than an hour between points, show all symbols
        if (i === 0) {
            meteogram.resolution = to - from;
        }

        // Populate the parallel arrays
        meteogram.symbols.push(time.symbol['@attributes']['var'].match(/[0-9]{2}[dnm]?/)[0]);
        meteogram.symbolNames.push(time.symbol['@attributes'].name);

        meteogram.temperatures.push({
            x: from,
            y: parseInt(time.temperature['@attributes'].value),
            // custom options used in the tooltip formatter
            to: to,
            index: i
        });

        meteogram.precipitations.push({
            x: from,
            y: parseFloat(time.precipitation['@attributes'].value)
        });
        meteogram.windDirections.push(parseFloat(time.windDirection['@attributes'].deg));
        meteogram.windDirectionNames.push(time.windDirection['@attributes'].name);
        meteogram.windSpeeds.push(parseFloat(time.windSpeed['@attributes'].mps));
        meteogram.windSpeedNames.push(time.windSpeed['@attributes'].name);

        meteogram.pressures.push({
            x: from,
            y: parseFloat(time.pressure['@attributes'].value)
        });

        if (i == 0) {
            pointStart = (from + to) / 2;
        }
    });

    // Smooth the line
    this.smoothLine(this.temperatures);

    // Create the chart when the data is loaded
    this.createChart();
};
// End of the Meteogram protype

// -----------------------------------------------------------------------------------------------------------------


function getWeather() {
    $.simpleWeather({
        location: 'Recklinghausen, Germany',
        woeid: '',
        unit: 'c',
        temp: 'c',
        success: function (weather) {
            html = '<div class="col-md-6" style="background-position: right; background-repeat: no-repeat; background-image: url(' + weather.image + '); ">' +
                '<h2 class="degree">' + weather.temp + '&deg;' + weather.units.temp + '</h2>' +
                '</div>';
            html += '<div class="col-md-6"><ul><li>' + weather.city + '</li>';
            html += '<li class="">' + weather.currently + '</li>';
            html += '<li class="">' + weather.temp + ' Grad Celsius</li>';
            html += '<li class="">Feuchte: ' + weather.humidity + '%</li>';
            html += '<li>' + weather.wind.direction + ' ' + weather.wind.speed + ' ' + weather.units.speed + '</li></ul></div>';
            grad = weather.temp;
            wind = weather.wind.speed;
            feuchte = weather.humidity;
            $("#weather").html(html);

            insertTagesdaten("Tagesdaten",wind,feuchte,grad);
        },
        error: function (error) {
            $("#weather").html('<p>' + error + '</p>');
        }
    });
    $(logger).append("Wetterdaten geholt  <span class='badge pull-right'>READY</span><hr>");
}

function returnGrad() {
    deg = 0;
    $.simpleWeather({
        location: 'Recklinghausen, Germany',
        woeid: '',
        unit: 'c',
        temp: 'c',
        success: function (weather) {
            grad = weather.temp;
            deg = grad;
        },
        error: function (error) {
            deg = 0;
        }
    });
    return deg;
}

function infoBlockTicker() {
    closeBtn = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    $.get('texte/text1.html')
    .success(function (data)
    {
        $('#helptext').html(data).append(closeBtn);
    });
}

function newsTicker() {
    $('.newsticker').newsTicker({
        row_height: 60,
        max_rows: 3,
        speed: 300,
        duration: 5000,
        direction: 'up',
        prevButton: $('#ticker-prev'),
        nextButton: $('#ticker-next'),
        hasMoved: function () {
            $('#nt-example2-infos-container').fadeOut(200, function () {
                $('#nt-example2-infos .infos-hour').text($('#nt-example2 li:first span').text());
                $('#nt-example2-infos .infos-text').text($('#nt-example2 li:first').data('infos'));
                $(this).fadeIn(400);
            });
        },
        pause: function () {
            $('#nt-example2 li i').removeClass('fa-play').addClass('fa-pause');
            sayit("TICKER PAUSIERT");
        },
        unpause: function () {
            $('#nt-example2 li i').removeClass('fa-pause').addClass('fa-play');
            sayit("TICKER UNPAUSIERT");
        }
    });
    $('.newsticker2').newsTicker({
        row_height: 60,
        max_rows: 3,
        speed: 300,
        duration: 5000,
        direction: 'down',
        prevButton: $('#ticker-prev'),
        nextButton: $('#ticker-next'),
        hasMoved: function () {
            $('#nt-example2-infos-container').fadeOut(200, function () {
                $('#nt-example2-infos .infos-hour').text($('#nt-example2 li:first span').text());
                $('#nt-example2-infos .infos-text').text($('#nt-example2 li:first').data('infos'));
                $(this).fadeIn(400);
            });
        },
        pause: function () {
            $('#nt-example2 li i').removeClass('fa-play').addClass('fa-pause');
            sayit("TICKER 2 PAUSIERT");
        },
        unpause: function () {
            $('#nt-example2 li i').removeClass('fa-pause').addClass('fa-play');
            sayit("TICKER 2 UNPAUSIERT");
        }
    });
    $('#nt-example2-infos').hover(function () {
        nt_example2.newsTicker('pause');
    }, function () {
        nt_example2.newsTicker('unpause');
    });
    $(logger).append("<br>Newsticker initialisiert");
}

function sayit(c){
    call = c;
    $.notifyBar({
        cssClass: "success",
        html: c,
        close: false,
        closeOnClick: false,
        position: top
    });
}

function makeSwitches(){
    $("[type='checkbox']").bootstrapSwitch();

    // TODO: Create this dynamically in function printSwitches()

    $('input[name="licht0"]').on('switchChange.bootstrapSwitch', function(event, state) {
        console.log(state); // true | false
        if(state==true)
        {
            sendAjax("DisplayGarten");
            $.notifyBar({
                cssClass: "success",
                html: "Aktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });
        }
        else
        {
            sendAjax("Aus");
            $.notifyBar({
                cssClass: "error",
                html: "Deaktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });
        }
    });

    $('input[name="licht1"]').on('switchChange.bootstrapSwitch', function(event, state) {
        console.log(state); // true | false
        if(state==true)
        {
            sendAjax("DisplayBrunnen");
            $.notifyBar({
                cssClass: "success",
                html: "Aktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });
        }
        else
        {
            sendAjax("Aus");
            $.notifyBar({
                cssClass: "error",
                html: "Deaktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });
        }
    });

    $('input[name="licht2"]').on('switchChange.bootstrapSwitch', function(event, state) {
        console.log(state); // true | false
        if(state==true)
        {
            sendAjax("DisplayTermine");
            $.notifyBar({
                cssClass: "success",
                html: "Aktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });
        }
        else
        {
            sendAjax("Aus");
            $.notifyBar({
                cssClass: "error",
                html: "Deaktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });
        }
    });

    $('input[name="licht3"]').on('switchChange.bootstrapSwitch', function(event, state) {
        console.log(state); // true | false
        if(state==true)
        {
            // sendAjax("DisplayTermine");
            $.notifyBar({
                cssClass: "success",
                html: "Aktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });
        }
        else
        {
            // sendAjax("Aus");
            $.notifyBar({
                cssClass: "error",
                html: "Deaktiviert",
                closeOnClick: false,
                position: top,
                close: false
            });

        }
    });

    $(logger).append("<br>Schalter erstellt");
}

function makeTabs(){
    // Select all tabs
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
    });
    $(logger).append("<br>Tabs erstellt");
}

function navbarBehaviour(){

}

$(function () {

    // On DOM ready...

    // Set the hash to the yr.no URL we want to parse
    if (!location.hash) {
        var place = 'Germany/Nordrhein-Westfalen/Recklinghausen';
        //place = 'France/Rhône-Alpes/Val_d\'Isère~2971074';
        //place = 'Norway/Sogn_og_Fjordane/Vik/Målset';
        //place = 'United_States/California/San_Francisco';
        //place = 'United_States/Minnesota/Minneapolis';
        location.hash = 'http://www.yr.no/place/' + place + '/forecast_hour_by_hour.xml';

    }

    // Then get the XML file through Highcharts' jsonp provider, see
    // https://github.com/highslide-software/highcharts.com/blob/master/samples/data/jsonp.php
    // for source code.
    $.getJSON(
        'http://www.highcharts.com/samples/data/jsonp.php?url=' + location.hash.substr(1) + '&callback=?',
        function (xml) {
            var meteogram = new Meteogram(xml, 'showchart');
        }
    );

});

// -----------------------------------------------------------------------------------------------------------------

// On Click Events
$(".showSpruch").on('click',function(){
    $('.container-spruch').fadeToggle('slow');
    $('#scroll-spruch').fadeToggle('slow');
    sayit("Spruch des Tages");
    neuerSpruch("modus");
    this.preventDefault();
});
$(".showWetter").on('click',function() {
    $('#wetter').fadeToggle('slow');
    $('#chart').fadeToggle('slow');
    $('#scroll-wetter').fadeToggle('slow');
    sayit("Wetter");
    this.preventDefault();
});
$(".showTermine").on('click',function() {
    $('.container-termine').fadeToggle('slow');
    $('#scroll-todo').fadeToggle('slow');
    sayit("Termine");
    this.preventDefault();
});
$(".showGarten").on('click',function() {
    $('.container-garten').fadeToggle('slow');
    $('#scroll-garten').fadeToggle('slow');
    sayit("Pflanzen");
    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: "id=Garten",
        success: function(msg){
            sayit(msg);
        }
    });
    $.preventDefault();
});
$(".showTime").on('click',function() {
    contentBefore = $('h1.alert').text();
    $('.container-clock').fadeToggle('slow');
    $('#scroll-clock').fadeToggle('slow');
    sayit("Zeitanzeige");
    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: "id=Zeit",
        success: function(msg){
            $('h1.alert').html(msg);
            sayit(msg);
        }
    });
    $.preventDefault();
});
$(".showWartung").on('click',function() {
    $('.container-wartung').fadeToggle('slow').toggleClass('inactive');
    $('#scroll-wartung').fadeToggle('slow').toggleClass('inactive');
    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: "id=Wartung",
        success: function(msg){
            sayit(msg);
        }
    });
    $.preventDefault();
});
$(".showGauge").on('click',function() {
    $('.container-gauge').fadeToggle('slow');
    $('#scroll-gauge').fadeToggle('slow');
    sayit("Messfelder");
    this.preventDefault();
});
$(".addTermin").on('click',function() {
    $('#addTerminWell').fadeToggle('slow');
    sayit("Termine");
    this.preventDefault();
});
$(".navbar").on('click',function () {
    $('#statusBlock').toggleClass('active');
});
$(".navbar").hover(function(){
    $('#statusBlock').slideBlockToggle();
});
$(".arduDisplay").on('click',function(){
    sendAjax("DisplayTermine");
});
$(".arduDisplay2").on('click',function(){
    sendAjax("DisplayGarten");
});
$(".arduDisplay3").on('click',function(){
    triggerLight(1);
});

// -----------------------------------------------------------------------------------------------------------------

$(document).ready(function () {
    getWeather();
    getSize();
    newsTicker();
    infoBlockTicker();
    makeSwitches();
    makeTabs();
    navbarBehaviour();
    init();
    initClock(200);

    $(logger).append("Das System wurde erfolgreich initialisiert");
    $(logger2).append("<hr>");
    $(logger2).append("Sensoren <span class='badge pull-right'>READY</span>");
    $(logger2).append("<hr>");
});

$(window).resize(function () {
    getSize();
    makeSwitches();
    makeTabs();
    $(logger).append("<br>Das System wurde erfolgreich skaliert");
    init();
});

window.onload = function () {

    var initPir = 0;
    // By default its black, lets change its attributes

    if( $('#g1').length )
    {
        var g1 = new JustGage({
            id: "g1",
            value: getRandomInt(350, 980),
            min: 0,
            max: 1000,
            title: "Ernteziel",
            label: "Äpfel"
        });
    }

    if( $('#g2').length )
    {
        var g2 = new JustGage({
            id: "g2",
            value: 32,
            min: 0,
            max: 1000,
            title: "Wassertank",
            label: "Liter"
        });
    }

    if( $('#g3').length )
    {
        var g3 = new JustGage({
            id: "g3",
            value: grad,
            min: -20,
            max: 44,
            title: "Hitzeindex",
            label: "Grad"
        });
    }

    if( $('#g4').length )
    {
        var g4 = new JustGage({
            id: "g4",
            value: wind,
            min: 0,
            max: 140,
            title: "Wind",
            label: "Km/h"
        });
    }

    if( $('#g5').length )
    {
        var g5 = new JustGage({
            id: "g5",
            value: feuchte,
            min: 0,
            max: 100,
            title: "Luftfeuchte",
            label: "%"
        });
    }

    if( $('#g6').length )
    {
        var g6 = new JustGage({
            id: "g6",
            value: aufgaben,
            min: 0,
            max: 100,
            title: "Termine",
            label: "Stück"
        });
    }

    if( $('#g7').length )
    {
        var g7 = new JustGage({
            id: "g7",
            value: 350,
            min: 0,
            max: 1000,
            title: "Wassertank 2",
            label: "Liter"
        });
    }

    if( $('#g8').length )
    {
        var g8 = new JustGage({
            id: "g8",
            value: 14.98,
            min: 0,
            max: 100,
            title: "Solar",
            label: "Volt"
        });
    }

    if( $('#g9').length )
    {
        var g9 = new JustGage({
            id: "g9",
            value: 0,
            min: 0,
            max: 100,
            title: "PIR",
            label: "Erfassungen"
        });
    }

    // Starte Polling Intervalle
    // 30 sec
    setInterval(function ()
    {
        g1.refresh(getRandomInt(0, 1000));
        g7.refresh(getRandomInt(0, 1000));
        g2.refresh(getRandomInt(0, 100));

        // neuen Spruch mit ajax
        neuerSpruch();

        $(logger2).append("Neuen Spruch geholt <span class='badge pull-right'>SPRUCH</span>");
        $(logger2).append("<hr>");
        $(logger2).append("Gauge gemessen <span class='badge pull-right'>GAUGE</span>");
        $(logger2).append("<hr>");
    }, 30000);

    // 3 sec
    setInterval(function ()
    {
        // Arduino Daten holen
        $.ajax({
            url: "ajax_sendArduino.php",
            type: "POST",
            data: {cmd:"Read",port:1},
            success: function(msg){
                if(msg==0){
                    // sayit("Erfassungen: " + initPir);
                    $("#g9").css("background-color","rgba(0,255,0,0.2);");
                    $(".well.feld3 > h3").html("Niemand in Reichweite").css("background-color","rgba(0,255,0,0.25);");
                }
                if(msg==1){
                    initPir = initPir+1;
                    $("#g9").css("background-color","rgba(255,0,0,0.25);");
                    $(".well.feld3 > h3").html("Jemand in Reichweite").css("background-color","rgba(255,0,0,0.25);");
                    // sayit("Bewegung registriert");
                }
                else{
                    $(".well.feld3 > h3").css("background-color","rgba(255,255,0,0.25);");
                    $("#g9").css("background-color","rgba(255,255,0,0.2);");
                    $(".well.feld3 > h3").html("PIR Offline");
                }
            },
            error: function(msg){
                sayit("kein Arduino gefunden");
            }
        });
        g9.refresh(initPir);
        var valz = initPir;
        $(logger2).append("PIR <span class='badge pull-right'>"+valz+"</span>");
        $(logger2).append("<hr>");
    },3000);
};

// -----------------------------------------------------------------------------------------------------------------

setTimeout(function () {
    $(".hideInTime").fadeOut(750, function () {
        $(".hideInTime").remove();
    });
}, 1000);




