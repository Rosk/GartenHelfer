<?php
    // Includes
    include("functions.inc.php");
    // GET
    include("inc/vars.inc.php");
    // MSG
    include("inc/msg.inc.php");
    // CONF
    include("inc/config.inc.php");
    // LANG
    include("inc/lang.de.inc.php");
    // initial vars
    $isfront = true;
    $today = showDateClean('UTC', 'now');
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ROSK <?php echo($pageName); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-table.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap-switch.css">
    <link rel="stylesheet" href="fonts/ionicons-2.0.1/css/ionicons.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Volkhov|Roboto+Condensed|Roboto:400,300,700'>
    <script>
        (function(doc){var addEvent='addEventListener',type='gesturestart',qsa='querySelectorAll',scales=[1,1],meta=qsa in doc?doc[qsa]('meta[name=viewport]'):[];function fix(){meta.content='width=device-width,minimum-scale='+scales[0]+',maximum-scale='+scales[1];doc.removeEventListener(type,fix,true);}if((meta=meta[meta.length-1])&&addEvent in doc){fix();scales=[.25,1.6];doc[addEvent](type,fix,true);}}(document));
    </script>
</head>
<body id="top">


<!-- Navigation - Topbar -->
<!-- #################################### -->
<?php include('inc/nav.inc.php'); ?>


<!-- Navigation - Scrollbar -->
<!-- #################################### -->
<div id="scrollBar">
    <?php include('inc/scrollbar.inc.php'); ?>
</div>


<!-- Navigation - Stausblock -->
<!-- #################################### -->
<div id="statusBlock" class="">
    <?php printStatusblock("2015-03-15","P1 WUCHS"); ?>
    <?php printStatusblock("2015-08-01","P1 BLÜTE"); ?>
</div>


<!-- Spruch des Tages -->
<!-- #################################### -->
<div id="spruch" class="container container-spruch inview">
    <div class="jumbotron jumbotron-wood">
        <div role="alert" class="alert alert-silence alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h1 class="alert">
                <?php print $de['willkommen']; ?>
                <?php include('inc/prompter.inc.php'); ?>
            </h1>
        </div>
    </div>
</div>

<!-- Monate -->
<div id="monate" class="container container-monate inview">
    <div class="col-md-12 nopad">
        <div class="well well-months">
            <?php showDate('UTC', 'now'); ?>
        </div>
    </div>
</div>

<!-- Help -->
<!-- #################################### -->
<div id="help-container" class="container container-help">
    <div class="row">
        <div id="help" class="col-md-12">
            <div class="alert alert-dismissable">
                <section class="intro-block">
                    <p id="helptext">Lorem ipsum dolor sit amet... This is just a default text</p>
                </section>
            </div>
        </div>
    </div>
</div>


<!-- Schwarzes Brett -->
<!-- #################################### -->
<div id="schwarzesBrett" class="container container-blackboard">
    <div class="jumbotron jumbotron-paper">
        <div role="alert" class="col-md-4 alert alert-warning alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h1 class="alert">
                Warnung
            </h1>
        </div>
        <div role="alert" class="col-md-4 alert alert-success alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h1 class="alert">
                Erfolg
            </h1>
        </div>
        <div role="alert" class="col-md-4 alert alert-silence alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h1 class="alert">
                Still
            </h1>
        </div>
        <div role="alert" class="col-md-6 alert alert-info alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h1 class="alert">
                Info
            </h1>
        </div>
        <div role="alert" class="col-md-6 alert alert-danger alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h1 class="alert">
                Gefahr
            </h1>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- Clock -->
<!-- #################################### -->
<div id="clock" class="container container-clock">
    <div class="row">
        <!-- FlipClock -->
        <div class="col-md-8">
            <div class="well fancyClock fancyC">
                <div class="flipclock"></div>
            </div>
        </div>
        <!-- Tonne -->
        <div class="col-md-4 center-txt center-block">
            <div class="well tonneToday">
                <?php tonneHeute($today); ?>
            </div>
        </div>
        <!-- Drei Statusfelder -->
        <div class="statusfelder">
            <div class="clearfix"></div>
            <!-- Feld 1 -->
            <div class="col-md-8">
                <div class="well feld1">
                <img src="img/hardware/Arduino_ADK_MEGA_2560-Rev3_icon.svg"  style="float: left; height: 145px; margin-right: 20px;">
                    <div id="log3">
                        <h6>Arduino Portmapping</h6>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- Feld 3 -->
            <div class="col-md-4">
                <div class="well feld3">
                    <h3 class="col-md-6">PIR 1</h3>
                    <h3 class="col-md-6">PIR 2</h3>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="well">
                <h3>Logger</h3>
                <div id="log" class="col-md-6">
                    <h6>System Logger</h6>
                </div>
                <div id="log2" class="col-md-6">
                    <h6>Polling Logger</h6>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<!-- Flotr Charts -->
<!-- #################################### -->
<div id="chart" class="container container-fluid">
    <div id="showchart" class="well well-chart" style="width:100%; height:600px;">

    </div>
</div>


<!-- Lichtschalter -->
<!-- #################################### -->
<div id="licht" class="container container-licht">
    <div class="well" style="">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-aussen">Aussenbeleuchtung</a></li>
            <li><a data-toggle="tab" href="#tab-innen">Innenbeleuchtung</a></li>
            <li><a data-toggle="tab" href="#tab-brunnen">Brunnen</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab-aussen" class="tab-pane fade in active">
                <div class="row row-schalter">
                    <div class="col-md-12">
                        <h3>Aussenbeleuchtung</h3>
                        <hr>
                        <div id="schalter">
                            <form>
                                <?php
                                printSwitches('licht');
                                ?>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-innen" class="tab-pane fade">
                <div class="row row-schalter">
                    <div class="col-md-12">
                        <h3>Innenbeleuchtung</h3>
                        <hr>
                        <div id="schalter">
                            <form>
                                <?php
                                printSwitches('licht');
                                ?>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-brunnen" class="tab-pane fade">
                <div class="row row-schalter">
                    <div class="col-md-12">
                        <h3>Brunnen</h3>
                        <hr>
                        <div id="schalter">
                            <form>
                                <?php
                                printSwitches('brunnen');
                                ?>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>
    </div>
</div>


<!-- #################################### -->
<!-- Gauge - Messfelder -->
<div id="gauge" class="container container-gauge">
    <div class="well well-gauge">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-aktuell">Aktuell</a></li>
            <li><a data-toggle="tab" href="#tab-wetter">Wetterindex</a></li>
            <li><a data-toggle="tab" href="#tab-sensor">Sensoren</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab-aktuell" class="tab-pane fade in active">
                <h3>Aktuell</h3>
                <div class="col-md-4 center-txt">
                    <div id="g6"></div>
                </div>
                <div class="col-md-4 center-txt">
                    <div id="g9"></div>
                </div>
                <div class="col-md-4 center-txt">
                    <div id="g1"></div>
                </div>
            </div>
            <div id="tab-wetter" class="tab-pane fade">
                <h3>Wetterdaten</h3>
                <div class="col-md-4 center-txt">
                    <div id="g3"></div>
                </div>
                <div class="col-md-4 center-txt">
                    <div id="g4"></div>
                </div>
                <div class="col-md-4 center-txt">
                    <div id="g5"></div>
                </div>
            </div>
            <div id="tab-sensor" class="tab-pane fade">
                <h3>Sensordaten</h3>
                <div class="col-md-4 center-txt">
                    <div id="g2"></div>
                </div>
                <div class="col-md-4 center-txt">
                    <div id="g7"></div>
                </div>
                <div class="col-md-4 center-txt">
                    <div id="g8"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


<!-- #################################### -->
<!-- Today - Aktuell -->
<div id="now" class="container container-aktuell">
    <div class="row">
        <div class="col-md-6">
            <div class="well well-today">
                <h3>Heute</h3>
                <h5>Newsticker</h5>
                <ul class="newsticker">
                    <li class="ticker"><i class="ion ion-arrow-right-a"></i> Bitte ab 21:00 Uhr die Türen
                        abschließen
                    </li>
                    <li class="ticker"><i class="ion ion-arrow-right-a"></i> Schönes Wochenende</li>
                    <li class="ticker"><i class="ion ion-arrow-right-a"></i> ACHTUNG !!! Blitzeinschlag!</li>
                </ul>
                <hr>
                <ul class="newsticker2">
                    <li class="ticker ticker2"><i class="ion ion-arrow-right-a"></i> A</li>
                    <li class="ticker ticker2"><i class="ion ion-arrow-right-a"></i> B</li>
                    <li class="ticker ticker2"><i class="ion ion-arrow-right-a"></i> C</li>
                    <li class="ticker ticker2"><i class="ion ion-arrow-right-a"></i> D</li>
                    <li class="ticker ticker2"><i class="ion ion-arrow-right-a"></i> E</li>
                </ul>
                <br><br>
                <h5>Termine & Wartungen Heute</h5>
                <?php
                terminHeute($today);
                wartungHeute($today);
                ?>
            </div>
        </div>

        <div id="wetter" class="col-md-6">
            <div class="well">
                <h3>Wetter</h3>
                <h6>Das aktuelle Wetter für den Standort</h6>
                <section class="intro-block">
                    <div id="weather">

                    </div>
                </section>
            </div>
            <div class="well well-wegfinder">
                <form action="http://maps.google.com/maps" method="get" target="_blank">
                    <h3>Wegfinder</h3>
                    <input style="width: 100%;" type="text" name="saddr"/>
                    <input type="hidden" name="daddr" value="Panhütterweg 20, Recklinghausen"/>
                    <input class="btn btn-default" type="submit" value="Finde den Weg"/>
                </form>
            </div>
        </div>

        <div id="todo" class="col-md-12 container-termine">
            <div class="well">
                <h3>Aktuelle Termine</h3>
                <h6>Was liegt an?</h6>
                <section class="intro-block">
                    <?php
                    printTerminListe(5);
                    ?>
                </section>
            </div>
        </div>

        <div id="wartung" class="col-md-12 container-wartung">
            <div class="well">
                <h3>Wartung</h3>
                <h6>Gibt es etwas zu warten?</h6>
                <section class="intro-block">
                    <?php printWartungListe(5); ?>
                </section>
            </div>
        </div>

        <div id="garten" class="col-md-12 container-garten">
            <div class="well">
                <h3>Garten - Pflanzenarten & Lexikon</h3>
                <h6>Was für Pflanzen sind im Garten?</h6>
                <section class="intro-block">
                    <?php printPflanzeListe("mikro"); ?>
                    <hr>
                    <?php printPflanzeListe(""); ?>
                    <hr>
                    <?php printPflanzeListe("lang"); ?>
                    <hr>
                    <div id="plantsRaw">
                        <?php
                            printPflanzeTable();
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


<!-- #################################### -->
<!-- Audio Player -->
<div id="audio" class="container container-audio">
    <div class="well well-sm">
        <h3>Audioplayer</h3>
        <audio preload="auto" class="audioplayer" controls>
            <source src="audio/BlueDucks_FourFlossFiveSix.mp3">
            <source src="audio/BlueDucks_FourFlossFiveSix.ogg">
            <source src="audio/BlueDucks_FourFlossFiveSix.wav">
        </audio>
        <script src="js/jquery.js"></script>
        <script src="js/audioplayer.js"></script>

        <div class="attribution">
            <div xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/" about="http://freemusicarchive.org/music/Blue_Ducks/Six/">
                <span property="dct:title">Six</span> (<a rel="cc:attributionURL" property="cc:attributionName" href="http://freemusicarchive.org/music/Blue_Ducks/">Blue Ducks</a>) / <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">CC BY-NC-SA 3.0</a>
            </div>
        </div>
    </div>
</div>


<!-- #################################### -->
<!-- Footer -->
<div id="footer" class="container container-fluid">
    <footer>
        <p class="pull-left">
            <a href="editor.php" class="btn btn-default"><i class="ion ion-edit"></i></a>
            <a href="#top" class="btn btn-default"><i class="ion ion-arrow-up-a"></i></a>
        </p>
        <p class="pull-left">
            <a href="#" class="btn btn-default">Backup DB</a>
            <a href="#" class="btn btn-default">Upload</a>
        </p>
        <p style="color: black;" class="pull-right">&copy; <b>ROSK</b> 2015 - GARTEN 0.25</p>
        <br><br><br>
        <p style="color: black;" class="pull-right"><?php echo $comPort; ?></p>
    </footer>
</div>



<!-- #################################### -->
<!-- Footer Scripts -->
<script src="js/vendor/jquery-1.11.3.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/vendor/bootstrap-table.js"></script>
<script src="js/vendor/locale/bootstrap-table-de-DE.js"></script>
<script src="js/vendor/locale/bootstrap-table-de-DE.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/jquery.color.js"></script>
<script src="js/jquery.simpleWeather.js"></script>
<script src="js/jquery.newsTicker.js"></script>
<script src="js/raphael.2.1.0.min.js"></script>
<script src="js/flipclock.js"></script>
<script src="js/justgage.1.0.1.js"></script>
<script src="js/plugins.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/logic.js"></script>

</body>

</html>
