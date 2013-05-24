

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
	
	var id = $("#id").val();
	
	if(incomplete){
		return false;
	}else{		
		$.post(url, {id: id, player2Choice: player2Choice.value}
		, function(data) {
			console.log(data);
			$("#pageContent").html(data);
		});
		return false;
	}
	
	
};

