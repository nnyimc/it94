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
		ident: { regex: /^[a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff][-a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]*[a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]$/, msg: "Veuillez remplir ce champ." },
		mdp: { regex: /^[a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff][-a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]*[a-zA-Z0-9\u00C0-\u00D6\u00D8-\u00f6\u00f8\u00ff]$/, msg: "Veuillez remplir ce champ." }
	}
	
	for (var champ in validations) {
		if(validate(champ, validations[champ].regex, validations[champ].msg) == false){
			return false;
		}
	}
	return true;
}
