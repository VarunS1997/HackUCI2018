<?php require "PHP/stdConfig.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload | Sanatree</title>

    <?php require "PHP/stdHeader.php"; ?>
    <?php
    $tempDir = "TEMP/";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $check = getimagesize($_FILES["analysisImage"]["tmp_name"]);
        $randNum = mt_rand();

        if($check !== false) {
            $target_file = $tempDir . $randNum . "_" . $_FILES["analysisImage"]["tmp_name"];

            move_uploaded_file($_FILES["analysisImage"]["tmp_name"], $target_file);

            $queueSource = "../TEMP/DCSQueue.txt";
            $queueFile = fopen($queueSource, "a");

            fwrite($queueFile, $target_file . PHP_EOL);

            fclose($queueFile);
        }
    }
    ?>

    <style type="text/css">

    </style>
</head>
<body onload="initResponsive()" onresize="initResponsive()">
    <?php require_once "PHP/navbar.php"; ?>
    <div class="wrapper" id="body-wrapper">
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">Analyzed Requests</div>
                <p>
                    Please go easy on our developers, this page is still being worked on.
                </p>
                <form method="POST" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' id="fileForm">
                    <p>
                        Upload New Task<br/>
                        <input type="file" name="analysisImage" id="analysisImage"/><br />
                        <input type="submit" value="Upload" name="submit">
                    </p>
                </form>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <?php
                $resultsFile = fopen("TEMP/cDCSRequests.txt", "r");
                while($data = fgets($resultsFile)){
                    echo "<p>$data</p>";
                }
                fclose($resultsFile);
                ?>
            </div>
        </div>
    </div>
    <?php require_once "PHP/footer.php"; ?>
</body>
</html>
