<?php
$cmd = ("python3 ../pyScripts/FaceRecognition.py " . $tempAdd . " 2>&1");

$pyOut = shell_exec($cmd);
echo "CMD: " . $cmd . "<br/>";
echo "OUT NULL: " . (is_null($pyOut) ? "YES" : "NO") . "<br/>";
echo $pyOut;
?>
