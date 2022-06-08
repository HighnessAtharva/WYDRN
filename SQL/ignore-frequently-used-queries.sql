-- To Get Mutual Videogame list (irrespective of platform) between two users
SELECT videogame FROM data WHERE username='HighnessAtharva'
INTERSECT
SELECT videogame FROM data WHERE username='jamesons'; --substitute logged in user and other username

-- To Get Mutual Album, Artist list between two users. 
SELECT album, artist FROM data WHERE username='HighnessAtharva'
INTERSECT
SELECT album, artist FROM data WHERE username='susujpeg';

-- To Get Mutual Book, Author list between two users.
SELECT book, author FROM data WHERE username='HighnessAtharva'
INTERSECT
SELECT book, author FROM data WHERE username='susujpeg';

-- To Get Mutual Movie, Year list between two users.
SELECT movie, year FROM data WHERE username='HighnessAtharva'
INTERSECT
SELECT movie, year FROM data WHERE username='susujpeg';

-- To Get Mutual TV Show list (irrespective of streaming platform) between two users.
SELECT tv FROM data WHERE username='HighnessAtharva'
INTERSECT
SELECT tv FROM data WHERE username='jamesons';


----------------------------------------------------------------------------------------
-- to get followers count of 'susujpeg' (logged in user)
select count(follower_username) from social where followed_username='susujpeg';

-- to get following count of 'susujpeg' (logged in user)
select count(followed_username) from social where follower_username='susujpeg';

----------------------------------------------------------------------------------------
-- to show the total count of entries made (add this in profile page)
SELECT * FROM `data` where username = 'susujpeg';

----------------------------------------------------------------------------------------
-- to get all the blank insert records in the database which are a result of clear button on profile.php
SELECT * FROM `data` where videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='';


----------------------------------------------------------------------------------------
-- to delete all the blank records from the database except the most recent blank record. (Make a trigger out of this)
DELETE FROM data
WHERE videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='' AND datetime<> (SELECT max(datetime) from data where videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='');
