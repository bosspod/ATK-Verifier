import mysql.connector
import roboflow
from PIL import Image
import requests
from io import BytesIO
from pyzbar.pyzbar import decode

import numpy as np
import urllib
import cv2
import os

database = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="covid_certificate"
)

cursor = database.cursor()

#cursor.execute("SELECT filename FROM ai WHERE verify = 'none'")
cursor.execute("SELECT * FROM ai WHERE verify = 'none'")

result = cursor.fetchall()

for i in result:
  student_id =str(i[1]).strip('(),').replace('\'', '')
  atk_result =str(i[2]).strip('(),').replace('\'', '')
  print(atk_result)
  print(student_id)
  response = requests.get(atk_result)
  img = Image.open(BytesIO(response.content))
  try:
    decocdeQR = decode(img)
    id = decocdeQR[0].data.decode('ascii')
    print("id = ",id)
    if id == student_id:
      chack_id = "match"
    else:
      chack_id = "not match"
  except:
    chack_id = "can't read qrcode"

  sql1 = "UPDATE ai SET qr = %s WHERE filename = %s"
  value1 = (chack_id, atk_result)
  cursor.execute(sql1, value1)
  database.commit()
  img.close()
  #os.remove('qrcode.png')


  rf = roboflow.Roboflow(api_key="k7bEUsZDD5bF6IzgJREO")
  workspace = rf.workspace("atk")
  project = workspace.project("atk-jply1")
  version = project.version(3)
  model = version.model
  preds= model.predict(atk_result, hosted=True, confidence=70, overlap=30).json()
  check = False
  for prediction in preds['predictions']:
    check = True
    if prediction['confidence'] >=0.7:
      it_atk = True
    else :
     it_atk = False
    if prediction['class'] == 'Pos' and it_atk:
      sql = "UPDATE ai SET verify = %s WHERE filename = %s"
      value = ("Positive",atk_result)
      cursor.execute(sql, value)
      database.commit()
      print(cursor.rowcount, "record(s) affected")
      break
    elif prediction['class'] == 'Neg' and it_atk:
      sql = "UPDATE ai SET verify = %s WHERE filename = %s"
      value = ("Negative",atk_result)
      cursor.execute(sql, value)
      database.commit()
      print(cursor.rowcount, "record(s) affected")
      break
  if check == False:
    sql = "UPDATE ai SET verify = %s WHERE filename = %s"
    value = ("NotATK",atk_result)
    cursor.execute(sql, value)
    database.commit()
    print(cursor.rowcount, "record(s) affected")