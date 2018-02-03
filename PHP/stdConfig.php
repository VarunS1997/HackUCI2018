<?php
require __DIR__ . '/vendor/autoload.php';

if (!session_id()) {
    session_start();
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

?>
