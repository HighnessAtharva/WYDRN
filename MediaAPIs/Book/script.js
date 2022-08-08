/*********************************

API DETAILS FOR BOOK SEARCH

API USED: GoogleBooks API (https://developers.google.com/books/docs/v1/using)
Application name: WYDRN
API key: N/A (None Required to Access Publicly Avaiable Data)

*********************************/

const BooksearchBox = document.getElementById('movie-search-box');
const searchList = document.getElementById('search-list');
const resultGrid = document.getElementById('result-grid');

// load movies from API
async function loadBooks(searchTerm) {
    const URL = `https://www.googleapis.com/books/v1/volumes?q=${searchTerm}&orderBy=relevance`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['items']
    if (data) displayBookList(results);
}

function findBook() {
    let searchTerm = (BooksearchBox.value).trim();
    if (searchTerm.length >= 2) {
        searchList.classList.remove('hide-search-list');
        loadBooks(searchTerm);
    } else {
        searchList.classList.add('hide-search-list');
    }
}

function displayBookList(Books) {
    searchList.innerHTML = "";
    //NOTE: TRY TO REDUCE THE LENGTH OF THE LOOP. USE AT MOST 3 TO REDUCE API CALLS.
    for (let idx = 0; idx < 3; idx++) {
        let BookListItem = document.createElement('div');
        BookListItem.dataset.id = Books[idx]['id']; // setting book id in data id
        BookListItem.classList.add('search-list-item');

        //works without error 
        // if (Books[idx]['volumeInfo']['imageLinks'] != null) {
        //     BookPoster = Books[idx]['volumeInfo']['imageLinks'];
        // }

        //does not work for half the books
        // if (Books[idx]['volumeInfo']['imageLinks']['thumbnail'] != null) {
        //     BookPoster = Books[idx]['volumeInfo']['imageLinks']['thumbnail'];
        // }

        //this goes in the .innerHTML
        // <div class = "search-item-thumbnail">
        //     <img src = "${BookPoster}">
        // </div>
        BookListItem.innerHTML = `
     
        <div class = "search-item-info">
            <h3>${Books[idx]['volumeInfo']['title']}</h3>
            <p>${Books[idx]['volumeInfo']['authors']}</p>
        </div>`;
        searchList.appendChild(BookListItem);
    }
    loadBookDetails();
}

function loadBookDetails() {
    const searchListBooks = searchList.querySelectorAll('.search-list-item');
    searchListBooks.forEach(Book => {
        Book.addEventListener('click', async() => {
            searchList.classList.add('hide-search-list');
            BooksearchBox.value = "";
            const result = await fetch(`https://www.googleapis.com/books/v1/volumes/${Book.dataset.id}`);
            const BookDetails = await result.json();
            console.log(BookDetails['volumeInfo']);
            displayBookDetails(BookDetails['volumeInfo']);
        });
    });
}

function displayBookDetails(details) {

    var description = null;
    if ('description' in details) {
        description = details['description'];
    } else {
        description = "No Description Available";
    }


    console.log(details);

    resultGrid.innerHTML = `
    <div class = "movie-poster">
        <img src = "${(details['imageLinks']['thumbnail'] !=null) ? details['imageLinks']['thumbnail'] : "../../images/API/WYDRNbook.png"}" alt = "Book poster">
    </div>
    <div class = "movie-info">
        <h3 class = "movie-title">${details['title']} - ${details['authors']}</h3>

        <ul class = "movie-misc-info">
            <li class = "year">Release Date: ${details['publishedDate']}</li>
        </ul>
<br>
<ul class = "movie-misc-info">
        <li class = "year">Publisher: ${details['publisher']}</li><br>
        </ul>
        <br>Summary:<br><p>${description}</p>`;
}

window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchList.classList.add('hide-search-list');
    }
});