$(document).ready(function() {
	window.history.pushState("object or string", "Title", "/aufgabe9/game");
});


function loadCreateGame(url){
	console.log("load content from" + url);
	$.get(url, function(data) {
		$('#pageContent').html(data);
	});
}


function checkCreateForm(url){
	var player1Name = document.getElementById("player1Name");
	var player1Email = document.getElementById("player1Email");
	var player2Name = document.getElementById("player2Name");
	var player2Email = document.getElementById("player2Email");
	var player1Choice = document.getElementById("player1Choice");
	var player1Message = document.getElementById("player1Message");
		
	var incomplete = false;
	
	if(player1Name.value === ""){
		document.getElementById("player1NameError").innerHTML = "Bitte geben Sie Ihren Namen ein!";
		incomplete = true;
	}
	if(player1Email.value === ""){
		document.getElementById("player1EmailError").innerHTML = "Bitte geben Sie Ihre E-Mail ein!";
		incomplete = true;
	}
	else{
		var player1EmailValue = player1Email.value;
		if(!checkEmailFormat(player1EmailValue)){
			document.getElementById("player1EmailError").innerHTML = "Bitte geben Sie eine korrekte E-Mail ein!";
			incomplete = true;
		}
	}
	
	if(player2Name.value === ""){
		document.getElementById("player2NameError").innerHTML = "Bitte geben Sie den Namen Ihres Gegners ein!";
		incomplete = true;

	}
	if(player2Email.value === ""){
		document.getElementById("player2EmailError").innerHTML = "Bitte geben Sie die E-Mail Ihres Gegners ein!";
		incomplete = true;
	}
	else{
		var player2EmailValue = player2Email.value;
		if(!checkEmailFormat(player2EmailValue)){
			document.getElementById("player2EmailError").innerHTML = "Bitte geben Sie eine korrekte E-Mail ein!";
			incomplete = true;
		}
	}
	
	if(player1Choice.value === "0"){
		document.getElementById("player1ChoiceError").innerHTML = "Bitte w&auml;hlen Sie Ihre Waffe!";
		incomplete = true;
	}
	else{
		document.getElementById("player1ChoiceError").innerHTML = "";
	}
	
	if(!incomplete){
		setCookie("player1Name", player1Name.value, 5);
		setCookie("player1Email", player1Email.value, 5);
		$.post(url, {player1Name: player1Name.value, player1Email: player1Email.value, player2Name: player2Name.value, player2Email: player2Email.value, player1Choice: player1Choice.value, player1Message: player1Message.value}
		, function(data) {
			$('#pageContent').html(data);
		});
		return false;
	}else{
		return false;
	}
};

function setUpCreateGame(){
	
	var player1Name = document.getElementById("player1Name");
	var player1Email = document.getElementById("player1Email");
	var player2Name = document.getElementById("player2Name");
	var player2Email = document.getElementById("player2Email");
	var player1Choice = document.getElementById("player1Choice");
	
	player1Name.value = getCookie("player1Name");
	player1Email.value = getCookie("player1Email");
	
	player1Name.onchange = function(){
		if(player1Name.value === ""){
			document.getElementById("player1NameError").innerHTML = "Bitte geben Sie Ihren Namen ein!";
		}
		else{
			document.getElementById("player1NameError").innerHTML = "";
		}
	};
	
	player1Email.onchange = function(){
		if(player1Email.value === ""){
			document.getElementById("player1EmailError").innerHTML = "Bitte geben Sie Ihre E-Mail ein!";
		}
		else if(!checkEmailFormat(player1Email.value)){
			document.getElementById("player1EmailError").innerHTML = "Bitte geben Sie eine korrekte E-Mail ein!";
		}
		else{
			document.getElementById("player1EmailError").innerHTML = "";
		}
	};
	
	player2Name.onchange = function(){
		if(player2Name.value === ""){
			document.getElementById("player2NameError").innerHTML = "Bitte geben Sie den Namen Ihres Gegners ein!";
		}
		else{
			document.getElementById("player2NameError").innerHTML = "";
		}
	};
	
	player2Email.onchange = function(){
		if(player2Email.value === ""){
			document.getElementById("player2EmailError").innerHTML = "Bitte geben Sie die E-Mail Ihres Gegners ein!";
		}
		else if(!checkEmailFormat(player2Email.value)){
			document.getElementById("player2EmailError").innerHTML = "Bitte geben Sie eine korrekte E-Mail ein!";
		}
		else{
			document.getElementById("player2EmailError").innerHTML = "";
		}
	};
}
