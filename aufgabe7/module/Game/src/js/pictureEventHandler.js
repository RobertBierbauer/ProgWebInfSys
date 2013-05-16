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