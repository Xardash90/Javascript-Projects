
const poke_container = document.getElementById("poke_container");
const pokemons_number = 150;



// Async Funktion fetch Pokemon --> holen ALLER Pokemon
const fetchPokemons = async () => {
	for(let i = 1; i <= pokemons_number; i++) {
		await getPokemon(i);
	}
}


//Async Funktion getPokemon() zum holen der Daten und umwandeln in json
const getPokemon = async id => {
	//poke api in variable url
	const url = `https://pokeapi.co/api/v2/pokemon/${id}`;
	
	//variable res für funktion fetch --> await immer bei async functions! 
	const res = await fetch(url);
	const pokemon = await res.json();
	createPokemonCard(pokemon);
}

fetchPokemons();

function createPokemonCard(pokemon){
	const pokemonEl = document.createElement('div');
	pokemonEl.classList.add('pokemon');
	
	const name = pokemon.name[0].toUpperCase() + pokemon.name.slice(1);
	
	const pokeInnerHTML = `
		<div class="img-container">

		</div>
		${name}
	`;
	
	pokemonEl.innerHTML = pokeInnerHTML;
	
	poke_container.appendChild(pokemonEl);
}

