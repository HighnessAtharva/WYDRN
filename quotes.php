<?php
/**
 * TO STORE QUOTES RELATED TO MEDIAS AND GET RANDOM QUOTE FOR EACH MEDIA TO DISPLAY ON OTHER PAGES. 
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */

$bookquotes=[
    "Nothing is insoluble. Nothing is hopeless. Not while there's life. -  Alan Moore",
    "So many books, so little time.-  Frank Zappa",
    //add 13 more quotes here
];

$moviequotes=[
    "Quote - Movie Name",
    //add 14 more quotes here
];


$tvquotes=[
    "Quote - Show Name",
    //add 14 more quotes here
];


$videogamequotes=[
    "Quote - Game Name",
    //add more quotes here
];


$albumquotes=[
    "Quote - Artist Name",
    //add 14 more quotes here
];


echo $bookquotes[array_rand($bookquotes)];
echo $moviequotes[array_rand($moviequotes)];
echo $tvquotes[array_rand($tvquotes)];
echo $videogamequotes[array_rand($videogamequotes)];
echo $albumquotes[array_rand($albumquotes)];
?>
