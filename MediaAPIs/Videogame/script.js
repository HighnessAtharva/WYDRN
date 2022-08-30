/*******************************
API DETAILS FOR VIDEOGAME SEARCH

API USED: RAWG API (https://rawg.io/apidocs)
Application name: WYDRN
API key: fe197746ce494b4791441d9a9161c1be
Registered to: HighnessAtharva
Rate Limit: 20000 requests per month. Renews on 12th of every month

********************************/
const gameKey = "fe197746ce494b4791441d9a9161c1be";
const gameSearchBox = document.getElementById('movie-search-box');
const searchList = document.getElementById('search-list');
const resultGrid = document.getElementById('result-grid');

// load movies from API
async function loadgame(searchTerm) {

    const URL = `https://api.rawg.io/api/games?search=${searchTerm}&key=${gameKey}`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results'];

    if (data) displaygameList(results);
}

function findgame() {
    let searchTerm = (gameSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchList.classList.remove('hide-search-list');
        loadgame(searchTerm);
    } else {
        searchList.classList.add('hide-search-list');
    }
}

function displaygameList(game) {
    searchList.innerHTML = "";
    for (let idx = 0; idx < 3; idx++) {
        let gameListItem = document.createElement('div');
        gameListItem.dataset.id = game[idx]['id']; // setting movie id in  data-id
        gameListItem.classList.add('search-list-item');
        if (game[idx]['background_image'] != null)
            gamePoster = game[idx]['background_image'];
        else
            gamePoster = "../../images/API/WYDRNgame.png";
        let year = game[idx]['released'];
        year = year.split("-");
        year = year[0];
        gameListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "${gamePoster}">
        </div>
        <div class = "search-item-info">
            <h3>${game[idx]['name']}</h3>
            <p>${year}</p>
        </div>`;
        searchList.appendChild(gameListItem);
    }
    loadgameDetails();
}

function loadgameDetails() {
    const searchListgame = searchList.querySelectorAll('.search-list-item');
    searchListgame.forEach(game => {
        game.addEventListener('click', async() => {

            searchList.classList.add('hide-search-list');
            gameSearchBox.value = "";

            const result = await fetch(`https://api.rawg.io/api/games/${game.dataset.id}?key=${gameKey}`);
            const gameDetails = await result.json();
            displaygameDetails(gameDetails);
        });
    });
}

function displaygameDetails(details) {
    if (details === undefined) {
        resultGrid.innerHTML += "NO DATA AVAILABLE FOR THIS VIDEOGAME";
    }
    console.log(details)

    let year = details['released'];
    year = year.split("-");
    year = year[0];

    var genres = null;
    if ('genres' in details) {
        genres = details['genres'];
        if (genres.length > 0) {
            genres = genres[0]['name']
        } else {
            genres = "NA"
        }

    } else {
        genres = "NA";

    }

    var publisher = null;
    if ('publishers' in details) {
        publisher = details['publishers'];
        if (publisher.length > 0) {
            publisher = publisher[0]['name'];
        } else {
            publisher = "NA";
        }
        // console.log('Yes')
    } else {

        publisher = "NA";
    }

    // resultGrid.innerHTML = `
    // <div class = "movie-poster">
    //     <img src = "${(details['background_image'] != null) ?  details['background_image'] : "../../images/API/WYDRNgame.png"}" alt = "game poster" width="500" height="300">
    // </div>

    // <div class = "movie-info">
    //     <h3 class = "movie-title">${details['name_original']}</h3>
    //     <br>
    //     <p class = "year"><b>Released:</b> ${year}</p>
    //     <p class = "language"><b>Publisher:</b> ${publisher}</p><br>
    //     <p class = "genre"><b>Genre:</b> ${genres}</p><br>

    //     <p class = "plot summary"><b>Plot:</b> ${details['description']}</p>    
    // </div>
    // `;
    resultGrid.innerHTML = `<div class="movie-card">

    <div class="container2">

        <a href="#"><img src = "${(details['background_image'] != null) ?  details['background_image'] : "../../images/API/WYDRNgame.png"}" alt = "game poster" class="cover" /></a>

        <div class="hero">

            <div class="details">

                <div class="title1">${details['name_original']}</div>

                <div class="title2"><span>${publisher}</span></div>





            </div>
            <!-- end details -->

        </div>
        <!-- end hero -->

        <div class="description">

            <div class="column1">
                <span class="tag">${genres}</span><br><br>
                <span class="tag">${year}</span>
            </div>
            <!-- end column1 -->

            <div class="column2">
            <p class="plot-summary">Summary</p>
                <p> ${details['description']}</p>
            </div>
            <!-- end column2 -->
        </div>
        <!-- end description -->


    </div>
    <!-- end container -->
</div>`;

}



window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});