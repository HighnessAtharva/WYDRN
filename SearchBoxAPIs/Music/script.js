/*********************************

API DETAILS FOR ALBUM SEARCH

API USED: LastFM (https://www.last.fm/api)
Application name: WYDRN
API key: 6a4eb1d0536cfe3583784a65332ee179
Shared-secret: c953036f143092a6f452413b1a13d8ea
Registered to: HighnessAtharva

*********************************/

const LastFMAPIKey = "6a4eb1d0536cfe3583784a65332ee179";
const LastFMSecret = "c953036f143092a6f452413b1a13d8ea";
const albumSearchBox = document.getElementById('music-search-box');
const albumArtist = document.getElementById('music-artist');
const searchListAlbums = document.getElementById('search-list-music');

function findAlbum() {
    let searchTerm = (albumSearchBox.value).trim();
    if (searchTerm.length > 0) {
        searchListAlbums.classList.remove('hide-search-list');
        loadAlbums(searchTerm);
    } else {
        searchListAlbums.classList.add('hide-search-list');
    }
}

// load movies from API
async function loadAlbums(searchTerm) {
    const URL = `https://ws.audioscrobbler.com/2.0/?method=album.search&album=${searchTerm}&limit=3&api_key=${LastFMAPIKey}&format=json`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']['albummatches']['album'];
    // console.log(results);
    if (data) displayAlbumList(results);
}



function displayAlbumList(albums) {
    searchListAlbums.innerHTML = "";
    for (let idx = 0; idx < albums.length; idx++) {
        let albumListItem = document.createElement('div');
        //albumListItem.dataset.id = albums[idx]['id'];
        albumListItem.dataset.name = albums[idx]['name'];
        albumListItem.dataset.artist = albums[idx]['artist'];
        albumListItem.classList.add('search-list-item');
        if (albums[idx]['image'][1]["#text"] != null)
            albumPoster = albums[idx]['image'][1]["#text"];
        else
            albumPoster = "https://i.ibb.co/hRCvsdq/image-not-found.png";
        albumListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "${albumPoster}">
        </div>
        <div class = "search-item-info">
            <h3>${albums[idx]['name']}</h3>
            <p>${albums[idx]['artist']}</p>
        </div>`;
        searchListAlbums.appendChild(albumListItem);
    }
    loadalbumDetails();
}

function loadalbumDetails() {
    const albumlist = searchListAlbums.querySelectorAll('.search-list-item');
    albumlist.forEach(album => {
        album.addEventListener('click', async() => {
            // console.log(album.dataset.artist);
            // console.log(album.dataset.name);
            searchListAlbums.classList.add('hide-search-list');
            albumSearchBox.value = "";
            const result = await fetch(`https://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=${LastFMAPIKey}&artist=${album.dataset.artist}&album=${album.dataset.name}&format=json`);
            const albumDetails = await result.json();
            albumSearchBox.value = albumDetails['album']['name'];
            albumArtist.value = albumDetails['album']['artist'];
            albumSearchBox.setAttribute("readonly", "readonly");
            albumArtist.setAttribute("readonly", "readonly");

        });
    });
}

window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchListAlbums.classList.add('hide-search-list');
    }
});