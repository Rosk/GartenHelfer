<?php
/**
 *
 * Navbar
 * User: rosk
 * Date: 22.07.15
 * Time: 11:50
 */
?>

<!-- If page is Index page -->
<?php if($isfront): ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid navbar-main">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">NAV SWITCH</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a id="topbrand" href="#top">
                <img class="img-responsive nav-img-brand" src="img/Gartenhelfer.png" style="float: left;">
            </a>
            <a class="nav-brand-date" href="./" style="float: left;">
                <span class="invert">
                    <?php echo showDayNr('UTC', 'now'); ?>.<?php echo showMonthNr('UTC', 'now'); ?>
                    .20<?php echo showYearNr('UTC', 'now'); ?>
                </span>
            </a>
        </div>

        <div id="navbar" class="navbar-collapse collapse fade in">
            <div class="showGarten nav-quad h-center v-center"><span><i class="ion ion-ios-flower-outline"></i></span></div>
            <div class="showWartung nav-quad h-center v-center"><span><i class="ion ion-wrench"></i></span></div>
            <div class="showTermine nav-quad h-center v-center"><span><i class="ion ion-ios-person"></i></span></div>
            <div class="showWetter nav-quad h-center v-center"><span><i class="ion ion-ios-sunny"></i></span></div>
            <div class="showSwitch nav-quad h-center v-center"><span><i class="ion ion-ios-lightbulb"></i></span></div>
            <div class="showGauge nav-quad h-center v-center"><span><i class="ion ion-speedometer"></i></span></div>
            <div class="showTime nav-quad h-center v-center"><span><i class="ion ion-ios-clock"></i></span></div>
            <div class="showSpruch nav-quad h-center v-center"><span><i class="ion ion-speakerphone"></i></span></div>
        </div>
        <!--/.navbar-collapse -->
    </div>
</nav>
<?php endif; ?>


<!-- If page is the Editor -->
<?php if(!$isfront): ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid navbar-main">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">NAV SWITCH</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a href="#top">
                      <img class="img-responsive nav-img-brand" src="img/Gartenhelfer.png" style="float: left;">
                    </a>

                    <a class="nav-brand-date" href="./" style="float: left;">
                        <span class="invert">
                            <?php echo showDayNr('UTC', 'now'); ?>.<?php echo showMonthNr('UTC', 'now'); ?>
                            .20<?php echo showYearNr('UTC', 'now'); ?>
                        </span>
                    </a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <div class="nav-quad h-center v-center"><span><i class="ion ion-help-buoy"></i></span></div>
                    <div class="showJson nav-quad h-center v-center"><span><i class="ion ion-gear-b"></i></span></div>
                </div>
                <!--/.navbar-collapse -->
            </div>
        </nav>
<?php endif; ?>