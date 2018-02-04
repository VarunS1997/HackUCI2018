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
    $queueSource = "../TEMP/DCTQueue.txt";

    $queueFile = fopen($queueSource, "r+");

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
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = file_get_contents('php://input');
    $postPieces = explode(":::::", $postData);

    $MLC = $postPieces[0];
    $UIc = $postPieces[count($postPieces)-1];

    $conn = loadSQL();

    $updateSQL = $conn->prepare("UPDATE Users SET MLC=? WHERE USER_ID=?");

    if($updateSQL != false){
        $updateSQL->bind_param("ss", $MLC, $UId);
        $updateSQL->execute();
    }
}
 ?>
