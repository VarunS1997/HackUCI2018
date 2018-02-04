import requests
import time
import FaceRecognition as fr

if __name__ == '__main__':
	while(True):
		r = requests.get('https://sanatree.tech/PHP/DCT.php')
		if(r.text != "NULL"):
			idList = [] #Type should be str
			fr.createClassifer(idList)
		time.sleep(1);
