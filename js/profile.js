$(document).ready(function() {

    //trigger videogame poster toggle
    $("#media-game").hover(function() {
        $("#gamePoster").css("opacity", "1");
        $("#header").css("opacity", "0.2");
        $("#header").css("background-color", "black");


    }, function() {
        $("#gamePoster").css("opacity", "0");
        $("#header").css("opacity", "1");
        // $("#header").css("background-color", "initial");

    });


    //trigger book poster toggle
    $("#media-book").hover(function() {
        $("#bookPoster").css("opacity", "1");
        $("#header").css("opacity", "0.2");
        $("#header").css("background-color", "black");
    }, function() {
        $("#bookPoster").css("opacity", "0");
        $("#header").css("opacity", "1");
        // $("#header").css("background-color", "initial");
    });


    //trigger movie poster toggle
    $("#media-movie").hover(function() {
        $("#moviePoster").css("opacity", "1");
        $("#header").css("opacity", "0.2");
        $("#header").css("background-color", "black");
    }, function() {
        $("#moviePoster").css("opacity", "0");
        $("#header").css("opacity", "1");
        // $("#header").css("background-color", "initial");
    });


    //trigger TV poster toggle
    $("#media-tv").hover(function() {
        $("#tvPoster").css("opacity", "1");
        $("#header").css("opacity", "0.2");
        $("#header").css("background-color", "black");
    }, function() {
        $("#tvPoster").css("opacity", "0");
        $("#header").css("opacity", "1");
        // $("#header").css("background-color", "initial");
    });


    //trigger TV poster toggle
    $("#media-music").hover(function() {
        $("#musicPoster").css("opacity", "1");
        $("#header").css("opacity", "0.2");
        $("#header").css("background-color", "black");
    }, function() {
        $("#musicPoster").css("opacity", "0");
        $("#header").css("opacity", "1");
        // $("#header").css("background-color", "initial");
    });







});