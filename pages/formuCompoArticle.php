<?php
  session_start();
  include("../includes/inclEntete-auth.php");
  
  #Bandeau 
  echo "<div id='header'>
		 <div id='bandeau'>
		   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
		   <p id='membres'>Administration | Création</p>
		 </div>
	  </div>"; 
  
  
  echo" 
        <form id='compo' action='../pages/compo.php' method='POST' enctype='multipart/form-data' style='margin-top: 8%'>
		  <h1 style='text-align:center'>Création d'article</h1>
		  
		  <p><label for='titre'>Titre</label></p>
		  <input type='text' id='titre' name='titre'/>

		  <p><label for='chapeau'>Chapeau</label></p>
		  <textarea rows='4' cols='40' id='chapeau' name='chapeau'></textarea>
		  
		  <p><label for='photo'> Photo </label></p>
		  <input type='file' id='photo' name='photo' />
		  
		  <div id ='compoParag'>
		  <p><label for ='parag1'> Paragraphe 1 </label></p>
		  <textarea  rows='25' cols='40' id='parag1' name='parag1'></textarea>
		  <input class='ajouter' type='button' name='ajoutParag' value='Ajouter' onClick='ajouterParag()'/>
		  </div>	
			
		  <p><label for ='motsCles'> Mots Clés </label></p>
		  <textarea  rows='5' cols='30' id='motsCles' name='motsCles'></textarea>
		  
		  <p><label for='auteur'> Auteur </label></p>
		  <input type ='text' id='auteur' name='auteur' />
		  
		  <p><input type='submit' value='Aperçu' id='compoSubmit' name='validation' /></p>  
		  
		</form>
  ";
?>