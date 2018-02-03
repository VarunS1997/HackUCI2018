import requests
import os
import re

if __name__ == '__main__':
	path = '../JSON'
	dirs = os.listdir(path)
	for file in dirs:
		if re.fullmatch('^[0-9a-zA-Z_-]*\.json$', file): 
			with open(path+'/'+file,'rb') as f:
				data = f.read()
				f.close()
			r = requests.post('http://sanatree.tech/PHP/PyPost.php',  data)  