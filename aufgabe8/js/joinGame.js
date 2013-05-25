

function checkJoinForm(url){
	
	var player2Choice = document.getElementById("player2Choice");
	var player2Message = document.getElementById("player2Message");
	
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
		$.post(url, {id: id, player2Choice: player2Choice.value, player2Message: player2Message.value}
		, function(data) {
			console.log(data);
			$("#pageContent").html(data);
		});
		return false;
	}
	
	
};

