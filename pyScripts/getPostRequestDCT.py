import requests
import time

if __name__ == '__main__':
	while(True):
		r = requests.post('https://sanatree.tech/PHP/DCT.php')
		if(r.text != "NULL"):
			dosomething
		time.sleep(1);
