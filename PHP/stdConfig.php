<?php
require __DIR__ . '/vendor/autoload.php';

if (!session_id()) {
    session_start();
}

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

 // FACEBOOK
$APP_ID = '215405775691641';
$APP_SECRET = '57f4a9a49a23094846505ff5ef84eb47';
$APP_V = 'v2.5';

$fb = new Facebook\Facebook([
  'app_id' => $APP_ID, // Replace {app-id} with your app id
  'app_secret' => $APP_SECRET,
  'default_graph_version' => $APP_V,
]);

$helper = $fb->getRedirectLoginHelper();

$FBError = true;
if(!isset($_SESSION["FB_ACCESS_TOKEN"]) or !isset($_SESSION["FB_TOKEN_META"])){
    try {
        $accessToken = $helper->getAccessToken();

        if(isset($accessToken)){
            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();

            // Get the access token metadata from /debug_token
            $tokenMetadata = $oAuth2Client->debugToken($accessToken);

            $tokenMetadata->validateAppId($APP_ID);
            $tokenMetadata->validateExpiration();

            if (! $accessToken->isLongLived()) {
                // Exchanges a short-lived access token for a long-lived one
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            }

            $_SESSION['FB_ACCESS_TOKEN'] = $accessToken;
            $_SESSION["FB_TOKEN_META"] = $tokenMetadata;
            $FBError = false;
        }
    } catch(Exception $e) {
        $FBError = true;
    }
} else{
    try{
        $_SESSION["FB_TOKEN_META"]->validateExpiration();
        $FBError = false;
    } catch(Facebook\Exceptions\FacebookSDKException $e){
        $FBError = true;
    }
}

// MySQL
if(!$FBError and isset($_SESSION["FB_ACCESS_TOKEN"]) and !(isset($_SESSION["IN_DB"]) and $_SESSION["IN_DB"])){
    // MySQL
    $conn = loadSQL();

    $usersTable = "Users";
    $histTable = "Histories";

    $SearchSQL = $conn->prepare("SELECT * FROM $usersTable WHERE FIRST_NAME=? AND LAST_NAME=? AND DOB=?");
    $InsertSQL = $conn->prepare("INSERT INTO $usersTable (FIRST_NAME, LAST_NAME, DOB, START_DATE, USER_ID, ADDRESS, ACCESS_TOKEN) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if($SearchSQL != false && $InsertSQL != false){
        try {
          // Returns a `Facebook\FacebookResponse` object
          $token = $_SESSION["FB_ACCESS_TOKEN"]->getValue();
          $response = $fb->get('/me?fields=id,name, birthday, friends', $token);

          $user = $response->getGraphUser();

          $name = explode(" ", $user["name"]);

          $fName = $name[0];
          $lName = $name[count($name)-1];
          $DOB = (is_null($user["birthday"])) ? "NULL" : $user["birthday"]->format("m/d/Y");
          $fbID = $user["id"];
          $address = "Irvine, CA";


          $SearchSQL->bind_param("sss", $fName, $lName, $DOB);
          $SearchSQL->execute();
          $SearchSQL->store_result();

          if($SearchSQL->num_rows() == 0){
              $date = date("m/d/Y");
              $InsertSQL->bind_param("sssssss", $fName, $lName, $DOB, $date,$fbID, $address, $token);
              $InsertSQL->execute();
          }

          $_SESSION["FIRST_NAME"] = $fName;
          $_SESSION["LAST_NAME"] = $lName;
          $_SESSION["DOB"] = $DOB;
          $_SESSION["FACEBOOK_ID"] = $fbID;
          $_SESSION["ADDRESS"] = $address;

          $_SESSION["FB_FRIENDS"] = $user["friends"];

          $_SESSION["IN_DB"] = true;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {

        } catch(Facebook\Exceptions\FacebookResponseException $e){

        }
    } else{
        $conn->close();
        throw new Exception("Prepared Statement could not be made... ");
    }
}

?>
