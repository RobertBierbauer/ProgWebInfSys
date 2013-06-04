function checkJoinForm(url){
	var player2Name = document.getElementById("joinPlayer2Name");
	var player2Choice = document.getElementById("player2Choice");
	var player2Message = document.getElementById("player2Message");
	
	var incomplete = false;
	
	if(player2Name.value === ""){
		document.getElementById("joinPlayer2NameError").innerHTML = "Bitte geben Sie Ihren Namen ein!";
		incomplete = true;
	}
	else{
		document.getElementById("joinPlayer2NameError").innerHTML = "";
	}
	
	if(player2Choice.value === "0"){
		document.getElementById("player2ChoiceError").innerHTML = "Bitte w&auml;hlen Sie Ihre Waffe!";
		incomplete = true;
	}
	else{
		document.getElementById("player2ChoiceError").innerHTML = "";
	}
	
	var id = $("#joinId").val();
	
	if(incomplete){
		return false;
	}else{		
		$.post(url, {id: id, player2Name: player2Name.value, player2Choice: player2Choice.value, player2Message: player2Message.value}, function(data) {
			console.log(data);
			
			
			window.history.pushState("object or string", "Ergebnis", "game#viewresult#"+data.game.id+"#player2");
			anchor();
		}).error(function(data){
			console.log("Fehler");
			console.log(data);
		});
		return false;
	}
	
	
};

function setUpJoinGame(){
	var player2Name = document.getElementById("joinPlayer2Name");

	player2Name.onchange = function(){
		if(player2Name.value === ""){
			document.getElementById("joinPlayer2NameError").innerHTML = "Bitte geben Sie Ihren Namen ein!";
		}
		else{
			document.getElementById("joinPlayer2NameError").innerHTML = "";
		}
	};


	$("#rockImgJoin").hover(
		function(){
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Stein zerquetscht Echse"));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Stein schleift Schere"));
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Papier bedeckt Stein"));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Spock verdampft Stein"));
		},
		function(){
			$("#joinWeaponDescription").empty();
		}
	);

	$("#scissorsImgJoin").hover(
		function(){
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Schere schneidet Papier"));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Schere k&ouml;pft Echse"));
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Spock zertr&uuml;mmert Schere"));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Stein schleift Schere"));
		},
		function(){
			$("#joinWeaponDescription").empty();
		}
	);

	$("#paperImgJoin").hover(
		function(){
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Papier bedeckt Stein"));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Papier widerlegt Spock"));
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Schere schneidet Papier"));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Echse frisst Papier"));
		},
		function(){
			$("#joinWeaponDescription").empty();
		}
	);

	$("#lizardImgJoin").hover(
		function(){
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Echse vergiftet Spock"));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Echse frisst Papier"));
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Stein zerquetscht Echse"));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Schere k&ouml;pft Echse"));
		},
		function(){
			$("#joinWeaponDescription").empty();
		}
	);

	$("#spockImgJoin").hover(
		function(){
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Spock zertr&uuml;mmert Schere"));
			$("#joinWeaponDescription ul:first-child").append($('<li>').append("Spock verdampft Stein"));
			$("#joinWeaponDescription").append($('<ul>'));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Echse vergiftet Spock"));
			$("#joinWeaponDescription ul:last-child").append($('<li>').append("Papier widerlegt Spock"));
		},
		function(){
			$("#joinWeaponDescription").empty();
		}
	);
};