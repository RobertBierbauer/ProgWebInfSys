/**
 * Handels the routes
 */
$(document).ready(function(){
	anchor();
});

function anchor(){
	var hashs = new Array();
	var anchor = window.location.hash;
	anchor = anchor.replace(/%23/g, "#");
	hashs = anchor.split("#");
	console.log(hashs);
	
	if(hashs.length === 1){
		$("#index").show();
		$("#create").hide();
		$("#createdGame").hide();
		$("#joinGame").hide();
		$("#result").hide();
	}
	else{
		if(hashs[1] === "create"){
			$.get("game/creategame/"+hashs[2], function(data){
				console.log(data.replaygame);
				if(data.replaygame.id !== null){
					if(hashs[3] === "player1"){
						$("#player1Name").val(data.replaygame.player1Name);
						$("#player1Email").val(data.replaygame.player1Email);
						$("#player2Name").val(data.replaygame.player2Name);
						$("#player2Email").val(data.replaygame.player2Email);
					}else if(hashs[3] === "player2"){
						$("#player2Name").val(data.replaygame.player1Name);
						$("#player2Email").val(data.replaygame.player1Email);
						$("#player1Name").val(data.replaygame.player2Name);
						$("#player1Email").val(data.replaygame.player2Email);						
					}
					window.history.pushState("object or string", "Spiel beitreten", "/aufgabe9/game#create");
				}
			});
			$("#create").show();
			$("#index").hide();
			$("#createdGame").hide();
			$("#joinGame").hide();
			$("#result").hide();
		}
		if(hashs[1] === "createdGame"){
			$("#create").hide();
			$("#index").hide();
			$("#createdGame").show();
			$("#joinGame").hide();
			$("#result").hide();
		}
		if(hashs[1] === "joinGame"){
			var test = this;
			$.get("game/joingame/"+hashs[2], function(data){
				//console.log(data);
				if(data.result){
					window.history.pushState("object or string", "Spiel beitreten", "/aufgabe9/game#viewresult#"+hashs[2]+"#player2");
					test.anchor();
				}else{
					if(data.game.player1Message !== ""){						
						$("#message").text(data.game.player1Message);
					}
					else{
						$("#message").text(data.game.player1Name + " hat dir keine Nachricht hinterlassen!");
					}
					$("#joinPlayer2Name").val(data.game.player2Name);
					$("#joinId").val(data.game.id);
					$("#create").hide();
					$("#index").hide();
					$("#createdGame").hide();
					$("#result").hide();
					window.history.pushState("object or string", "Spiel beitreten", "/aufgabe9/game#joinGame");
				}
				
			});
			
		}
		if(hashs[1] === "viewresult"){
			console.log(hashs);
			$.get("game/showviewresult/"+hashs[2], function(data){
				if(data.success){
					var winner = "";
					if(data.game.winner === 0){
						winner = "Unentschieden";
					}else if(data.game.winner === 1){
						winner = "<p>" + data.game.player1Name+" hat gewonnen!</p>";
						
					}else{
						winner = "<p>" + data.game.player2Name+" hat gewonnen!</p>";
					}
					var text = "<p>Das Spiel wurde erstellt von: "+data.game.player1Name +" mit der E-Mail: "+data.game.player1Email+"!</p>"+
					"<p>Er hat "+data.game.player2Name+" mit der E-Mail "+data.game.player2Email+" herausgefordert!</p>"+
					"<p>" + data.game.player1Name+"'s Waffe: "+data.choices[data.game.player1Choice]+"</p>"+
					"<p>" + data.game.player2Name+"'s Waffe: "+data.choices[data.game.player2Choice]+"</p>";
					if(data.game.player1Message !== ""){						
						text += "<p>Nachricht von "+data.game.player1Name+": "+data.game.player1Message+"</p>";
					}
					else{
						text += "<p>" + data.game.player1Name + " hat keine Nachricht hinterlassen</p>";
					}
					if(data.game.player2Message !== ""){						
						text += "<p>Nachricht von "+data.game.player2Name+": "+data.game.player2Message+"</p>";
					}
					else{
						text += "<p>" + data.game.player2Name + " hat keine Nachricht hinterlassen</p>";
					}
					text += "<p>Ergebnis: </p>"+winner;
					$("#resultInfo").html(text);
					$("#revancheButton").attr('onclick', 'loadCreateGame("'+data.game.id+'","'+hashs[3]+'")');
				}else{
					$("#resultError").text("Das Spiel existiert nicht!");
				}
				$("#result").show();
			});
			$("#create").hide();
			$("#index").hide();
			$("#createdGame").hide();
			$("#joinGame").hide();
			$("#result").show();
		}
	}
}

/**
 * Requests every 5 seconds the actual highscorelist from the server and prints it
 * @param url the url of the controller
 */
function getHighscoreList(url){
	setInterval(function(){ 
		$.get(url, function(data) {
			data = data.highscore;
			var table = "";			
			var key, count = 0;
			for(key in data) {
				if(count < 10){					
					if(data.hasOwnProperty(key)) {
						table += "<tr><td>"+key+"</td><td>"+data[key]+"</td></tr>";
					}
					count++;
				}
			}
			$("#tableBody").html(table);
		});   
	}, 30000);
}


function setNewWeapon(hiddenFieldName, value){
	var field = document.getElementById('' + hiddenFieldName);
	var joinString = "";
	if(hiddenFieldName === "player2Choice"){
		joinString = "Join";
		console.log(joinString);
	}
	var oldValue = field.value;
	if(oldValue != value){	
		var oldImg;
		var newImg;
		field.value = value;
		if(value === "1" || oldValue === "1" ){
			var tmpImg = document.getElementById('rockImg' + joinString);
			(value === "1") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "2" || oldValue === "2" ){
			var tmpImg = document.getElementById('scissorsImg' + joinString);
			(value === "2") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "3" || oldValue === "3" ){
			var tmpImg = document.getElementById('paperImg' + joinString);
			(value === "3") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "4" || oldValue === "4" ){
			var tmpImg = document.getElementById('lizardImg' + joinString);
			(value === "4") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "5" || oldValue === "5" ){
			var tmpImg = document.getElementById('spockImg' + joinString);
			(value === "5") ? newImg = tmpImg : oldImg = tmpImg;
		}
		
		if(oldImg !== undefined){
			oldImg.style.border = "0px";
		}
		newImg.style.border = "3px solid red";
	}
};

function checkEmailFormat(email){
	
	if(email.indexOf("@") === -1){
		return false;
	}
	else{
		email = email.substring(email.indexOf("@") + 1);
		if(email.indexOf(".") === -1){
			return false;
		}
		return true;
	}
};

function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name){
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1)
	  {
	  c_start = c_value.indexOf(c_name + "=");
	  }
	if (c_start == -1)
	  {
	  c_value = null;
	  }
	else
	  {
	  c_start = c_value.indexOf("=", c_start) + 1;
	  var c_end = c_value.indexOf(";", c_start);
	  if (c_end == -1)
	  {
	c_end = c_value.length;
	}
	c_value = unescape(c_value.substring(c_start,c_end));
	}
	return c_value;
}

