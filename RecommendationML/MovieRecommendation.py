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



def getUserMovies(user_name: str) -> list[str]:
    userMovies = []
    try:
        connection = mysql.connector.connect(host='localhost', database='wydrn', user='root', password='')
        sql_select_Query = f"select DISTINCT `movie` from `data` where `username`='{user_name}' and movie!='';"

        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        records = cursor.fetchall()
        print("Total number of rows in table: ", cursor.rowcount)
        userMovies.extend(row[0] for row in records)
        return userMovies
    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            # print("MySQL connection is closed")


movies_df = pd.read_csv("tmdb_5000_movies.csv", encoding= 'unicode_escape')

# # Demographic Filtering
C = movies_df["vote_average"].mean()
m = movies_df["vote_count"].quantile(0.9)

def get_director(x):
    for i in x:
        if i["job"] == "Director":
            return i["name"]
    return np.nan



def get_list(x):
    if isinstance(x, list):
        names = [i["name"] for i in x]
        if len(names) > 3:
            names = names[:3]
        return names
    return []

new_movies_df = movies_df.copy().loc[movies_df["vote_count"] >= m]
# print(new_movies_df.shape)


def weighted_rating(x, C=C, m=m):
    v = x["vote_count"]
    R = x["vote_average"]
    return (v/(v + m) * R) + (m/(v + m) * C)

new_movies_df["score"] = new_movies_df.apply(weighted_rating, axis=1)
new_movies_df = new_movies_df.sort_values('score', ascending=False)
new_movies_df[["title", "vote_count", "vote_average", "score"]].head(10)

tfidf = TfidfVectorizer(stop_words="english")
movies_df["overview"] = movies_df["overview"].fillna("")
tfidf_matrix = tfidf.fit_transform(movies_df["overview"])

# print(tfidf_matrix.shape)

# Compute similarity
cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)
# print(cosine_sim.shape)

indices = pd.Series(movies_df.index, index=movies_df["title"]).drop_duplicates()
# print(indices.head())




def get_recommendations(title, cosine_sim=cosine_sim):
    """
    in this function, we take the cosine score of given movie sort them based on cosine score (movie_id, cosine_score) take the next 10 values because the first entry is itself get those movie indices map those indices to titles return title list
    """
    skipped = 0
    with contextlib.suppress(KeyError):
        idx = indices[title]
        sim_scores = list(enumerate(cosine_sim[idx]))
        sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)
        sim_scores = sim_scores[1:11]
        movies_indices = [ind[0] for ind in sim_scores]
        results = movies_df["title"].iloc[movies_indices]
        results = results.values.tolist()
        return results if results is not None else [""]



def recommend(username):
    """ 
    dummy_list=["Avatar","Spectre","Pirates of the Caribbean: At World's End","John Carter","The Dark Knight Rises","Tangled","Spider-Man 3","Harry Potter and the Half-Blood Prince","Avengers: Age of Ultron","Superman Returns","Batman v Superman: Dawn of Justice","Pirates of the Caribbean: Dead Man's Chest","Quantum of Solace","Man of Steel","The Lone Ranger","The Avengers","The Chronicles of Narnia: Prince Caspian","Men in Black 3","Pirates of the Caribbean: On Stranger Tides","The Amazing Spider-Man","The Hobbit: The Battle of the Five Armies","The Hobbit: The Desolation of Smaug","Robin Hood","King Kong","The Golden Compass","Captain America: Civil War","Titanic","Jurassic World","Battleship","Spider-Man 2","Skyfall","Alice in Wonderland","Iron Man 3","Monsters University","X-Men: The Last Stand","Transformers: Age of Extinction","Transformers: Revenge of the Fallen","The Amazing Spider-Man 2","Oz: The Great and Powerful","Cars 2","TRON: Legacy","Toy Story 3","Green Lantern","Furious 7","Terminator Salvation","X-Men: Days of Future Past","World War Z","Jack the Giant Slayer","Star Trek Into Darkness","Prince of Persia: The Sands of Time","The Great Gatsby","Transformers: Dark of the Moon","Pacific Rim","The Good Dinosaur","Indiana Jones and the Kingdom of the Crystal Skull","Star Trek Beyond","Brave","Rush Hour 3","WALL·E","A Christmas Carol","2012","The Legend of Tarzan","Jupiter Ascending","X-Men: Apocalypse","The Chronicles of Narnia: The Lion, the Witch and the Wardrobe","Up","The Dark Knight","Iron Man","Monsters vs Aliens","Wild Wild West","Hugo","Suicide Squad","Edge of Tomorrow","Waterworld","The Jungle Book","Inside Out","Snow White and the Huntsman"]
    """

    userMovies=getUserMovies(username)
    userMovies=[string.title() for string in userMovies]
    RecList = [get_recommendations(movie) for movie in userMovies]

    # UNCOMMENT THIS WHEN YOU UNCOMMENT DUMMY LIST
    # for movie in dummy_list:
    #     RecList.append(get_recommendations(movie))

    RecList=[x for x in RecList if x is not None] # remove None values
    RecList = [item for sublist in RecList for item in sublist] # flatten list
    # print(RecList)
    random.shuffle(RecList)

    weightedList = Counter(RecList).most_common(10)
    movies=[]
    ranks=[]
    weightedDict = dict(dict(weightedList))
    # print(weightedDict)
    print(json.dumps(weightedDict))


    # Uncomment this when you want to print plot in Script (Plot not tested yet for webpage)
    # for i in range(len(weightedList)):
    #     movies.append(weightedList[i][0])
    #     ranks.append(weightedList[i][1])

    # def plot():
    #     popularity = movies_df.sort_values("popularity", ascending=False)
    #     plt.figure(figsize=(12, 6))
    #     plt.barh(movies,ranks, align="center", color="skyblue")
    #     plt.gca().invert_yaxis()
    #     plt.title("Top 25 Movie Recommendations")
    #     plt.xlabel("Most Likely to be Watched")
    #     plt.show()
    # plot()

# Username is recieved from the server i.e. PHP script that invokes this python script using exec()
recommend(username=sys.argv[1])