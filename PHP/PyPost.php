<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $jsonData = file_get_contents('php://input');

    $tempAdd = "TEMP/IMPORT_DATA.json";
    $tempFile = fopen($tempAdd, "w+");
    fwrite($tempFile, $jsonData);
    fclose($tempFile);

    $pyOut = passthru("python pyScripts/Json_to_Sql.py " . $start_word . " " . $end_word);
}
?>
