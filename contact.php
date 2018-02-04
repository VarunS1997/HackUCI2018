<?php require "PHP/stdConfig.php"; ?>
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
            <div class="subsection">
                <div class="title">Looking for Us?</div>
                <p>
                    You can send all email inquiries to <a href="mailto:support@sanatree.tech">support@sanatree.tech</a> while we grow our sapling below.
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">Coming Soon: An Embeded Email Form</div>
                <p>
                    Our developers are hard at work to bring a better, more-seamless method of communication to the site. It will be placed right here on this page when we are done. For now, though, it's just a small sapling.
                </p>
                <img src="imageAssets/sapling.png" alt="A Small Sapling"/>
            </div>
        </div>
    </div>
    <?php require_once "PHP/footer.php"; ?>
</body>
</html>
