<?php require "PHP/stdConfig.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sanatree</title>

    <?php require "PHP/stdHeader.php"; ?>

    <link rel="stylesheet" type="text/css" href="CSS/homeStyles.css" />
</head>
<body>
    <div id="page-header-wrapper" class="wrapper">
        <div class="sanatree-logo-container">
            <a href="./">
                <img class="sanatree-logo" src="imageAssets/branding/sanatree-logo.svg" alt="Sanatree" />
            </a>
        </div>
        <div id="navigation-bar-container">
            <ul id="navigation-bar">
                <li><a href="myAccount.php">Get Started</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="wrapper" id="splash-wrapper">
        <div class="wrapper" id="splash-content">
            <div class="title">
                Live | Connect | <span class="colored">Thrive</span>
            </div>
            SanaTree leads the way in social analytics that help you live a safer, healthier, more-connected life. With leading analysis techniques, we provide your doctor with anything and everything they need to make sure YOU get the best care you can.<br />
            <a class="button" href="myAccount.php">Get Started Now!</a>
        </div>
    </div>
    <div class="wrapper" id="body-wrapper" style="padding-top:0px">
        <div class="subsection-wrapper wrapper blueBackgrounded">
            <div class="subsection extra-padding">
                <div class="title">What is SanaTree?</div>
                <p class="larger">
                    SanaTree is an invaluable tool for keeping up-to-date and comprehensive medical histories, all through platforms you already use.
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">Why Do We Need This?</div>
            </div>
            <div class="subsection imaged-subsection extra-padding">
                <img src="imageAssets/medical.svg" alt="" />
                <div class="img-text">
                    <p class="bold">
                        SanaTree has a mission to not only improve medical efficiency, but also raise the bar for healthcare everywhere.
                    </p>
                    <p>
                        Imagine if, before you even met, your doctor already knew your familial history of diseases, allergies, and other conditions.
                    </p>
                    <p>
                        Now imagine if EVERY doctor you met knew all this information and you only needed to press 2 buttons.
                    </p>
                    <p>
                        Now imagine how much better your doctors can be. That's our mission.
                    </p>
                </div>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection extra-padding">
                <div class="img-text">
                    <p class="bold">
                        We only hope to improve the quality of your preventative measures, treatments, and diagnoses.
                    </p>
                    <p>
                        With this comprehensive tracking system, your doctors can plan ahead in a way previously restricted to geneticists, but for a fraction of the cost.
                    </p>
                    <p>
                        And of course, SanaTree would also save countless minutes, for both you and your doctor. And in medicine, every minute counts.
                    </p>
                </div>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection imaged-subsection extra-padding">
                <div class="img-text">
                    <p class="bold">
                        Here, at SanaTree, we treat your data as we treat you -- with the utmost respect and discretion.
                    </p>
                    <p>
                        Using the latest in secure communications, all of our webpages support secure (HTTPS) connections.
                    </p>
                    <p>
                        We are extremely transparent with how we use your data. You can read all about it in our <a href="privacypolicy.htm">Privacy Policy</a>.
                    </p>
                    <p>
                        We believe in our measures so much, that we will wipe any and all of your data from our servers whenever you want, just let us know.
                    </p>
                </div>
                <img src="imageAssets/lock.svg" alt="" />
            </div>
        </div>
    </div>
    <?php require_once "PHP/footer.php"; ?>
</body>
</html>
