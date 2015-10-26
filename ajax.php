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

$id = $_POST['id'];
$datum = showDateClean('UTC', 'now');
$randint = rand(0,100);

echo "Gewählt: " . $id . " und heute ist der " . $datum . ' - ' . $randint;
