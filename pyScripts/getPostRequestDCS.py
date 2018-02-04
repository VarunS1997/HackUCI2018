import requests
import time
import FaceRecognition as fr


if __name__ == '__main__':
	while(True):
		r = requests.post('https://sanatree.tech/PHP/DCT.php')
		if(r.text != "NULL"):
			pass
		time.sleep(1);