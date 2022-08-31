/*******************************
API DETAILS FOR MOVIE SEARCH

API USED: TMDB [Television and Movie Database] API (https://developers.themoviedb.org/3/getting-started/introduction)
Application name: Movie-Web-App
API key: e446bc89015229cf337e16b0849d506c
Registered to: HighnessAtharva

********************************/

const movieKey = "e446bc89015229cf337e16b0849d506c";
const movieSearchBox = document.getElementById('movie-search-box');
const searchList = document.getElementById('search-list');
const resultGrid = document.getElementById('result-grid');

// load movies from API
async function loadMovies(searchTerm) {
    const URL = `https://api.themoviedb.org/3/search/movie?api_key=${movieKey}&language=en-US&query=${searchTerm}&page=1&include_adult=true`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']
    console.log(results);
    if (data) displayMovieList(results);
}

function findMovies() {
    let searchTerm = (movieSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchList.classList.remove('hide-search-list');
        loadMovies(searchTerm);
    } else {
        searchList.classList.add('hide-search-list');
    }
}

function displayMovieList(movies) {
    searchList.innerHTML = "";
    //NOTE: TRY TO REDUCE THE LENGTH OF THE LOOP. USE AT MOST 3 TO REDUCE API CALLS.
    for (let idx = 0; idx < movies.length; idx++) {
        let movieListItem = document.createElement('div');
        movieListItem.dataset.id = movies[idx]['id']; // setting movie id in  data-id
        movieListItem.classList.add('search-list-item');
        if (movies[idx]['poster_path'] != null)
            moviePoster = "https://image.tmdb.org/t/p/w185/" + movies[idx]['poster_path'];
        else
            moviePoster = "../../images/API/WYDRNmovie.png";

        let year = movies[idx]['release_date'];
        year = year.split("-");
        year = year[0];
        movieListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "${moviePoster}">
        </div>
        <div class = "search-item-info">
            <h3>${movies[idx]['original_title']}</h3>
            <p>${year}</p>
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

            const result = await fetch(`https://api.themoviedb.org/3/movie/${movie.dataset.id}?api_key=${movieKey}&language=en-US`);
            const movieDetails = await result.json();
            // console.log(movieDetails);
            displayMovieDetails(movieDetails);
        });
    });
}

function displayMovieDetails(details) {
    if (details === undefined) {
        resultGrid.innerHTML += "NO DATA AVAILABLE FOR THIS MOVIE";
    }

    // TO HANDLE MISSING GENRES
    let genres = null;
    if ('genres' in details) {
        if (details['genres'].length == 0) {
            genres = "N/A";
        } else {
            genres = details['genres'][0]['name'];
        }
    } else {
        genres = "NA";
    }

    // TO HANDLE MISSING OVERVIEW
    var overview = null;
    if ('overview' in details) {
        if (details['overview'].length == 0) {
            overview = "N/A";
        } else {
            overview = details['overview'];
        }
    }

    console.log(details);

    release_year = details['release_date'];
    release_year = release_year.split("-");
    release_year = release_year[0];

    // TO CONVERT ISO LANGUAGE FORMAT TO FULL NAME. EX: EN -> ENGLISH 
    let languageNames = new Intl.DisplayNames(['en'], { type: 'language' });


    resultGrid.innerHTML = `<div class="movie-card">

        <div class="container2">

            <a href="#"><img src = "${(details['poster_path'] != null) ? "https://image.tmdb.org/t/p/original/"+ details['poster_path'] : "../../images/API/WYDRNmovie.png"}" alt = "movie poster" class="cover" /></a>

            <div class="hero">
                <div class="details">
                    <div class="title1">${details['original_title']}</div>
                    <div class="title2"><span>${release_year}</span></div>
                </div>   <!-- end details -->
            </div>  <!-- end hero -->
          

            <div class="description">
                <div class="column1">
                    <span class="tag">${genres}</span><br><br>
                    <span class="tag">Language: ${languageNames.of(details['original_language'])}</span>
                </div>
                <!-- end column1 -->

                <div class="column2">
                <p class="plot-summary">Summary</p>
                    <p> ${overview}</p>
                </div><!-- end column2 -->
            </div><!-- end description -->
            
        </div>
        <!-- end container -->
    </div>`;
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});