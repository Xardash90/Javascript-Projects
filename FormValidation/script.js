"use strict"
document.addEventListener("DOMContentLoaded", () => {
	let usernameInput = document.getElementById('username');
	let emailInput = document.getElementById('email');
	let passwordInput = document.getElementById('password');
	let checkPasswordInput = document.getElementById('passwordCheck');
	let submitButton = document.getElementById('submit');
	let alertInfo = document.querySelectorAll(".error");

console.log(alertInfo)

	
	submitButton.addEventListener("click", (event) => {
	event.preventDefault();
	checkUserInput()
	});

		
	function checkUserInput() {	
		if (usernameInput.value == "" ) {
			alertInfo.style.display= "" ;
			
		} else {
			alertInfo.style.display= "none" ;
		} 
		
		if (emailInput.value == "" ) {
			alertInfo.style.display= "" ;
			
		} else {
			alertInfo.style.display= "none" ;
		} 
		
	}
})