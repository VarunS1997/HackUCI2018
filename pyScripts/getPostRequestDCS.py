import requests
import time
import FaceRecognition as fr


if __name__ == '__main__':
	while(True):
		r = requests.get('https://sanatree.tech/PHP/DCT.php')
		if(r.text != "NULL"):
			#Image intake. Utilize cv2.imreal()
			imageCaptured = None #replace None
			# face_recognizer = None
			idList = [] #Type should be str #Optional/Can Erase
			face_recognizer = fr.createClassifer(idList) #Optional/Can Erase
			fr.predict(imageCaptured,face_recognizer) #return a FB ID
		time.sleep(1);