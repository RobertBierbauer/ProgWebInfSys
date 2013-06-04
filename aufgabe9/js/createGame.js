function loadCreateGame(id, player){
	if(id !== undefined && player !== undefined){
		window.history.pushState("object or string", "Spiel erstellen", "#create#"+id+"#"+player);
	}else{
		window.history.pushState("object or string", "Spiel erstellen", "#create");
	}
	
	anchor();
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
			var text = "Eine E-Mail wurde an " + data.game.player2Email+ " gesendet.\nSie werden informiert, wenn " + data.game.player2Name + " die Waffe gewählt hat.";
			$("#confirm").text(text);
			window.history.pushState("object or string", "Spiel erstellen", "#createdGame");
			anchor();
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

	var hashs = new Array();
	var anchor = window.location.hash;
	hashs = anchor.split("#");
	

	if(hashs[3] === 'player2'){
		player2Name.value = getCookie("player1Name");
		player2Email.value = getCookie("player1Email");
	}else{
		player1Name.value = getCookie("player1Name");
		player1Email.value = getCookie("player1Email");
	}
	

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

	$("#rockImg").hover(
		function(){
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:first-child").append($('<li>').append("Stein zerquetscht Echse"));
			$("#weaponDescription ul:first-child").append($('<li>').append("Stein schleift Schere"));
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:last-child").append($('<li>').append("Papier bedeckt Stein"));
			$("#weaponDescription ul:last-child").append($('<li>').append("Spock verdampft Stein"));
		},
		function(){
			$("#weaponDescription").empty();
		}
	);

	$("#scissorsImg").hover(
		function(){
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:first-child").append($('<li>').append("Schere schneidet Papier"));
			$("#weaponDescription ul:first-child").append($('<li>').append("Schere k&ouml;pft Echse"));
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:last-child").append($('<li>').append("Spock zertr&uuml;mmert Schere"));
			$("#weaponDescription ul:last-child").append($('<li>').append("Stein schleift Schere"));
		},
		function(){
			$("#weaponDescription").empty();
		}
	);

	$("#paperImg").hover(
		function(){
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:first-child").append($('<li>').append("Papier bedeckt Stein"));
			$("#weaponDescription ul:first-child").append($('<li>').append("Papier widerlegt Spock"));
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:last-child").append($('<li>').append("Schere schneidet Papier"));
			$("#weaponDescription ul:last-child").append($('<li>').append("Echse frisst Papier"));
		},
		function(){
			$("#weaponDescription").empty();
		}
	);

	$("#lizardImg").hover(
		function(){
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:first-child").append($('<li>').append("Echse vergiftet Spock"));
			$("#weaponDescription ul:first-child").append($('<li>').append("Echse frisst Papier"));
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:last-child").append($('<li>').append("Stein zerquetscht Echse"));
			$("#weaponDescription ul:last-child").append($('<li>').append("Schere k&ouml;pft Echse"));
		},
		function(){
			$("#weaponDescription").empty();
		}
	);

	$("#spockImg").hover(
		function(){
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:first-child").append($('<li>').append("Spock zertr&uuml;mmert Schere"));
			$("#weaponDescription ul:first-child").append($('<li>').append("Spock verdampft Stein"));
			$("#weaponDescription").append($('<ul>'));
			$("#weaponDescription ul:last-child").append($('<li>').append("Echse vergiftet Spock"));
			$("#weaponDescription ul:last-child").append($('<li>').append("Papier widerlegt Spock"));
		},
		function(){
			$("#weaponDescription").empty();
		}
	);
}
