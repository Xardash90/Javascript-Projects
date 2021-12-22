
	
	function userInput(input) {
		document.getElementById("resultArea").innerHTML += input;
	}
	
	function countResult() {
		let inputField = document.getElementById("resultArea");
		let result = eval(inputField.innerHTML);
		inputField.innerHTML = result;
	}
	
	function deleteInput() {
		let inputField = document.getElementById("resultArea");
		inputField.innerHTML = inputField.innerHTML.slice(0, -1);
		
	}
	
	function resetInput() {
		let inputField = document.getElementById("resultArea");
		inputField.innerHTML = "";
		
	}
	
