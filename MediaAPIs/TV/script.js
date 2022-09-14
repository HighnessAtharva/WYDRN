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
    const URL = `https://api.themoviedb.org/3/search/tv?api_key=${tvKey}&language=en-US&page=1&query=${searchTerm}&include_adult=false`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    let results = data['results']
        // console.log(results);
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



//dropdown list that appears right below the search box.
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
            tvPoster = "../../images/API/WYDRNtv.png";

        let year = null;
        if ('first_air_date' in tvseries[idx]) {
            year = tvseries[idx]['first_air_date'].split("-");
            year = year[0];
        } else {
            year = "N/A";
        }




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
            // console.log(tvDetails);
            displaytvDetails(tvDetails);
        });
    });
}




//print out the actual content fetched from the API
function displaytvDetails(details) {
    console.log(details);

    // to handle missing first air date
    let year = null;
    if ('first_air_date' in details) {
        year = details['first_air_date'].split("-");
        year = year[0];
    } else {
        year = "N/A";
    }

    if (year.length != 4) {
        year = "N/A";
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
    let overview = null;
    if ('overview' in details) {
        if (details['overview'].length == 0) {
            overview = "N/A";
        } else {
            overview = details['overview'];
        }
    }

    let episodes = null;
    if ('number_of_episodes' in details) {
        episodes = details['number_of_episodes'];
    } else {
        episodes = "N/A";
    }

    // TO CONVERT ISO LANGUAGE FORMAT TO FULL NAME. EX: EN -> ENGLISH 
    let languageNames = new Intl.DisplayNames(['en'], { type: 'language' });


    let tmdbLink = null;
    if ('id' in details) {
        tmdbLink = 'https://www.themoviedb.org/tv/' + details['id'];
    } else {
        tmdbLink = '#';
    }

    resultGrid.innerHTML = `<div class="movie-card">

    <div class="container2">

        <a href="#"><img src ="${(details['poster_path'] != null) ? "https://image.tmdb.org/t/p/original/"+ details['poster_path'] : "../../images/API/WYDRNtv.png"}" alt = "movie poster" class="cover" /></a>

        <div class="hero">
            <div class="details">
                <div class="title1">${details['original_name']}</div>
                <div class="title2"><span>${year}</span></div>
            </div> <!-- end details -->
        </div><!-- end hero -->
        

        <div class="description">
            <div class="column1">
                <span class="tag">${genres}</span><br><br>
                <span class="tag">Episodes: ${episodes}</span>
            </div> <!-- end column1 -->
           

            <div class="column2">
            <p class="plot-summary">Summary</p>
                <p> ${overview}</p><br><br>
                <b>Read more about this TV show on <a href="${tmdbLink}" target="_blank">TMDB</a></b>
            </div>    <!-- end column2 -->
        </div>   <!-- end description -->
    </div>
    <!-- end container -->
</div>`;
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});