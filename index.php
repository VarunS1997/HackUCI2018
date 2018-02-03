<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sanatree</title>

    <?php require "PHP/stdConfig.php"; ?>

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
                <li><a href="./">SanaTree</a></li>
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
            <a class="button" href="#start">Get Started Now!</a>
        </div>
    </div>
    <div class="wrapper" id="body-wrapper">
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">What is Wushu?</div>
                <p>
                    Wushu (武术), as practiced at UCI, is a non-contact, chinese martial arts, emphasizing on coordination and performance. Wushu, meaning "martial arts", represents a collection of all chinese martial arts, but often, the term is used to refer to the the more-modern styles of it's traditional counterpart, Kung Fu.
                </p>
            </div>
            <p>
                <a href="about.php">Learn more...</a>
            </p>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection imaged-subsection">
                <div class="title">Practice Times</div>
                <p class="bold">
                    Practices welcome all wushu athletes, new and old, and are held three times a week at UCI's ARC facility:
                </p>
                <p>
                    Monday: 9:00 PM - 11:00 PM in the Physical Forum
                </p>
                <p>
                    Wednesday: 8:30 PM - 10:30 PM in the Training Zone
                </p>
                <p>
                    Saturday: 12:00 PM - 2:30 PM in the Sports Studio
                </p>
                <p>
                    If you are interested in trying Wushu at UCI, stop by at any one of the practices. Your first class is absolutely free-to-try, and all you need is something comfortable to work out in, and a friendly attitude.
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection imaged-subsection">

            </div>
        </div>
    </div>
    <?php require_once "PHP/footer.php"; ?>
</body>
</html>
