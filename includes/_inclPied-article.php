    <!-- Formulaire de contact-->
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

	
	<div id="contact">
		  <div class="siege">
		    <h2>Siège social</h2>
		    <p class="adresse">
		     5 allée
		    </p>
			<p class="adresse">
			Jean Sébastien Bach
			</p>
		    <p class="adresse">
		     94140 Alfortville
		    </p>
	      </div>
		  
		  <div class="coordonnees">
		    <h2>Coordonnées</h2>
			<p>06 65 01 92 62</p>
			<h3>Horaires</h3>
			<p>Lundi - Vendredi</p>
			<p>de 09h à 17h</p>
	      </div>
		  
		  <div class="mentions">
		    <h2>Mentions</h2>
			<p><a href="#">Crédits</a></p>
			<p><a href="#">Conditions</a></p>
	      </div>
		  
		  <div class="boutonContact">
			<a href="#formulaire"><input id="ancreContact" type="button" onclick="return contactOuvert()" value="Contactez-nous"/></a>
	      </div>

		<div id="container2">
		</div>
	</div>
	
	
  </body>
</html>
    