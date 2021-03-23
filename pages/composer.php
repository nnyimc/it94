<?php
  echo"
      
        <form id='compo' action='../pages/compo.php' method='POST' enctype='multipart/form-data'>
		
		  <p><label for='titre'>Titre</label></p>
		  <input type='text' id='titre' name='titre'/>

		  <p><label for='chapeau'>Chapeau</label></p>
		  <textarea rows='3' cols='50' id='chapeau' name='chapeau'></textarea>
		  
		  <p><label for='photo'> Photo </label></p>
		  <input type='file' id='photo' name='photo' />
		  
		  <div id ='compoParag'>
		  <p><label for ='parag1'> Paragraphe 1 </label></p>
		  <textarea  rows='20' cols='50' id='parag1' name='parag1'></textarea>
		  <input class='ajouter' type='button' name='ajoutParag' value='Ajouter' onClick='ajouterParag()'/>
		  </div>	
			
		  <p><label for ='motsCles'> Mots Clés </label></p>
		  <textarea  rows='5' cols='30' id='motsCles' name='motsCles'></textarea>
		  
		  <p><label for='auteur'> Auteur </label></p>
		  <input type ='text' id='auteur' name='auteur' />
		  
		  <p><input type='submit' value='Publier' id='compoSubmit' name='publication' /></p>  
		  
		</form>
  ";
?>