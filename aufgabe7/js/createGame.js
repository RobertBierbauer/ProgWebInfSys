function checkCreateForm(){
	var player1Name = document.getElementById("player1Name");
	var player1Email = document.getElementById("player1Email");
	var player2Name = document.getElementById("player2Name");
	var player2Email = document.getElementById("player2Email");
	var player1Choice = document.getElementById("player1Choice");
	
	var incomplete = false;
	
	if(player1Name.value === ""){
		document.getElementById("player1NameError").innerHTML = "Please insert your name!";
		incomplete = true;
	}
	if(player1Email.value === ""){
		document.getElementById("player1EmailError").innerHTML = "Please insert your email!";
		incomplete = true;
	}
	else{
		var player1EmailValue = player1Email.value;
		if(!checkEmailFormat(player1EmailValue)){
			document.getElementById("player1EmailError").innerHTML = "Please insert a correct email adress!";
			incomplete = true;
		}
	}
	
	if(player2Name.value === ""){
		document.getElementById("player2NameError").innerHTML = "Please insert the name of the second player!";
		incomplete = true;

	}
	if(player2Email.value === ""){
		document.getElementById("player2EmailError").innerHTML = "Please insert the email of the second player!";
		incomplete = true;
	}
	else{
		var player2EmailValue = player2Email.value;
		if(!checkEmailFormat(player2EmailValue)){
			document.getElementById("player2EmailError").innerHTML = "Please insert a correct email adress!";
			incomplete = true;
		}
	}
	
	if(player1Choice.value === "0"){
		document.getElementById("player1ChoiceError").innerHTML = "Please select a weapon!";
		incomplete = true;
	}
	else{
		document.getElementById("player1ChoiceError").innerHTML = "";
	}
	
	if(incomplete){
		return false;
	}
	
	setCookie("player1Name", player1Name.value, 5);
	setCookie("player1Email", player1Email.value, 5);
	return true;
};

function setUpCreateGame(){
	
	var player1Name = document.getElementById("player1Name");
	var player1Email = document.getElementById("player1Email");
	var player2Name = document.getElementById("player2Name");
	var player2Email = document.getElementById("player2Email");
	var player1Choice = document.getElementById("player1Choice");
	
	console.log(getCookie("player1Name"));
	player1Name.value = getCookie("player1Name");
	player1Email.value = getCookie("player1Email");
	
	player1Name.onchange = function(){
		if(player1Name.value === ""){
			document.getElementById("player1NameError").innerHTML = "Please insert your name!";
		}
		else{
			document.getElementById("player1NameError").innerHTML = "";
		}
	};
	
	player1Email.onchange = function(){
		if(player1Email.value === ""){
			document.getElementById("player1EmailError").innerHTML = "Please insert your email!";
		}
		else if(!checkEmailFormat(player1Email.value)){
			document.getElementById("player1EmailError").innerHTML = "Please insert a correct email!";
		}
		else{
			document.getElementById("player1EmailError").innerHTML = "";
		}
	};
	
	player2Name.onchange = function(){
		if(player2Name.value === ""){
			document.getElementById("player2NameError").innerHTML = "Please insert the name of the second player!";
		}
		else{
			document.getElementById("player2NameError").innerHTML = "";
		}
	};
	
	player2Email.onchange = function(){
		if(player2Email.value === ""){
			document.getElementById("player2EmailError").innerHTML = "Please insert the email of the second player!";
		}
		else if(!checkEmailFormat(player2Email.value)){
			document.getElementById("player2EmailError").innerHTML = "Please insert a correct email!";
		}
		else{
			document.getElementById("player2EmailError").innerHTML = "";
		}
	};
}
