<?php
/**
 * Created by PhpStorm.
 * User: odroid
 * Date: 06.08.15
 * Time: 16:56
 * asynchrone Datenverarbeitung
 * Diese Seite wird mit Ajax über jQuery parametrisiert aufgerufen.
 * Die verabeiteten Daten werden zurückgegeben,
 * und von der jQuery Methode verarbeitet
 *
 */
include('functions.inc.php');


$randint = rand(0,100);
$today = showDateClean('UTC', 'now');

$id   = $_POST["id"];
$grd  = $_POST["grad"];
$lf   = $_POST["lf"];
$wind = $_POST["wind"];


// Tagesdaten nur dann schreiben, falls es noch keine gibt...
if (hasTagesdaten($today) == true)
{
    echo "Die Tagesdaten wurden heute bereits gemessen...";
}
else{
    writeTagesdaten($today, $wind, $grd, $lf, showYearName('UTC', 'now'), showMonthNr('UTC', 'now'));
    echo "Eingetragen: " . $id . " am " . $today . ' - ' . $grd . '′ - ' . $wind .' - '. $lf . '%';
}