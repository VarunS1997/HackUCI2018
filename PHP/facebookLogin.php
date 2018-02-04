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

$permissions = ['email', "user_birthday"]; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://sanatree.tech/myAccount.php', $permissions);

header("Location: ".$loginUrl)

?>
