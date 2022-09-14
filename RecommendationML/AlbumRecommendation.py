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


def getuserAlbums(user_name: str) -> list[str]:
    userAlbums = []
    try:
        connection = mysql.connector.connect(
            host='localhost', database='wydrn', user='root', password='')

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
    RecList = []
    userAlbums = getuserAlbums(username)
    userAlbums = [string.title() for string in userAlbums]
    # print(userAlbums)
    # weightedDict = dict(dict(weightedList))

    albumList = ["Sgt. Pepper's Lonely Hearts Club Band",
                 "Pet Sounds",
                 "Revolver",
                 "Highway 61 Revisited",
                 "Rubber Soul",
                 "What's Going On",
                 "Exile on Main St.",
                 "London Calling",
                 "Blonde on Blonde",
                 "The Sun Sessions",
                 "Kind of Blue",
                 "Legend: The Best of Bob Marley and The Wailers",
                 "A Love Supreme",
                 "It Takes a Nation of Millions to Hold Us Back",
                 "At Fillmore East",
                 "Here's Little Richard",
                 "Bridge Over Troubled Water",
                 "Greatest Hits",
                 "Meet The Beatles!",
                 "The Birth of Soul",
                 "Electric Ladyland",
                 "Elvis Presley",
                 "Songs in the Key of Life",
                 "Beggars Banquet",
                 "Chronicle: The 20 Greatest Hits",
                 "Trout Mask Replica",
                 "Greatest Hits",
                 "Appetite for Destruction",
                 "Achtung Baby",
                 "Sticky Fingers",
                 "Back to Mono (1958-1969)",
                 "Moondance",
                 "Kid A",
                 "Off the Wall",
                 "[Led Zeppelin IV]",
                 "The Stranger",
                 "Graceland",
                 "Superfly",
                 "Physical Graffiti",
                 "After the Gold Rush",
                 "Star Time",
                 "Purple Rain",
                 "Back in Black",
                 "Otis Blue: Otis Redding Sings Soul",
                 "Led Zeppelin II",
                 "Imagine",
                 "The Clash",
                 "Harvest",
                 "Axis: Bold as Love",
                 "I Never Loved a Man the Way I Love You",
                 "Lady Soul",
                 "Born in the U.S.A.",
                 "The Wall",
                 "At Folsom Prison",
                 "Dusty in Memphis",
                 "Talking Book",
                 "Goodbye Yellow Brick Road",
                 "20 Golden Greats",
                 "40 Greatest Hits",
                 "Bitches Brew",
                 "Tommy",
                 "The Freewheelin' Bob Dylan",
                 "This Year's Model",
                 "There's a Riot Goin' On"
                 ]

    # get a random book from the array above
    albumList = random.choices(albumList, k=10)

    # key = book name, value = weighted score from 1 to 10 randomly
    weightedDict = dict(
        zip(albumList, [random.randint(1, 10) for i in range(10)]))
    print(json.dumps(weightedDict))


recommend(username=sys.argv[1])
