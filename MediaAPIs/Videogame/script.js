const gameSearchBox = document.getElementById('movie-search-box');
const searchList = document.getElementById('search-list');
const resultGrid = document.getElementById('result-grid');
// e446bc89015229cf337e16b0849d506c

// load movies from API
async function loadgame(searchTerm) {

    const URL = `https://api.rawg.io/api/games?search=${searchTerm}&key=fe197746ce494b4791441d9a9161c1be`;
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
            gamePoster = "https://i.ibb.co/hRCvsdq/image-not-found.png";
        gameListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "${gamePoster}">
        </div>
        <div class = "search-item-info">
            <h3>${game[idx]['name']}</h3>
            <p>${game[idx]['released']}</p>
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

            const result = await fetch(`https://api.rawg.io/api/games/${game.dataset.id}?key=fe197746ce494b4791441d9a9161c1be`);
            const gameDetails = await result.json();
            displaygameDetails(gameDetails);
        });
    });
}

function displaygameDetails(details) {
    // add developers
    // add genre
    //       

    resultGrid.innerHTML = `
    <div class = "movie-poster">
        <img src = "${(details['background_image'] != null) ?  details['background_image'] : "https://i.ibb.co/hRCvsdq/image-not-found.png"}" alt = "game poster">
    </div>
    <div class = "movie-info">
        <h3 class = "movie-title">${details['name_original']}</h3>
        <ul class = "movie-misc-info">
            <li class = "year">Release Date: ${details['released']}</li>
        </ul>
        <p class = "language"><b>Publisher:</b> ${details['publishers'][0]['name']}</p><br>
        <p class = "genre"><b>Genre:</b> ${details['genres'][0]['name']}</p><br>
        <p class = "plot"><b>Plot:</b> ${details['description_raw']}</p>
        
        
    </div>
    `;
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});