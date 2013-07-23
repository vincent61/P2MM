function confirmsuppr(dico){
	if(confirm("Voulez-vous supprimer le dictionnaire" + dico + "?")){
		$.post(
			"../controleurs/dictionnaire.php",
			{
				deleteDico: dico
			},
			"update_ligne_dictionnaire", 
			"text"
		);
		function update_ligne(){
		alert(dico  +" supprimé!");
	}
	
}
}