// Application name: WYDRN
// API key: 6a4eb1d0536cfe3583784a65332ee179
// Shared-secret: c953036f143092a6f452413b1a13d8ea
// Registered to: HighnessAtharva

const albumSearchBox = document.getElementById('movie-search-box');
const searchList = document.getElementById('search-list');
const resultGrid = document.getElementById('result-grid');

//https://api.discogs.com/database/search?q=Heart&format=album&key=GbtsdCNjHakVzCoxtiCA&secret=tOdlsCemqLtJdEIJxIxOGsLRmyeJlbSQ


// load movies from API
async function loadAlbums(searchTerm) {
    const URL = `https://api.discogs.com/database/search?q=${searchTerm}&format=album&type=master&key=GbtsdCNjHakVzCoxtiCA&secret=tOdlsCemqLtJdEIJxIxOGsLRmyeJlbSQ`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']
        //console.log(results);
    if (data) displayAlbumList(results);
}

function findAlbum() {
    let searchTerm = (albumSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchList.classList.remove('hide-search-list');
        loadAlbums(searchTerm);
    } else {
        searchList.classList.add('hide-search-list');
    }
}

function displayAlbumList(albums) {
    searchList.innerHTML = "";
    for (let idx = 0; idx < albums.length; idx++) {
        let albumListItem = document.createElement('div');
        albumListItem.dataset.id = albums[idx]['id']; // setting movie id in  data-id
        albumListItem.classList.add('search-list-item');
        if (albums[idx]['thumb'] != null)
            albumPoster = albums[idx]['thumb'];
        else
            albumPoster = "https://i.ibb.co/hRCvsdq/image-not-found.png";
        albumListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "${albumPoster}">
        </div>
        <div class = "search-item-info">
            <h3>${albums[idx]['title']}</h3>
            <p>${albums[idx]['year']}</p>
        </div>`;
        searchList.appendChild(albumListItem);
    }
    loadalbumDetails();
}

function loadalbumDetails() {
    const searchListAlbums = searchList.querySelectorAll('.search-list-item');
    searchListAlbums.forEach(album => {
        album.addEventListener('click', async() => {
            // console.log(album.dataset.id);
            searchList.classList.add('hide-search-list');
            albumSearchBox.value = "";
            const result = await fetch(`https://api.discogs.com/masters/${album.dataset.id}`);
            const albumDetails = await result.json();
            //console.log(albumDetails);
            displayalbumDetails(albumDetails);
        });
    });
}

function displayalbumDetails(details) {
    // need to figure out a way to add images here!
    resultGrid.innerHTML = `
    <div class = "movie-poster">
        <img src = "${(details['thumb'] != null) ?  details['thumb'] : "https://i.ibb.co/hRCvsdq/image-not-found.png"}" alt = "album poster">
    </div>
    <div class = "movie-info">
        <h3 class = "movie-title">${details['title']} - ${details['artists'][0]['name']}</h3>
        <ul class = "movie-misc-info">
            <li class = "year">Release Date: ${details['year']}</li>
        </ul>
        <p class = "genre"><b>Genre:</b> ${details['genres']}</p>
    </div>
    `;
}


window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});