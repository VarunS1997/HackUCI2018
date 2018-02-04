#!/usr/bin/python
import MySQLdb
import json
import datetime
import sys

class DataInput:
	lookUpUserCommand = '''SELECT * FROM `users` WHERE `FIRST_NAME` LIKE '{}' AND `LAST_NAME` LIKE '{}' AND `DOB` LIKE '{}' AND `ADDRESS` LIKE '{}' '''
	insertUserCommand = '''INSERT INTO `users` (`FIRST_NAME`, `LAST_NAME`,`USER_ID`, `DOB`, `ADDRESS`,`START_DATE`) VALUES ('{}', '{}', '{}', '{}', '{}', '{}')'''
	insertHistoryCommand = '''INSERT INTO `histories` (`USER_ID`, `DATE`, `DESCRIPTION`) VALUES ('{}', '{}', '{}')'''
	lookUpHistoryCommand = '''SELECT * FROM `histories` WHERE `USER_ID` LIKE '{}' '''

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

try:
	nl = "<br>"
	jFile = open(sys.argv[1], 'r')
	# data = json.load(jFile)

	logFile = open("../LOGS/log.txt", "w")

	up = DataInput()
	print(nl)
	print("STARTING..."+nl)
	print(, nl)

	# for each in data['append']:
	# 	ID = up.getID(each['fName'], each['lName'], each['DOB'], each['Address'])
	# 	if ID == None:
	# 		v = each["fName"] +" "+ each["lName"]+ " what not found in the database"
    #
	# 		logFile.write(v)
	# 		print(v)
	# 	else:
	# 		v = each["fName"] +" "+ each["lName"]+ " what found in the database"
    #
	# 		logFile.write(v)
	# 		print(v)
	# 		up.addHistory(ID, each['Date'], each['History'])
except Exception as e:
	print("{}: {}".format(type(e), str(e)))
