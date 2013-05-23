

function checkJoinForm(url){
	
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
	}else{
		
		$.post(url, {id: 'cf4ade46cc4c0d28d7d2d38578475b65f428dcbd', player2Choice: player2Choice.value}
		, function(data) {
			console.log(data);
		});
	}
	
	
};

