//Fonction permettant l'affichage de la div formulaire
function contactOuvert(){
	var div = document.getElementById("formulaire");
	//Si le style de la div cachée par défaut est différent de block
    if (div.style.display !== "block") {
		//le style sera changé en block
        div.style.display = "block";
    }
}

//Fonction permettant la fermeture de la div formulaire et la suppression des données renseignées dans le formulaire
function contactFerme(){
	var div = document.getElementById("formulaire");
	var formulaire = document.getElementById("formulContact");
	//Si le style de la div est différent de caché
    if (div.style.display !== "none") {
		// le style sera changé en caché
        div.style.display = "none";
    }
	//Réinitialisation automatique du formulaire
	formulaire.reset();
}



//Fonction qui reçoit comme argument une reg exp à comparer à une valeur de champ
function isRegexValid(regex, value){
	//si le test de la valeur est OK 
	if (regex.test(value)){
	  //retourner true
	  return true;
	  //sinon
	} else {
      // retourner false
	  return false;
	}
}



/*Fonction qui reçoit comme arguments l'identifiant du champ et le message d'erreur associé. 
La fonction affiche le message d'erreur et modifie le style du champ erronné*/
function showError(id, msg){
  //modification du style du champ impacté
  document.getElementById(id).style.border = "2pt solid purple";
  //insertion du message d'erreur  à l'intérieur de la div
  document.getElementById("errdiv_" + id).innerHTML = msg;
  //modification du style du message d'erreur placé dans la div
  document.getElementById("errdiv_" + id).style.display = "inline-block";		
}


/*Fonction qui reçoit comme arguments l'identifiant du champ, l'expression regulière de référence et le message d'erreur*/
function validate (id, regex, msg){
    if (isRegexValid(regex, document.getElementById(id).value) == false){
		showError(id, msg);
		return false;
	}
    document.getElementById(id).style.border = "";
    document.getElementById("errdiv_" + id).style.display = "none";
    return true;
}


function verif() {
	
	var validations = {
		nom: { regex: /^[a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff][-a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]*[a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]$/, msg: "Veuillez ne pas inclure d'espaces ou de chiffres." },
		prenom: { regex: /^[a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff][-a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]*[a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]$/, msg: "Veuillez ne pas inclure d'espaces ou de chiffres." },
		societe: { regex: /^[a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff][-a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]*[a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]$/, msg: "Remplacez les espaces par des tirets." },
		telephone: { regex: /^(\+)?([0-9](\.)*(-)*(\s)*)+$/, msg: "Veuillez ne pas inclure de lettres." },
		adressemail: { regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z.]{2,9}$/, msg: "Veuillez inclure votre adresse mail !" },
		message: { regex: /^[a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff][-a-zA-Z\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff\s\(\)\.,;!\?\[\]]*[\s\.!\?]$/, msg: "Veuillez indiquer votre message !" }
	}
	
	for (var champ in validations) {
		if(validate(champ, validations[champ].regex, validations[champ].msg) == false){
			return false;
		}
	}
	return true;
}
