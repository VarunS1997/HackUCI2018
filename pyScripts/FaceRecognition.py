import cv2
from urllib import request
import facebook


def test():
    # get your token from https://developers.facebook.com
    ACCESS_TOKEN = "EAACEdEose0cBAJQYFezGZB6rAnPYQdbqnu4pt0ZCUsgZALzxuJxdSZAWcfCZBT4CtAk1O9kVp2SoQ4mwb3RmZBHIK7ZATHcNYJ6O1bnVYAwHfWKr15aJXM9Ke3PuW9bKih49tKWETQ3nNP4CFAtAqTVnfGaSzArGnSyZAYiIreWfZCbiwcGHYrlwSZChXt7NdQByBQhNqZAg1dQ2gZDZD"
    graph = facebook.GraphAPI(ACCESS_TOKEN)

    USER_ID = "820921224634239"
    info = graph.get_object(USER_ID, fields='id, name, photos')
    print(info)
    print(getPhotosData(info))
    print(graph.get_object(USER_ID))

    feeds = graph.get_connections(USER_ID,'feed')
    # print(feeds)

def main():
    pass

def getPhotosData(infoObject) -> list:
    return infoObject["photos"]["data"]

if __name__ == '__main__':
    print("OpenCV Version",cv2.__version__)
    main()
    test()
