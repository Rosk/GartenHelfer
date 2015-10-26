<?php
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 29.07.15
 * Time: 21:08
 */

function writeTagesdaten($today, $w, $g, $l, $j, $m)
{
    $date = $today;
    $db = new Datenbank();
    $db->exec("INSERT INTO tagesdaten (datum, wind, grad, luftfeuchte, jahr, monat) VALUES ('" . $date . "', '" . $w . "', '" . $g . "', '" . $l . "', '" . $j . "', '" . $m . "')");
}


function readTagesdaten($day)
{
    $date = $day;
    $db = new Datenbank();
    $query = $db->query("SELECT * FROM tagesdaten WHERE datum='" . $date . "'");
    $datensatz = "<ul>";

    while ($row = $query->fetchArray()) {
        // Do Something with $row
        // print_r($row[0]);
        $datensatz .= "<li class='datensatz'>";
        $datensatz .= "<b>" . $row[0] . "</b><br>" . $row[1] . $row[2] . $row[3] . $row[4] . $row[5];
    }
    $datensatz .= "</ul>";

    return $datensatz;
}


function hasTagesdaten($day)
{
    $date = $day;
    $db = new Datenbank();
    $query = $db->query("SELECT * FROM tagesdaten WHERE datum='" . $date . "'");

    $datensatz = "";

    while ($row = $query->fetchArray()) {
        $datensatz .= "<b>" . $row[0] . "</b><br>" . $row[1] . $row[2] . $row[3] . $row[4] . $row[5];
    }

    if ($datensatz == "") {
        return false;
    } else {
        return true;
    }
}

