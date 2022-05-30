/*********************************

API DETAILS FOR BOOK SEARCH

API USED: GoogleBooks API (https://developers.google.com/books/docs/v1/using)
Application name: WYDRN
API key: N/A (None Required to Access Publicly Avaiable Data)

*********************************/


const BooksearchBox = document.getElementById('book-search-box');
const BookAuthor = document.getElementById('book-author');
const searchListBooks = document.getElementById('search-list-book');

// load movies from API
async function loadBooks(searchTerm) {
    const URL = `https://www.googleapis.com/books/v1/volumes?q=${searchTerm}&orderBy=relevance`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    var results = data['items']
        // console.log(results);
    if (data) displayBookList(results);
}

function findBook() {
    let searchTerm = (BooksearchBox.value).trim();
    if (searchTerm.length >= 2) {
        searchListBooks.classList.remove('hide-search-list');
        loadBooks(searchTerm);
    } else {
        searchListBooks.classList.add('hide-search-list');
    }
}

function displayBookList(Books) {
    searchListBooks.innerHTML = "";
    for (let idx = 0; idx < Books.length; idx++) {
        let BookListItem = document.createElement('div');
        BookListItem.dataset.id = Books[idx]['id'];
        // console(BookListItem.dataset.id);
        BookListItem.classList.add('search-list-item');

        BookListItem.innerHTML = `     
        <div class = "search-item-info">
            <h3>${Books[idx]['volumeInfo']['title']}</h3>
            <p>${Books[idx]['volumeInfo']['authors']}</p>
        </div>`;
        searchListBooks.appendChild(BookListItem);
    }
    loadBookDetails();
}

function loadBookDetails() {
    const booklist = searchListBooks.querySelectorAll('.search-list-item');
    booklist.forEach(Book => {
        Book.addEventListener('click', async() => {
            searchListBooks.classList.add('hide-search-list');
            BooksearchBox.value = "";
            const result = await fetch(`https://www.googleapis.com/books/v1/volumes/${Book.dataset.id}`);
            const BookDetails = await result.json();
            // console.log(BookDetails['volumeInfo']);
            BooksearchBox.value = BookDetails['volumeInfo']['title'];
            BookAuthor.value = BookDetails['volumeInfo']['authors'];
            BooksearchBox.setAttribute("readonly", "readonly");
            BookAuthor.setAttribute("readonly", "readonly");
        });
    });
}

window.addEventListener('click', (event) => {
    if (event.target.className != "form-control") {
        searchListBooks.classList.add('hide-search-list');
    }
});