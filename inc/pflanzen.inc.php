<?php
/**
 * Created by PhpStorm.
 * Plant: rosk
 * Date: 24.07.15
 * Time: 21:04
 */

// Plant Class
class Plant {
    public $namekurz = "";
    public $namelang  = "";
    public $eingepflanzt = "";
    public $id = "";
}

// Pflanzen Methoden

// neue Pflanze in mysqlite db
function insertPflanze($namekurz, $namelang, $standort, $giessen, $frostsicher, $saatmonat, $erntemonat, $wikipedia)
{
    $db = new Datenbank();
    $p1 = $namekurz;
    $p2 = $namelang;
    $p3 = $standort;
    $p4 = $giessen;
    $p5 = $frostsicher;
    $p6 = $saatmonat;
    $p7 = $erntemonat;
    $p8 = $wikipedia;
    $db->exec("INSERT INTO pflanzen (namekurz, namelang, standort, giessen, frostsicher, saatmonat, erntemonat, wikipedia)
               VALUES ('" . $p1 . "','" . $p2 . "','" . $p3 . "','" . $p4 . "','" . $p5 . "','" . $p6 . "','" . $p7 . "','" . $p8 . "')");
}

// Pflanze löschen
function deletePflanze($id)
{
    $db = new Datenbank();
    $s = $id;
    $db->query('DELETE FROM pflanzen WHERE id="' . $s . '"');
}

// Pflanzenliste ausgeben
function printPflanzeListe($f)
{
    $count = 0;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM pflanzen ORDER BY namekurz, namelang ASC'); // gepuffertes Abfrageergebnis
    $list = "";

    if ($f == "lang") {
        echo "<h5>Alle Pflanzen in Langform</h5>";
        while ($row = $query->fetchArray()) {
            // Do Something with $row
            // print_r($row[0]);
            $list .= "<li class='pflanze'>
            <b>ID:" . $row[0] . "</b>
            <h5>" . $row[1] . "</h5>
            <p>" . $row[2] . "</p>
            <h6><b>Ort:</b> \t\t" . $row[3] . "</h6>
            <h6><b>Giessen:</b> \t" . $row[4] . "</h6>
            <h6><b>Frostsicher:</b> \t\t" . $row[5] . "</h6>
            <h6><b>Saatmonat:</b>\t" . $row[6] . "</h6>
            <h6><b>Erntemonat:</b>\t" . $row[7] . "</h6>
            <h6><a target='_blank' class='' href='" . $row[8] . "'>Wikipedia</a></h6>
            <a class='btn btn-default' alt='Text" . $row[0] . "' href='?del3=" . $row[0] . "'>Löschen</a>
            </li>";
            $count++;
        }
    }
    if ($f == "mikro") {
        echo "<h5>Alle Pflanzen in Miniform</h5>";
        while ($row = $query->fetchArray()) {
            $list .= "<li class='pflanze-mikro'>
            <h5>" . $row[1] . "</h5>
            <!-- <p>" . $row[2] . "</p>" . ArrayToList($row,sizeof($row),0,"pflanzen") . " -->

            </li>";
            $count++;
        }
    }
    if(!$f) {
        echo "<h5>Alle Pflanzen in Kurzform</h5>";
        while ($row = $query->fetchArray()) {
            // Do Something with $row
            // print_r($row[0]);
            $list .= "<li class='pflanze-mini'>
            <h5>" . $row[1] . "</h5>
            <p>" . $row[2] . "</p>
            <h6><a target='_blank' class='' href='" . $row[8] . "'>Wikipedia</a></h6>
            </li>";
            $count++;
        }
    }


    echo "<ul>";
    echo $list;
    echo "</ul>";
    echo "<div class='clearfix result-row' style='width: 100%; float: none; clear: both;'>";
    echo "<div class='badge' style=''>";
    echo $count . " Pflanzen";
    echo "</div>";
    echo "</div>";
}


function printPflanzeTable(){
    $table = '<h3>Pflanzen in der Datenbank</h3>';
    $table .= '<table id="table" data-url="sqlitedb/data1.json"></table>';
    plants2Json();
    print $table;
}

function plants2Json(){
    $count = 0;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM pflanzen ORDER BY namekurz, namelang ASC'); // gepuffertes Abfrageergebnis
    $json = "";

    while ($row = $query->fetchArray())
    {
        $json[]=$row;
        $count++;
    }
    $handle = fopen("sqlitedb/data1.json", "w+");
    fwrite($handle, json_encode($json));
    fclose($handle);

    return json_encode($json);
}