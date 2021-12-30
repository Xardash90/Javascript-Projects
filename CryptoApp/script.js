

const APIURL = "https://api.coincap.io/v2/assets";

const mains = document.getElementById("main");



getCryptoData(APIURL);

async function getCryptoData(url){
       const resp = await fetch(url);
    const respData = await resp.json();
	
	const coinName = respData.data[0].name;
	
	console.log(respData.data)
	showCryptoData(respData.data);
}



async function showCryptoData(coins) {



	coins.forEach((coin) => {
	const { rank, symbol, name, priceUsd, changePercent24Hr  } = coin;	
	

	    const coinEl = document.createElement("div");
        coinEl.classList.add("card-container");

        coinEl.innerHTML = `
          
					<div class="card-header">
					<small>Rank: ${ rank}</small> 
						<h3>${name}</h3>				
					</div>
				<div class="card-body">
							<p>${Math.round(priceUsd * 100) / 100} $ <small &bnsp;> ${Math.round(changePercent24Hr * 100) / 100} %</small></p>
				
							<i class="fas fa-chart-bar"></i>
						</div>
        `;


        main.appendChild(coinEl);
	
   });
}

