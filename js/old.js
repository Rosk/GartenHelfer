(function (homecontrol) {

// On Init
    homecontrol.load().(function () {
        animStack();
    });

// Show the time
    homecontrol('.showTime').click(function (timed) {
        timed('#timeRow').toggleClass('active');
    });

// Show Json
    homecontrol('.showJson').click(function () {
        jsonContent();
    });


// Animation Stack
    var animStack = function (anim) {
        anim("h1").hide();
        var colors = ["#4562e9", "#123456", "#aabbdd", "#ff3300", "#cc5543", "#498138"];
        var color = Math.floor((Math.random() * colors.length));
        var speed1 = 500;
        var speed2 = 750;

        anim("h1").delay(speed1).show('slow');

        anim("body").animate({
            backgroundColor: colors[color]
        }, speed2);


        anim(".navbar-inverse").animate({
            backgroundColor: colors[color],
            backgroundImage: "none"
        }, speed2, function () {
            anim(".navbar-brand").animate({
                color: "#ffffff"
            }, speed2, function () {
                anim(".jumbotron").animate({
                    backgroundColor: "#ffffff"
                }, speed1);
                anim("h2").animate({
                    color: "#ffffff"
                }, speed1);
                anim("section p").animate({
                    color: "rgba(255,255,255,0.7)"
                }, speed1);
                anim("footer p").animate({
                    color: "rgba(255,255,255,0.7)"
                }, speed1);
            });
        });
    };


// window Size
    var getSize = function (gsize) {// Bootstrap Dimmensions
        // Extra small screen / phone
        var screenxs = 480;
        // Small screen / tablet
        var screensm = 768;
        // Medium screen / desktop
        var screenmd = 992;
        // Large screen / wide desktop
        var screenlg = 1200;

        // get size of window
        var winHeight = gsize(window).height();
        var winWidth = gsize(window).width();
        var docHeight = gsize(document).height();
        var docWidth = gsize(document).width();
        var screenMode = "";
        var logHeight = "";

        homecontrol(window).resize = function () {
            // testlog
            gsize("#log").append("<div>winH:" + winHeight + "</div>");
            gsize("#log").append("<div>winW:" + winWidth + "</div>");
            gsize("#log").append("<div>docH:" + docHeight + "</div>");
            gsize("#log").append("<div>docW:" + docWidth + "</div>");
        };


        // Bootstrap Mediaqueries
        if (winWidth < screenxs) {
            screenMode = "MobileScreen";
            logHeight = winHeight;
            // resize log
            gsize("#log").delay(5).animate({
                height: logHeight + "px"
            }, 50);
        }
        if (winWidth > screenxs && winWidth < screensm) {
            screenMode = "TabletScreen";
            logHeight = winHeight / 2;
            // resize log
            gsize("#log").delay(5).animate({
                height: logHeight
            }, 50);
        }
        if (winWidth > screensm && winWidth < screenmd) {
            screenMode = "DesktopScreen";
            logHeight = winHeight / 2;
            // resize log
            gsize("#log").delay(5).animate({
                height: logHeight
            }, 50);
        }
        if (winWidth > screenmd && winWidth < screenlg) {
            screenMode = "WideScreen";
            logHeight = winHeight / 2;
            // resize log
            gsize("#log").delay(5).animate({
                height: logHeight
            }, 50);
        }
        if (winWidth > screenlg) {
            screenMode = "BigScreen";
            logHeight = winHeight / 3;
            // resize log
            gsize("#log").delay(5).animate({
                height: logHeight
            }, 50);
        }

        return screenMode;
    };


// Window Resize
    homecontrol(window).resize(function () {
        var mode = getSize("body");
        homecontrol("#log").append("<div>Handler for .resize() called.</div>").append("<h3>" + mode + "</h3>");
    });


// json Content
    var jsonContent = function (json) {

        json.getJSON('#json', function (data) {
            var items = [];
            json.each(data, function (key, val) {
                items.push("<li id='" + key + "'>" + val + "</li>");

                json("#log").append("<h3>OK</h3>");
            });

        });

        json("#log").append("<h3>OK</h3>");
    };

});
/**
 * Created by odroid on 04.07.15.
 */
