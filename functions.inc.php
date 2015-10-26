<?php
$db = new Datenbank();
$pr = new Prompt();

// CONF
include("inc/config.inc.php");
include('inc/lang.de.inc.php');

// Features
include('inc/termine.inc.php');
include('inc/wartung.inc.php');
include('inc/tonne.inc.php');
include('inc/spruch.inc.php');
include('inc/pflanzen.inc.php');
include('inc/tagesdaten.inc.php');
include('inc/statusblock.inc.php');


class Datenbank extends SQLite3
{
    function __construct()
    {
        // db
        $this->open('sqlitedb/db.sql');
    }
}

class Prompt
{
    function __construct()
    {
        $arr = array(
            'eins' => array(
                'subdata1',
                'subdata2'
            ),
            'zwei' => '12345',
            'drei' => 'ABCDEF',
        );
        $string = serialize($arr);
        // Prompter
        $this->writeFile($string);
        $this->readFile();
    }

    function readFile()
    {

        $str = file_get_contents('serialtest.txt');
        $arr = unserialize($str);
        return $arr;
    }

    function writeFile($string)
    {
        $fn = "serialtest.txt";
        $fh = fopen($fn, 'w');
        fwrite($fh, $string);
        fclose($fh);
    }
}



// print out the daily phrase
function printPhrase()
{
    $count = 0;
    $db = new Datenbank();
    $query = $db->query('SELECT * FROM sprueche'); // gepuffertes Abfrageergebnis
    $phrases = array();

    while ($row = $query->fetchArray()) {
        // Do Something with $row
        // print_r($row[0]);
        array_push($phrases, $row[1]);
        $count++;
    }

    // Some daily phrases

    // count them
    $phraseCount = count($phrases);
    // make random phrase nr
    $phrase = rand(0, $phraseCount - 1);
    // echo "Aktuell sind $phraseCount Phrasen vorhanden!<br>";
    echo $phrases[$phrase];
}



// Create Switches from DB schalter
function printSwitches($g)
{
    $group = $g;
    // count
    $count = 0;
    // db
    $db = new Datenbank();
    // query
    $query = $db->query('SELECT * FROM schalter WHERE gruppe = "'.$group.'"'); // gepuffertes Abfrageergebnis
    // DB vals
    $switches = array();
    $switchgrp = array();
    $switchval = array();
    $switchserial = array();
    $switchserialoff = array();

    // results
    while ($row = $query->fetchArray())
    {
        array_push($switches, $row[1]);
        array_push($switchgrp, $row[2]);
        array_push($switchval, $row[3]);
        array_push($switchserial, $row[4]);
        array_push($switchserialoff, $row[5]);

        $sw = "";
        $sw .= '<div class="col-sm-12 col-md-3">';
        $sw .= '<h6>'. $switches[$count].'</h6>';
        $sw .= '<input class="'.$switchgrp[$count].$count.'" type="checkbox" name="'.$switchgrp[$count].$count.'">';
        $sw .= '<br><div class="badge badge-serial">'.$switchserial[$count].'</div>';
        $sw .= '<div class="badge badge-serial">'.$switchserialoff[$count].'</div><br>';
        $sw .= '<div class="badge badge-value">'.$switchval[$count].'</div>';
        $sw .= '<div class="badge badge-bulb"><i class="ion ion-lightbulb"></i></div>';
        $sw .= '<div class="badge badge-bulb"><i class="ion ion-eye"></i></div>';
        $sw .= '<div class="badge badge-bulb"><i class="ion ion-key"></i></div>';
        $sw .= '<div><div class="led-red led-inline-left"></div>';
        $sw .= '<div class="led-yellow led-inline-left"></div>';
        $sw .= '<div class="led-green led-inline-left"></div>';
        $sw .= '<div class="led-blue led-inline-left"></div>';
        $sw .= '<div class="led-off led-inline-left"></div></div>';
        $sw .= '</div>';
        
        $scr = "<script>";
        // TODO: Create here the correct script
        $scr .= "";
        $scr .= "</script>";
        
        
        echo($sw);
        echo($scr);
        $count++;
    }
}



// create a Block
function makeBlock($t, $c, $i, $v)
{
    $title = $t;
    $class = $i;
    $value = $v;
    $columns = $c;

    $prefix = "<div class='col-" . $columns . "-" . $class . " col-md-" . $columns . " " . $i . "'>";
    $prefix .= "<div class='innerBlock block-" . $class . "'>";

    $postfix = "</div>";
    $postfix .= "</div>";

    $block = $prefix . $value . $postfix;
    print $block;
}



// create Light Triggers
function makeLightTriggers($c){
    $i = 1;
    $zonen = "";
    while($i <= $c)
    {
        $zonen .= '<div class="col-md-2">';
        $zonen .= '<h2><i class="ion ion-lightbulb"></i> '.$i .'</h2>';
        $zonen .= '<input type="checkbox" name="Licht'.$i.'">';
        $zonen .= '</div>';

        $i++;
    }

    echo $zonen;
}



// make a unordered List
function arrayToList($a, $c, $m, $cl)
{
    $arr = $a;
    $count = $c;
    $mode = $m;
    $class = $cl;
    $gal = "<ul class='".$class."'>";

    switch ($mode) {
        case 0:
            for ($i = 0; $i <= $count; $i++) {
                $gal .= "<li class='".$class."'>";
                $gal .= $arr[$i] .' --- '. $i;
                $gal .= "</li>";
            }
            break;
        case 1:
            for ($i = 0; $i <= $count; $i++) {
                $gal .= "<li class='".$class."'>";
                $gal .= "<div class='".$class."'>";
                $gal .= $arr[$i] .' --- '. $i;
                $gal .= "</div>";
                $gal .= "</li>";
            }
            break;
    }
    $gal .= "</ul>";
    return $gal;
}



// Date & Time
function showDate($t, $e)
{
    $timezone = $t;
    $emit = $e;

    // Die Standard-Zeitzone, die verwendet werden soll
    date_default_timezone_set($timezone);

    if ($emit) {
        $thismonth = date('M');
        $thisday = date('d');
        $daycircle = "";
        echo "<div class='button-months'>";
        // Zeige alle zwölf Monate
        for ($i = 1; $i < 13; $i++) {
            $class = "";

            if ($thismonth == date("M", mktime(0, 0, 0, $i, 1))) {
                $class = "active";
                $daycircle = "<div class='daycircle'>".$thisday."</div>";
            }
            else
            {
                $daycircle = "";
            }
            echo "<div class='col-xs-3 col-sm-2 col-md-1 button btn " . $class . "'>" . date("M", mktime(0, 0, 0, $i, 1)) . $daycircle . "</div>";
        }
        echo "</div><div class='clearfix'></div>";
    } else {
        echo "keine Zeitdaten gefunden";
    }
}



// show Date
function showDateClean($t, $e)
{
    $timezone = $t;
    $emit = $e;
    date_default_timezone_set($timezone);
    if ($emit) {
        // Gibt etwas aus wie: 'Monday 8th of August 2005 03:12:46 PM'
        return date('d.m.Y');
    } else {
        return "keine Zeitdaten gefunden";
    }
}



// show Day Number
function showDayNr($t, $e)
{
    $timezone = $t;
    $emit = $e;
    date_default_timezone_set($timezone);
    if ($emit) {
        // Gibt etwas aus wie: '23'
        return date('d');
    } else {
        return "keine Tage gefunden";
    }
}



// show Month Number
function showMonthNr($t, $e)
{
    $timezone = $t;
    $emit = $e;
    date_default_timezone_set($timezone);
    if ($emit) {
        // Gibt etwas aus wie: 'August'
        return date('m');
    } else {
        return "keinen Monat gefunden";
    }
}



// show Month Name
function showMonthname($t, $e)
{
    $timezone = $t;
    $emit = $e;
    date_default_timezone_set($timezone);
    if ($emit) {
        // Gibt etwas aus wie: 'August'
        return date('M');
    } else {
        return "keinen Monat gefunden";
    }
}



// show Year
function showYearNr($t, $e)
{
    $timezone = $t;
    $emit = $e;
    date_default_timezone_set($timezone);
    if ($emit) {
        // Gibt etwas aus wie: 'Monday 8th of August 2005 03:12:46 PM'
        return date('y');
    } else {
        return "keine Zeitdaten gefunden";
    }
}



// showYearName
function showYearName($t, $e)
{
    $timezone = $t;
    $emit = $e;
    date_default_timezone_set($timezone);
    if ($emit) {
        // Gibt etwas aus wie: 'Monday 8th of August 2005 03:12:46 PM'
        return date('Y');
    } else {
        return "keine Zeitdaten gefunden";
    }
}


// upload a File
function uploadFile($f, $m)
{
    // $fileName = basename($_FILES["fileToUpload"]["name"]);
    $fileName = $f;

    // Target dir
    if ($m == 1) {
        $target_dir = "uploads/";
    }
    elseif ($m == 2) {
        $target_dir = "uploads/images";
    }
    elseif ($m == 3) {
        $target_dir = "uploads/music";
    }
    elseif ($m == 4) {
        $target_dir = "uploads/movies";
    } else {
        $target_dir = "";
    }

    // Target = dir + filename
    $target_file = $target_dir . $fileName;

    // no error on init
    $uploadOk = 1;

    // fileType var
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // FILE CHECK
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        // Allow certain file formats
        if ($imageFileType != "jpg"
            && $imageFileType != "png"
            && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Erlaubt: JPG, JPEG, PNG & GIF";
            $uploadOk = 0;
        }
    }

    // Check if $uploadOk is set to 0 by an error

    // if error
    if ($uploadOk == 0) {
        echo "die Datei wurde nicht hochgeladen";
    } // if no error
    else {
        // move ok
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } // move error
        else {
            echo "Sorry, es gab einen Fehler beim Upload";
        }
    }
}



