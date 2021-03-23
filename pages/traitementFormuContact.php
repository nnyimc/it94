<?php
  session_start();
  if(isset($_POST['submit'])){
	#connexion au serveur
    require("connexionServMySQL.php");
	
	$co = connexion();
    $sql1 = "USE it94;";
    $req1 = mysqli_query($co, $sql2) or
	die ("Erreur lors de la sélection de la base de données.");		  
  
    
	#remplissage de la table contacts
	require("remplirContacts.php");
	 remplirContacts();
	echo "<p>Nous vous confirmons la bonne prise en compte de votre demande.<p>";
    echo "<p>Vos coordonnées on bien été enregistrées.</p>";
	echo "<p>Vous pouvez poursuivre votre navigation <a href='http://localhost:8888/it94v4.2/html/'> ici. </a></p>";	
	
	}
  session_destroy();
?>