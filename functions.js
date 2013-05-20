//On enlève les espaces avant et après une chaîne de caractères
function trim(str) {
    return String(str).replace(/^\s*/,'').replace(/\s*$/,'');
}

//Vérification si l'un des radiobuttons est "checked"
function checkRadioButton(CheckButtonsGroup){
	var check = false;
	
	var lgth = CheckButtonsGroup.length;
	// On parcours les radioButtons afin de vérifier si l'un d'eux est à l'état "checked"
	for (var i=0;i<lgth;i++){
		if (CheckButtonsGroup[i].checked){
			check = true;
		}
	}
	return check;
}