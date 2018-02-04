<div id="page-header-wrapper" class="wrapper backgrounded">
    <div class="UCIW-logo-container">
        <a href="./">
            <img class="sanatree-logo" src="imageAssets/branding/sanatree-logo.svg" alt="SanaTree" />
        </a>
    </div>
    <div id="navigation-bar-container">
        <ul id="navigation-bar">
            <li><a href="myAccount.php"><?php echo isset($_SESSION["FIRST_NAME"]) ? "Your Account" : "Get Started"; ?></a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>
</div>
