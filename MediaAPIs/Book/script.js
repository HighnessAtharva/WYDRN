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
    let results = data['items']
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


//dropdown list that appears right below the search box.
function displayBookList(Books) {
    searchList.innerHTML = "";
    //NOTE: TRY TO REDUCE THE LENGTH OF THE LOOP. USE AT MOST 3 TO REDUCE API CALLS.
    for (let idx = 0; idx < 3; idx++) {
        let BookListItem = document.createElement('div');
        BookListItem.dataset.id = Books[idx]['id']; // setting book id in data id
        BookListItem.classList.add('search-list-item');

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
            // console.log(BookDetails['volumeInfo']);
            displayBookDetails(BookDetails['volumeInfo']);
        });
    });
}


//print out the actual content fetched from the API
function displayBookDetails(details) {
    console.log(details);

    let description = null;
    if ('description' in details) {
        description = details['description'];
    } else {
        description = "No Description Available";
    }

    let pub_date = details['publishedDate'];
    pub_date = pub_date.split("-");
    pub_date = pub_date[0];

    let googleBooks = details['infoLink'];

    resultGrid.innerHTML = `<div class="movie-card">

    <div class="container2">

    <a href="#"> <img src = "${(details['imageLinks']['thumbnail'] !=null) ? details['imageLinks']['thumbnail'] : "../../images/API/WYDRNbook.png"}" alt = "Book poster" class="cover"></a>

        <div class="hero">
            <div class="details">
                <div class="title1">${details['title']}</div>
                <div class="title2"><span>By ${details['authors']}</span></div>
            </div><!-- end details -->
        </div><!-- end hero -->
        

        <div class="description">

            <div class="column1"><br>
                <span class="tag">Published:  ${pub_date}</span><br><br>
            </div>
            <!-- end column1 -->

            <div class="column2">
            <p class="plot-summary">Summary</p>
                <p> ${description}<br><br>
                <b>Read more about this book on <a href="${googleBooks}" target="_blank">Google Books</a></b>
                </p>
            </div> <!-- end column2 -->
           
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