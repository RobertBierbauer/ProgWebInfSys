/**
 * Requests evry 5 seconds the actual highscorelist from the server and prints it
 * @param url the url of the controller
 */
function getHighscoreList(url){
	setInterval(function(){ 
		$.get(url, function(data) {
			var table = "";
			for(var i = 0; i<10; i++){
				table += "<tr><td>"+data.highscore[i][0]+"</td><td>"+data.highscore[i][1]+"</td></tr>";
			}
			$("#tableBody").html(table);
		});   
	}, 5000);
	
}

function setNewWeapon(hiddenFieldName, value){
	var field = document.getElementById('' + hiddenFieldName);
	var oldValue = field.value;
	if(oldValue != value){	
		var oldImg;
		var newImg;
		field.value = value;
		if(value === "1" || oldValue === "1" ){
			var tmpImg = document.getElementById('rockImg');
			(value === "1") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "2" || oldValue === "2" ){
			var tmpImg = document.getElementById('scissorsImg');
			(value === "2") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "3" || oldValue === "3" ){
			var tmpImg = document.getElementById('paperImg');
			(value === "3") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "4" || oldValue === "4" ){
			var tmpImg = document.getElementById('lizardImg');
			(value === "4") ? newImg = tmpImg : oldImg = tmpImg;
		}
		if(value === "5" || oldValue === "5" ){
			var tmpImg = document.getElementById('spockImg');
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
	console.log("dsfdsa"+value);
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

