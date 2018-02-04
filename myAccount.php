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
    <title>Account | Sanatree</title>

    <?php require "PHP/stdHeader.php"; ?>

    <style type="text/css">

    </style>
</head>
<body onload="initResponsive()" onresize="initResponsive()">
    <?php require_once "PHP/navbar.php"; ?>
    <div class="wrapper" id="body-wrapper">
        <div class="subsection-wrapper wrapper">
            <div class="title">
                Welcome<?php if(isset($_SESSION["FIRST_NAME"])){
                    echo ", " . $_SESSION["FIRST_NAME"];
                } ?>
            </div>
            <div class="subsection">
                <?php
                if(isset($_SESSION["FIRST_NAME"])){
                    echo "<p>FIRST NAME: " . $_SESSION["FIRST_NAME"] . "</p>";
                }
                if(isset($_SESSION["LAST_NAME"])){
                    echo "<p>LAST NAME: " . $_SESSION["LAST_NAME"] . "</p>";
                }
                if(isset($_SESSION["DOB"])){
                    echo "<p>DOB: " . $_SESSION["DOB"] . "</p>";
                }
                if(isset($_SESSION["FACEBOOK_ID"])){
                    echo "<p>FB ID: " . $_SESSION["FACEBOOK_ID"] . "</p>";
                }
                if(isset($_SESSION["FB_FRIENDS"])){
                    echo "<p>-- FB FRIENDS --<br/>";

                    foreach($_SESSION["FB_FRIENDS"] as $friend){
                        echo "Name: " . $friend["name"] . "<br />";
                    }

                    echo "</p>";
                }
                 ?>
            </div>
            <div class="subsection">
                <?php
                if(isset($_SESSION["IN_DB"]) && $_SESSION["IN_DB"] && isset($_SESSION["FACEBOOK_ID"])){

                    $conn = loadSQL();
                    $histTable = "Histories";

                    $uDate = NULL;
                    $uDescrip = NULL;

                    $SearchSQL = $conn->prepare("SELECT DATE, DESCRIPTION FROM $histTable WHERE USER_ID=?");

                    if($SearchSQL != false){
                        $SearchSQL->bind_param("s", $_SESSION["FACEBOOK_ID"]);
                        $SearchSQL->execute();
                        $SearchSQL->bind_result($uDate, $uDescrip);

                        echo "<p>-- MEDICAL RECORDS --<br/>";

                        while($SearchSQL->fetch()){
                            echo "$uDate: " . $uDescrip . "<br />";
                        }

                        echo "</p>";
                    }
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
