/**
 * This file is present in:
 * 1. diary.php
 * 2. feed.php
 * 3  media_book.php
 * 4. media_music.php
 * 5. media_tv.php
 * 6. media_videogame.php
 * 7. media_movie.php
 * 8. mutual_view.php
 * 9. privacy_policy.php 
 * 10. media_list_view.php
 * 11. badges.php
 * 12. followers.php
 * 13. following.php
 * 
 */



var mybutton = document.getElementById("BackToTopBtn");

//this onscroll event will trigger 2 functions
window.onscroll = function() {
    scrollFunction(); //this is a scroll to top button function
    scrollFunction2(); //this is a navbar resize function when user scrolls down the navbar size reduces.
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function scrollFunction2() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        document.getElementById("myHeader").style.fontSize = "14px";
        document.getElementById("myHeader").style.paddingTop = "2px";
        document.getElementById("myHeader").style.paddingBottom = "2px";

    } else {
        document.getElementById("myHeader").style.fontSize = "16px";
        document.getElementById("myHeader").style.paddingTop = "10px";
        document.getElementById("myHeader").style.paddingBottom = "10px";
    }
}