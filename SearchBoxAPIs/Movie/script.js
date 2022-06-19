/*******************************
API DETAILS FOR MOVIE SEARCH

API USED: TMDB [Television and Movie Database] API (https://developers.themoviedb.org/3/getting-started/introduction)
Application name: Movie-Web-App
API key: e446bc89015229cf337e16b0849d506c
Registered to: HighnessAtharva

********************************/

const TDMBApiKey = "e446bc89015229cf337e16b0849d506c";
const movieSearchBox = document.getElementById('movie-search-box');
const movieYearBox = document.getElementById('movie-year');
const searchListMovies = document.getElementById('search-list-movies');

// load movies from API based on search term typed in input box
function findMovies() {
    let searchTerm = (movieSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchListMovies.classList.remove('hide-search-list');
        loadMovies(searchTerm);
    } else {
        searchListMovies.classList.add('hide-search-list');
    }
}

// load movies from API and call the displayMovieList function
async function loadMovies(searchTerm) {
    const URL = `https://api.themoviedb.org/3/search/movie?api_key=${TDMBApiKey}&language=en-US&query=${searchTerm}&page=1&include_adult=true`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']
        // console.log(results);
    if (data) displayMovieList(results);
}

// display the list of movies returned from API below the search bar
function displayMovieList(movies) {
    searchListMovies.innerHTML = "";
    for (let idx = 0; idx <= 3; idx++) {
        let movieListItem = document.createElement('div');
        movieListItem.dataset.id = movies[idx]['id']; // setting movie id in  data-id
        movieListItem.classList.add('search-list-item');
        if (movies[idx]['poster_path'] != "")
            moviePoster = movies[idx]['poster_path'];
        else
            moviePoster = "https://i.ibb.co/hRCvsdq/image-not-found.png";

        let name = movies[idx]['original_title'];
        let year = movies[idx]['release_date'];
        year = year.split("-");
        year = year[0];
        movieListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "https://image.tmdb.org/t/p/w185/${moviePoster}">
        </div>
        <div class = "search-item-info">
            <h3>${name}</h3>

            <p>${year}</p>
        </div>`;
        searchListMovies.appendChild(movieListItem);
    }
    loadMovieDetails();
}

function loadMovieDetails() {
    const movielist = searchListMovies.querySelectorAll('.search-list-item');
    movielist.forEach(movie => {
        movie.addEventListener('click', async() => {
            // console.log(movie.dataset.id);
            searchListMovies.classList.add('hide-search-list');
            movieSearchBox.value = "";

            const result = await fetch(`https://api.themoviedb.org/3/movie/${movie.dataset.id}?api_key=${TDMBApiKey}&language=en-US`);
            const movieDetails = await result.json();
            // console.log(movieDetails);
            //console.log(movieDetails['original_title'], movieDetails['release_date']);
            movieSearchBox.value = movieDetails['original_title'];
            let year = movieDetails['release_date']
            year = year.split("-");
            year = year[0];
            movieYearBox.value = year;
            movieSearchBox.setAttribute("readonly", "readonly");
            movieYearBox.setAttribute("readonly", "readonly");

        });
    });
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchListMovies.classList.add('hide-search-list');
    }
});