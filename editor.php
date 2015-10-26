<?php
$isfront = false;

// Includes
include("functions.inc.php");

// GET
include("inc/vars.inc.php");

// MSG
include("inc/msg.inc.php");
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ROSK <?php echo($pageName); ?> -- Editor</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/bootstrap-switch.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="fonts/ionicons-2.0.1/css/ionicons.css">
    <link href='http://fonts.googleapis.com/css?family=Volkhov|Roboto+Condensed|Roboto:400,300,700' rel='stylesheet'
          type='text/css'>
</head>

<body>


<?php include('inc/nav.inc.php'); ?>


<div class="container container-spruch">
    <h1 class="white" style="color: #ffffff;">GartenHelfer Editor</h1>

    <div class="jumbotron">
        <?php include('inc/prompter.inc.php'); ?>
    </div>
</div>


<div class="container container-aktuell">





    <div class="well col-md-6" style="">
            <h3>Musik hochladen</h3>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <section class="">
                    Audio-Datei hochladen:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input class="btn btn-default" type="submit" value="Hochladen" name="submit">
                </section>
            </form>
    </div>

    <div class="well col-md-6" style="">
            <h3>Filmupload</h3>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <section class="">
                    Film hochladen:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input class="btn btn-default" type="submit" value="Hochladen" name="submit">
                </section>
            </form>
        </div>

<div class="well col-md-6">
    <h3>Neuer Spruch</h3>

    <form>
        <input type="text" maxlength="256" id="add" name="add">
        <button type="submit" class="btn pull-right">Eintragen</button>
    </form>
</div>

<div class="col-md-6">
    <div class="well">
        <h3>Abfalltonnen-Kalender</h3>

        <form>
            <input type="text" placeholder="01.01.2015" maxlength="256" id="add5" name="add5">
            <select type="text" id="add5_2" name="add5_2">
                <option>Braune Tonne</option>
                <option>Gelbe Tonne</option>
                <option>Blaue Tonne</option>
                <option>Schwarze Tonne</option>
            </select>
            <button type="submit" class="btn pull-right">Eintragen</button>
        </form>
        <div class="clearfix"></div>
        <hr>
        <?php printTonneListe(20); ?>
    </div>
</div>

<div id="addTerminWell" class="col-md-6">
    <div class="well">
        <h3>Neuer Termin</h3>

        <form>
            <label><i class="ion ion-ios-alarm"></i> Termin</label>
            <input title="Titel" type="text" placeholder="Termin" maxlength="256" id="add2" name="add2">
            <label><i class="ion ion-ios-calendar"></i> Datum</label>
            <input title="Datum" type="date" placeholder="01.01.2015" id="add2_2" name="add2_2">
            <label><i class="ion ion-ios-clock-outline"></i> Uhrzeit</label>
            <input title="Uhrzeit" type="time" placeholder="00:00 Uhr" id="add2_3" name="add2_3">
            <button type="submit" class="btn btn-default pull-right">Eintragen</button>
        </form>
    </div>
</div>

<div id="addTerminWell" class="col-md-6">
    <div class="well">
        <h3>Neue Wartungsaufgabe</h3>

        <form>
            <label><i class="ion ion-ios-alarm"></i> Wartung</label>
            <input title="Titel" type="text" placeholder="Termin" maxlength="256" id="add4" name="add4">
            <label><i class="ion ion-ios-calendar"></i> Datum</label>
            <input title="Datum" type="date" placeholder="01.01.2015" id="add4_2" name="add4_2">
            <label><i class="ion ion-ios-clock-outline"></i> Uhrzeit</label>
            <input title="Uhrzeit" type="time" placeholder="00:00 Uhr" id="add4_3" name="add4_3">
            <label><i class="ion ion-ios-clock-outline"></i> Priorität</label>
            <select name="add4_4">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <button type="submit" class="btn btn-default pull-right">Eintragen</button>
        </form>
    </div>
</div>

<div id="addPflanzeWell" class="col-md-12" style="">
    <div class="well">
        <h3>Neue Pflanze</h3>

        <form id="addPlant">
            <div class="col-sm-12">
                <h6>Name - Kurzform</h6>
                <input title="Name Kurz" type="text" placeholder="Name der Pflanze" id="p1" name="p1">
            </div>
            <div class="col-sm-12">
                <h6>Name - Langform</h6>
                <input title="Name Lang" type="text" placeholder="Lateinischer Name der Pflanze" id="p2" name="p2">
            </div>
            <div class="col-sm-6">
                <h6>Standort</h6>
                <select title="Standort" id="p3" name="p3">
                    <option value="hell">Hell</option>
                    <option value="sonnig">Sonnig</option>
                    <option value="Halbschatten">Halbschatten</option>
                    <option value="Schatten">Schatten</option>
                    <option value="Vorgarten">Vorgarten</option>
                    <option value="Balkon">Terasse</option>
                    <option value="Kübel">Kübel</option>
                </select>
            </div>
            <div class="col-sm-6">
                <h6>Giessen</h6>
                <select title="Giessen" id="p4" name="p4">
                    <option value="Selten">Selten</option>
                    <option value="Täglich">Täglich</option>
                    <option value="Wöchentlich">Wöchentlich</option>
                    <option value="Monatlich">Monatlich</option>
                    <option value="Nie">Nie</option>
                </select>
            </div>
            <div class="col-sm-6">
                <h6>Frostsicher</h6>
                <select title="Frostsicher" id="p5" name="p5">
                    <option value="Ja">Ist frostsicher</option>
                    <option value="Nein">Ist nicht frostsicher</option>
                </select>
            </div>
            <div class="col-sm-6">
                <h6>Saatmonat</h6>
                <select title="Saatmonat" id="p6" name="p6">
                    <option value="Keiner">Keiner</option>
                    <option value="Januar">Januar</option>
                    <option value="Februar">Februar</option>
                    <option value="März">März</option>
                    <option value="April">April</option>
                    <option value="Mai">Mai</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Dezember">Dezember</option>
                </select>
            </div>
            <div class="col-sm-6">
                <h6>Erntemonat</h6>
                <select title="Erntemonat" id="p7" name="p7">
                    <option value="Keiner">Keiner</option>
                    <option value="Januar">Januar</option>
                    <option value="Februar">Februar</option>
                    <option value="März">März</option>
                    <option value="April">April</option>
                    <option value="Mai">Mai</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Dezember">Dezember</option>
                </select>
            </div>
            <div class="col-sm-12">
                <h6>Wikipedia Link</h6>
                <input title="Wikipedia" type="time" placeholder="http://wikipedia.de/" id="p8" name="p8">
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-default" style="width: 100%;">Einpflanzen</button>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
</div>

<div class="col-md-12">
    <div class="well">
        <h3>Sprüche</h3>
        <?php
        printSpruchListe();
        ?>
    </div>
</div>

<div class="col-md-12">
    <div class="well">
        <h3>Alle Termine</h3>
        <?php
        printTerminListe(99);
        ?>
    </div>
</div>


<div class="col-md-12">
    <div class="well">
        <h3>Logger</h3>
        <div id="log">
            ## LOG ##
        </div>
    </div>
</div>



<footer>
    <p class="pull-left">
    </p>
    <p class="pull-right">&copy; <b>ROSK</b> 2015 - GARTEN 0.24</p>
</footer>

</div>


<!-- Footer Scripts -->
<script src="js/vendor/jquery-1.11.3.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.color.js"></script>
<script src="js/jquery.simpleWeather.js"></script>
<script src="js/jquery.newsTicker.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/jquery.tzineClock.js"></script>
<script src="js/raphael.2.1.0.min.js"></script>
<script src="js/justgage.1.0.1.js"></script>
<script src="js/plugins.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="js/logic.js"></script>

</body>

</html>
