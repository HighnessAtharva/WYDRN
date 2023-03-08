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


def getUserTV(user_name: str) -> list[str]:
    userTV = []
    try:
        connection = mysql.connector.connect(
            host='localhost', database='wydrn', user='root', password='')

        sql_select_Query = f"select DISTINCT `tv` from `data` where `username`='{user_name}' and tv!='';"
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        records = cursor.fetchall()
        print("Total number of rows in table: ", cursor.rowcount)

        userTV.extend(row[0] for row in records)
        return userTV

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            # print("MySQL connection is closed")


def recommend(username):
    RecList = []
    userTV = getUserTV(username)
    userTV = [string.title() for string in userTV]
    # print(userTV)
    # weightedDict = dict(dict(weightedList))
    tvList = [
        "The Halloween Candy Magic Pet",
        "The Next Thing You Eat",
        "Queens",
        "The Bachelorette",
        "Westworld",
        "Wakefield",
        "Home Sweet Home",
        "Game of Thrones",
        "Beyond Oak Island",
        "Beyond Scared Straight",
        "Hoarders",
        "Little Women: Atlanta",
        "Marrying Millions",
        "Nightwatcher's",
        "Seven Year Switch",
        "Swamp People",
        "Unsolved",
        "Acapulco Shore",
        "Dani Who?",
        "Watchmen",
        "Why Not Us",
        "Dope'sick",
        "Champaign, Ill",
        "Buried",
        "Demon Slayer Kimetsu No Yaiba",
        "True Detective",
        "Neon Genesis Evangelion",
        "The Mandalorian",
        "Castle O'reily"]

    # get a random book from the array above
    randomTV = random.choices(tvList, k=10)

    # key = book name, value = weighted score from 1 to 10 randomly
    weightedDict = dict(zip(randomTV, [random.randint(1, 10) for _ in range(10)]))

    print(json.dumps(weightedDict))


recommend(username=sys.argv[1])
