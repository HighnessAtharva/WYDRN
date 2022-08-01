/*******************************
API DETAILS FOR TV SERIES SEARCH

API USED: TMDB [Television and Movie Database] API (https://developers.themoviedb.org/3/getting-started/introduction)
Application name: Movie-Web-App
API key: e446bc89015229cf337e16b0849d506c
Registered to: HighnessAtharva

********************************/
const tvKey = "e446bc89015229cf337e16b0849d506c"
const tvSearchBox = document.getElementById('movie-search-box');
const searchList = document.getElementById('search-list');
const resultGrid = document.getElementById('result-grid');


// load movies from API
async function loadTV(searchTerm) {
    //https: //api.themoviedb.org/3/search/tv?api_key=e446bc89015229cf337e16b0849d506c&language=en-US&page=1&query=${searchTerm}&include_adult=true
    const URL = `https://api.themoviedb.org/3/search/tv?api_key=${tvKey}&language=en-US&page=1&query=${searchTerm}&include_adult=true`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']
    console.log(results);
    if (data) displayTVList(results);
}

function findTV() {
    let searchTerm = (tvSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchList.classList.remove('hide-search-list');
        loadTV(searchTerm);
    } else {
        searchList.classList.add('hide-search-list');
    }
}

function displayTVList(tvseries) {

    searchList.innerHTML = "";
    //NOTE: TRY TO REDUCE THE LENGTH OF THE LOOP. USE AT MOST 3 TO REDUCE API CALLS.
    for (let idx = 0; idx < tvseries.length; idx++) {
        let TVListItem = document.createElement('div');
        TVListItem.dataset.id = tvseries[idx]['id']; // setting movie id in  data-id
        TVListItem.classList.add('search-list-item');


        if (tvseries[idx]['poster_path'] != null)
            tvPoster = "https://image.tmdb.org/t/p/w185/" + tvseries[idx]['poster_path'];
        else
            tvPoster = "https://i.ibb.co/hRCvsdq/image-not-found.png";

        let year = tvseries[idx]['first_air_date'];
        year = year.split("-");
        year = year[0];


        TVListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "${tvPoster}">
        </div>
        <div class = "search-item-info">
            <h3>${tvseries[idx]['original_name']}</h3>
            <p>${year}</p>
        </div>`;
        searchList.appendChild(TVListItem);
    }
    loadtvDetails();
}

function loadtvDetails() {
    const searchListtv = searchList.querySelectorAll('.search-list-item');
    searchListtv.forEach(tv => {
        tv.addEventListener('click', async() => {
            // console.log(tv.dataset.id);
            searchList.classList.add('hide-search-list');
            tvSearchBox.value = "";
            const result = await fetch(`https://api.themoviedb.org/3/tv/${tv.dataset.id}?api_key=${tvKey}&language=en-US`);
            const tvDetails = await result.json();
            console.log(tvDetails);
            displaytvDetails(tvDetails);
        });
    });
}

function displaytvDetails(details) {
    let year = details['first_air_date'];
    year = year.split("-");
    year = year[0];

    // TO HANDLE MISSING GENRES
    let genres = null;
    if ('genres' in details) {
        if ('genres' [0]['name'] in details) {
            genres = details['genres'][0]['name'];
        }

    } else {
        genres = "NA";
    }

    resultGrid.innerHTML = `
    <div class = "movie-poster">
        <img src = "${(details['poster_path'] != null) ? "https://image.tmdb.org/t/p/original/"+ details['poster_path'] : "https://i.ibb.co/hRCvsdq/image-not-found.png"}" alt = "tv poster">
    </div>
    <div class = "movie-info">
        <h3 class = "movie-title">${details['original_name']}</h3>
        <ul class = "movie-misc-info">
            <li class = "year">Release Date: ${year}</li>
        </ul>
        <p class = "genre"><b>Genre:</b> ${genres}</p>
        <p class = "plot"><b>Plot:</b> ${details['overview']}</p>
        <p class = "language"><b>Language:</b> ${details['original_language']}</p>
        
    </div>
    `;
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});