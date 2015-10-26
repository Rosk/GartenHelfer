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

$db = new Datenbank();
$query = $db->query('SELECT * FROM sprueche'); // gepuffertes Abfrageergebnis
$ids = array();
$thespruch = "Kein Spruch parat.";

while ($row = $query->fetchArray())
{
    $ids[] = $row[0];
}

$randid = rand(0,sizeof($ids)-1);
$query2 = $db->query('SELECT spruch FROM sprueche WHERE id = '.$ids[$randid].''); // gepuffertes Abfrageergebnis

while ($row2 = $query2->fetchArray())
{
    $theid      = $row2[0];
    $thespruch  = $row2[0];
}


echo $thespruch;

