<?php
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 22.07.15
 * Time: 14:07
 */
// Wartungen

function createWartungTable()
{
    $db = new Datenbank();
    $db->exec('CREATE TABLE wartungen (id INT PRIMARY KEY AUTOINCREMENT, wartung TEXT, wartungnr INT );');
}

function insertWartung($wartung, $wartungnr, $datum, $uhrzeit, $prioritaet)
{
    $db = new Datenbank();
    $s = $wartung;
    $t = $wartungnr;
    $u = $datum;
    $v = $uhrzeit;
    $p = $prioritaet;
    $db->exec("INSERT INTO wartungen (wartung, wartungnr, datum, uhrzeit, prioritaet) VALUES ('" . $s . "', '" . $t . "', '" . $u . "', '" . $v . "', '" . $p . "')");
}

function deleteWartung($id)
{
    $db = new Datenbank();
    $s = $id;
    $db->query('DELETE FROM wartungen WHERE id="' . $s . '"');
}

function printWartungListe($l)
{
    $count = 0;
    $limit = $l;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM wartungen ORDER BY prioritaet, datum  LIMIT ' . $limit . ''); // gepuffertes Abfrageergebnis
    $list = "";

    while ($row = $query->fetchArray()) {
        // Do Something with $row
        // print_r($row[0]);
        $list .= "<li class='wartung'>
        <div class='badge badge-prio pull-right'>$row[5]</div>
        <b>ID:" . $row[0] . "</b><br> " . $row[3] . " um " . $row[4] . "<br>
        <h5><i class='ion ion-wrench'></i> " . $row[1] . "</h5>
        <a class='pull-right btn btn-default' alt='Text" . $row[0] . "' href='?del4=" . $row[0] . "'>Erledigt</a></li>";
        $count++;
    }

    echo "<ul>";
    echo $list;
    echo "</ul>";
    echo "<div class='clearfix result-row' style='width: 100%; float: none; clear: both;'>";
    echo "<hr><div class='badge badge-large'>" . $count . " Wartungen</div>";
    echo "</div>";
}

function wartungHeute($datum)
{
    $list = "";
    $count = 0;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM wartungen WHERE datum="' . $datum . '" ORDER BY datum, prioritaet'); // gepuffertes Abfrageergebnis

    while ($row = $query->fetchArray()) {
        $list .= "
        <li class='wartung'>" . $row[3] . " um " . $row[4] . "<br>
        <div class='badge badge-prio pull-right'>$row[5]</div>
        <h5><i class='ion ion-wrench'></i> " . $row[1] . "</h5>
        <a class='pull-right btn btn-small' alt='Text" . $row[0] . "' href='?del4=" . $row[0] . "'>Erledigt</a></li>";
        $count++;
    }

    if ($list != "") {
        echo "<ul>";
        echo $list;
        echo "</ul>";
        echo "<div class='clearfix' style='width: 100%; float: none; clear: both;'>";
        echo "</div>";
    } else {
        echo "<h6><i class='ion ion-ios-arrow-thin-right'></i> Keine Wartungen für heute!</h6>";
    }
}

?>