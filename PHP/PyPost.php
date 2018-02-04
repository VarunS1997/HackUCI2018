<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $jsonData = file_get_contents('php://input');

    $tempAdd = "../TEMP/IMPORT_DATA.json";
    $tempFile = fopen($tempAdd, "r+");
    fwrite($tempFile, $jsonData);
    fclose($tempFile);
} else{
    $tempAdd = "../TEMP/IMPORT_DATA.json";
}


$cmd = ("python3 ../pyScripts/JSON2SQL.py " . $tempAdd . " 2>&1");

$pyOut = shell_exec($cmd);
echo "CMD: " . $cmd . "<br/>";
echo "OUT NULL: " . (is_null($pyOut) ? "YES" : "NO") . "<br/>";
echo $pyOut;
?>
