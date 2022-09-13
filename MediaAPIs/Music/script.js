/*********************************

API DETAILS FOR ALBUM SEARCH

API USED: LastFM (https://www.last.fm/api)
Application name: WYDRN
API key: 6a4eb1d0536cfe3583784a65332ee179
Shared-secret: c953036f143092a6f452413b1a13d8ea
Registered to: HighnessAtharva

*********************************/

const musicKey = "6a4eb1d0536cfe3583784a65332ee179";
const albumSearchBox = document.getElementById('movie-search-box');
const searchList = document.getElementById('search-list');
const resultGrid = document.getElementById('result-grid');


// load movies from API
async function loadAlbums(searchTerm) {
    const URL = `https://ws.audioscrobbler.com/2.0/?method=album.search&album=${searchTerm}&limit=3&api_key=${musicKey}&format=json`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['results']['albummatches']['album'];

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



//dropdown list that appears right below the search box.
function displayAlbumList(albums) {
    searchList.innerHTML = "";
    //NOTE: TRY TO REDUCE THE LENGTH OF THE LOOP. USE AT MOST 3 TO REDUCE API CALLS.
    for (let idx = 0; idx < albums.length; idx++) {
        let albumListItem = document.createElement('div');
        //albumListItem.dataset.id = albums[idx]['id']; // setting movie id in  data-id
        albumListItem.dataset.name = albums[idx]['name'];
        albumListItem.dataset.artist = albums[idx]['artist'];
        albumListItem.classList.add('search-list-item');
        // albumPoster = "../../images/API/WYDRNmusic.png";
        // if (albums[idx]['image'][1]["#text"] != null)
        //     albumPoster = albums[idx]['image'][1]["#text"];
        if (albums[idx]['image'][1]['#text'] != "") {
            albumPoster = albums[idx]['image'][1]['#text'];
        } else {
            albumPoster = '../../images/API/WYDRNmusic.png'
        }

        albumListItem.innerHTML = `
        <div class = "search-item-thumbnail">
            <img src = "${albumPoster}">
        </div>
        <div class = "search-item-info">
            <h3>${albums[idx]['name']}</h3>
            <p>${albums[idx]['artist']}</p>
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
            //https: //ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=6a4eb1d0536cfe3583784a65332ee179&artist=${album.dataset.artist}&album=${album.dataset.name}&format=json
            const result = await fetch(`https://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=${musicKey}&artist=${album.dataset.artist}&album=${album.dataset.name}&format=json`);
            const albumDetails = await result.json();
            //console.log(albumDetails);
            displayalbumDetails(albumDetails['album']);
        });
    });
}



//print out the actual content fetched from the API
function displayalbumDetails(details) {
    // need to figure out a way to add images here!
    console.log(details);
    if (details === undefined) {
        resultGrid.innerHTML += "NO DATA AVAILABLE FOR THIS ALBUM";
    }
    const name = details['name'];
    const artist = details['artist']

    // TO HANDLE MISSING TAGS
    var tags = null;
    if (details['tags'] === "") {
        tags = "NA";
    } else {
        tags = details['tags']['tag'][0]['name'];
        tags = titleCase(tags);
    }

    // TO HANDLE MISSING SUMMARY
    var summary = null;
    if ('wiki' in details) {
        summary = details['wiki']['summary'];
    } else {
        summary = "Not available";
    }

    if (details['image'][4]['#text'] != "") {
        albumPoster = details['image'][4]['#text'];
    } else {
        albumPoster = '../../images/API/WYDRNmusic.png'
    }

    resultGrid.innerHTML = `
    <div class="movie-card">
        <div class="container2">

            <a href="#"><img src = "${albumPoster}" alt = "album poster" class="cover" /></a>
            <div class="hero">
                <div class="details">
                    <div class="title1">${name} </div>
                    <div class="title2"><span>${artist}</span></div>
                </div>
            </div>
            

            <div class="description">
                <div class="column1">
                    <span class="tag">${tags}</span><br><br>
                </div>
                <!-- end column1 -->

                <div class="column2">
                    <p class="plot-summary">Summary</p>
                    <p> ${summary} </p>
                    </div>    </div>
                        </div>
                    </div>
             `;
    // for (let idx = 0; idx < details['tracks']['track'].length; idx++) {
    //     resultGrid.innerHTML += `${idx+1}. ${details['tracks']['track'][idx]['name']}`;
    // }



}

window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});

function titleCase(str) {
    return str.toLowerCase().split(' ').map(function(word) {
        return word.replace(word[0], word[0].toUpperCase());
    }).join(' ');
}