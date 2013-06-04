/**
 * Handels the routes
 */
$(document).ready(function(){
	anchor();
	$(window).on("hashchange", function(){
		anchor();
	});
});

function anchor(){
	console.log("test");
	var hashs = new Array();
	var anchor = window.location.hash;
	hashs = anchor.split("#");
	console.log(hashs);
	
	if(hashs[1] === ''){
		$("#index").show();
		$("#create").hide();
		$("#createdGame").hide();
		$("#joinGame").hide();
		$("#result").hide();
	}
	if(hashs[1] === "create"){
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
		$.get("game/joingame/"+hashs[2], function(data){
			//console.log(data);
			$("#message").text(data.game.player1Message);
			$("#joinPlayer2Name").val(data.game.player2Name);
			$("#joinId").val(data.game.id);
		});
		$("#create").hide();
		$("#index").hide();
		$("#createdGame").hide();
		$("#result").hide();
		window.history.pushState("object or string", "Spiel beitreten", "/aufgabe9/game#joinGame");
	}
	if(hashs[1] === "viewresult"){
		$("#create").hide();
		$("#index").hide();
		$("#createdGame").hide();
		$("#joinGame").hide();
		$("#result").show();
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

