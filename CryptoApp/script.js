
const APIKEY = "ec4c7048-55d6-495a-bbdc-dcd2f7cadd23";
const APIURL = "https://api.coincap.io/v2/assets/";

const mains = document.getElementById("main");



getCryptoData(APIURL);

async function getCryptoData(url){
       const resp = await fetch(url);
    const respData = await resp.json();
	
	const coinName = respData.data[0].name;
	

	showCryptoData(respData.data);
}



async function showCryptoData(coins) {

		
	coins.forEach((coin) => {
		
	const { rank, symbol, name, priceUsd, changePercent24Hr  } = coin;	
	
	changePercent = Math.round(changePercent24Hr * 100) / 100;
	changePrice = Math.round(priceUsd * 100) / 100;
	
	if (rank <= 5) {
	let icon =	document.getElementById('icon');
	// icon.style.add
	// icon.style.color = "yellow";
	}
	
	
	

	
	    const coinEl = document.createElement("div");
        coinEl.classList.add("card-container");

        coinEl.innerHTML = `
          
					<div class="card-header">
					<small class="rank"><i id="icon" class="fa fa-star"  style="font-size:15px;color:white"></i>   Rank: ${rank}</small> 
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

// function hightlightPercentage(percent) {
		
	// if (percent >= 0) {
		// return "green";
	// } else {
		// return "red";
	// }
// }













