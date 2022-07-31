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


def getUserTV(user_name:str) -> list[str]:
    userTV=[]
    try:
        connection = mysql.connector.connect(host='localhost', database='wydrn', user='root', password='')

        sql_select_Query = f"select DISTINCT `tv` from `data` where `username`='{user_name}' and tv!='';"
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        records = cursor.fetchall()
        print("Total number of rows in table: ", cursor.rowcount)

        for row in records:
            userTV.append(row[0])

        return userTV

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            # print("MySQL connection is closed")



print("-------------- BOOK RECOMMENDATION SYSTEM -------------- \n\n")


RecList=[]
userTV=getUserTV('HighnessAtharva')
userTV=[string.title() for string in userTV]
print(userTV)

