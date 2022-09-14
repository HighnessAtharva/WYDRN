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


def getUsergames(user_name: str) -> list[str]:
    usergames = []
    try:
        connection = mysql.connector.connect(
            host='localhost', database='wydrn', user='root', password='')

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


def recommend(username):
    RecList = []
    usergames = getUsergames(username)
    usergames = [string.title() for string in usergames]
    # print(usergames)
    # weightedDict = dict(dict(weightedList))

    gameList = [
        "Scooby-Doo! Unmasked",
        "Viewtiful Joe: Double Trouble!",
        "The Legend of Heroes: A Tear of Vermillion",
        "PQ: Practical Intelligence Quotient",
        "Lost in Blue's",
        "Ghost in the Shell: Stand Alone Complex",
        "Dig Dug: Digging Strike",
        "Frogger: Helmet Chaos",
        "Mega Man Battle Network 5: Double Team DS",
        "Nanostray",
        "Sega Casino",
        "Teenage Mutant Ninja Turtles 3: Mutant Nightmare",
        "Pac-Man World 3",
        "Tokobot",
        "Fullmetal Alchemist: Dual Sympathy",
        "Exit's",
        "Bubble Bobble Revolution",
        "The Rub Rabbits!",
        "Electroplankton",
        "LifeSigns: Surgical Unit",
        "Space Invaders Revolution",
        "Wii's Play",
        "New Super Mario Bros.",
        "Pokmon Diamond",
        "Pokmon Pearl",
        "Gears of War",
        "The Legend of Zelda: Twilight Princess",
        "Cooking Mama"
    ]

    # get a random book from the array above
    randomGame = random.choices(gameList, k=10)

    # key = book name, value = weighted score from 1 to 10 randomly
    weightedDict = dict(
        zip(randomGame, [random.randint(1, 10) for i in range(10)]))
    print(json.dumps(weightedDict))


recommend(username=sys.argv[1])
