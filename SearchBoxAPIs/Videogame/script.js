/*

VIDEOGAMES 

*/
const gameSearchBox = document.getElementById('game-search-box');
const searchListGames = document.getElementById('search-list-games');

function findgame() {
    let searchTerm = (gameSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchListGames.classList.remove('hide-search-list');
        loadgame(searchTerm);
    } else {
        searchListGames.classList.add('hide-search-list');
    }
}

// load movies from API
async function loadgame(searchTerm) {
    const URL = `https://api.rawg.io/api/games?search=${searchTerm}&key=fe197746ce494b4791441d9a9161c1be`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results'];

    if (data) displaygameList(results);
}



function displaygameList(game) {
    searchListGames.innerHTML = "";
    for (let idx = 0; idx < 3; idx++) {
        let gameListItem = document.createElement('div');
        gameListItem.dataset.id = game[idx]['id'];
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
        searchListGames.appendChild(gameListItem);
    }
    loadgameDetails();
}

function loadgameDetails() {
    const gamelist = searchListGames.querySelectorAll('.search-list-item');
    gamelist.forEach(game => {
        game.addEventListener('click', async() => {

            searchListGames.classList.add('hide-search-list');
            gameSearchBox.value = "";

            const result = await fetch(`https://api.rawg.io/api/games/${game.dataset.id}?key=fe197746ce494b4791441d9a9161c1be`);
            const gameDetails = await result.json();
            gameSearchBox.value = gameDetails['name_original'];
            gameSearchBox.setAttribute("readonly", "readonly");

        });
    });
}

window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchListGames.classList.add('hide-search-list');
    }
});