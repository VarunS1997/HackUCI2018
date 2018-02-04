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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = file_get_contents('php://input');

    if($postData == "H@ckUC!2018"){
            $conn = loadSQL();
            $results = $conn->query("SELECT USER_ID FROM Users");

            if ($results->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo $row["USER_ID"] . PHP_EOL;
                }
            }
    }
}
 ?>
