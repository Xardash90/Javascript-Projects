

const APIURL = "https://api.coincap.io/v2/assets";

const mains = document.getElementById("main");

console.log(mains);

getCryptoData(APIURL);

async function getCryptoData(url){
       const resp = await fetch(url);
    const respData = await resp.json();
	
	const coinName = respData.data[0].name;
	

	showCryptoData(respData.data);
}


async function showCryptoData(coins) {



	coins.forEach((coin) => {
	const {  name, priceUsd, changePercent24Hr  } = coin;	
	

	    const coinEl = document.createElement("div");
        coinEl.classList.add("card-container");

        coinEl.innerHTML = `
          
					<div class="card-header">
						
						<h3>${name}</h3>				
					</div>
				<div class="card-body">
							<small>${priceUsd}</small>
							<small>${changePercent24Hr}</small>
							<i class="fas fa-chart-bar"></i>
						</div>
        `;


        main.appendChild(coinEl);
	
   });
}

