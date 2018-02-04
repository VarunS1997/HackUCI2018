#!/usr/bin/env python
import MySQLdb
import json
import datetime
import sys

class DataInput:
	lookUpUserCommand = '''SELECT * FROM `Users` WHERE `FIRST_NAME` LIKE '{}' AND `LAST_NAME` LIKE '{}' AND `DOB` LIKE '{}' AND `ADDRESS` LIKE '{}' '''
	insertUserCommand = '''INSERT INTO `Users` (`FIRST_NAME`, `LAST_NAME`,`USER_ID`, `DOB`, `ADDRESS`,`START_DATE`) VALUES ('{}', '{}', '{}', '{}', '{}', '{}')'''
	insertHistoryCommand = '''INSERT INTO `Histories` (`USER_ID`, `DATE`, `DESCRIPTION`) VALUES ('{}', '{}', '{}')'''
	lookUpHistoryCommand = '''SELECT * FROM `Histories` WHERE `USER_ID` LIKE '{}' '''

	def __init__(self, hst = "localhost", user= "sanatree_hackuci", passwd= "H@ckUC!2018", datab = "sanatree_userDB"):
		self.db = MySQLdb.connect(host = hst, user= user, passwd= passwd, db = datab)
		self.cursor = self.db.cursor()

	def getUser(self,fName, lName, dob, address):
		self.cursor.execute(self.lookUpUserCommand.format(fName,lName,dob,address))
		return self.cursor.fetchone()

	def getID(self,fName, lName, dob, address):
		user = self.getUser(fName, lName, dob, address)
		if(user != None):
			return user[2]
		else:
			return None

	def addHistory(self,ID, date, history):
		self.cursor.execute(self.insertHistoryCommand.format(ID,date,history))
		self.db.commit()

printStmnts = []

jFile = open(sys.argv[1], 'r')
data = json.load(jFile)

logFile = open("../LOGS/log.txt", "w")

up = DataInput()

printStmnts.append("Init Complete")

for each in data['append']:
	ID = up.getID(each['fName'], each['lName'], each['DOB'], each['Address'])
	if ID == None:
		v = each["fName"] +" "+ each["lName"]+ " was not found in the database"

		logFile.write(v + "\n")
		printStmnts.append(v)
	else:
		v = each["fName"] +" "+ each["lName"]+ " was found in the database"

		logFile.write(v + "\n")
		printStmnts.append(v)

		up.addHistory(ID, each['Date'], each['History'])

printStmnts.append("DONE")
print(*printStmnts, sep="<br>", end="")
