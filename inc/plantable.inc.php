<?php
header('Content-type: application/json');

include("../functions.inc.php");

$db = new Datenbank();
$query = $db->query('SELECT * FROM pflanzen ORDER BY namekurz, namelang ASC'); // gepuffertes Abfrageergebnis
$json = "";

while ($row = $query->fetchArray())
{
    $json[]=$row;
}
$handle = fopen("../pflanzen.json", "w+");
fwrite($handle, json_encode($json));
fclose($handle);
return json_encode($json);
?>