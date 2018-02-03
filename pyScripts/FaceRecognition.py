import cv2, facebook
import matplotlib.pyplot as plt
from urllib.request import urlopen
import numpy as np


ACCESS_TOKEN = "EAADD6RCZBH3kBAMDQIQXk4CiyBD5gBriT6kHuCisN299UBFv8bXi1P4fkWmE1A5AjzYRGugYVCsMy1gZBjA1idRdJ0OzsqZBeQWhBYtS20dfPhBOIQ4U5qooIfZBX9HiWxs56XkJWdRBB73j0IuxEBYNIj8wxPzCLefx1B8c2QZDZD"
TEST_ID = "820921224634239"
SCALE_FACTOR = 1.01
MIN_NEIGHBORS = 5
PERCENTAGE = .1
DICT = {}

def detect_face(img):
    height, width, channels = img.shape
    height = int(height * PERCENTAGE)
    width = int(width * PERCENTAGE)
    # convert the test image to gray image as opencv face detector expects gray images
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # load OpenCV face detector, I am using LBP which is fast
    # there is also a more accurate but slow Haar classifier
    face_cascade = cv2.CascadeClassifier('opencv-files/lbpcascade_frontalface.xml')

    # let's detect multiscale (some images may be closer to camera than others) images
    # result is a list of faces
    faces = face_cascade.detectMultiScale(gray, scaleFactor=SCALE_FACTOR, minNeighbors=MIN_NEIGHBORS, minSize=(height,width))

    # if no faces are detected then return original img
    if (len(faces) == 0):
        print("No Faces Detected!!")
        return None, None

    # under the assumption that there will be only one face,
    # extract the face area
    (x, y, w, h) = faces[0]

    # return only the face part of the image
    return gray[y:y + w, x:x + h], faces[0]

def convertToRGB(img):
    return cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

def drawAroundFaces(colored_img):
    height, width, channels = colored_img.shape
    height = int(height * PERCENTAGE)
    width = int(width * PERCENTAGE)

    f_cascade = cv2.CascadeClassifier('opencv-files/lbpcascade_frontalface.xml')
    img_copy = colored_img.copy()
    gray = cv2.cvtColor(img_copy, cv2.COLOR_BGR2GRAY)

    # let's detect multiscale (some images may be closer to camera than others) images
    faces = f_cascade.detectMultiScale(gray, scaleFactor=SCALE_FACTOR, minNeighbors=MIN_NEIGHBORS, minSize=(height,width))
    print(faces)
    for (x, y, w, h) in faces:
        cv2.rectangle(img_copy, (x, y), (x + w, y + h), (0, 255, 0), 2)

    plt.imshow(convertToRGB(img_copy))
    plt.show()

    return img_copy

########################## FACEBOOK API ##########################

def getPhotosData(infoObject) -> list:
    print(infoObject)
    return infoObject["photos"]["data"]

def getImageUrl(id: str) -> str:
    url = "http://graph.facebook.com/{}/picture?type=large".format(id)
    print(url)
    return url

def trainFaceRecognition(id_list: list):
    graph = facebook.GraphAPI(ACCESS_TOKEN)
    for id in id_list:
        # infoObject = getPhotosData()
        infoObject = graph.get_object(id, fields='id, name, photos')
        for photo in infoObject:
            print(photo)

        webImage = urlToImageNp(getImageUrl(id))

def urlToImageNp(url: str):
    #Grabbing Image through Web Url
    resp = urlopen(url)
    image = np.asarray(bytearray(resp.read()), dtype="uint8")
    image = cv2.imdecode(image, cv2.IMREAD_COLOR)

    #Grabbing Image Locally
    # image = cv2.imread("arnold.JPG")

    return image

def test():
    graph = facebook.GraphAPI(ACCESS_TOKEN)
    webImageUrl = getImageUrl(TEST_ID)
    testImage = urlToImageNp(webImageUrl)
    # testImage = cv2.imread("arnold.jpg")
    faces = detect_face(testImage)
    drawAroundFaces(testImage)
    print(faces)
    # test2 = cv2.imread('myself.jpg')
    # plt.imshow(convertToRGB(faces_detected_img))
    # plt.show()
    # print(faces_detected_img)

def testGatherTrainingData(id_list):
    faces = []
    labels = []
    id_list = ["820921224634239"]
    # graph = facebook.GraphAPI(ACCESS_TOKEN)
    for n,id in enumerate(id_list):
        DICT[n] = id
        webImageUrl = getImageUrl(TEST_ID)
        testImage = urlToImageNp(webImageUrl)
        face, rect = detect_face(testImage)
        drawAroundFaces(testImage)
        if face is not None:
            faces.append(face)
            labels.append(n)
            print(faces)

    return faces, labels


def predict(test_img, face_recognizer):
    # make a copy of the image as we don't want to chang original image
    img = test_img.copy()
    # detect face from the image
    face, rect = detect_face(img)
    faceBorder = drawAroundFaces(img)
    plt.imshow(faceBorder)
    plt.show()

    # predict the image using our face recognizer
    prediction = face_recognizer.predict(face)
    print("PREDICTED:", prediction)
    return prediction[0]

if __name__ == '__main__':
    # test()
    faces, labels = testGatherTrainingData([])
    print("Total faces: ", len(faces))
    print("Total labels: ", len(labels), labels)
    print("nparray:", np.array(labels))
    face_recognizer = cv2.face.LBPHFaceRecognizer_create()
    face_recognizer.train(np.array(faces), np.array(labels))


    testImg = cv2.imread("arnold2.jpg")
    print(predict(testImg, face_recognizer))
    # testImg = cv2.cvtColor(testImg, cv2.COLOR_BGR2GRAY)