

const APIURL = "https://api.coincap.io/v2/assets";

const main = document.getElementById("main")


getCryptoData(APIURL);

async function getCryptoData(url){
    const resp = await fetch(url);
    const respData = await resp.json();
	
	const coinName = respData.data[0].name;
	
	console.log(respData);
	showCryptoData(respData.results);
}


async function showCryptoData(coins) {


	coins.forEach((coin) => {
	const { id, symbol, name, priceUsd, changePercent24Hr } = coin;	
	
	    const coinEl = document.createElement("div");
        coinEl.classList.add("card-container");

        coinEl.innerHTML = `
           <div class="card-header">
						<img src="crypto.png" />
						<h3>Bitcoin</h3>				
					</div>
						<div class="card-body">
							<small>47700,00 $</small>
							<small>6.6%</small>
							<i class="fas fa-chart-bar"></i>
						</div>
        `;
		console.log(coinEl);

        main.appendChild(coinEl);
	
   });
}

