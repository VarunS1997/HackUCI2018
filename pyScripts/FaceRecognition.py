import cv2, facebook
import cv2.face as face
import matplotlib.pyplot as plt
from urllib.request import urlopen
import numpy as np
import pickle

ACCESS_TOKEN = "EAADD6RCZBH3kBAMDQIQXk4CiyBD5gBriT6kHuCisN299UBFv8bXi1P4fkWmE1A5AjzYRGugYVCsMy1gZBjA1idRdJ0OzsqZBeQWhBYtS20dfPhBOIQ4U5qooIfZBX9HiWxs56XkJWdRBB73j0IuxEBYNIj8wxPzCLefx1B8c2QZDZD"
TEST_ID = "820921224634239"
HOST = "192.254.233.160"
DB = "sanatree_userDB"
USERNAME = "sanatree_hackuci"
PASSWORD = "rHDekqSx#FaD"
SCALE_FACTOR = 1.01
MIN_NEIGHBORS = 6
PERCENTAGE = .1
HAARCASCADE = "opencv-files/haarcascade_frontalface_alt.xml"
LBP = "opencv-files/lbpcascade_frontalface.xml"
DICT = {}

def detect_face(img):
    height, width, channels = img.shape
    height = int(height * PERCENTAGE)
    width = int(width * PERCENTAGE)
    # convert the test image to gray image as opencv face detector expects gray images
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # load OpenCV face detector, I am using LBP which is fast
    # there is also a more accurate but slow Haar classifier
    face_cascade = cv2.CascadeClassifier(HAARCASCADE)

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

    f_cascade = cv2.CascadeClassifier(HAARCASCADE)
    img_copy = colored_img.copy()
    gray = cv2.cvtColor(img_copy, cv2.COLOR_BGR2GRAY)

    # let's detect multiscale (some images may be closer to camera than others) images
    faces = f_cascade.detectMultiScale(gray, scaleFactor=SCALE_FACTOR, minNeighbors=MIN_NEIGHBORS, minSize=(height,width))
    # print(faces)
    for (x, y, w, h) in faces:
        cv2.rectangle(img_copy, (x, y), (x + w, y + h), (0, 255, 0), 2)

    plt.imshow(convertToRGB(img_copy))
    plt.show()

    return img_copy

########################## FACEBOOK API ##########################

def getPhotosData(infoObject) -> list:
    # print(infoObject)
    return infoObject["photos"]["data"]

def getImageUrl(id: str) -> str:
    url = "http://graph.facebook.com/{}/picture?type=large".format(id)
    print(url)
    return url

def urlToImageNp(url: str):
    #Grabbing Image through Web Url
    resp = urlopen(url)
    image = np.asarray(bytearray(resp.read()), dtype="uint8")
    return cv2.imdecode(image, cv2.IMREAD_COLOR)

def testGatherTrainingData(id_list):
    faces = []
    labels = []
    # id_list = ["10204090278614708", "1849926508352506", "2069021659993333", "1645206745539012"]
    graph = facebook.GraphAPI(ACCESS_TOKEN)
    for n,id in enumerate(id_list):
        object = graph.get_object(id)
        # print(object)
        DICT[n] = id
        webImageUrl = getImageUrl(id)
        testImage = urlToImageNp(webImageUrl)
        face, rect = detect_face(testImage)
        drawAroundFaces(testImage)
        if face is not None:
            faces.append(face)
            labels.append(n)
        #Hard Coding in more Photo Data
        if "Jackson Tsoi" in object["name"]:
            img1 = cv2.imread("../imageAssets/Jackson/1.jpg")
            face, rect = detect_face(img1)
            drawAroundFaces(img1)
            if face is not None:
                faces.append(face)
                labels.append(n)
            img2 = cv2.imread("../imageAssets/Jackson/2.jpg")
            face, rect = detect_face(img2)
            drawAroundFaces(img2)
            if face is not None:
                faces.append(face)
                labels.append(n)
        elif "Simon Lee" in object["name"]:
            img1 = cv2.imread("../imageAssets/Simon/1.jpg")
            face, rect = detect_face(img1)
            drawAroundFaces(img1)
            if face is not None:
                faces.append(face)
                labels.append(n)
            img2 = cv2.imread("../imageAssets/Simon/2.jpg")
            face, rect = detect_face(img1)
            drawAroundFaces(img2)
            if face is not None:
                faces.append(face)
                labels.append(n)
            img4 = cv2.imread("../imageAssets/Simon/4.jpg")
            face, rect = detect_face(img4)
            drawAroundFaces(img4)
            if face is not None:
                faces.append(face)
                labels.append(n)
        elif "Lucas Verde" in object["name"]:
            img1 = cv2.imread("../imageAssets/Lucas/1.jpg")
            face, rect = detect_face(img1)
            drawAroundFaces(img1)
            if face is not None:
                faces.append(face)
                labels.append(n)
            img2 = cv2.imread("../imageAssets/Lucas/2.jpg")
            face, rect = detect_face(img2)
            drawAroundFaces(img2)
            if face is not None:
                faces.append(face)
                labels.append(n)
        elif "Varun Singh" in object["name"]:
            img1 = cv2.imread("../imageAssets/Varun/1.jpg")
            face, rect = detect_face(img1)
            drawAroundFaces(img1)
            if face is not None:
                faces.append(face)
                labels.append(n)

    return faces, labels

def createClassifer(id_list:list):
    faces, labels = testGatherTrainingData(id_list)
    print("Total faces: ", len(faces))
    print("Total labels: ", len(labels), labels)
    face_recognizer = face.LBPHFaceRecognizer_create()
    face_recognizer.train(np.array(faces), np.array(labels))
    return face_recognizer

def predict(test_img, face_recognizer):
    # make a copy of the image as we don't want to chang original image
    img = test_img.copy()
    # detect face from the image
    face, rect = detect_face(img)
    faceBorder = drawAroundFaces(img)

    # predict the image using our face recognizer
    prediction = face_recognizer.predict(face)
    print("PREDICTED:", prediction)
    print("DICT:", DICT)
    return DICT[prediction[0]]

if __name__ == '__main__':
    fakeData = ["10204090278614708", "1849926508352506", "2069021659993333", "1645206745539012"]
    # faces, labels = testGatherTrainingData(fakeData)
    # face_recognizer = face.LBPHFaceRecognizer_create()
    # face_recognizer.train(np.array(faces), np.array(labels))
    face_recognizer = createClassifer(fakeData)
    # testImageCapture = cv2.imread("glasses.jpg")
    # predict(testImageCapture, face_recognizer)

    repFunc = repr(face_recognizer)
    rep = repr(DICT)
    pass