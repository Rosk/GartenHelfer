<?php
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 24.07.15
 * Time: 21:03
 */
// Sprueche

function createSpruchTable()
{
    $db = new Datenbank();
    $db->exec('CREATE TABLE sprueche (id INT PRIMARY KEY AUTOINCREMENT, spruch TEXT, spruchnr INT );');
}

function insertSpruch($spruch)
{
    $db = new Datenbank();
    $s = $spruch;
    $db->exec("INSERT INTO sprueche (spruch, spruchnr) VALUES ('" . $s . "', '23')");
}

function deleteSpruch($id)
{
    $db = new Datenbank();
    $s = $id;
    $db->query('DELETE FROM sprueche WHERE id="' . $s . '"');
}

function printSpruchListe()
{
    $count = 0;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM sprueche'); // gepuffertes Abfrageergebnis
    $list = "";

    while ($row = $query->fetchArray()) {
        // Do Something with $row
        // print_r($row[0]);
        $list .= "<li class='spruch'><b>ID:" . $row[0] . "</b> <h5>" . $row[1] . "</h5> <a class='pull-right btn btn-default' alt='Text" . $row[0] . "' href='?del=" . $row[0] . "'>Löschen</a></li>";
        $count++;
    }

    echo "<ul>";
    echo $list;
    echo "</ul>";
    echo "<div class='clearfix result-row' style='width: 100%; float: none; clear: both;'>";
    echo $count . " Sprüche";
    echo "</div>";
}


function returnSpruch()
{
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM sprueche'); // gepuffertes Abfrageergebnis
    $ids = array();

    while ($row = $query->fetchArray())
    {
        $ids[] = $row[0];
    }

    $randid = $ids[rand(sizeof(0,$ids))];
    $query2 = $db->query('SELECT spruch FROM sprueche WHERE id = '.$randid.''); // gepuffertes Abfrageergebnis

    while ($row2 = $query2->fetchArray())
    {
        $theid      = $row2[0];
        $thespruch  = $row2[1];
    }

    if($thespruch=="" || !$thespruch){
        $thespruch = "Kein Spruch parat.";
    }

    echo $thespruch;
}