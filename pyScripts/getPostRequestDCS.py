import requests
import time
import FaceRecognition as fr
import numpy as np
import cv2
from urllib.request import urlopen

if __name__ == '__main__':
	while(True):
		r = requests.get('https://sanatree.tech/PHP/DCS.php')
		if(r.text != "NULL"):
			idRequest = requests.get("https://sanatree.tech/PHP/getUserIDs.php")

			idList = []
			for id in idRequest:
				ids = str(id).split("\\n")
				idList = [str(id).replace("b'", "").replace("'", "") for id in ids if
						  len(str(id).replace("b'", "").replace("'", "")) > 0]
			#Image intake. Utilize cv2.imreal()
			imageCaptured = None #replace None

			print("idList: ",idList)
			for l in idList:
				print(l)


			urlofImageCaptured = r.text
			print("url:",urlofImageCaptured)
			resp = urlopen(urlofImageCaptured)
			imageCaptured = np.asarray(bytearray(resp.read()), dtype="uint8")
			imageCaptured = cv2.imdecode(imageCaptured, cv2.IMREAD_COLOR) #convert to cv2 image format

			# face_recognizer = None
			face_recognizer = fr.createClassifer(idList) #Optional/Can Erase
			id = fr.predict(imageCaptured,face_recognizer) #return a FB ID
			res = requests.get("https://sanatree.tech/PHP/SaveResult.php?id={}".format(id))
			print("HERE: {}".format(res.text))
		time.sleep(1);