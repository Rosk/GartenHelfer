<?php
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 22.07.15
 * Time: 14:07
 */

// Tonnen


function insertTonne($datum, $farbe)
{
    $db = new Datenbank();
    $s = $datum;
    $t = $farbe;
    $db->exec("INSERT INTO tonne (datum, farbe) VALUES ('" . $s . "', '" . $t . "')");
}

function deleteTonne($id)
{
    $db = new Datenbank();
    $s = $id;
    $db->query('DELETE FROM tonne WHERE id="' . $s . '"');
}

function printTonneListe($l)
{
    $count = 0;
    $limit = $l;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM tonne ORDER BY datum LIMIT ' . $limit . ''); // gepuffertes Abfrageergebnis
    $list = "";

    while ($row = $query->fetchArray()) {
        // Do Something with $row
        // print_r($row[0]);
        $list .= "<li class='tonne'>Am <b>" . $row[1] . "</b> wird die " . $row[2] . " geleert. Bitte rechtzeitig vor die Tür stellen.<br><a class='btn btn-small' alt='Text" . $row[0] . "' href='?del5=" . $row[0] . "'>Leeren</a></li>";
        $count++;
    }

    echo "<ul>";
    echo $list;
    echo "</ul>";
    echo "<div class='clearfix result-row' style='width: 100%; float: none; clear: both;'>";
    echo "<div class='badge badge-large'>" . $count . " Tonnen vermerkt</div>";
    echo "</div>";
}

function tonneHeute($datum)
{
    $list = "";
    $count = 0;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM tonne WHERE datum="' . $datum . '"'); // gepuffertes Abfrageergebnis

    while ($row = $query->fetchArray()) {
        if ($row[2] == "Braune Tonne") {
            $list .= "<i class='ion ion-ios-trash-outline tonneicon' style='color: #623106;'></i>";
        }
        if ($row[2] == "Gelbe Tonne") {
            $list .= "<i class='ion ion-ios-trash-outline tonneicon' style='color: #fff638;'></i>";
        }
        if ($row[2] == "Blaue Tonne") {
            $list .= "<i class='ion ion-ios-trash-outline tonneicon' style='color: #008cd3;'></i>";
        }
        if ($row[2] == "Schwarze Tonne") {
            $list .= "<i class='ion ion-ios-trash-outline tonneicon' style='color: #001620;'></i>";
        }
        if ($row[2] == "") {
            $list .= "<i class='ion ion-ios-sunny tonneicon' style='color: #657172;'></i>";
        }
        $count++;
    }

    if ($list != "") {
        echo "<ul>";
        echo $list;
        echo "</ul>";
        echo "<div class='clearfix' style='width: 100%; float: none; clear: both;'>";
        echo "</div>";
    } else {
        echo "<i class='ion ion-ios-trash tonneicon' style='color: #657172;'></i>";
        echo "<h3>Heute keine Leerung</h3>";
        echo "<div class='clearfix'></div>";
    }
}

?>
