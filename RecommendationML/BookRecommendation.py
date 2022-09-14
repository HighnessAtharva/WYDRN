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


def getUserBooks(user_name: str) -> list[str]:
    userBooks = []
    try:
        connection = mysql.connector.connect(
            host='localhost', database='wydrn', user='root', password='')

        sql_select_Query = f"select DISTINCT `book` from `data` where `username`='{user_name}' and book!='';"
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        records = cursor.fetchall()
        print("Total number of rows in table: ", cursor.rowcount)

        for row in records:
            userBooks.append(row[0])

        return userBooks

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            # print("MySQL connection is closed")


def recommend(username):
    RecList = []
    userBooks = getUserBooks(username)
    userBooks = [string.title() for string in userBooks]
    # print(userBooks)
    # weightedDict = dict(dict(weightedList))
    bookList = ["Things Fall Apart",
                "Fairy tales",
                "The Divine Comedy",
                "The Epic Of Gilgamesh",
                "The Book Of Job",
                "One Thousand and One Nights",
                "Njál's Saga",
                "Pride and Prejudice",
                "Le Père Goriot",
                "Molloy, Malone Dies, The Unnamable, the trilogy",
                "The Decameron",
                "Ficciones",
                "Wuthering Heights",
                "The Stranger",
                "Poems",
                "Journey to the End of the Night",
                "Don Quijote De La Mancha",
                "The Canterbury Tales",
                "Stories",
                "Nostromo",
                "Great Expectations",
                "Jacques the Fatalist",
                "Berlin Alexanderplatz",
                "Crime and Punishment",
                "The Idiot",
                "The Possessed",
                "The Brothers Karamazov",
                "Middlemarch",
                "Invisible Man",
                "Medea",
                "Absalom, Absalom!",
                "The Sound and the Fury",
                "Madame Bovary",
                "Sentimental Education",
                "Gypsy Ballads",
                "One Hundred Years of Solitude",
                "Love in the Time of Cholera",
                "Faust",
                "Dead Souls",
                "The Tin Drum"]

    #get a random book from the array above
    randomBook = random.choices(bookList, k=10)

    #key = book name, value = weighted score from 1 to 10 randomly
    weightedDict = dict(zip(randomBook, [random.randint(1, 10) for i in range(10)]))
    print(json.dumps(weightedDict))


recommend(username=sys.argv[1])


