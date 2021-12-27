
document.addEventListener("DOMContentLoaded", () => {
	

const APIURL = "https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=04c35731a5ee918f014970082a0088b1&page=1&language=de";
const APIURL2 = "https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=04c35731a5ee918f014970082a0088b1&language=de&page=";
const IMGPATH = "https://image.tmdb.org/t/p/w1280";
const SEARCHAPI = "https://api.themoviedb.org/3/search/movie?&api_key=04c35731a5ee918f014970082a0088b1&query=";
const LANGAPI = "&language=de";
let nextPageCounter = 1;


const main = document.getElementById("main");
const form = document.getElementById("form");
const search = document.getElementById("search");
const nextButton = document.getElementById("nextSite");
const lastButton = document.getElementById("lastSite");
const bottomNextButton = document.getElementById("bottomNextSite");
const bottomLastButton = document.getElementById("bottomLastSite");

// initially get fav movies
getMovies(APIURL);
HeaderButtons();
BottomButtons();

async function getMovies(url) {
    const resp = await fetch(url);
    const respData = await resp.json();

    console.log(respData);

    showMovies(respData.results);
}



function showMovies(movies) {
    // clear main
    main.innerHTML = "";

    movies.forEach((movie) => {
        const { poster_path, title, vote_average, overview } = movie;

        const movieEl = document.createElement("div");
        movieEl.classList.add("movie");

        movieEl.innerHTML = `
            <img
                src="${IMGPATH + poster_path}"
                alt="${title}"
            />
            <div class="movie-info">
                <h3>${title}</h3>
                <span class="${getClassByRate(
                    vote_average
                )}">${vote_average}</span>
            </div>
            <div class="overview">
                <h3>Handlung:</h3>
                ${overview}
            </div>
        `;

        main.appendChild(movieEl);
    });
}

function getClassByRate(vote) {
    if (vote >= 8) {
        return "green";
    } else if (vote >= 5) {
        return "orange";
    } else {
        return "red";
    }
}

form.addEventListener("submit", (e) => {
    e.preventDefault();

    const searchTerm = search.value;

    if (searchTerm) {
        getMovies(SEARCHAPI + searchTerm + LANGAPI);

    
    }
	else if (searchTerm == "") {
		getMovies(APIURL);
	}
});


function HeaderButtons() {		
nextButton.addEventListener("click", (e) => {
	e.preventDefault();
	nextPageCounter++;
	getMovies(APIURL2 + nextPageCounter);
	console.log(nextPageCounter);
	
})
lastButton.addEventListener("click", (e) => {
	e.preventDefault();
	if(nextPageCounter == 1){
		nextPageCounter = 1;
		getMovies(APIURL2 + nextPageCounter);	
	} else {
		nextPageCounter--;
		getMovies(APIURL2 + nextPageCounter);
	  }	
	 })

}

function BottomButtons() {		
bottomNextButton.addEventListener("click", (e) => {
	e.preventDefault();
	nextPageCounter++;
	getMovies(APIURL2 + nextPageCounter);
	console.log(nextPageCounter);
	
})
bottomLastButton.addEventListener("click", (e) => {
	e.preventDefault();
	if(nextPageCounter == 1){
		nextPageCounter = 1;
		getMovies(APIURL2 + nextPageCounter);	
	} else {
		nextPageCounter--;
		getMovies(APIURL2 + nextPageCounter);
	  }	
	 })

}



})
