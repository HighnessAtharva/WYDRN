window.onscroll = function() {
    scrollFunction2(); //this is a navbar resize function when user scrolls down the navbar size reduces.
};



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