import cv2
from urllib import request
import facebook, requests
from io import BytesIO
from PIL import Image
import matplotlib.pyplot as plt
import numpy
# %matplotlib incline


def test():
    # get your token from https://developers.facebook.com
    ACCESS_TOKEN = "EAACEdEose0cBAOk0ELqLM1y18bU006UNZCWQNqBHCZBLwnPga40ZCHP88oZAuJkjXGxR9xendAvLQRftPSQiFGcRDUwXwj6kZAgeBTLtsbBj8XZC65sbYaSIyBJDHuvDYTk45aQKtBfzlvyCrZAgPy3Npzr5IKfs0ivcMMI4u5yUFHIXiXw9fNAw388ZCeZB4Yn3IA3QdAWwzuQZDZD"
    graph = facebook.GraphAPI(ACCESS_TOKEN)

    USER_ID = "820921224634239"
    info = graph.get_object(USER_ID, fields='id, name, photos')

    webImage = getWebImage(USER_ID)
    face, rect = detect_face(webImage)
    # face.show()

    # print(info)
    print(getPhotosData(info))
    print(graph.get_object(USER_ID))

    # feeds = graph.get_connections(USER_ID,'feed')
    # print(feeds)

def main():
    pass

def getPhotosData(infoObject) -> list:
    return infoObject["photos"]["data"]

def imageUrl(id: str) -> str:
    url = "http://graph.facebook.com/{}/picture?type=large".format(id)
    print(url)
    return url

def getWebImage(id: str) -> Image:
    imageOfUrl = imageUrl(id)
    response = requests.get(imageOfUrl)
    img = Image.open(BytesIO(response.content))  # 250,250 resize() ??
    img = cv2.cvtColor(numpy.array(img), cv2.COLOR_RGB2BGR)
    return img

def getCameraImage(id: str) -> Image:
    pass


def detect_face(img):
    # convert the test image to gray image as opencv face detector expects gray images
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # load OpenCV face detector, I am using LBP which is fast
    # there is also a more accurate but slow Haar classifier
    face_cascade = cv2.CascadeClassifier('opencv-files/lbpcascade_frontalface.xml')

    # let's detect multiscale (some images may be closer to camera than others) images
    # result is a list of faces
    faces = face_cascade.detectMultiScale(gray, scaleFactor=1.2, minNeighbors=5);

    # if no faces are detected then return original img
    if (len(faces) == 0):
        return None, None

    # under the assumption that there will be only one face,
    # extract the face area
    (x, y, w, h) = faces[0]

    # return only the face part of the image
    return gray[y:y + w, x:x + h], faces[0]

if __name__ == '__main__':
    print("OpenCV Version",cv2.__version__)
    main()
    test()
