/*****************************/
-- To Get Mutual Videogame list (irrespective of platform) between two users
SELECT videogame FROM data WHERE username='HighnessAtharva' AND videogame != ''
INTERSECT
SELECT videogame FROM data WHERE username='susujpeg' AND videogame != ''; 
-- To Get Mutual Album, Artist list between two users. 
SELECT album, artist FROM data WHERE username='HighnessAtharva' AND album!='' AND artist!='' 
INTERSECT
SELECT album, artist FROM data WHERE username='susujpeg' AND album!='' AND artist!='';

-- To Get Mutual Book, Author list between two users.
SELECT book, author FROM data WHERE username='HighnessAtharva'  AND book!='' AND author!='' 
INTERSECT
SELECT book, author FROM data WHERE username='susujpeg' AND book!='' AND author!='';

-- To Get Mutual Movie, Year list between two users.
SELECT movie, year FROM data WHERE username='HighnessAtharva' AND movie!='' AND year!=''
INTERSECT
SELECT movie, year FROM data WHERE username='susujpeg' AND movie!='' AND year!='';

-- To Get Mutual TV Show list (irrespective of streaming platform) between two users.
SELECT tv FROM data WHERE username='HighnessAtharva' AND tv != ''
INTERSECT
SELECT tv FROM data WHERE username='susujpeg' AND tv != '';


/*****************************/
-- to get total count of mutual videogames (logged in user)
SELECT COUNT(*) FROM(SELECT videogame FROM data WHERE username='HighnessAtharva' AND videogame != ''
INTERSECT
SELECT videogame FROM data WHERE username='susujpeg' AND videogame != '') I;

-- to get total count of mutual albums (logged in user)
SELECT COUNT(*) FROM(SELECT album, artist FROM data WHERE username='HighnessAtharva' AND album!='' AND artist!='' 
INTERSECT
SELECT album, artist FROM data WHERE username='susujpeg' AND album!='' AND artist!='') I;

-- to get total count of mutual books (logged in user)
SELECT COUNT(*) FROM(SELECT book, author FROM data WHERE username='HighnessAtharva'  AND book!='' AND author!='' 
INTERSECT
SELECT book, author FROM data WHERE username='susujpeg' AND book!='' AND author!='') I;

-- to get total count of mutual movies (logged in user)
SELECT COUNT(*) FROM(SELECT movie, year FROM data WHERE username='HighnessAtharva' AND movie!='' AND year!=''
INTERSECT
SELECT movie, year FROM data WHERE username='susujpeg' AND movie!='' AND year!='') I;

-- to get total count of mutual tvshows (logged in user)
SELECT COUNT(*) FROM(SELECT tv FROM data WHERE username='HighnessAtharva' AND tv != ''
INTERSECT
SELECT tv FROM data WHERE username='susujpeg' AND tv != '') I;




/*****************************/
-- to get followers count of 'susujpeg' (logged in user)
select count(follower_username) from social where followed_username='susujpeg';

-- to get following count of 'susujpeg' (logged in user)
select count(followed_username) from social where follower_username='susujpeg';


/*****************************/
-- to get all the blank insert records in the database which are a result of clear button on profile.php
SELECT * FROM `data` where videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='';



/*****************************/
-- to delete all the blank records from the database except the most recent blank record. (Make a trigger out of this)
DELETE FROM data
WHERE username = 'HighnessAtharva' AND videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='' AND datetime<> (SELECT max(datetime) from data where videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='');



/*****************************/
-- To get the total media count for a user (total media count is displayed in profile)
select sum(allcount) AS Total_Count from(
     (SELECT count(videogame) as allcount FROM `data` where username='HighnessAtharva' AND videogame!='')
     UNION ALL
     (SELECT count(album) as allcount FROM `data` where username='HighnessAtharva' AND album!='')
     UNION ALL
     (SELECT count(book) as allcount FROM `data` where username='HighnessAtharva' AND book!='')
     UNION ALL
     (SELECT count(movie) as allcount FROM `data` where username='HighnessAtharva' AND movie!='')
     UNION ALL
     (SELECT count(tv) as allcount FROM `data` where username='HighnessAtharva' AND tv!='')
)t;


/*****************
TO WIPE A USER'S DATA. PERMAMENTLY DELETE ALL THE DATA OF A USER.
**************/

DELETE FROM `users` WHERE `user_name` = 'jamesjoyce';
DELETE FROM `data` WHERE `username` = 'jamesjoyce';
DELETE FROM `social` WHERE `follower_username` = 'jamesjoyce';
DELETE FROM `social` WHERE `followed_username` = 'jamesjoyce';