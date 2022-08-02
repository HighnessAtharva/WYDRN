<?php

$bookquotes=[
    "Nothing is insoluble. Nothing is hopeless. Not while there's life. -  Alan Moore",
    "So many books, so little time.-  Frank Zappa",
    //add more quotes here
];

$moviequotes=[
    "Quote - Movie Name",
    //add more quotes here
];


$tvquotes=[
    "Quote - Show Name",
    //add more quotes here
];


$videogamequotes=[
    "Quote - Game Name",
    //add more quotes here
];


$albumquotes=[
    "Quote - Artist Name",
    //add more quotes here
];


echo $bookquotes[array_rand($bookquotes)];
echo $moviequotes[array_rand($moviequotes)];
echo $tvquotes[array_rand($tvquotes)];
echo $videogamequotes[array_rand($videogamequotes)];
echo $albumquotes[array_rand($albumquotes)];
?>
