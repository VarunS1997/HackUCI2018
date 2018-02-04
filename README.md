
##__Inspiration__
People always talk about how much data Facebook collects and people always complain about how late their doctors always are. And we thought we can fix that. We also tackled the problem of unidentified Jane and John Does with facial recognition and using Facebook to determine any close friends or family members that were in close proximity with the patient to see if there are any conditions that the family has or who may have come in contact with an infectious from the patient.

##__What It Does__
Our current prototype simulates the data that a doctor would send to our database, simulates the simple yet intuitive front end that our users would experience, incorporating some of Facebook's APIs to gain information from the patients profile, and also incorporating a working facial recognition. Taking all of these aspects our program simulates the network that would happen if we were to implement our program in the real world. 

##__How We Built It__
We decided to use an SQL database to store the users and doctors data. To simulate the database receiving data from the doctors, we created a script in Python and sent post requests to the database server and sending a JSON file in the process. In receiving the JSON file we again used Python to update our database with the data. On the facial recognition side, we used OpenCV and implemented a machine learning to train our program to detect faces and match them to the profile pictures of people. On the front-end side, we have Php running the web development and also incorporates the Facebook API to gain the user data from Facebook.

##__Challenges We Ran Into__
Implementing the facial recognition would be one of our bigger challenges as we had to train it to be able to recognize and identify people. We then mostly had a lot of problem with server configurations as we were trying to use the .tech domain but had issues with DNS but eventually got it to work with the domain. We also had trouble configuring the server as we did not know that Python 3.2.3 was already installed and could've been used by calling python3 for a script. Also, the use of Php to run the Python script made things a lot harder to debug as there were no console and error messages did not show up. Overall we feel that despite the challenges we had we did the best we could to implement the idea we had imagined.

##__Accomplishments__
Each individual member of the team has accomplished something that was given out of their comfort zone of development. One of our members was able to implement a machine learning algorithm for the first time outside of class. Another learned SQL commands and worked with the SQLdt library in Python to send queries to the database. For two of our members, it was their first time attending a Hackathon, including a freshman. Also, working with the server we rented was also an accomplishment on its own because of the lack of support we had with it from the company we rented it from.

##__What We Learned__
For some of us, as it was their first Hackathon, they have learned first hand how to develop with multiple people working on different aspects of the program, such as the back-end and front-end. We found that the project could become very unorganized and that there were many miscommunications that happen when we don't discuss the program thoroughly. We learned that having models helped visualize the structure we were trying to build with the program.
