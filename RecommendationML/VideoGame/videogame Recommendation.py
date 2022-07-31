import numpy as np
import pandas as pd
import random
from collections import Counter
import mysql.connector
import matplotlib.pyplot as plt
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.metrics.pairwise import linear_kernel
from sklearn.metrics.pairwise import cosine_similarity
from ast import literal_eval


def getUsergames(user_name:str) -> list[str]:
    usergames=[]
    try:
        connection = mysql.connector.connect(host='localhost', database='wydrn', user='root', password='')

        sql_select_Query = f"select DISTINCT `videogame` from `data` where `username`='{user_name}' and videogame!='';"
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        records = cursor.fetchall()
        print("Total number of rows in table: ", cursor.rowcount)

        for row in records:
            usergames.append(row[0])

        return usergames

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            # print("MySQL connection is closed")



print("-------------- VIDEOGAME RECOMMENDATION SYSTEM -------------- \n\n")


RecList=[]
usergames=getUsergames('HighnessAtharva')
usergames=[string.title() for string in usergames]
print(usergames)

