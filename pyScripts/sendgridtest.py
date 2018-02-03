# using SendGrid's Python Library
# https://github.com/sendgrid/sendgrid-python
#read from a json file, write contents into email, send to a sql server
import sendgrid
import os
from sendgrid.helpers.mail import *
import json
import base64
import re

sg = sendgrid.SendGridAPIClient(apikey='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')
#from_email = Email("lverde@uci.edu")
#to_email = Email("lverde@uci.edu")
#subject = "Sending with SendGrid is Fun"
#content = Content("text/plain", "and easy to do anywhere, even with Python")
#mail = Mail(from_email, subject, to_email, content)
#response = sg.client.mail.send.post(request_body=mail.get())
#print(response.status_code)
#print(response.body)
#print(response.headers)
    
if __name__ == '__main__':

    from_email = Email("test@example.com")
    subject = "Patient Data"
    to_email = Email("simonlee252@gmail.com")
    
    path = '../JSON'
    dirs = os.listdir(path)
    for file in dirs:
        if re.fullmatch('^[0-9a-zA-Z_-]*\.json$', file): 
            with open(file,'rb') as f:
                data = f.read()
                f.close()   

            content = Content("text/html", data.decode("utf-8"))

            mail = Mail(from_email, subject, to_email, content)

            try:
                response = sg.client.mail.send.post(request_body=mail.get())
            except urllib.HTTPError as e:
                print(e.read())
                exit()

            print(response.status_code)
            print(response.body)
            print(response.headers)
