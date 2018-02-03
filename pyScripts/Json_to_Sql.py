import MySQLdb
import json
import sys

class DataInput:
	lookUpUserCommand = '''SELECT * FROM `users` WHERE `FIRST_NAME` LIKE '{}' AND `LAST_NAME` LIKE '{}' AND `DOB` LIKE '{}' AND `ADDRESS` LIKE '{}' '''
	insertUserCommand = '''INSERT INTO `users` (`FIRST_NAME`, `LAST_NAME`,`USER_ID`, `DOB`, `ADDRESS`,`START_DATE`) VALUES ('{}', '{}', '{}', '{}', '{}', '{}')'''
	insertHistoryCommand = '''INSERT INTO `histories` (`USER_ID`, `DATE`, `DESCRIPTION`) VALUES ('{}', '{}', '{}')'''
	lookUpHistoryCommand = '''SELECT * FROM `histories` WHERE `USER_ID` LIKE '{}' '''

	def __init__(self, hst,datab):
		self.db = MySQLdb.connect(host = hst, db = datab)
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

if __name__ == '__main__':
	file = open(sys.argv[0], 'r')
	data = json.load(file)
	up = DataInput("localhost", "sanatree_userDB")
	for each in data['append']:
		ID = up.getID(each['fName'], each['lName'], each['DOB'], each['Address'])
		if ID == None:
			raise Exception("User not found in database")
		else:
			up.addHistory(ID, each['Date'], each['History'])

