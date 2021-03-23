var i = 0;
function ajouterParag() {
	if (i < 3 ) {
	    var paragraphes = ""; 
		paragraphes = ["Paragraphe 2", "Paragraphe 3", "Paragraphe 4"];
		
		var etiquette = document.createElement("label");
		  etiquette.setAttribute("for", paragraphes[i]);
		  etiquette.innerHTML = paragraphes[i];
		  document.getElementById("compoParag").appendChild(etiquette);
		  
		
		var parags ="";
		parags = ["parag2", "parag3", "parag4"];
		
		var zoneTexte = document.createElement("textarea");
	      zoneTexte.name = parags[i];
		  zoneTexte.maxLength = 2000;
		  zoneTexte.cols = 50;
		  zoneTexte.rows = 20;
		  zoneTexte.setAttribute("id", parags[i]);
		  document.getElementById("compoParag").appendChild(zoneTexte);
     	  
		var bouton = document.createElement("input"); 
           bouton.setAttribute("onClick", "ajouterParag()");
           bouton.setAttribute("type", "button");
           bouton.setAttribute("value", "Ajouter");		   
		  document.getElementById("compoParag").appendChild(bouton);
	      
		  i++;
		    console.log(i);
		
	  } if  (i === 3) {
		  bouton.style.display = 'none';
	  }
}