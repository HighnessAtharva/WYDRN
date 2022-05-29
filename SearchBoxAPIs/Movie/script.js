let movieSearchBox = document.getElementById('movie-search-box');
let movieYearBox = document.getElementById('movie-year');
let searchList = document.getElementById('search-list');

// load movies from API based on search term typed in input box
function findMovies() {
    let searchTerm = (movieSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchList.classList.remove('hide-search-list');
        loadMovies(searchTerm);
    } else {
        searchList.classList.add('hide-search-list');
    }
}

// load movies from API and call the displayMovieList function
async function loadMovies(searchTerm) {
    const URL = `https://api.themoviedb.org/3/search/movie?api_key=e446bc89015229cf337e16b0849d506c&language=en-US&query=${searchTerm}&page=1&include_adult=true`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']
    console.log(results);
    if (data) displayMovieList(results);
}

// display the list of movies returned from API below the search bar
function displayMovieList(movies) {
    searchList.innerHTML = "";
    for (let idx = 0; idx <= 3; idx++) {
        let movieListItem = document.createElement('div');
        movieListItem.dataset.id = movies[idx]['id']; // setting movie id in  data-id
        movieListItem.classList.add('search-list-item');
        if (movies[idx]['poster_path'] != "")
            moviePoster = movies[idx]['poster_path'];
        else
            moviePoster = "https://i.ibb.co/hRCvsdq/image-not-found.png";
        movieListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "https://image.tmdb.org/t/p/w185/${moviePoster}">
        </div>
        <div class = "search-item-info">
            <h3>${movies[idx]['original_title']}</h3>
            <p>${movies[idx]['release_date']}</p>
        </div>`;
        searchList.appendChild(movieListItem);
    }
    loadMovieDetails();
}

function loadMovieDetails() {
    const searchListMovies = searchList.querySelectorAll('.search-list-item');
    searchListMovies.forEach(movie => {
        movie.addEventListener('click', async() => {
            // console.log(movie.dataset.id);
            searchList.classList.add('hide-search-list');
            movieSearchBox.value = "";

            const result = await fetch(`https://api.themoviedb.org/3/movie/${movie.dataset.id}?api_key=e446bc89015229cf337e16b0849d506c&language=en-US`);
            const movieDetails = await result.json();
            console.log(movieDetails['original_title'], movieDetails['release_date']);
            movieSearchBox.value = movieDetails['original_title'];
            movieYearBox.value = movieDetails['release_date'];
        });
    });
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});