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
    "It's the possibility of having a dream come true that makes life interesting. - Paulo Coelho",
    "What's the point of having a voice if you're gonna be silent in those moments you shouldn't be? - Angie Thomas",
    "Too much sanity may be madness — and maddest of all: to see life as it is, and not as it should be! - Miguel de Cervantes Saavedra",
    "That's the thing about books. They let you travel without moving your feet. - Jhumpa Lahiri",
    "Not all those who wander are lost. - J.R.R. Tolkein",
    “Those who don’t believe in magic will never find it. — Roald Dahl",
    “It is better to be hated for what you are than to be loved for what you are not. - André Gide",
    “The worst enemy to creativity is self-doubt. - Sylvia Plath",
    “Even the darkest night will end and the sun will rise. - Victor Hugo",
    “To choose doubt as a philosophy of life is akin to choosing immobility as a means of transportation. - Yann Martel",
    "Happiness can be found, even in the darkest of times, if one only remembers to turn on the light. - J.K. Rowling",
    “We can know only that we know nothing. And that is the highest degree of human wisdom. ― Leo Tolstoy",
    “If a book is well written, I always find it too short. ― Jane Austen",
    "There is no Friend as Loyal as a Book – Ernest Hemingway",

    //add 13 more quotes here
];

$moviequotes=[
    “A wise man can learn more from his enemies than a fool from his friends. – Niki Lauda",
    “Every man dies, but not every man really lives. – William Wallace",
    “Don’t let anyone ever make you feel like you don’t deserve what you want. – Heath Ledger",
    “Great men are not born great, they grow great. – Mario Puzo",
    “It’s what you do right now that makes a difference. – Struecker",
    “Just because someone stumbles and loses their path, doesn’t mean they’re lost forever. - Professor X",
    “Life is not the amount of breaths you take. It’s the moments that take your breath away. – Alex Hitchens",
    “Life moves pretty fast. If you don’t stop and look around once in a while, you could miss it. – Ferris Bueller",
    “Our lives are defined by opportunities, even the ones we miss. – Benjamin Button",
    “Our lives are not fully lived if we’re not willing to die for those we love, for what we believe. – Martin Luther King Jr.",
    "I figure life's a gift and I don't intend on wasting it. - Titanic",
    “If you focus on what you left behind, you will never be able to see what lies ahead. - Gusteau",
    “The very things that hold you down are going to lift you up. - Timothy Mouse",
    “All we have to decide is what to do with the time that is given to us. - Gandalf",
    “Carpe diem. Seize the day, boys. Make your lives extraordinary. - John Keating",

    //add 14 more quotes here
];


$tvquotes=[
   
    “You come at the king, you best not miss. — The Wire",
    “You can’t change your past, but you can let go and start your future. - Glee",
    “Don’t be sorry, be fierce. - Ru Paul's Drag Race",
    “Treat yo’self. - Parks and Recreation",
    “Learning requires failure. - Atlanta",
    "It's not the broken dreams that break us. It's the ones we don't dare to dream. - Glee",
    "You don't win alone. That's how it is. - Haikyuu",
    “The littlest thing can cause a ripple effect that changes your life. — How I Met Your Mother",
    "You know how they say that youth is wasted on the young? Well, I say don’t let the wisdom of age be wasted on you. - Ted Lasso",
    "All the angels are gone, son. There's only devils left.  - Yellowstone",
    "You can’t play God without being acquainted with the devil. - Westworld",
    "Evil is evil. Lesser, greater, middling, it’s all the same. - The Witcher",
    "Sometimes we are what we are, and we should embrace that. - Lucifer",
    "He who fights by the sword, dies by it. - Peaky Blinders",
    "It might be stormy now, but it can’t rain forever. - Outer Banks",

    //add 14 more quotes here
];


$videogamequotes=[
   "What is better? To be born good or to overcome your evil nature through great effort? - The Elder Scrolls",
   "The right man in the wrong place can make all the difference in the world. - Half-Life 2
   "Stand in the ashes of a trillion dead souls, and asks the ghosts if honor matters. The silence is your answer. - Mass effect 3
   "Wanting something does not give you the right to have it. - Assassin's Creed 2
   "Even in dark times, we cannot relinquish the things that make us human." - Metro 2033		
   "No gods or kings. Only man. - BioShock",
   "If our lives are already written, it would take a courageous man to change the script. - Alan Wake",
   "The courage to walk into the Darkness, but strength to return to the Light. - Destiny",
   "Don't wish it were easier, wish you were better. - Animal Crossing",
   "Good men mean well. We just don't always end up doing well. - Dead Space 3",
   "War. War never changes. - Fallout 3",
   "You can’t undo what you’ve already done, but you can face up to it. - Silent Hill: Downpour",
   "Endure and survive. - The Last Of Us",
   "You are here, and it’s beautiful, and escaping isn’t always something bad. - Firewatch",
   "Life is all about resolve. Outcome is secondary. - Okami",

    //add more quotes here
];


$albumquotes=[
    "To send light into the darkness of men's hearts - such is the duty of the artist. - Robert Schumann",
    “Lose your dreams and you might lose your mind. - Mick Jagger",
    “The beautiful thing about learning is that nobody can take it away from you. - BB King",
    “One good thing about music, when it hits you, you feel no pain. - Bob Marley",
    “Music is the divine way to tell beautiful, poetic things to the heart. - Pablo Casals",
    “Life is what happens when you’re making other plans. - John Lennon",
    “Music can change the world because it can change people. - Bono",
    “Music is the movement of sound to reach the soul for the education of its virtue. - Plato",
    “Music hath charms to soothe the savage beast, to soften rocks or bend a knotted oak. - William Congreve",
    “Too many pieces of music finish too long after the end. - Igor Stravinsky",
    “Music gives a soul to the universe, wings to the mind, flight to the imagination, and life to everything. - Plato",
    “Without deviation from the norm, progress is not possible. - Frank Zappa",
    “Imagination creates reality. - Richard Wagner",
    “Dare to wear the foolish clown face. - Frank Sinatra",
    “Everything is scary if you look at it. So you just got to live it. - Mary J. Blige",

    //add 14 more quotes here
];


echo $bookquotes[array_rand($bookquotes)];
echo $moviequotes[array_rand($moviequotes)];
echo $tvquotes[array_rand($tvquotes)];
echo $videogamequotes[array_rand($videogamequotes)];
echo $albumquotes[array_rand($albumquotes)];
?>
