

function checkJoinForm(){
	
	var player2Choice = document.getElementById("player2Choice");
	
	var incomplete = false;
	
	if(player2Choice.value === "0"){
		document.getElementById("player2ChoiceError").innerHTML = "Please select a weapon!";
		incomplete = true;
	}
	else{
		document.getElementById("player2ChoiceError").innerHTML = "";
	}
	
	if(incomplete){
		return false;
	}
	
	return true;
};

