//On enl�ve les espaces avant et apr�s une cha�ne de caract�res
function trim(str) {
    return String(str).replace(/^\s*/,'').replace(/\s*$/,'');
}

//V�rification si l'un des radiobuttons est "checked"
function checkRadioButton(CheckButtonsGroup){
	var check = false;
	
	var lgth = CheckButtonsGroup.length;
	// On parcours les radioButtons afin de v�rifier si l'un d'eux est � l'�tat "checked"
	for (var i=0;i<lgth;i++){
		if (CheckButtonsGroup[i].checked){
			check = true;
		}
	}
	return check;
}