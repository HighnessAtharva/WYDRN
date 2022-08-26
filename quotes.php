<?php
/**
 * TO STORE QUOTES RELATED TO MEDIAS AND GET RANDOM QUOTE FOR EACH MEDIA TO DISPLAY ON OTHER PAGES.
 *
 * @version    PHP 8.0.12
 * @since      July 2022
 * @author     Rashmi Kamble
 */

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
