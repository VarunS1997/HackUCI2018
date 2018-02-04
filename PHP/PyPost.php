<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $jsonData = file_get_contents('php://input');

    $tempAdd = "../TEMP/IMPORT_DATA.json";
    $tempFile = fopen($tempAdd, "w+");
    fwrite($tempFile, $jsonData);
    fclose($tempFile);
} else{
    $tempAdd = "../TEMP/IMPORT_DATA.json";
}


$cmd = "python ../pyScripts/JSON2SQL.py " . $tempAdd;

$pyOut = shell_exec(escapeshellcmd($cmd));
echo $cmd;
echo $pyOut;
?>
