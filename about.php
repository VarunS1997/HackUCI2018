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
                <div class="title">Inspiration</div>
                <p>
                    People always talk about how much data Facebook collects and people always complain about how late their doctors always are. And we thought we can fix that. Moreover, we thought we could use the overlap between these areas to yield useful information and improve processes already in place. We were right.
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">What It Does</div>
                <p>
                    Our current prototype simulates the data that a doctor would send to our database, simulates the simple yet intuitive front end that our users would experience, incorporating some of Facebook's APIs to gain information from the patients profile, and also incorporating a working facial recognition.
                </p>
                <p>
                    All in all, a user would be able to log into our website through Facebook's APIs. Thus, our project will use the provided user data to construct a family tree and train a computer vision machine learner to identify the individual. Meanwhile, our extremely lightweight "doctor side" is built to seamlessly integrate with systems already in place to allow us to update patient histories in our systems, thereby enabling us to also warn along the relevant social relationships (in the event of a contagious or genetic diagnosis by a doctor).
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">How We Built It</div>
                <p>
                    Fundamentally, our program relies on the integration of several languages around a centralized MySQL database.
                </p>
                <p>
                    Meanwhile, a lightweight python script deploys the "doctor side" of our program by accepting updates to patient histories in the form of the commonly-supported format of JSON. In receiving the JSON file we again used Python to update our database with the data. On the facial recognition side, we used OpenCV and implemented a machine learning to train our program to detect faces and match them to the profile pictures of people
                </p>
                <p>
                    Lastly, the server-side processing is entirely handled by a PHP-based solution.
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">Challenges We Ran Into</div>
                <p>
                    Some of our greatest challenges included the facial recognition algorithm, server set-up, and communication protocols.
                </p><p>
                    In regards to server set-up, once we obtained the .tech domain, we faced significant challenges in properly pointing the namespace servers to the appropriate hosting service. Furthermore, once the servers were indeed pointing correctly, we faced additional issues with SSL. Typically, the SSL certificate could not be validated due to domain name mismatches. Still, this, too was overcome. Last, but certainly not least, we also had to work within the parameters of our host. In other words, our code had to be designed within a development environment that we did not have full control of. In fact, we had to accommodate Python 3.2 and distributed computing methods, when our original design had no such portions.
                </p><p>
                    Finally, in the design of such a complex system, we had to implement our own communication processes to optimize server loads with user demands. Moreover, these sort of communications became necessary to perform the full functionality of this website. For security reasons, the full details will not be discussed.
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">Accomplishments</div>
                <p>
                    Each individual member of the team has accomplished something that was given out of their comfort zone of development. One of our members was able to implement a machine learning algorithm for the first time outside of class. Another learned SQL commands and worked with the SQLdt library in Python to send queries to the database. For two of our members, it was their first time attending a Hackathon, including a freshman.
                </p>
            </div>
        </div>
        <div class="subsection-wrapper wrapper">
            <div class="subsection">
                <div class="title">What We Learned</div>
                <p>
                    For some of us, as it was their first Hackathon, they have learned first hand how to develop with multiple people working on different aspects of the program, such as the back-end and front-end. We found that the project could become very unorganized and that there were many miscommunications that happen when we don't discuss the program thoroughly. We learned that having models helped visualize the structure we were trying to build with the program.
                </p>
            </div>
        </div>
    </div>
    <?php require_once "PHP/footer.php"; ?>
</body>
</html>
