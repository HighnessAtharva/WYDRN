<?php

/**
 * Handy and frequently used functions for WYDRN
 *
 * @version    PHP 8.0.12
 * @since      March 2022
 * @author     AtharvaShah
 */

/*
Checks if a user is logged in and is valid. If yes, redirects to the login page. Important to start the session in order to perform the check_login function. Use session_start(); in pages that you wish to use this function.
 */
function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from `users` where `user_id` = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
}

/*
Generates a random 5 to 20-digit number that is to be used to generate dynamic userIDs
 */
function random_num($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}

/*
Sends an Email requesting verification of the account to the recipient.
 */

function mailer_verify_email($recipient)
{
    require "connection.php";
    require "PHPMailer/Exception.php";
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/SMTP.php";
    $user_data = check_login($con);
    $username = $user_data['user_name'];
    $hashed_verify = md5($username);

    $mail = new PHPMailer\PHPMailer\PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 0 = messages only, 1 = errors + messages
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "westerospatriot@gmail.com";
    $mail->Password = "REPLACE_THIS_WITH_YOUR_PASS"; //Google Account -> Security -> App Passwords
    $mail->SetFrom("westerospatriot@gmail.com");
    $mail->Subject = "WYDRN - Verify Your Email";
    //mailer body start
    $mailerbody = "<button style='padding:20px;'>";
    $mailerbody .= "<a style='text-decoration: none;' href='localhost/WYDRN/verify.php?link=$hashed_verify'>Click the link below to verify your Account and get access to all the features.</a>";
    $mailerbody .= '</button>';
    //mailer body end
    $mail->Body = $mailerbody;
    $mail->AddAddress($recipient);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return 0;
    } else {
        // echo "Message has been sent";
        return 1;
    }
}

/*
Sends an Email with Reset Password Link.
 */
function send_reset_link($recipient, $link)
{

    require "PHPMailer/Exception.php";
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/SMTP.php";

    $mail = new PHPMailer\PHPMailer\PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 0 = messages only, 1 = errors + messages
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "westerospatriot@gmail.com";
    $mail->Password = "REPLACE_THIS_WITH_YOUR_PASS"; //Google Account -> Security -> App Passwords
    $mail->SetFrom("westerospatriot@gmail.com");
    $mail->Subject = "WYDRN - Reset Password";
    $mail->Body = $link;
    $mail->AddAddress($recipient);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return 0;
    } else {
        // echo "Message has been sent";
        return 1;
    }
}

/*
Sends an Email notifying the user that their password has been changed.
 */
function send_password_reset_notif($recipient, $link)
{

    require "PHPMailer/Exception.php";
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/SMTP.php";

    $mail = new PHPMailer\PHPMailer\PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 0 = messages only, 1 = errors + messages
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "westerospatriot@gmail.com";
    $mail->Password = "REPLACE_THIS_WITH_YOUR_PASS"; //Google Account -> Security -> App Passwords
    $mail->SetFrom("westerospatriot@gmail.com");
    $mail->Subject = "WYDRN - Your Password has been reset";
    $mail->Body = $link;
    $mail->AddAddress($recipient);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return 0;
    } else {
        // echo "Message has been sent";
        return 1;
    }
}

/*
Returns whether a user account is verified or not (1 - Verified  ||  0 -  Not Verified)
Used in Edit Profile page to determine
 */
function check_verified_status($username)
{
    require "connection.php";
    $sql = "SELECT `verified` FROM users WHERE `user_name`='$username'";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
            return $row['verified'];
        } else {
            die('That user does not exist' . mysqli_error($con));
        }
    }
    mysqli_close($con);
}

/*
Sets a user account is verified or not (1 - Verified  ||  0 -  Not Verified).
 */
function set_verified($username)
{
    require "connection.php";
    $sql = "UPDATE users SET verified=1 WHERE user_name='$username'";
    if (mysqli_query($con, $sql)) {
        return 1;
    } else {
        echo "User does not exist";
        return 0;
    }
}

/*
Checks whether a user is active or not (1 - Active  ||  0 -  Inactive)
 */
function check_active_status($username)
{
    require "connection.php";
    $sql = "SELECT active FROM users WHERE user_name='$username'";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
            return $row['active'];
        } else {
            die('That user does not exist' . mysqli_error($con));
        }
    }
    mysqli_close($con);
}

/*
Sets a user account status as active (Returns 1 - Set Active Successfully  ||  0 -  Error in Setting Active)
Called when user logins
 */
function set_active($username)
{
    require "connection.php";
    $sql = "UPDATE users SET active=1 WHERE user_name='$username'";
    if (mysqli_query($con, $sql)) {
        return 1;
    } else {
        echo "User does not exist";
        return 0;
    }
}

/*
Sets a user account status as inactive (Returns 1 - Set inactive Successfully  ||  0 -  Error in Setting inactive)
Called when user logouts
 */
function set_inactive($username)
{
    require "connection.php";
    $sql = "UPDATE users SET active=0 WHERE user_name='$username'";
    if (mysqli_query($con, $sql)) {
        return 1;
    } else {
        echo "User does not exist";
        return 0;
    }
}

/*
Used to pass the datetime and return a printable and user-friendly datetime format D:M:Y H:M:AM/PM
 */
function printable_datetime($datetime)
{
    $datetime = date("F j Y | g:i A", strtotime($datetime));
    return $datetime;
}

function printable_date($date)
{
    $date = date("F j, Y", strtotime($date));
    return $date;
}

/*
Get total mutual media count between two users
 */
function get_mutual_media_count($user1, $user2)
{
    require "connection.php";
    $array = array();

    // mutual video game count
    $sql = "SELECT count(*) FROM(SELECT videogame FROM data WHERE username='$user1' AND videogame != ''
	INTERSECT
	SELECT videogame FROM data WHERE username='$user2' AND videogame != '') I";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            $mutual_videogame_count = $row[0];
        } else {
            die('Could not get the records' . mysqli_error($con));
        }
    }

    // mutual album count
    $sql = "SELECT COUNT(*) FROM(SELECT album, artist FROM data WHERE username='$user1' AND album!='' AND artist!=''
	INTERSECT
	SELECT album, artist FROM data WHERE username='$user2' AND album!='' AND artist!='') I";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            $mutual_album_count = $row[0];
        } else {
            die('Could not get the records' . mysqli_error($con));
        }
    }

    // mutual book count
    $sql = "SELECT COUNT(*) FROM(SELECT book, author FROM data WHERE username='$user1'  AND book!='' AND author!=''
	INTERSECT
	SELECT book, author FROM data WHERE username='$user2' AND book!='' AND author!='') I";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            $mutual_book_count = $row[0];
        } else {
            die('Could not get the records' . mysqli_error($con));
        }
    }

    // mutual movie count
    $sql = "SELECT COUNT(*) FROM(SELECT movie, year FROM data WHERE username='$user1' AND movie!='' AND year!=''
	INTERSECT
	SELECT movie, year FROM data WHERE username='$user2' AND movie!='' AND year!='') I";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            $mutual_movie_count = $row[0];
        } else {
            die('Could not get the records' . mysqli_error($con));
        }
    }

    // mutual tv show count
    $sql = "SELECT count(*) FROM(SELECT tv FROM data WHERE username='$user1' AND tv != ''
	INTERSECT
	SELECT tv FROM data WHERE username='$user2' AND tv != '') I";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            $mutual_tvshow_count = $row[0];
        } else {
            die('Could not get the records' . mysqli_error($con));
        }
    }
    mysqli_close($con);

    $total_mutual_count = $mutual_videogame_count + $mutual_album_count + $mutual_book_count + $mutual_movie_count + $mutual_tvshow_count;

    // push videogame count
    array_push($array, $mutual_videogame_count, $mutual_album_count, $mutual_book_count, $mutual_movie_count, $mutual_tvshow_count, $total_mutual_count);

    /*$array will look like
    [0]=>videogame count,
    [1]=>album count,
    [2]=>book count,
    [3]=>movie count,
    [4]=>tvshow count,
    [5]=>total mutual count
     */
    return $array;
}

/*executes any given SQL query and returns the first row of the result set.*/
function executeSQL($con, $sql)
{
    if ($query = mysqli_query($con, $sql)) {
        $row = mysqli_fetch_array($query);
        if (isset($row[0])) {
            return $row[0];
        } else {
            return '--';
        }
    } else {
        echo mysqli_error($con);
    }
}

/*Return a random image from the assets/abstract folder - to be used in feed.php*/
function randomImage()
{
    $images = [
        "images/website/assets/abstract/1.jpg",
        "images/website/assets/abstract/3.jpg",
        "images/website/assets/abstract/4.jpg",
        "images/website/assets/abstract/7.jpg",
        "images/website/assets/abstract/9.jpg",
        "images/website/assets/abstract/10.jpg",
        "images/website/assets/abstract/11.jpg",
        "images/website/assets/abstract/12.jpg",
        "images/website/assets/abstract/15.jpg",
        "images/website/assets/abstract/17.jpg",
        "images/website/assets/abstract/18.jpg",
        "images/website/assets/abstract/19.jpg",
        "images/website/assets/abstract/20.jpg",
        "images/website/assets/abstract/21.jpg",
        "images/website/assets/abstract/22.jpg",
        "images/website/assets/abstract/23.jpg",
        "images/website/assets/abstract/24.jpg",
        "images/website/assets/abstract/25.jpg",
        "images/website/assets/abstract/25.jpg",
        "images/website/assets/abstract/25.jpg",
        "images/website/assets/abstract/25.jpg",
        "images/website/assets/abstract/25.jpg",
        "images/website/assets/abstract/26.jpg",
        "images/website/assets/abstract/27.jpg",
        "images/website/assets/abstract/28.jpg",
        "images/website/assets/abstract/29.jpg",
        "images/website/assets/abstract/30.jpg",
        "images/website/assets/abstract/31.jpg",
        "images/website/assets/abstract/32.jpg",
        "images/website/assets/abstract/33.jpg",
        "images/website/assets/abstract/34.jpg",
        "images/website/assets/abstract/35.jpg",
        "images/website/assets/abstract/36.jpg",
        "images/website/assets/abstract/37.jpg",
        "images/website/assets/abstract/38.jpg",
        "images/website/assets/abstract/39.jpg",
        "images/website/assets/abstract/40.jpg",
        "images/website/assets/abstract/41.jpg",
        "images/website/assets/abstract/42.jpg",
        "images/website/assets/abstract/43.jpg",
        "images/website/assets/abstract/44.jpg",
        "images/website/assets/abstract/47.jpg",
        "images/website/assets/abstract/48.jpg",
        "images/website/assets/abstract/49.jpg",
        "images/website/assets/abstract/51.jpg",
        "images/website/assets/abstract/52.jpg",
        "images/website/assets/abstract/53.jpg",
        "images/website/assets/abstract/54.jpg",
        "images/website/assets/abstract/56.jpg",
        "images/website/assets/abstract/57.jpg",
        "images/website/assets/abstract/58.jpg",
    ];

    $rand_keys = array_rand($images, 1);
    return $images[$rand_keys];
}

/*Return a random video that will be used on login page as background*/

function randomVideo()
{
    $videos = [
        "images/website/assets/videos/1.mp4",
        "images/website/assets/videos/2.mp4",
        "images/website/assets/videos/3.mp4",
        "images/website/assets/videos/4.mp4",
        "images/website/assets/videos/5.mp4",
        "images/website/assets/videos/6.mp4",
        "images/website/assets/videos/7.mp4",
        "images/website/assets/videos/8.mp4",
        "images/website/assets/videos/9.mp4",
        "images/website/assets/videos/10.mp4",
        "images/website/assets/videos/11.mp4",
        "images/website/assets/videos/12.mp4",
    ];
    $rand_keys = array_rand($videos, 1);
    return $videos[$rand_keys];
}

function getRandomGradient()
{
    $gradients = [
        "linear-gradient(90deg, #1CB5E0 0%, #000851 100%);",
        "linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%)",
        "linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%)",
        "linear-gradient(90deg, #FDBB2D 0%, #22C1C3 100%)",
        "linear-gradient(90deg, #9ebd13 0%, #008552 100%)",
        "linear-gradient(90deg, #0700b8 0%, #00ff88 100%)",
        "linear-gradient(90deg, #d53369 0%, #daae51 100%)",
        "linear-gradient(90deg, #efd5ff 0%, #515ada 100%)",
        "linear-gradient(90deg, #00d2ff 0%, #3a47d5 100%)",
        "linear-gradient(90deg, #f8ff00 0%, #3ad59f 100%)",
        "linear-gradient(90deg, #fcff9e 0%, #c67700 100%)",
        "linear-gradient(90deg, #00DBDE 0%, #FC00FF 100%)",
        "linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%)",
        "linear-gradient(147deg, #FFE53B 0%, #FF2525 74%)",
        "linear-gradient(0deg, #08AEEA 0%, #2AF598 100%)",
        "linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%)",
        "linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%)",

    ];
    return $gradients[array_rand($gradients)];
}

/*Return a random quote to be used on media_book.php*/

function getRandomBookQuote()
{
    $bookquotes = [
        "Nothing is insoluble. Nothing is hopeless. Not while there's life. -  Alan Moore",
        "So many books, so little time.-  Frank Zappa",
        "Not all those who wander are lost. - J.R.R. Tolkein",
        "Those who don’t believe in magic will never find it. — Roald Dahl",
        "The worst enemy to creativity is self-doubt. - Sylvia Plath",
        "Even the darkest night will end and the sun will rise. - Victor Hugo",
        "If a book is well written, I always find it too short. ― Jane Austen",
        "There is no Friend as Loyal as a Book – Ernest Hemingway",

    ];
    return $bookquotes[array_rand($bookquotes)];
}

/*Return a random quote to be used on media_movie.php*/

function getRandomMovieQuote()
{
    $moviequotes = [
        "Every man dies, but not every man really lives. – William Wallace",
        "Great men are not born great, they grow great. – Mario Puzo",
        "It’s what you do right now that makes a difference. – Struecker",
        "Our lives are defined by opportunities, even the ones we miss. – Benjamin Button",
        "I figure life's a gift and I don't intend on wasting it. - Titanic",
        "The very things that hold you down are going to lift you up. - Timothy Mouse",
        "All we have to decide is what to do with the time that is given to us. - Gandalf",
        "Carpe diem. Seize the day, boys. Make your lives extraordinary. - John Keating",

    ];
    return $moviequotes[array_rand($moviequotes)];
}

/*Return a random quote to be used on media_tv.php*/

function getRandomTvQuote()
{

    $tvquotes = [

        "You aim at the king, you best not miss. — The Wire",
        "Don’t be sorry, be fierce. - Ru Paul's Drag Race",
        "Treat yo’self. - Parks and Recreation",
        "Learning requires failure. - Atlanta",
        "You don't win alone. That's how it is. - Haikyuu",
        "All the angels are gone, son. There's only devils left.  - Yellowstone",
        "You can’t play God without being acquainted with the devil. - Westworld",
        "Evil is evil. Lesser, greater, middling, it’s all the same. - The Witcher",
        "Sometimes we are what we are, and we should embrace that. - Lucifer",
        "He who fights by the sword, dies by it. - Peaky Blinders",
        "It might be stormy now, but it can’t rain forever. - Outer Banks",

    ];
    return $tvquotes[array_rand($tvquotes)];
}

/*Return a random quote to be used on media_videogame.php*/

function getRandomVideoGameQuote()
{
    $videogamequotes = [
        "No gods or kings. Only man. - BioShock",
        "Don't wish it were easier, wish you were better. - Animal Crossing",
        "Good men mean well. We just don't always end up doing well. - Dead Space 3",
        "War. War never changes. - Fallout 3",
        "Endure and survive. - The Last Of Us",
        "Life is all about resolve. Outcome is secondary. - Okami",
    ];

    return $videogamequotes[array_rand($videogamequotes)];
}

/*Return a random quote to be used on media_music.php*/

function getRandomAlbumQuote()
{
    $albumquotes = [
        "Lose your dreams and you might lose your mind. - Mick Jagger",
        "One good thing about music, when it hits you, you feel no pain. - Bob Marley",
        "Life is what happens when you’re making other plans. - John Lennon",
        "Music can change the world because it can change people. - Bono",
        "Too many pieces of music finish too long after the end. - Igor Stravinsky",
        "Without deviation from the norm, progress is not possible. - Frank Zappa",
        "Imagination creates reality. - Richard Wagner",
        "Dare to wear the foolish clown face. - Frank Sinatra",
        "I close my eyes and seize it, I light my torch and burn it - Death Grips",

    ];
    return $albumquotes[array_rand($albumquotes)];
}

/*Return a prinatable date of member joining to display it on their respective profiles*/
function getDateofJoining($con, $username)
{
    $date_joined = executeSQL($con, "SELECT `date` FROM `users` where `user_name`='$username'");
    $date_joined = strtotime($date_joined);
    return date("M jS, Y", $date_joined);
}

/*************
TOTAL MEDIA COUNT
 *************/
function getTotalMediaCount($con, $username)
{

    $sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='')
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='')
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='')
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='')
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='')
)t";

    return executeSQL($con, $sql);
}

/*************
TOTAL MEDIA COUNT UNIQUE
 *************/

function getTotalMediaCountUnique($con, $username)
{
    $sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(DISTINCT `videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='')
    UNION ALL
    (SELECT count(DISTINCT `album`) AS allcount FROM `data` where `username`='$username' AND album!='')
    UNION ALL
    (SELECT count(DISTINCT `book`) AS allcount FROM `data` where `username`='$username' AND book!='')
    UNION ALL
    (SELECT count(DISTINCT `movie`) AS allcount FROM `data` where `username`='$username' AND movie!='')
    UNION ALL
    (SELECT count(DISTINCT `tv`) AS allcount FROM `data` where `username`='$username' AND tv!='')
)t";

    return executeSQL($con, $sql);
}

/*************
TOTAL MEDIA ADDED LAST WEEK
 *************/

function getTotalMediaAddedLastWeek($con, $username)
{
    $sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
  )t ";

    return executeSQL($con, $sql);
}

/*************
TOTAL MEDIA ADDED LAST MONTH
 *************/
function getTotalMediaAddedLastMonth($con, $username)
{
    $sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
  )t ";

    return executeSQL($con, $sql);
}

/*************
TOTAL MEDIA ADDED LAST 3 MONTHS
 *************/
function getTotalMediaAddedLast3Months($con, $username)
{
    $sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
  )t ";

    return executeSQL($con, $sql);
}

/*************
TOTAL MEDIA ADDED LAST 6 MONTHS
 *************/

function getTotalMediaAddedLast6Months($con, $username)
{
    $sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
  )t ";

    return executeSQL($con, $sql);
}

/*************
TOTAL MEDIA ADDED LAST YEAR
 *************/
function getTotalMediaAddedLastYear($con, $username)
{
    $sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
  )t ";

    return executeSQL($con, $sql);
}

/*************
TOTAL BOOKS COUNT
 *************/
function getTotalBooksCount($con, $username)
{
    $sql = "SELECT count(book) AS Total_Count FROM `data` where `username`='$username' AND book!=''";
    return executeSQL($con, $sql);
}

/*************
TOTAL BOOKS COUNT UNIQUE
 *************/
function getTotalBooksCountUnique($con, $username)
{
    $sql = "SELECT count(DISTINCT `book`) AS Total_Count FROM `data` where `username`='$username' AND book!=''";
    return executeSQL($con, $sql);
}

/*************
Favorite BOOK -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
function getFavoriteBook($con, $username)
{
    $sql = "SELECT book, count(book) as favorites FROM `data` where username='$username' and book!='' GROUP BY book HAVING count(book)>1 ORDER BY count(book) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
Favorite AUTHOR -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
function getFavoriteAuthor($con, $username)
{
    $sql = "SELECT author, count(author) as favorites FROM `data` where username='$username' and author!='' GROUP BY book HAVING count(author)>1 ORDER BY count(author) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
TOTAL MOVIE COUNT
 *************/
function getTotalMoviesCount($con, $username)
{
    $sql = "SELECT count(`movie`) AS Total_Count FROM `data` where `username`='$username' AND movie!=''";
    return executeSQL($con, $sql);
}

/*************
TOTAL MOVIE COUNT UNIQUE
 *************/
function getTotalMoviesCountUnique($con, $username)
{
    $sql = "SELECT count(DISTINCT `movie`) AS Total_Count FROM `data` where `username`='$username' AND movie!=''";
    return executeSQL($con, $sql);
}

/*************
Favorite MOVIE
 *************/
function getFavoriteMovie($con, $username)
{
    $sql = "SELECT movie, count(movie) as favorites FROM `data` where username='$username' and movie!='' GROUP BY movie HAVING count(movie)>1 ORDER BY count(movie) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
TOTAL TV SHOW COUNT
 *************/
function getTotalTVCount($con, $username)
{
    $sql = "SELECT count(`tv`) AS Total_Count FROM `data` where `username`='$username' AND tv!=''";
    return executeSQL($con, $sql);
}

/*************
TOTAL TV SHOW COUNT UNIQUE
 *************/
function getTotalTVCountUnique($con, $username)
{
    $sql = "SELECT count(DISTINCT `tv`) AS Total_Count FROM `data` where `username`='$username' AND tv!=''";
    return executeSQL($con, $sql);
}

/*************
Favorite TV SHOW
 *************/
function getFavoriteTV($con, $username)
{
    $sql = "SELECT tv, count(tv) as favorites FROM `data` where username='$username' and tv!='' GROUP BY tv HAVING count(tv)>1 ORDER BY count(tv) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
Favorite STREAMING PLATFORM
 *************/
function getFavoriteStreamingPlatform($con, $username)
{
    $sql = "SELECT streaming, count(streaming) as favorites FROM `data` where username='$username' and streaming!='' GROUP BY streaming HAVING count(streaming)>1 ORDER BY count(streaming) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
TOTAL VIDEOGAME COUNT
 *************/
function getTotalVideoGameCount($con, $username)
{
    $sql = "SELECT count(`videogame`) AS Total_Count FROM `data` where `username`='$username' AND videogame!=''";
    return executeSQL($con, $sql);
}

/*************
TOTAL VIDEOGAME COUNT UNIQUE
 *************/
function getTotalVideoGameCountUnique($con, $username)
{
    $sql = "SELECT count(DISTINCT `videogame`) AS Total_Count FROM `data` where `username`='$username' AND videogame!=''";
    return executeSQL($con, $sql);
}

/*************
Favorite GAMING PLATFORM -> MOST REPEATEDLY LOGGED
 *************/
function getFavoriteGamingPlatform($con, $username)
{
    $sql = "SELECT platform, count(platform) as favorites FROM `data` where username='$username' and platform!='' GROUP BY platform HAVING count(platform)>1 ORDER BY count(platform) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
Favorite VIDEOGAME -> MOST REPEATEDLY LOGGED
 *************/
function getFavoriteVideoGame($con, $username)
{
    $sql = "SELECT videogame, count(videogame) as favorites FROM `data` where username='$username' and videogame!='' GROUP BY videogame HAVING count(videogame)>1 ORDER BY count(videogame) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
TOTAL ALBUM COUNT
 *************/
function getTotalAlbumCount($con, $username)
{
    $sql = "SELECT count(`album`) AS Total_Count FROM `data` where `username`='$username' AND album!=''";
    return executeSQL($con, $sql);
}

/*************
TOTAL ALBUM COUNT UNIQUE
 *************/
function getTotalAlbumCountUnique($con, $username)
{
    $sql = "SELECT count(DISTINCT `album`) AS Total_Count FROM `data` where `username`='$username' AND album!=''";
    return executeSQL($con, $sql);
}

/*************
Favorite ALBUM -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
function getFavoriteAlbum($con, $username)
{
    $sql = "SELECT album, count(album) as favorites FROM `data` where username='$username' and album!='' GROUP BY album HAVING count(album)>1 ORDER BY count(album) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/*************
Favorite ARTIST/SINGER/SONGWRITER -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
function getFavoriteArtist($con, $username)
{
    $sql = "SELECT artist, count(artist) as favorites FROM `data` where username='$username' and artist!='' GROUP BY artist HAVING count(artist)>1 ORDER BY count(artist) DESC LIMIT 5";
    return executeSQL($con, $sql);
}

/********************
GET THE MOVIE POSTER PATH USING AN API REQUEST
 ******************/
function MoviePosterPath($name, $year)
{
    $api_key = "e446bc89015229cf337e16b0849d506c";
    $url = 'https://api.themoviedb.org/3/search/movie?api_key=' . $api_key . '&query=' . $name . '&year=' . $year . '&include_adult=false';
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results'][0]['poster_path'])) {
        $response = "images/API/WYDRNmovie.png";
    } else {
        $response = "https://image.tmdb.org/t/p/w300" . $response['results'][0]['poster_path'];
    }
    return $response;
}

/********************
GET THE BOOK POSTER PATH USING AN API REQUEST
 ******************/
function BookPosterPath($name, $author)
{
    $merge = $name . "+" . $author;
    $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $merge . '&orderBy=relevance';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['items'][0]['volumeInfo']['imageLinks']['thumbnail'])) {
        $response = "images/API/WYDRNbook.png";
    } else {
        $response = $response['items'][0]['volumeInfo']['imageLinks']['thumbnail'];
    }
    // print_r ($response['items'][0]['volumeInfo']['imageLinks']['thumbnail']);
    return $response;
}
/********************
GET THE TV POSTER PATH USING AN API REQUEST
 ******************/

function TvPosterPath($name)
{
    $api_key = "e446bc89015229cf337e16b0849d506c";
    $url = 'https://api.themoviedb.org/3/search/tv?api_key=' . $api_key . '&query=' . $name . '&include_adult=false';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results'][0]['poster_path'])) {
        $response = "images/API/WYDRNtv.png";
    } else {
        $response = "https://image.tmdb.org/t/p/w300" . $response['results'][0]['poster_path'];
    }
    return $response;
}

/********************
GET THE MUSIC POSTER PATH USING AN API REQUEST
 ******************/
function MusicPosterPath($name, $artist)
{
    $api_key = "6a4eb1d0536cfe3583784a65332ee179";
    $url = 'https://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=' . $api_key . '&artist=' . $artist . '&album=' . $name . '&format=json';
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['album']['image'][5]['#text'])) {
        $response = "images/API/WYDRNmusic.png";
    } else {
        $response = $response['album']['image'][5]['#text'];
    }
    return $response;
}

/********************
GET THE VIDEOGAME POSTER PATH USING AN API REQUEST
 ******************/

function GamePosterPath($name)
{
    $api_key = "fe197746ce494b4791441d9a9161c1be";
    $url = 'https://api.rawg.io/api/games?search=' . $name . '&key=' . $api_key;
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results'][0]['background_image'])) {
        $response = "images/API/WYDRNgame.png";
    } else {
        $response = $response['results'][0]['background_image'];
    }
    return $response;
}
