<?php
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 22.07.15
 * Time: 14:07
 */

// Termine

function createTerminTable()
{
    $db = new Datenbank();
    $db->exec('CREATE TABLE termine (id INT PRIMARY KEY AUTOINCREMENT, termin TEXT, terminnr INT );');
}

function insertTermin($termin, $terminnr, $datum, $uhrzeit)
{
    $db = new Datenbank();
    $s = $termin;
    $t = $terminnr;
    $u = $datum;
    $v = $uhrzeit;
    $db->exec("INSERT INTO termine (termin, terminnr, datum, uhrzeit) VALUES ('" . $s . "', '" . $t . "', '" . $u . "', '" . $v . "')");
}

function deleteTermin($id)
{
    $db = new Datenbank();
    $s = $id;
    $db->query('DELETE FROM termine WHERE id="' . $s . '"');
}

function printTerminListe($l)
{
    $count = 0;
    $limit = $l;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM termine ORDER BY datum LIMIT ' . $limit . ''); // gepuffertes Abfrageergebnis
    $list = "";

    while ($row = $query->fetchArray()) {
        // Do Something with $row
        // print_r($row[0]);

        $list .= "<li class='termin'>
        <div class='badge badge-prio pull-right'>$row[5]</div>
        <b>ID:" . $row[0] . "</b><br> " . $row[3] . " um " . $row[4] . "<br>
        <h5><i class='ion ion-wrench'></i> " . $row[1] . "</h5>
        <a class='pull-right btn btn-default' alt='Text" . $row[0] . "' href='?del2=" . $row[0] . "'>Erledigt</a></li>";
        $count++;
    }

    echo "<ul>";
    echo $list;
    echo "</ul>";
    echo "<div class='clearfix result-row' style='width: 100%; float: none; clear: both;'>";
    echo "<div class='badge badge-large'>" . $count . " Termine</div>";
    echo "</div>";
}

function terminHeute($datum)
{
    $list = "";
    $count = 0;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM termine WHERE datum="' . $datum . '"'); // gepuffertes Abfrageergebnis

    while ($row = $query->fetchArray()) {
        // Do Something with $row
        // print_r($row[0]);
        $list .= "<li class='terminShort'>" . $row[3] . " um " . $row[4] . "<br><h5>" . $row[1] . "</h5> <a class='pull-right btn btn-small' alt='Text" . $row[0] . "' href='?del2=" . $row[0] . "'>Erledigt</a></li>";
        $count++;
    }

    if ($list != "") {
        echo "<ul>";
        echo $list;
        echo "</ul>";
        echo "<div class='clearfix' style='width: 100%; float: none; clear: both;'>";
        echo "</div>";
    } else {
        echo "<h6><i class='ion ion-ios-arrow-thin-right'></i> Keine Termine für heute!</h6>";
    }
}

?>


