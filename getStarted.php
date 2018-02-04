<?php require "PHP/stdConfig.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>About | Sanatree</title>

    <?php require "PHP/stdHeader.php"; ?>

    <style type="text/css">

    </style>
</head>
<body onload="initResponsive()" onresize="initResponsive()">
    <?php require_once "HTML/navbar.html"; ?>
    <div class="wrapper" id="body-wrapper">
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">Hello, Let's Begin</div>
                <a class="button" href="PHP/facebookLogin.php">Get Started With Facebook</a>
            </div>
        </div>
    </div>
    <?php require_once "PHP/footer.php"; ?>
</body>
</html>
