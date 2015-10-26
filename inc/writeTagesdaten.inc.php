<?php
// Includes
include("../functions.inc.php");
/**
 * Created by PhpStorm.
 * User: rosk
 * Date: 05.08.15
 * Time: 09:46
 */

$today = showDateClean('UTC', 'now');
$grd = $_GET["grad"];

// Tagesdaten nur dann schreiben, falls es noch keine gibt...
if (hasTagesdaten($today) == false)
{
echo "Already Measured...";
}

writeTagesdaten($today, "22.45", $grd, 45, showYearName('UTC', 'now'), showMonthNr('UTC', 'now'));

