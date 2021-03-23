function contactOuvert(){
	var div = document.getElementById("formulaire");
    if (div.style.display !== "block") {
        div.style.display = "block";
    }
}

function contactFerme(){
	var div = document.getElementById("formulaire");
	var formulaire = document.getElementById("formulContact");
    if (div.style.display !== "none") {
        div.style.display = "none";
    }
	formulaire.reset();
}

function verif() {
	//Initialisation des variables qui correspondent aux champs du formulaire
    var nom = document.getElementById("nom").value;
	//Regexp : la valeur du champ doit être composée de lettres et de tirets uniquement
	var rexnom = /^[a-zA-Z][-a-zA-Z]*[a-zA-Z]$/;
	 
	var prenom = document.getElementById("prenom").value;
	//Regexp : la valeur du champ doit être composée de lettres et de tirets uniquement
	var rexprenom = /^[a-zA-Z][-a-zA-Z]*[a-zA-Z]$/;
    
	var societe = document.getElementById("societe").value;
	var rexsociete = /^[a-zA-Z0-9][-a-zA-Z0-9]*[a-zA-Z0-9]$/;
	
	var telephone = document.getElementById("telephone").value;
	//Regexp : la valeur du champ peut commencer par un +, elle est composée de chiffres séparés par des espaces, des points ou des tirets.
	var rextelephone = /^(\+)?([0-9](\.)*(-)*(\s)*)+$/;
	
	var adressemail = document.getElementById("adressemail").value;
	//Regexp : la valeur du champ doit avoir le format d'un mail
	var rexadressemail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z.]{2,9}$/;
	/*Un mail commence par une lettre ou un signe ._-\* qui peuvent se répeter, il contient un @ suivi d'au moins
	2 lettres ou signes suivi d'un point ou une serie de lettres séparées d'un point */
	
	var message = document.getElementById("message").value;
	
	//Variables liées aux css des messages d'erreur
	var errdiv = document.getElementsByClassName("errdiv");
	var errors = document.getElementsByClassName("error");
		
	//Contrôleur nom qui indique 1 en cas d'anomalie
		var ctrlrnom = 0;
		if (nom.trim() === " ") {
		  ctrlrnom = 1;
		} else if (nom === ""){
		  ctrlrnom = 1;
		} else if (rexnom.test(nom)){
		  ctrlrnom = 0;
		} else {
		  ctrlrnom = 1;
		}
		
		//Si le contrôleur indique 1 les messages d'erreur s'affichent
		if (ctrlrnom == 1){
		  errors[0].style.border= "2pt solid purple";
		  errdiv[0].style.display="inline-block";
		  //return false obligatoire pour ne pas transmettre le formulaire avant la fin de la vérification.
		  return false;
		 } else {
		  errors[0].style.border= "";
		  errdiv[0].style.display="none";
		}
		
		//Contrôleur prenom qui indique 1 en cas d'anomalie
		var ctrlrprenom = 0;
		if (prenom.trim() === " ") {
		  ctrlrprenom = 1;
		} else if (prenom === ""){
		  ctrlrprenom = 1;
		} else if (rexprenom.test(prenom)){
		  ctrlrprenom = 0;
		} else {
		  ctrlrprenom = 1;
		}
		
		//Si le contrôleur indique 1 les messages d'erreur s'affichent
		if (ctrlrprenom == 1){
		  errors[1].style.border= "2pt solid purple";
		  errdiv[1].style.display="inline-block";
		  //return false obligatoire pour ne pas transmettre le formulaire avant la fin de la vérification.
		  return false;
		 } else {
		  errors[1].style.border= "";
		  errdiv[1].style.display="none";
		}
		
		//Contrôleur société qui indique 1 en cas d'anomalie
		var ctrlrsociete = 0;
		if (societe.trim() === " ") {
		  ctrlrsociete = 1;
		} else if (societe === "") {
		  ctrlrsociete = 1;
		}  else if (rexsociete.test(societe)){
		  ctrlrsociete = 0;
		} else {
		  ctrlrsociete = 1;
		}
		
		//Si le contrôleur indique 1 les messages d'erreur s'affichent
		if (ctrlrsociete == 1){
		  errors[2].style.border= "2pt solid purple";
		  errdiv[2].style.display="inline-block";
		  //return false obligatoire pour ne pas transmettre le formulaire avant la fin de la vérification.
		  return false;
		 } else {
		  errors[2].style.border= "";
		  errdiv[2].style.display="none";
		}
		
		
		//Contrôleur téléphone qui indique 1 en cas d'anomalie
		var ctrlrtelephone = 0;
		if (telephone.trim() === "") {
		  ctrlrtelephone = 1;
		} else if (rextelephone.test(telephone)){
		  ctrlrtelephone = 0;
		} else {
		  ctrlrtelephone = 1;
		}
		
		//Si le contrôleur indique 1 les messages d'erreur s'affichent
		if (ctrlrtelephone == 1){
		  errors[3].style.border= "2pt solid purple";
		  errdiv[3].style.display="inline-block";
		  //return false obligatoire pour ne pas transmettre le formulaire avant la fin de la vérification.
		  return false;
		 } else {
		  errors[3].style.border= "";
		  errdiv[3].style.display="none";
		}
		
	    // Contrôleur mail affiche 1 en cas d'anomalie
		var ctrlrmail = 0;
		if (adressemail.trim() === " ") {
		  ctrlrmail = 1;
		} else if (adressemail === ""){
		  ctrlrmail = 1;
		} else if (rexadressemail.test(adressemail)){
		  ctrlrmail = 0;
		} else {
		  ctrlrmail = 1;
		}
		
		// Message d'erreur déclenché lorsque le contrôleur enregistre une anomalie
		if (ctrlrmail == 1){
		  errors[4].style.border= "2pt solid purple";
		  errdiv[4].style.display="inline-block";
		   //return false obligatoire pour ne pas transmettre le formulaire avant la fin de la vérification.
		  return false;
		} else {
		  errors[4].style.border= "";
		  errdiv[4].style.display="none";
		}
		
		// Contrôleur mail affiche 1 en cas d'anomalie
		var ctrlrmessage = 0;
        if (message === ""){
		  ctrlrmessage = 1;
		} else if (message === " "){
		  ctrlrmessage = 1;
		} else {
		  ctrlrmessage = 0;
		}
		
		// Message d'erreur déclenché lorsque le contrôleur enregistre une anomalie
		if (ctrlrmessage == 1){
		  errors[5].style.border= "2pt solid purple";
		  errdiv[5].style.display="inline-block";
		   //return false obligatoire pour ne pas transmettre le formulaire avant la fin de la vérification.
		  return false;
		} else {
		  errors[5].style.border= "";
		  errdiv[5].style.display="none";
		}
		
}
