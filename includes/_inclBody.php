  <body>
    
    <div id="header">
	  <div id="bandeau">
	    <a href="../html/" class="lienlogo"><img id="logo" src="../images/insert-tech94.png" width="200pt" height="67pt" alt="Insert-Tech 94"/></a>
	    <span>
          <a href="#formulaire"><input class="contactBandeau" type="button" onclick="return contactOuvert()" value="Contactez-nous"/></a>
	    </span> 
	   </div>
	</div>

    <div id="main">
	<!-- Image de couverture-->
	  <div id="couverture">
	    <img id="illustration" src="" alt="Insert-Tech 94" width="100%" height="100%"/>
	  </div>

	<!--Menu et rubriques principales-->
	  <div id="menu">
		
		<div class="rubs pt2">
		  <h2>Objectifs</h2>
		  <ul class="items">		 
		    <li>Formation et redynamisation:
		      <ul class="sousitems">
		       <li>Des salariés précaires</li>
		       <li>Des personnes en difficulté d’emploi</li>
			   <li>Des jeunes sans compétence</li>
		     </ul>
		   </li>
		   <li>Ateliers à vocation populaire visant à:
		     <ul class="sousitems">
			   <li>Mettre en place des structures de recyclage</li>
			   <li>Reconditionner le matériel dit obsolète</li>
			   <li>Inclure des seniors et personnes à faible revenu</li>
			 </ul>
		   </li>
		 </ul>
	    </div>
		
		<div class="rubs pt1">
	     <h2>Généralités</h2>
		 <ul class="items">
		   <li>Association de Démocratisation de l'Informatique</li>
		   <li>Fondée en 2009</li>
		   <li>Basée en Île-de-France, dans le Val-de-Marne (94)</li>
		   <li>Constituée de 20 membres</li>
		 </ul>
	    </div>
		
		<div class="rubs pt1">
		 <h2>Domaines d'action</h2>
		 <ul class="items">
		   <li>Technologies de l'Information et de la Communication</li>
		   <li>Formation, Accompagnement et Aide au retour à l'Emploi</li>
		   <li>Interventions sociales</li>
		 </ul>
	    </div>
		
		<div id="container1">
		</div>
	  </div>
	</div>
	
	<div id="formulaire">
	  <button id="fermeture" onclick="return contactFerme()">X</button>
	  <form id="formulContact" name="formuContact" method="POST" onsubmit="return verif()" action="../pages/traitementFormuContact.php">
		<div id="formuTitre">
		  <h2> Prenez contact avec Insert-Tech 94: </h2>
		</div>
		<div id="formuIdentite">
		    <label for="nom">Nom</label>
			<input class="error" id="nom" name="nom" placeholder="Votre nom..." type="text" maxlength="35"/>
			<span id="errdiv_nom"></span>
			
			<label for="prenom">Prénom</label>
			<input class="error" id="prenom" name="prenom" placeholder="Votre prénom..." type="text" maxlength="25"/>
			<span id="errdiv_prenom"></span>
	   </div>
		<div id="formuCoordonnees">
		    <label for="societe">Sociéte</label>
			<input class="error" id="societe" name="societe" placeholder="Votre société..." type="text" maxlength="25" />
		    <span id="errdiv_societe"></span>
			
		    <label for="telephone">Téléphone</label>
			<input class="error" id="telephone" name="telephone" placeholder="Votre numéro..." type="text" maxlength="25"/>
			<span id="errdiv_telephone"></span>
			
			<label for="adressemail">E-mail</label>
			<input class="error" id="adressemail" name="adressemail" placeholder="Votre mail..." type="text" maxlength="40">
			<span id="errdiv_adressemail"></span>
		</div>
		<div id="formuMessage">
		    <label for="message">Message</label>
		    <textarea class="error" id="message" name="message" placeholder="Votre message..." rows="12" cols="40" maxlength="500"></textarea>
			<span class="errdiv_message"></span>
	    </div>
	    <div id="formuSubmit">
		    <input id="submit" name="submit" type="submit" value="Envoyer"/>
	    </div>
	    <div id="container3">
		</div>
	  </form>
	</div>
    