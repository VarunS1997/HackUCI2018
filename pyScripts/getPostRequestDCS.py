import requests
import time
import pickle
import FaceRecognition as fr


if __name__ == '__main__':
	while(True):
		r = requests.get('https://sanatree.tech/PHP/DCT.php')
		if(r.text != "NULL"):
			idList = []  # Type should be str #Optional/Can Erase
			idRequest = requests.post("https://sanatree.tech/PHP/getUser.php", "H@ckUC!2018")
			for id in idRequest: #Filling up idList from request API
				idList.append(str(id))

			#Image intake. Utilize cv2.imreal()
			imageCaptured = None #replace None

			urlofImageCaptured = None
			resp = urlopen(urlofImageCaptured)
			imageCaptured = np.asarray(bytearray(resp.read()), dtype="uint8")
			imageCaptured = cv2.imdecode(image, cv2.IMREAD_COLOR)

			# face_recognizer = None
			face_recognizer = fr.createClassifer(idList) #Optional/Can Erase
			id = fr.predict(imageCaptured,face_recognizer) #return a FB ID
			requests.post("https://sanatree.tech/PHP/DCT.php", "{}:::::{}".format(id,id))
		time.sleep(1);