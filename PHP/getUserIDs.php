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

$conn = loadSQL();
$results = $conn->query("SELECT USER_ID FROM Users");

if(is_null($results)){
    echo mysqli_error($conn);
} elseif ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        echo $row["USER_ID"] . PHP_EOL;
    }
}
 ?>
