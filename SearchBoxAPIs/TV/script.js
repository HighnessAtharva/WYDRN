/*******************************
API DETAILS FOR TV SERIES SEARCH

API USED: TMDB [Television and Movie Database] API (https://developers.themoviedb.org/3/getting-started/introduction)
Application name: Movie-Web-App
API key: e446bc89015229cf337e16b0849d506c
Registered to: HighnessAtharva

********************************/

const tvSearchBox = document.getElementById('tv-search-box');
const searchListTV = document.getElementById('search-list-tv');

// load movies from API
async function loadTV(searchTerm) {
    const URL = `https://api.themoviedb.org/3/search/tv?api_key=e446bc89015229cf337e16b0849d506c&language=en-US&page=1&query=${searchTerm}&include_adult=true`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']
        // console.log(results);
    if (data) displayTVList(results);
}

function findTV() {
    let searchTerm = (tvSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchListTV.classList.remove('hide-search-list');
        loadTV(searchTerm);
    } else {
        searchListTV.classList.add('hide-search-list');
    }
}

function displayTVList(tvseries) {
    searchListTV.innerHTML = "";
    for (let idx = 0; idx < tvseries.length; idx++) {
        let TVListItem = document.createElement('div');
        TVListItem.dataset.id = tvseries[idx]['id'];
        TVListItem.classList.add('search-list-item');
        if (tvseries[idx]['poster_path'] != null)
            tvPoster = tvseries[idx]['poster_path'];
        else
            tvPoster = "https://i.ibb.co/hRCvsdq/image-not-found.png";
        TVListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "https://image.tmdb.org/t/p/w185/${tvPoster}">
        </div>
        <div class = "search-item-info">
            <h3>${tvseries[idx]['original_name']}</h3>
            <p>${tvseries[idx]['first_air_date']}</p>
        </div>`;
        searchListTV.appendChild(TVListItem);
    }
    loadtvDetails();
}

function loadtvDetails() {
    const tvlist = searchListTV.querySelectorAll('.search-list-item');
    tvlist.forEach(tv => {
        tv.addEventListener('click', async() => {
            // console.log(tv.dataset.id);
            searchListTV.classList.add('hide-search-list');
            tvSearchBox.value = "";
            const result = await fetch(`https://api.themoviedb.org/3/tv/${tv.dataset.id}?api_key=e446bc89015229cf337e16b0849d506c&language=en-US`);
            const tvDetails = await result.json();
            // console.log(tvDetails);
            tvSearchBox.value = tvDetails['original_name'];
            tvSearchBox.setAttribute("readonly", "readonly");
        });
    });
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchListTV.classList.add('hide-search-list');
    }
});