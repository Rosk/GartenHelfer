<?php
/**
 * Asynchrone Datenverarbeitung PHP <-> Arduino
 * Diese Seite wird mit Ajax über jQuery parametrisiert aufgerufen.
 * Die verabeiteten Daten werden zurückgegeben,
 * und von der jQuery Methode auf dem Server verarbeitet.
 *
 * Befehle, die an das Arduino gesendet werden können:
 * An
 * Aus
 * DisplayTermine
 * DisplayBrunnen
 * DisplayGarten
 */

// Fehler ausgeben
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Funktionen inkludieren
include('functions.inc.php');

// Wenn ein Befehl über die POST var "cmd" eingeht
if (isset($_POST["cmd"]))
{
    $cmd = $_POST["cmd"];
    $port = $_POST["port"];

    /** Der switch sendet die Daten zum Arduino. Es können belibeig lange Steuerbefehle gesendet werden. */
    switch ($cmd) {
        case "BOOT":
            $fp = fopen($comPort, "w+");
            if($fp){
                echo "OK - Arduino gefunden";
                fclose($fp);
            }
            else{
                echo "Error";
            }
            break;
        case "An":
            $fp = fopen($comPort, "w+");
            sleep(2);
            fwrite($fp, "0"); /* das wird gesendet */
            fclose($fp);
            echo "OK - An";
            break;
        case "Aus":
            $fp = fopen($comPort, "w+");
            sleep(2);
            fwrite($fp, "1"); /* das wird gesendet */
            fclose($fp);
            echo $de["ok"]." - Aus";
            break;
        case "Licht":
            $fp = fopen($comPort, "w+");
            sleep(2);
            fwrite($fp, "L".$port); /* das wird gesendet */
            fclose($fp);
            echo $de["ok"]." - Licht ".$port;
            break;

        // Display Befehle
        case "DisplayTermine":
            $fp = fopen($comPort, "w+");
            sleep(2);
            fwrite($fp, "X"); /* das wird gesendet */
            fclose($fp);
            echo $de["ok"]." - Display Termine";
            break;
        case "DisplayBrunnen":
            $fp = fopen($comPort, "w+");
            sleep(2);
            fwrite($fp, "A"); /* das wird gesendet */
            fclose($fp);
            echo $de["ok"]." - Display Brunnen";
            break;
        case "DisplayGarten":
            $fp = fopen($comPort, "w+");
            sleep(2);
            fwrite($fp, "B"); /* das wird gesendet */
            fclose($fp);
            echo $de["ok"]." - Display Garten";
            break;
        case "Read":
            $fp = fopen($comPort, "r+");
            sleep(1);
            $ser = fread($fp,3); /* das wird gelesen */
            fclose($fp);
            echo $ser;
            break;
        default:
            die('Es gab einen Fehler. Der gesendete Befehl ist nicht vorhanden und wurde nicht gesendet.');
    }
}