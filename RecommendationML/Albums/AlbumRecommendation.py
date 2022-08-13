import contextlib
import numpy as np
import pandas as pd
import random
import json
import sys
from collections import Counter
import mysql.connector
import matplotlib.pyplot as plt

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.metrics.pairwise import linear_kernel
from sklearn.metrics.pairwise import cosine_similarity
from ast import literal_eval


def getuserAlbums(user_name:str) -> list[str]:
    userAlbums=[]
    try:
        connection = mysql.connector.connect(host='localhost', database='wydrn', user='root', password='')

        sql_select_Query = f"select DISTINCT `album`, `artist` from `data` where `username`='{user_name}' and album!='';"
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        records = cursor.fetchall()
        print("Total number of rows in table: ", cursor.rowcount)

        for row in records:
            userAlbums.append(row[0])


        return userAlbums

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            # print("MySQL connection is closed")






def recommend(username):
    RecList=[]
    userAlbums=getuserAlbums(username)
    userAlbums=[string.title() for string in userAlbums]
    # print(userAlbums)
    # weightedDict = dict(dict(weightedList))
    
    weightedDict={"After Hours": 4, "EMOTION":2, "Twenty Something Nightmare":1, "Dummy4":1,"Dummy5":1,"Dummy6":1,"Dummy7":1, "Dummy8":1, "Dummy9":1, "Dummy10":1}
    print(json.dumps(weightedDict))

recommend(username=sys.argv[1])