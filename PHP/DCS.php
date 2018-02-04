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

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $queueSource = "../TEMP/DCSQueue.txt";

    $queueFile = fopen($queueSource, "r");

    $firstLine = NULL;
    $newData = "";

    while($content = fgets($queueFile)){
        if(is_null($firstLine)){
            $firstLine = $content;
        } else{
            $newData = $newData . $content;
        }
    }

    fclose($queueFile);

    if(is_null($firstLine)){
        echo "NULL";
    } else{
        echo $firstLine;

        $resultsFile = fopen("../TEMP/cDCSRequests.txt", "a");
        fwrite($resultsFile, $firstLine);
        fclose($resultsFile);

        $queueFile = fopen($queueSource, "w");
        fwrite($queueFile, $newData);
        fclose($queueFile);

    }
}
 ?>
