function checkSelectJoinForm(){
	var id = document.getElementById("id");	
	var incomplete = false;
	
	if(id.value === ""){
		document.getElementById("idError").innerHTML = "Please insert the ID of the game!";
		incomplete = true;
	}
	else{
		var idValue = id.value;
		if(idValue.length !== 40){
			document.getElementById("idError").innerHTML = "The ID is not correct!";
			incomplete = true;
		}
	}
	if(incomplete){
		return false;
	}
	
	return true;
};

function setUpSelectJoinGame(){
	var id = document.getElementById("id");	
	
	id.onchange = function(){		
		if(id.value === ""){
			document.getElementById("idError").innerHTML = "Please insert the ID of the game!";
		}
		else{
			var idValue = id.value;
			if(idValue.length !== 40){
				document.getElementById("idError").innerHTML = "The ID is not correct!";
			}
			else{
				document.getElementById("idError").innerHTML = "";
			}
		}
	};
}
