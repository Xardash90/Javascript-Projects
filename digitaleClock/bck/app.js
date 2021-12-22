function startTime() {
	let day = new Date(); 
	let hour = day.getHours();
	let minutes = day.getMinutes();
	let seconds = day.getSeconds();
	
	minutes = checkTime(minutes);
	seconds = checkTime(seconds);
	
	document.getElementById("clock").innerHTML = hour + ":" + minutes + ":" + seconds;
	let t = setInterval(startTime, 1000);
	
}	
	function checkTime(i) {
		if (i < 10) {
		i = "0" + i;
		}
		return i; 
	}
	
	
	
