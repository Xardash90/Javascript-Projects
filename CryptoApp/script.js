

const APIURL = "https://api.coincap.io/v2/assets";


async function getCryptoData(url){
    const resp = await fetch(url,  { origin: "cors" });
    const respData = await resp.json();
	
	console.log(respData);
}

getCryptoData(APIURL);
