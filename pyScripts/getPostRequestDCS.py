import requests
import time
import FaceRecognition as fr


if __name__ == '__main__':
	while(True):
		r = requests.post('https://sanatree.tech/PHP/DCT.php')
		if(r.text != "NULL"):
			#Image intake. Utilize cv2.imreal()
			imageCaptured = None #replace None
			face_recognizer = None
			fr.predict(imageCaptured,face_recognizer)
		time.sleep(1);