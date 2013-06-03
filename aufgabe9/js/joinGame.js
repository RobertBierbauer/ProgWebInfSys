

function checkJoinForm(url){
	var player2Choice = document.getElementById("player2Name");
	var player2Choice = document.getElementById("player2Choice");
	var player2Message = document.getElementById("player2Message");
	
	var incomplete = false;
	
	if(player2Name.value === ""){
		document.getElementById("player2NameError").innerHTML = "Bitte geben Sie Ihren Namen ein!";
		incomplete = true;
	}
	else{
		document.getElementById("player2NameError").innerHTML = "";
	}
	
	if(player2Choice.value === "0"){
		document.getElementById("player2ChoiceError").innerHTML = "Bitte w&auml;hlen Sie Ihre Waffe!";
		incomplete = true;
	}
	else{
		document.getElementById("player2ChoiceError").innerHTML = "";
	}
	
	var id = $("#id").val();
	
	if(incomplete){
		return false;
	}else{		
		$.post(url, {id: id, player2Name: player2Name.value, player2Choice: player2Choice.value, player2Message: player2Message.value}
		, function(data) {
			console.log(data);
			$("#pageContent").html(data);
		});
		return false;
	}
	
	
};

