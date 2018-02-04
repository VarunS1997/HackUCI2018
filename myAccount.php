<?php
require "PHP/stdConfig.php";
// check for login
if($FBError || (isset($_GET["error"]) and $_GET["error"] == "access_denied")){
    header("Location: getStarted.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact | Sanatree</title>

    <?php require "PHP/stdHeader.php"; ?>

    <style type="text/css">

    </style>
</head>
<body onload="initResponsive()" onresize="initResponsive()">
    <?php require_once "HTML/navbar.html"; ?>
    <div class="wrapper" id="body-wrapper">
        <div class="subsection-wrapper wrapper">
            <div class="title">
                Welcome<?php if(isset($fName)){
                    echo ", " . $fName;
                } ?>
            </div>
            <div class="subsection">
                <?php
                if(isset($fName)){
                    echo "FIRST NAME: " . $fName . "<br />";
                }
                if(isset($lName)){
                    echo "LAST NAME: " . $lName . "<br />";
                }
                if(isset($DOB)){
                    echo "DOB: " . $DOB . "<br />";
                }
                if(isset($fbID)){
                    echo "FB ID: " . $fbID . "<br />";
                }
                 ?>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="title">
                Log Out
            </div>
            <div class="subsection">
                <a class="button" href="PHP/facebookLogout.php">Log Out</a>
            </div>
        </div>
    </div>
    <?php require_once "PHP/footer.php"; ?>
</body>
</html>
