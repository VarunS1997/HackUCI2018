<?php
function loadSQL(){
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
        $server = "localhost";
        $username = "root";
        $password = "";
        $db = "sanatree_userdb";

        $conn = new mysqli($server, $username, $password, $db);
    } catch (mysqli_sql_exception $e){
        try{
            $server = "localhost";
            $username = "sanatree_hackuci";
            $password = "H@ckUC!2018";
            $db = "sanatree_userDB";

            $conn = new mysqli($server, $username, $password, $db);
        } catch (mysqli_sql_exception $e){
            throw new Exception("Service unavailable. Authentication failed. Aborted processes.... " . $e->getMessage());
        }
    }

    return $conn;
}

if(isset($_GET["id"])){
    $data = htmlspecialchars($_GET["id"]);

    $resultsFile = fopen("../TEMP/cDCSRequests.txt", "a");
    fwrite($resultsFile, " --- " . $data . PHP_EOL);
    fclose($resultsFile);

    echo "DONE: " . $data;
}
 ?>
