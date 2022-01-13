
document.addEventListener("DOMContentLoaded", () => {
	
const APIKEY = "ec4c7048-55d6-495a-bbdc-dcd2f7cadd23";
const APIURL = "https://api.coincap.io/v2/assets/";
const SEARCHAPI = "https://api.coincap.io/v2/assets/";
const form = document.getElementById("form");



setInterval(createSnowFlake, 50);

function createSnowFlake() {
	const snow_flake = document.createElement('i');
	snow_flake.classList.add('fas');
	snow_flake.classList.add('fa-snowflake');
	snow_flake.style.left = Math.random() * window.innerWidth + 'px';
	snow_flake.style.animationDuration = Math.random() * 3 + 2 + 's';// between 2 - 5 
	snow_flake.style.opacity = Math.random();
	snow_flake.fontSize = Math.random() * 10 + 10 + 'px';
	
	document.body.prepend(snow_flake);
	
	setTimeout(() => {
		snow_flake.remove();
	}, 5000)
		
}




getCryptoData(APIURL);


async function getCryptoData(url){
    const resp = await fetch(url);
    const respData = await resp.json();
	showCryptoData(respData.data);


	const coinDatas = respData.data;
	
	for (let coinData of coinDatas) {
		
		let id = coinData.id;
		let rank = coinData.rank;
		let last24Hour = coinData.changePercent24Hr;
		let coinName = coinData.name;
		

		console.log(last24Hour);
	
		xlabels.push(coinName);
		ynumber.push(last24Hour);
	}

}




async function showCryptoData(coins) {	
	main.innerHTML = "";
	
	coins.forEach((coin) => {
		
	const { rank, symbol, name, priceUsd, changePercent24Hr  } = coin;	
	
	changePercent = Math.round(changePercent24Hr * 100) / 100;
	changePrice = Math.round(priceUsd * 100) / 100;
	
	if (rank <= 5) {
	let icon =	document.getElementById('icon');
	// icon.add.
	// icon.style.backgroundColor = "yellow";
	// console.log(icon)
	}
	
	    const coinEl = document.createElement("div");
        coinEl.classList.add("card-container");

        coinEl.innerHTML = `
          
					<div class="card-header">
					<small class="rank"><i id="icon" class="fa fa-star"  style="font-size:15px;color:"></i>   Rank: ${rank}</small> 
						<h3>${name}</h3>				
					</div>
					<div class="card-body">
					<p>${changePrice} $ <small id="percentage" &bnsp;> ${changePercent}%</small></p>
							<i class="fas fa-chart-bar"></i>
						</div>
        `;
        main.appendChild(coinEl);

   });
}






form.addEventListener("submit", (e) => {
	e.preventDefault();

		const searchTerm = search.value;

		if (searchTerm) {
			getCryptoData(SEARCHAPI + searchTerm);

		console.log(SEARCHAPI + searchTerm);
		}
		else if (searchTerm == "") {
			getCryptoData(APIURL);
		}
	});
	
	
	

// function hightlightPercentage(percent) {
		
	// if (percent >= 0) {
		// return "green";
	// } else {
		// return "red";
	// }
// }
	const xlabels = [];
	const ynumber = [];

	
// Statistic 

	chartIt() ;
	async function chartIt() {
	await getCryptoData(APIURL);
	const myChart = document.getElementById("myChart").getContext("2d");
				//Globar Options			
				//Chart.defaults.global.defaultFontFamily = 'Lato';
				//Chart.defaults.global.defaultFontSize = 18;
				//Chart.defaults.global.defaultFontColor = '#777';
			
				let massPopChart = new Chart(myChart, {

					type:'horizontalBar', // bar, horizontalBar, Pie, line, doughnut, radar, polarArea
					data:{
						labels: xlabels,
						datasets: [{
						 label: 'Crypto last 24 Hour',
							data: ynumber,
							//backgroundColor:'green'
							backgroundColor:[
							'rgb(75, 192, 192, 1.0)',							
						],
						borderWidth: 1,
						borderColor: '#777',
						hoverBorderWidth: 1,
						hoverBorderColor: '#000',
						}]
					},
					
					options:{
					
					title:{
			

						text:'Crypto last 24 Hour'
					}
					}
				});
	}
})







